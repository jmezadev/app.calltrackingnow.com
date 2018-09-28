<?php

class Auths extends Database {

    private $id = null;
    private $auth_type = 'userpass';
    private $nonce_lifetime = null;
    private $md5_cred = null;
    private $password = null;
    private $realm = null;
    private $username = null;

    private $table = 'ps_auths';

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
     * @return string
     */
    public function getAuthType() {
        return $this->auth_type;
    }

    /**
     * @param string $auth_type
     */
    public function setAuthType($auth_type) {
        $this->auth_type = $auth_type;
    }

    /**
     * @return null
     */
    public function getNonceLifetime() {
        return $this->nonce_lifetime;
    }

    /**
     * @param null $nonce_lifetime
     */
    public function setNonceLifetime($nonce_lifetime) {
        $this->nonce_lifetime = $nonce_lifetime;
    }

    /**
     * @return null
     */
    public function getMd5Cred() {
        return $this->md5_cred;
    }

    /**
     * @param null $md5_cred
     */
    public function setMd5Cred($md5_cred) {
        $this->md5_cred = $md5_cred;
    }

    /**
     * @return null
     */
    public function getPassword() {
        return $this->password;
    }

    /**
     * @param null $password
     */
    public function setPassword($password) {
        $this->password = $password;
    }

    /**
     * @return null
     */
    public function getRealm() {
        return $this->realm;
    }

    /**
     * @param null $realm
     */
    public function setRealm($realm) {
        $this->realm = $realm;
    }

    /**
     * @return null
     */
    public function getUsername() {
        return $this->username;
    }

    /**
     * @param null $username
     */
    public function setUsername($username) {
        $this->username = $username;
    }

    function addEndpointAuths() {
        $sql
            = "INSERT INTO $this->table (
                  id, 
                  auth_type, 
                  password, 
                  username
                ) 
                VALUES 
                (
                  '$this->id', 
                  '$this->auth_type', 
                  '$this->password', 
                  '$this->username'
                );";

        //        echo $sql . '<br>';
        $this->doSql($sql);
    }

    function updateEndpointAuths() {

        $sql
            = "UPDATE $this->table SET 
                  username = '$this->username',
                  password = '$this->password'
                WHERE id = '$this->id';";

        //        echo $sql;
        $this->doSql($sql);
    }

    function deleteEndpointAuths() {
        $sql = "DELETE FROM $this->table WHERE id = '$this->id'";

        $this->doSql($sql);
    }

}