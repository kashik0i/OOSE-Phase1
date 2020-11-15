<?php
#singleton design pattern?
class DbConnection
{
    private static $Instance;
    private $conn;
    private static $_host = 'localhost';
    private static $_username = 'root';
    private static $_password = '';
    private static $_database = 'OOSE-Phase1';

    private function __construct($servername, $username, $password, $dbname)
    {
        #try {
        #    $this->Instance = new PDO("mysql:host=$this->_host;dbname=$this->_database", $this->_username, $this->_password);
        #    echo 'Connected to database';
        #} catch (PDOException $e) {
        #    echo $e->getMessage();
        #}
        $this->conn=new mysqli($servername, $username, $password, $dbname);

    }
    
    #static?
    #private static $Instance;

    public function getConn()
    {
        return $this->conn;
    }
    public static function getInstance()
    {
        if(!DbConnection::$Instance)
        {
            DbConnection::$Instance= new DbConnection(DbConnection::$_host, DbConnection::$_username, DbConnection::$_password, DbConnection::$_database);
        }
        return DbConnection::$Instance;
    }
}
#$db = DbConnection::getInstance();


// Create connection
#$conn;
#$conn= new mysqli($servername, $username, $password, $dbname);
#
#// Check connection
#if ($conn->connect_error) {
#    die("Connection failed: " . $conn->connect_error);
#}
#echo "Connected successfully";
?>
