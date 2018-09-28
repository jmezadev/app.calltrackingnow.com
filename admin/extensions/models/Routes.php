<?php

class Routes extends Database {

    private $id = 0;
    private $context = 'contextbd';
    private $exten = 0;
    private $priority = 0;
    private $app = '';
    private $appdata = '';
    private $campaing_id = '';

    private $table = "ps_extensions";

    function __construct() {
        parent::__construct();
    }

    /**
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id) {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getContext() {
        return $this->context;
    }

    /**
     * @param string $context
     */
    public function setContext($context) {
        $this->context = $context;
    }

    /**
     * @return int
     */
    public function getExten() {
        return $this->exten;
    }

    /**
     * @param int $exten
     */
    public function setExten($exten) {
        $this->exten = $exten;
    }

    /**
     * @return int
     */
    public function getPriority() {
        return $this->priority;
    }

    /**
     * @param int $priority
     */
    public function setPriority($priority) {
        $this->priority = $priority;
    }

    /**
     * @return string
     */
    public function getApp() {
        return $this->app;
    }

    /**
     * @param string $app
     */
    public function setApp($app) {
        $this->app = $app;
    }

    /**
     * @return string
     */
    public function getAppdata() {
        return $this->appdata;
    }

    /**
     * @param string $appdata
     */
    public function setAppdata($appdata) {
        $this->appdata = $appdata;
    }

    /**
     * @param string $campaignid
     */
    public function setCampaignID($campaignid) {
        $this->campaing_id = $campaignid;
    }

    /**
     * @return string
     */
    public function getCampaignID() {
        return $this->campaing_id;
    }

    function getIDEndpoint($didNumber) {

        $sql = "SELECT id_did
                FROM ctn_dids_temp3 did
                WHERE did.did_number = '$didNumber'";
        $result = $this->doQueryArray($sql);

        return $result[0]['id_did'];

    }

    function addRule(){

        $id_did = $this->getIDEndpoint($this->exten);

        $sql = "INSERT INTO $this->table (
                  context,
                  exten,
                  priority,
                  app,
                  appdata,
                  route
                ) VALUES (
                  '$this->context',
                  '$this->exten',
                  '$this->priority',
                  '$this->app',
                  '$this->appdata',
                  1
                );";

        $sql_did_to_extensions = "INSERT INTO ctn_dids_ps_extensions (id_did, id) VALUES ($id_did, lastval())";
        $sql_bridge_number = "INSERT INTO ctn_bridges_numbers (id_did, status) VALUES ($id_did, 0);";
        $sql_dids = "UPDATE ctn_dids_temp3 SET id_campaign = $this->campaing_id WHERE id_did = $id_did;";

