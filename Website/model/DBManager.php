<?php
spl_autoload_register(function ($class) {
    include "{$class}.php";
});

class DBManager
{
    public $db;

    function __construct()
    {
        $configIni = parse_ini_file('static/config.ini');

        $host     = $configIni['db_host'];
        $user     = $configIni['db_user'];
        $pass     = $configIni['db_password'];
        $dbname   = $configIni['db_name'];

        try {
            $this->db = new PDO("mysql:host=$host;dbname=$dbname;port=3307", $user, $pass, array(PDO::ATTR_EMULATE_PREPARES => false, PDO::MYSQL_ATTR_DIRECT_QUERY => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        } catch (Exception $e) {
            die("Database connection Error <br>" . $e->getMessage());
        }
    }

    // Get all ASNs
    function getAllAsns()
    {
        $query = $this->db->prepare("CALL GetAllAsns");
        $query->execute();
        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    // Get ASNs By Province (2 Letter province code)
    // AB, BC, MB, NB, NL, NT, NS, NU, ON, PE, QC, SK, YT
    function GetAsnByProvince($province)
    {
        $query = $this->db->prepare("CALL GetAsnByProvince(?)");
        $query->execute(array($province));
        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    function GetLastUpdateDate()
    {
        $query = $this->db->prepare("CALL GetLastUpdateDate");
        $query->execute();
        $data = $query->fetch(PDO::FETCH_ASSOC);
        return $data;
    }
}
