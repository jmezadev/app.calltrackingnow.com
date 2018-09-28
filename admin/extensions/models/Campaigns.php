<?php

class Campaigns extends Database {

    private $id_campaign = 0;
    private $id_did = '';
    private $name = '';
    private $start_date = '';
    private $end_date = '';
    private $description = '';
    private $date = '';
    private $date_updated = '';

    private $table = 'ctn_campaigns';

    function __construct() {
        parent::__construct();
        $this->setDate();
    }

    /**
     * @param string $date
     */
    public function setDate() {
        $this->date = date("Y-m-d") . " " . date("h:i:sa");
    }

    /**
     * @return int
     */
    public function getIdCampaign() {
        return $this->id_campaign;
    }

    /**
     * @param int $id_campaign
     */
    public function setIdCampaign($id_campaign) {
        $this->id_campaign = $id_campaign;
    }

    /**
     * @return int
     */
    public function getIdDid() {
        return $this->id_did;
    }

    /**
     * @param int $id_did
     */
    public function setIdDid($id_did) {
        $this->id_did = $id_did;
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
    public function getStartDate() {
        return $this->start_date;
    }

    /**
     * @param string $start_date
     */
    public function setStartDate($start_date) {
        $this->start_date = $start_date;
    }

    /**
     * @return string
     */
    public function getEndDate() {
        return $this->end_date;
    }

    /**
     * @param string $end_date
     */
    public function setEndDate($end_date) {
        $this->end_date = $end_date;
    }

    /**
     * @return string
     */
    public function getDescription() {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description) {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getDateUpdated() {
        return $this->date_updated;
    }

    /**
     * @param string $date_updated
     */
    public function setDateUpdated($date_updated) {
        $this->date_updated = $date_updated;
    }

    function getCampaigns() {

        $sql = "SELECT
                  campaign.id_campaign AS id,
                  name AS camp_name, 
                  description AS camp_description,
                  to_char(start_date, 'MM/DD/YYYY HH24:MI') AS camp_start,
                  end_date AS camp_end,
                  to_char(date_created, 'MM/DD/YYYY HH24:MI') AS date_created
                FROM $this->table campaign
                ORDER BY date_created ASC";

        return $this->doQueryArray($sql);

    }

    function getCampaignInfo($id_campaign) {

        /*$sql = "SELECT
                  id_campaign AS id,
                  name AS camp_name, 
                  description AS camp_description,
                  to_char(start_date, 'MM/DD/YYYY HH24:MI') AS camp_start,
                  to_char(end_date, 'MM/DD/YYYY HH24:MI') AS camp_end,
                  dids.did,
                  to_char(date_created, 'MM/DD/YYYY HH24:MI') AS date_created
                FROM $this->table campaign
                INNER JOIN ctn_dids dids ON campaign.id_did = dids.id_did
                WHERE campaign.id_campaign = '$id_campaign';";*/

        $sql = "SELECT
                  campaign.id_campaign AS id,
                  name AS camp_name,
                  description AS camp_description,
                  to_char(start_date, 'MM/DD/YYYY HH24:MI') AS camp_start,
                  to_char(end_date, 'MM/DD/YYYY HH24:MI') AS camp_end
                FROM ctn_campaigns campaign
                WHERE campaign.id_campaign = $id_campaign;
                ";
        return $this->doQueryArray($sql);

    }

    function updateCampaign() {

        $sql = "UPDATE
                  $this->table 
                SET 
                  name = '$this->name',
                  description = '$this->description'
                WHERE
                  id_campaign = $this->id_campaign;";

        $this->doSql($sql);

    }

    function addCampaign() {

        $sql = "INSERT INTO $this->table
                  (
                    name,
                    start_date,
                    end_date,
                    description,
                    date_created
                  ) 
                  VALUES
                  (
                    '$this->name',
                    '$this->start_date',
                    '$this->end_date',
                    '$this->description',
                    '$this->date'
                  );";
        //echo $sql;
        $this->doSql($sql);
    }

    function deleteCampaign() {

        $sql = "DELETE FROM
                  $this->table 
                WHERE
                  id_campaign = $this->id_campaign;";

        $this->doSql($sql);
    }
}