        $this->doSql($sql);
        $this->doSql($sql_did_to_extensions);
        $this->doSql($sql_bridge_number);
        $this->doSql($sql_dids);

    }

    function deleteRule($id_did){

        $sql = "DELETE FROM $this->table WHERE id = $this->id;";
        $sql_did_ps_extensions = "DELETE FROM ctn_dids_ps_extensions WHERE id = $this->id;";
        $sql_update_did_status = "UPDATE ctn_dids_temp3 SET status = 0, id_campaign = NULL WHERE id_did = $id_did;";

        $this->doSql($sql_did_ps_extensions);
        $this->doSql($sql);
        $this->doSql($sql_update_did_status);
        //$this->doQuery($sql_ctn_dids);

    }

    function getExtensionsRules(){

        /*$sql = "SELECT
                  extensions.id,
                  extensions.exten AS ext_id,
                  extensions.exten AS exten_num,
                  extensions.context,
                  extensions.exten,
                  extensions.priority,
                  extensions.app,
                  extensions.appdata,
                  substring( extensions.appdata FROM position('/' IN extensions.appdata) + 1 FOR (char_length(extensions.appdata) - position('/' IN extensions.appdata)) - ( char_length(extensions.appdata) - position('@' IN extensions.appdata)) - 1 ) AS bridge,
                  campaign.id_campaign,
                  campaign.name AS name_campaign
                FROM ps_extensions extensions
                  INNER JOIN ctn_dids_ps_extensions cdpe ON extensions.id = cdpe.id
                  INNER JOIN ctn_dids dids ON dids.id_did = cdpe.id_did
                  INNER JOIN ctn_campaigns campaign ON dids.id_campaign = campaign.id_campaign
                WHERE route = 1
                ORDER BY id ASC";*/

        $sql = "SELECT
                  extensions.id,
                  extensions.exten AS ext_id,
                  dids.id_did AS id_did,
                  extensions.exten AS exten_num,
                  extensions.context,
                  extensions.exten,
                  extensions.priority,
                  extensions.app,
                  extensions.appdata,
                  substring( extensions.appdata FROM position('/' IN extensions.appdata) + 1 FOR (char_length(extensions.appdata) - position('/' IN extensions.appdata)) - ( char_length(extensions.appdata) - position('@' IN extensions.appdata)) - 1 ) AS bridge,
                  campaign.id_campaign,
                  campaign.name AS name_campaign
                FROM ps_extensions extensions
                  INNER JOIN ctn_dids_temp3 dids ON dids.did_number = extensions.exten
                  INNER JOIN ctn_campaigns campaign ON dids.id_campaign = campaign.id_campaign
                WHERE route = 1
                ORDER BY id ASC";
        $rules = $this->doQueryArray($sql);

        return $rules;
    }

    function updateRoute($campaign_id) {

        $sql = "UPDATE $this->table SET exten = '$this->exten', appdata = '$this->appdata' WHERE id = $this->id;";
        $sql_campaign = "UPDATE ctn_dids_temp3 SET id_campaign = $campaign_id WHERE did_number = '$this->exten';";
        //echo $sql;
        $this->doSql($sql_campaign);
        $this->doSql($sql);

    }

    function setDIDStatus($did) {

        $sql = "UPDATE ctn_dids_temp3 SET status = 1 WHERE did_number = '$did';";
        //echo $sql;
        $this->doSql($sql);

    }

    function getExtensionsRulesArray(){

        $sql = "SELECT
                  id,
                  exten AS ext_id,
                  context,
                  exten,
                  priority,
                  app,
                  appdata,
                  substring( appdata FROM position('@' IN appdata) + 1 FOR (char_length(appdata) - position('@' IN appdata)) - ( char_length(appdata) - position(',' IN appdata)) - 1 ) AS bridge
                FROM ps_extensions
                WHERE route = 1
                ORDER BY id ASC";

        $rules = $this->doQueryArray($sql);

        $count = count($rules);
        $rulesArray = [];

        var_dump($rules);

        for ($i = 0; $i < $count; $i++) {

            $rulesArray[$rules[$i]['exten']] = [];

            for ($j = 0; $j < $count; $j++) {
                array_push($rulesArray[$rules[$i]['exten']], $rules[$j]['context']);
                array_push($rulesArray[$rules[$i]['exten']], $rules[$j]['app']);
                array_push($rulesArray[$rules[$i]['exten']], $rules[$j]['appdata']);
            }
        }

        return $rulesArray;
    }

    function getRouteById($id_route){

        /*$sql = "SELECT
                  id,
                  context,
                  exten,
                  priority,
                  app,
                  appdata,
                  substring( appdata FROM position('/' IN appdata) + 1 FOR (char_length(appdata) - position('/' IN appdata)) - ( char_length(appdata) - position('@' IN appdata)) - 1 ) AS bridge
                FROM $this->table
                WHERE id = $id_route;";*/

        $sql = "SELECT
                  extensions.id,
                  extensions.exten AS ext_id,
                  extensions.exten AS did_number,
                  extensions.context,
                  extensions.exten,
                  extensions.priority,
                  extensions.app,
                  extensions.appdata,
                  substring( extensions.appdata FROM position('/' IN extensions.appdata) + 1 FOR (char_length(extensions.appdata) - position('/' IN extensions.appdata)) - ( char_length(extensions.appdata) - position('@' IN extensions.appdata)) - 1 ) AS bridge,
                  campaign.id_campaign,
                  campaign.name AS name_campaign
                FROM ps_extensions extensions
                  INNER JOIN ctn_dids_temp3 dids ON dids.did_number = extensions.exten
                  INNER JOIN ctn_campaigns campaign ON dids.id_campaign = campaign.id_campaign
                WHERE extensions.id = '$id_route' AND route = 1
                ORDER BY id ASC;";

        $rulesArray = $this->doQueryArray($sql);

        return $rulesArray;
    }


}