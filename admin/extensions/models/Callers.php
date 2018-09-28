<?php

class Callers extends Database {

    private $id = '';
    private $number = '';
    private $name = '';
    private $date = '';
    private $date_updated = '';

    private $table = 'ctn_callers';

    function __construct() {
        parent::__construct();
    }

    /**
     * @return string
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId($id) {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getNumber() {
        return $this->number;
    }

    /**
     * @param string $number
     */
    public function setNumber($number) {
        $this->number = $number;
    }

    /**
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name) {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getDate() {
        return $this->date;
    }

    /**
     *
     */
    public function setDate() {
        $this->date = date("Y-m-d") . " " . date("h:i:sa");
    }

    /**
     * @param string $date_updated
     */
    public function setDateUpdated($date_updated) {
        $this->date_updated = $date_updated;
    }

    function getCallers() {

        $sql = "SELECT * FROM $this->table ORDER BY date_created ASC";
        return $this->doQueryArray($sql);

    }

}