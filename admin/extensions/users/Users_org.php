<?php

class Users extends Database {

    private $id = null;
    private $first_name = null;
    private $last_name = null;
    private $email = null;
    private $phone = null;
    private $password = null;
    private $created_date = null;


    private $table = 'ctn_users';

    function __construct() {
        parent::__construct();
    }

    /**
     * @return User id
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @param int $p_id
     */
    public function setId($p_id) {
        $this->id = $id;
    }

    /**
     * @return string User fisrt name
     */
    public function getFirstName() {
        return $this->first_name;
    }

    /**
     * @param string $p_first_name
     */
    public function setFirstName($p_first_name) {
        $this->first_name = $p_first_name;
    }

    /**
     * @return string User last name
     */
    public function getLastName() {
        return $this->last_name;
    }

    /**
     * @param string $p_last_name
     */
    public function setLastName($p_last_name) {
        $this->last_name = $p_last_name;
    }

    /**
     * @return string User email
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     * @param string $p_email
     */
    public function setEmail($p_email) {
        $this->email = $p_email;
    }

    /**
     * @return User email
     */
    public function getPhone() {
        return $this->phone;
    }

    /**
     * @param string User phone
     */
    public function setPhone($p_phone) {
        $this->phone = $p_phone;
    }

    /**
     * @return string User password
     */
    public function getPassword() {
        return $this->password;
    }

    /**
     * @param string $p_password
     */
    public function setPassword($p_password) {
        $this->password = md5($p_password);
    }


    /**
     * @return string User password
     */
    public function getDateCreated() {
        return $this->created_date;
    }

    /**
     * @param string $p_password
     */
    public function setCreatedDate($p_created_date) {
        $this->created_date = $p_created_date;
    }

    function addUser() {
        $sql= "INSERT INTO $this->table (
                  first_name, 
                  last_name, 
                  email, 
                  phone,
                  password,
                  created_date
                ) 
                VALUES 
                (
                  '$this->first_name', 
                  '$this->last_name', 
                  '$this->email',
                  '$this->phone',
                  '$this->password', 
                  '$this->created_date'
                );";
        $this->doSql($sql);
    }

    function login($p_email, $p_password) {

        $pass = md5($p_password);
        $sql= "SELECT 
                  first_name, 
                  last_name, 
                  email, 
                  phone,
                  created_date 
                FROM $this->table 
                WHERE email = '$p_email' AND password = '$pass';";
        $row = $this->doQuery($sql);
        if($row){
            session_start();
            $_SESSION['ctn_authenticated'] = 'yes';
            $_SESSION['ctn_id']            = $row['user_id'];
            $_SESSION['ctn_first_name']    = $row['first_name'];
            $_SESSION['ctn_last_name']     = $row['last_name'];
            echo "true";
        }
        else{
            echo "false";
        }
    }


    function getAllEndpoints() {


        $sql = "SELECT 
        		  user_id,
                  first_name, 
                  last_name, 
                  email, 
                  phone,
                  created_date 
                FROM $this->table;";

        return $this->doQueryArray($sql);

    }

    function getUserInfo($user_id) {
        $sql = "SELECT * FROM ctn_users WHERE user_id = $user_id;";
        return $this->doQueryArray($sql);
    }

}