<?php
/**
 * Created by PhpStorm.
 * User: vivelab02
 * Date: 16/08/18
 * Time: 10:48 AM
 */

class Identify extends Database {

    private $id = null;
    private $endpoint = null;
    private $match = null;

    private $table = "ps_endpoint_id_ips";

    function __construct() {
        parent::__construct();
    }

    /**
     * @return null
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @param null $id
     */
    public function setId($id) {
        $this->id = $id;
    }

    /**
     * @return null
     */
    public function getEndpoint() {
        return $this->endpoint;
    }

    /**
     * @param null $endpoint
     */
    public function setEndpoint($endpoint) {
        $this->endpoint = $endpoint;
    }

    /**
     * @return null
     */
    public function getMatch() {
        return $this->match;
    }

    /**
     * @param null $match
     */
    public function setMatch($match) {
        $this->match = $match;
    }

    function addNewDIDEndpointIdentify() {

        $sql
            = "INSERT INTO $this->table (
                    endpoint,
                    match
                )
                VALUES 
                (
                  '$this->endpoint',
                  '$this->match'
                );";

         //echo $sql . '<br>';
         $this->doSql($sql);
    }

    function updateEndpointIdentify() {

        $sql
            = "UPDATE $this->table SET
                  match = '$this->match',
                  endpoint = '$this->id'
                WHERE id = '$this->id'";

//        echo $sql . '<br>';
         $this->doSql($sql);
    }

    function deleteEndpointIdentify(){
        $sql = "DELETE FROM $this->table WHERE endpoint = '$this->id'";

        $this->doSql($sql);
    }

}