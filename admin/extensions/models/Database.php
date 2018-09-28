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
        (DEV_MODE) ? $this->mysqliConnexion() : $this->postgreConnexion();
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

        if(DEV_MODE) {

            try {

                mysqli_query($this->conn, $sql);

            } catch(mysqli_sql_exception $e) {

                echo("<p><span style='color: darkred; font-weight: bold '>Error MySQL (Code: " . $e->getCode() . "): </span>" . $e->getMessage() . "</p>");
                echo("<br>");

                echo 'No se pudo registrar la extensión.';
                die();

            }

        } else {
            $result = pg_query($this->conn, $sql);

            if (!$result) {

                $info = array(
                    'code' => 1,
                    'title' => 'Unsuccessfully!',
                    'msg' => pg_last_error($this->conn)
                );

                header('Content-Type: application/json');
                echo json_encode($info);
                exit;
            }
        }

    }

    /**
     * @param $sql
     * @return null
     */
    function doQuery($sql) {

        $resultVal = null;

        $query  = pg_query($this->conn, $sql);
        $result = pg_fetch_array($query);

        foreach($result as $val) {
            $resultVal = $val;
        }

        return $resultVal;
    }

    function doQueryArray($sql) {
        $resultVal = array();

        if(DEV_MODE) {

            $info = [];

            $query  = mysqli_query($this->conn, $sql);
//            $result = mysqli_fetch_assoc($query);

            while ($result = mysqli_fetch_array($query)) {
                $info[] = $result;
            }

            return $info;

        } else {
            $query  = pg_query($this->conn, $sql);

            if (!$query) {
                echo pg_last_error($this->conn);
                exit;
            }

            while($result = pg_fetch_assoc($query)) {
                $resultVal[] = $result;
            }

            return $resultVal;

        }
    }

}