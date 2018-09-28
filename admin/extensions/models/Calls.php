<?php

class Calls extends Database {

    private $id_call = 0;
    private $id_bridge_number = 0;
    private $id_campaign = '';
    private $direction = '';
    private $date = '';
    private $date_updated = '';
    private $source = '';
    private $destination = '';
    private $channel = '';
    private $duration = '';
    private $name = '';

    private $table = 'ctn_calls';

    function __construct() {
        parent::__construct();
    }

    /**
     * @return int
     */
    public function getIdCall() {
        return $this->id_call;
    }

    /**
     * @param int $id_call
     */
    public function setIdCall($id_call) {
        $this->id_call = $id_call;
    }

    /**
     * @return string
     */
    public function getDirection() {
        return $this->direction;
    }

    /**
     * @param string $direction
     */
    public function setDirection($direction) {
        $this->direction = $direction;
    }

    /**
     * @return int
     */
    public function getIdBridgeNumber() {
        return $this->id_bridge_number;
    }

    /**
     * @param int $id_bridge_number
     */
    public function setIdBridgeNumber($id_bridge_number) {
        $this->id_bridge_number = $id_bridge_number;
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
    public function getIdCampaign() {
        return $this->id_campaign;
    }

    /**
     * @param string $id_campaign
     */
    public function setIdCampaign($id_campaign) {
        $this->id_campaign = $id_campaign;
    }

    /**
     * @return string
     */
    public function getSource() {
        return $this->source;
    }

    /**
     * @param string $source
     */
    public function setSource($source) {
        $this->source = $source;
    }

    /**
     * @return string
     */
    public function getDestination() {
        return $this->destination;
    }

    /**
     * @param string $destination
     */
    public function setDestination($destination) {
        $this->destination = $destination;
    }

    /**
     * @return string
     */
    public function getChannel() {
        return $this->channel;
    }

    /**
     * @param string $channel
     */
    public function setChannel($channel) {
        $this->channel = $channel;
    }

    /**
     * @return string
     */
    public function getDuration() {
        return $this->duration;
    }

    /**
     * @param string $duration
     */
    public function setDuration($duration) {
        $this->duration = $duration;
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
     * @return string
     */
    public function getDateUpdated() {
        return $this->date_updated;
    }

    function getCalls() {

        $sql = "SELECT
                  calls.id_call AS id,
                  calls.destination AS did,
                  campaigns.name AS campaign,
                  calls.source AS from,
                  calls.destination AS to,
                  calls.channel AS bridge,
                  calls.duration,
                  calls.name,
                  calls.file_recording,
                  calls.date_created
                FROM
                  ctn_calls calls
                  INNER JOIN ctn_campaigns campaigns ON calls.id_campaign = campaigns.id_campaign
                ORDER BY calls.date_created DESC";

        return $this->doQueryArray($sql);

    }

}