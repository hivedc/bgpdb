## BGP Database
This website is a simple PHP application designed to display a database of Canadian ASNs (Autonomous System Numbers). ASNs are unique identifiers assigned to networks on the Internet. This application provides users with the ability to search and view details about different ASNs registered in Canada.

## Update
This Python script is designed to retrieve data about Canadian registered ASNs (Autonomous System Numbers) from the ARIN (American Registry for Internet Numbers) API and save it to a database. ARIN is one of the Regional Internet Registries responsible for managing IP addresses and ASNs in North America.

Requirements
To run this script, you need:

Python 3.x installed on your system.

MariaDB database server with appropriate permissions to create and modify tables.

Required Python libraries, which can be installed via pip:

Copy code
```
pip install -r requirements.txt
```

Copy content of secrets.example.json and make a file called secrets.json with your database information


Run update.py on as a cronjob
```
0 0 1 */1 * /usr/bin/python3 /home/bgpdb/bgpdbUpdate.py
```