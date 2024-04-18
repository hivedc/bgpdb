import requests
import mariadb
import sys
import time
import datetime
import json
import mmap

ARIN_ASN_API_URL = "http://whois.arin.net/rest/asn/"
ARIN_ORG_API_URL = "http://whois.arin.net/rest/org/"
BGPTOOLS_PREFIX_JSON_URL = "https://bgp.tools/table.jsonl"

secretsData = json.load(open("secrets.json", "r"))

DB_HOST = secretsData["host"]
DB_PORT = secretsData["port"]
DB_USER = secretsData["user"]
DB_PASSWORD = secretsData["password"]
DB_DATABASE = secretsData["database"]

TEMP_DIR = "Update/temp/"
BGPTOOLS_USER_AGENT = secretsData["bgpToolsContactInfo"]

def db_conn():

    try:
        mydb = mariadb.connect(
            host=DB_HOST,
            port=DB_PORT,
            user=DB_USER,
            password=DB_PASSWORD,
            database=DB_DATABASE,
        )
    except mariadb.Error as e:
        print(f"Error connecting to MariaDB Platform: {e}")
        sys.exit(1)

    cursor = mydb.cursor()
    return mydb, cursor


def getAsData(asn):

    try:

        header = {"Accept": "application/arin.whoisrws-v1+json"}

        req1 = requests.get(ARIN_ASN_API_URL + str(asn), headers=header).json()

        data = {}

        data["asn"] = asn
        data["org_id"] = req1["asn"]["orgRef"]["@handle"]
        data["name"] = req1["asn"]["orgRef"]["@name"]

        if "registrationDate" not in req1["asn"]:
            data["asn_date"] = None
        else:
            data["asn_date"] = datetime.datetime.fromisoformat(
                req1["asn"]["registrationDate"]["$"]
            )

        req2 = requests.get(ARIN_ORG_API_URL + data["org_id"], headers=header).json()

        if "registrationDate" not in req2["org"]:
            data["org_date"] = None
        else:
            data["org_date"] = datetime.datetime.fromisoformat(
                req2["org"]["registrationDate"]["$"]
            )

        data["country"] = req2["org"]["iso3166-1"]["code2"]["$"]

        if data["country"] != "CA":
            data["province"] = None
            data["city"] = None
        else:
            data["province"] = req2["org"]["iso3166-2"]["$"]
            data["city"] = req2["org"]["city"]["$"]

        return data

    except:
        return "Invalid ASN"


def insertToDb(mydb, cursor, asnList):

    sql = """
    INSERT INTO asn
    (id, asn, org_id, name, status, asn_date, org_date, province, city)
    VALUES (NULL, %d, %s, %s, %s, %s, %s, %s, %s)
    ON DUPLICATE KEY UPDATE
    id=id, asn=VALUES(asn), org_id=VALUES(org_id), name=VALUES(name), status=VALUES(status),
    asn_date=VALUES(asn_date), org_date=VALUES(org_date), province=VALUES(province),  city=VALUES(city);
    """
    cursor.executemany(sql, asnList)
    mydb.commit()


def downloadPrefixList():
    try:
        # Download new prefix list
        header = {"User-Agent": BGPTOOLS_USER_AGENT}
        req = requests.get(BGPTOOLS_PREFIX_JSON_URL, headers=header)
        open(TEMP_DIR + "prefixList.jsonl", "wb").write(req.content)
    except Exception as e:
        print(f"Error downloading file: {e}")


def checkIfAsnIsActive(asn):
    with open(TEMP_DIR + "prefixList.jsonl") as f:
        s = mmap.mmap(f.fileno(), 0, access=mmap.ACCESS_READ)
        str = '"ASN":' + asn + ","
        if s.find(bytes(str, 'utf-8')) != -1:
            return True
        else:
            return False


def main():
    mydb, cursor = db_conn()
    downloadPrefixList()

    # SQL bulk insert
    # How many asns are stored before inserting to the database
    numOfAsnsToInsert = 1

    asnList = []

    for i in range(55, 64495):
        data = getAsData(i)

        if data != "Invalid ASN" and data["country"] == "CA":

            status = checkIfAsnIsActive(str(data["asn"]))

            val = (
                int(data["asn"]),
                data["org_id"],
                data["name"],
                status,
                data["asn_date"],
                data["org_date"],
                data["province"],
                data["city"],
            )

            asnList.append(val)

            print(val)
            print

            # Bulk insert when asnList has n items
            if len(asnList) == numOfAsnsToInsert:
                insertToDb(mydb, cursor, asnList)
                asnList = []

        time.sleep(1)

    for i in range(393216, 401308):
        data = getAsData(i)

        if data != "Invalid ASN" and data["country"] == "CA":

            status = checkIfAsnIsActive(str(data["asn"]))

            val = (
                int(data["asn"]),
                data["org_id"],
                data["name"],
                status,
                data["asn_date"],
                data["org_date"],
                data["province"],
                data["city"],
            )

            asnList.append(val)

            print(val)
            print

            # Bulk insert when asnList has n items
            if len(asnList) == numOfAsnsToInsert:
                insertToDb(mydb, cursor, asnList)
                asnList = []

        time.sleep(1)

    cursor.close()
    mydb.close()


if __name__ == "__main__":
    main()


# ASN list for Canada
# https://www.whatismyip.com/asn/country/ca/

# ARIN asnames & country
# https://ftp.ripe.net/ripe/asnames/asn.txt


# ASN Blocks
# 1 - 64495       (64495) ARIN
# 131072 - 152681 (21609)
# 196608 - 216475 (19867)
# 262144 - 273820 (11676)
# 327683 - 329419 (1,736)
# 393216 - 401308 (08092) ARIN


# https://whois.ipinsight.io/countries/CA
