<?php
/**
 * Created by PhpStorm.
 * User: vivelab02
 * Date: 14/06/18
 * Time: 5:07 PM
 */

class Database {

    private $conn = null;

    function __construct() {
        $this->postgreConnexion();
    }

    /**
     * @return mysqli|null
     *
     */
    function mysqliConnexion() {

        $host     = 'localhost';
        $user     = 'jmeza';
        $password = '123456';
        $dbName   = 'asterisk_dev';
        $port     = '3306';

        $this->conn = mysqli_connect($host, $user, $password, $dbName);
        if(!$this->conn) {
            echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
            echo "errno de depuración: " . mysqli_connect_errno() . PHP_EOL;
            echo "error de depuración: " . mysqli_connect_error() . PHP_EOL;
            exit;
        }

        // Ensure reporting is setup correctly
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

        return $this->conn;
    }

    /**
     * @return null|resource
     *
     */
    function postgreConnexion() {

        $conn_string = "host=localhost port=5432 dbname=asterisk user=asterisk_user password=heyday2018";
        $this->conn = pg_connect($conn_string) or die("Can't connect to database" . pg_last_error());
        return $this->conn;
    }

    /**
     * @param $sql
     */
    function doSql($sql) {

        $result = pg_query($this->conn, $sql);

        if (!$result) {

            $info = array(
                'code' => 0,
                'msg' => "Error PostgreSQL: " . pg_last_error($this->conn)
            );
        }
        else{
            $info = array(
                'code' => 1
            );
        }

        header('Content-Type: application/json');
        echo json_encode($info);
        exit;


    }

    /**
     * @param $sql
     * @return null
     */
    function doQuery($sql) {
        
        $resultVal = null;

        $query = pg_query($this->conn, $sql);
        $result = pg_fetch_assoc ($query);

        return $result;
        exit;

    }

    function doQueryArray($sql) {
        $resultVal = array();

        $query  = pg_query($this->conn, $sql);

        while($row = pg_fetch_assoc($query)){
            $resultVal[] =  $row;
        }

        return $resultVal;

        
    }

}