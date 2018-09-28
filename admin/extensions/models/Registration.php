<?php
/**
 * Created by PhpStorm.
 * User: vivelab02
 * Date: 16/08/18
 * Time: 9:45 AM
 */

class Registration extends Database {

    private $id = 0;
    private $auth_rejection_permanent = 0;
    private $client_uri = null;
    private $contact_user = null;
    private $expiration = 0;
    private $max_retries = 0;
    private $outbound_auth = null;
    private $outbound_proxy = null;
    private $retry_interval = 60;
    private $forbidden_retry_interval = 0;
    private $server_uri = null;
    private $transport = null;
    private $support_path = null;
    private $fatal_retry_interval = 0;
    private $line = 'no';
    private $endpoint = null;

    private $table = "ps_registrations";

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
     * @return int
     */
    public function getAuthRejectionPermanent() {
        return $this->auth_rejection_permanent;
    }

    /**
     * @param int $auth_rejection_permanent
     */
    public function setAuthRejectionPermanent($auth_rejection_permanent) {
        $this->auth_rejection_permanent = $auth_rejection_permanent;
    }

    /**
     * @return null
     */
    public function getClientUri() {
        return $this->client_uri;
    }

    /**
     * @param null $client_uri
     */
    public function setClientUri($client_uri) {
        $this->client_uri = $client_uri;
    }

    /**
     * @return null
     */
    public function getContactUser() {
        return $this->contact_user;
    }

    /**
     * @param null $contact_user
     */
    public function setContactUser($contact_user) {
        $this->contact_user = $contact_user;
    }

    /**
     * @return null
     */
    public function getExpiration() {
        return $this->expiration;
    }

    /**
     * @param null $expiration
     */
    public function setExpiration($expiration) {
        $this->expiration = $expiration;
    }

    /**
     * @return null
     */
    public function getMaxRetries() {
        return $this->max_retries;
    }

    /**
     * @param null $max_retries
     */
    public function setMaxRetries($max_retries) {
        $this->max_retries = $max_retries;
    }

    /**
     * @return null
     */
    public function getOutboundAuth() {
        return $this->outbound_auth;
    }

    /**
     * @param null $outbound_auth
     */
    public function setOutboundAuth($outbound_auth) {
        $this->outbound_auth = $outbound_auth;
    }

    /**
     * @return null
     */
    public function getOutboundProxy() {
        return $this->outbound_proxy;
    }

    /**
     * @param null $outbound_proxy
     */
    public function setOutboundProxy($outbound_proxy) {
        $this->outbound_proxy = $outbound_proxy;
    }

    /**
     * @return null
     */
    public function getRetryInterval() {
        return $this->retry_interval;
    }

    /**
     * @param null $retry_interval
     */
    public function setRetryInterval($retry_interval) {
        $this->retry_interval = $retry_interval;
    }

    /**
     * @return null
     */
    public function getForbiddenRetryInterval() {
        return $this->forbidden_retry_interval;
    }

    /**
     * @param null $forbidden_retry_interval
     */
    public function setForbiddenRetryInterval($forbidden_retry_interval) {
        $this->forbidden_retry_interval = $forbidden_retry_interval;
    }

    /**
     * @return null
     */
    public function getServerUri() {
        return $this->server_uri;
    }

    /**
     * @param null $server_uri
     */
    public function setServerUri($server_uri) {
        $this->server_uri = $server_uri;
    }

    /**
     * @return null
     */
    public function getTransport() {
        return $this->transport;
    }

    /**
     * @param null $transport
     */
    public function setTransport($transport) {
        $this->transport = $transport;
    }

    /**
     * @return null
     */
    public function getSupportPath() {
        return $this->support_path;
    }

    /**
     * @param null $support_path
     */
    public function setSupportPath($support_path) {
        $this->support_path = $support_path;
    }

    /**
     * @return null
     */
    public function getFatalRetryInterval() {
        return $this->fatal_retry_interval;
    }

    /**
     * @param null $fatal_retry_interval
     */
    public function setFatalRetryInterval($fatal_retry_interval) {
        $this->fatal_retry_interval = $fatal_retry_interval;
    }

    /**
     * @return null
     */
    public function getLine() {
        return $this->line;
    }

    /**
     * @param null $line
     */
    public function setLine($line) {
        $this->line = $line;
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
     * Add new Endpoint (PjSIP Endpoint) and its configuration
     *
     */
    function addNewDIDEndpointRegistration() {

        $sql
            = "INSERT INTO $this->table (
                    id,
                    client_uri,
                    outbound_auth,
                    retry_interval,
                    server_uri,
                    transport,
                    line
                )
                VALUES 
                (
                  '$this->id',
                  '$this->client_uri',
                  '$this->outbound_auth',
                  '$this->retry_interval',
                  '$this->server_uri',
                  '$this->transport',
                  '$this->line'
                );";

        //        echo $sql . '<br>';
        $this->doSql($sql);
    }

    function deleteEndpointRegistration(){
        $sql = "DELETE FROM $this->table WHERE id = '$this->id'";

        $this->doSql($sql);
    }

    function updateEndpointRegistration(){
        $sql
            = "UPDATE $this->table SET
                  client_uri = '$this->client_uri',
                  server_uri = '$this->server_uri',
                  transport = '$this->transport'
                WHERE id = '$this->id'";

        $this->doSql($sql);
    }


}