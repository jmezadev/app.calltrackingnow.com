<?php

class Endpoint extends Database {

    private $id = 0;
    private $name = null;
    private $callerid = null;
    private $context = 'default';
    private $mailbox = null;
    private $nat = null;
    private $type = null;
    private $username = null;
    private $transport = 'transport-udp-nat';
    private $use_avpf = 'yes';
    private $force_rport = 'yes';
    private $rtp_symmetric = 'yes';
    private $media_encryption = 'dtls';
    private $dtls_ca_file = '/etc/asterisk/keys/ca.crt';
    private $dtls_cert_file = '/etc/asterisk/keys/asterisk.pem';
    private $dtls_verify = 'fingerprint';
    private $dtls_setup = 'actpass';
    private $ice_support = 'yes';
    private $outbound_auth = null;
    private $media_use_received_transport = 'yes';
    private $media_address = '34.239.223.218';
    private $disallow = 'all';
    private $allow = 'alaw';
    private $direct_media = 'yes';
    private $rtcp_mux = 'yes';
    private $date = null;

    private $table = "ps_endpoints";
    private $table_ctn_extensions = "ctn_extensions";
    private $table_ctn_did = "ctn_dids";

    function __construct() {
        parent::__construct();
        $this->setDate();
    }

    /**
     * @return string
     */
    public function getDtlsVerify() {
        return $this->dtls_verify;
    }

    /**
     * @param string $dtls_verify
     */
    public function setDtlsVerify($dtls_verify) {
        $this->dtls_verify = $dtls_verify;
    }

    /**
     * @return string
     */
    public function getUseAvpf() {
        return $this->use_avpf;
    }

    /**
     * @param string $use_avpf
     */
    public function setUseAvpf($use_avpf) {
        $this->use_avpf = $use_avpf;
    }

    /**
     * @return string
     */
    public function getRtcpMux() {
        return $this->rtcp_mux;
    }

    /**
     * @param string $rtcp_mux
     */
    public function setRtcpMux($rtcp_mux) {
        $this->rtcp_mux = $rtcp_mux;
    }

    /**
     * @return string
     */
    public function getMediaUseReceivedTransport() {
        return $this->media_use_received_transport;
    }

    /**
     * @param string $media_use_received_transport
     */
    public function setMediaUseReceivedTransport($media_use_received_transport) {
        $this->media_use_received_transport = $media_use_received_transport;
    }

    /**
     * @return string
     */
    public function getMediaEncryption() {
        return $this->media_encryption;
    }

    /**
     * @param string $media_encryption
     */
    public function setMediaEncryption($media_encryption) {
        $this->media_encryption = $media_encryption;
    }

    /**
     * @return string
     */
    public function getIceSupport() {
        return $this->ice_support;
    }

    /**
     * @param string $ice_support
     */
    public function setIceSupport($ice_support) {
        $this->ice_support = $ice_support;
    }

    /**
     * @return string
     */
    public function getDirectMedia() {
        return $this->direct_media;
    }

    /**
     * @param string $direct_media
     */
    public function setDirectMedia($direct_media) {
        $this->direct_media = $direct_media;
    }

    /**
     * @return string
     */
    public function getDisallow() {
        return $this->disallow;
    }

    /**
     * @param string $disallow
     */
    public function setDisallow($disallow) {
        $this->disallow = $disallow;
    }


    /**
     * @param string $disallow
     */
    public function setDate() {
        $this->date =  date("Y-m-d") . " " . date("h:i:sa");
    }

    /**
     * @return string
     */
    public function getAllow() {
        return $this->allow;
    }

    /**
     * @param string $allow
     */
    public function setAllow($allow) {
        $this->allow = $allow;
    }

    /**
     * @return null
     */
    public function getCallerid() {
        return $this->callerid;
    }

    /**
     * @param null $callerid
     */
    public function setCallerid($callerid) {
        $this->callerid = $callerid;
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
    public function getName() {
        return $this->name;
    }

    /**
     * @param null $name
     */
    public function setName($name) {
        $this->name = $name;
    }

    /**
     * @return null
     */
    public function getContext() {
        return $this->context;
    }

    /**
     * @param null $context
     */
    public function setContext($context) {
        $this->context = $context;
    }

    /**
     * @return null
     */
    public function getMailbox() {
        return $this->mailbox;
    }

    /**
     * @param null $mailbox
     */
    public function setMailbox($mailbox) {
        $this->mailbox = $mailbox;
    }

    /**
     * @return null
     */
    public function getNat() {
        return $this->nat;
    }

    /**
     * @param null $nat
     */
    public function setNat($nat) {
        $this->nat = $nat;
    }

    /**
     * @return null
     */
    public function getType() {
        return $this->type;
    }

    /**
     * @param null $type
     */
    public function setType($type) {
        $this->type = $type;
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
     * @return string
     */
    public function getMediaAddress() {
        return $this->media_address;
    }

    /**
     * @param string $media_address
     */
    public function setMediaAddress($media_address) {
        $this->media_address = $media_address;
    }

    /**
     * @return string
     */
    public function getForceRport() {
        return $this->force_rport;
    }

    /**
     * @param string $force_rport
     */
    public function setForceRport($force_rport) {
        $this->force_rport = $force_rport;
    }

    /**
     * @return string
     */
    public function getRtpSymmetric() {
        return $this->rtp_symmetric;
    }

    /**
     * @param string $rtp_symmetric
     */
    public function setRtpSymmetric($rtp_symmetric) {
        $this->rtp_symmetric = $rtp_symmetric;
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
     * Get Endpoint information
     *
     * @param $name
     */
    function endpointInfo($name) {
        $sql = "SELECT username, type, secret, callerid, mailbox, context, nat FROM $this->table WHERE name = '$name'";

        $endpointInfo = $this->doQueryArray($sql);

        $this->setUsername($endpointInfo['username']);
        $this->setType($endpointInfo['type']);
        $this->setCallerid($endpointInfo['callerid']);
        $this->setMailbox($endpointInfo['mailbox']);
        $this->setContext($endpointInfo['context']);
        $this->setNat($endpointInfo['nat']);
    }

    /**
     * Add new Endpoint (PjSIP Endpoint) and its configuration
     *
     */
    function addNewEndpoint() {

        $sql
            = "INSERT INTO $this->table (
                  id,
                  transport,
                  aors,
                  auth,
                  context,
                  use_avpf,
                  media_encryption,
                  dtls_ca_file,
                  dtls_cert_file,
                  dtls_verify,
                  dtls_setup,
                  ice_support,
                  outbound_auth,
                  force_rport,
                  rtp_symmetric,
                  media_use_received_transport,
                  media_address,
                  disallow,
                  allow,
                  direct_media,
                  rtcp_mux,
                  date_created
                )
                VALUES 
                (
                  '$this->id',
                  '$this->transport',
                  '$this->id',
                  '$this->id',
                  '$this->context',
                  '$this->use_avpf',
                  '$this->media_encryption',
                  '$this->dtls_ca_file',
                  '$this->dtls_cert_file',
                  '$this->dtls_verify',
                  '$this->dtls_setup',
                  '$this->ice_support',
                  '$this->outbound_auth',
                  '$this->force_rport',
                  '$this->rtp_symmetric',
                  '$this->media_use_received_transport',
                  '$this->media_address',
                  '$this->disallow',
                  '$this->allow',
                  '$this->direct_media',
                  '$this->rtcp_mux',
                  '$this->date'
                );";

        $sql_extensions = "INSERT INTO $this->table_ctn_extensions (id) VALUES ('$this->id') ";

//         echo $sql . '<br>';
        $this->doSql($sql);
        $this->doSql($sql_extensions);
    }

    /**
     * Add new DID Endpoint (PjSIP Endpoint) and its configuration
     *
     */
    function addNewDIDEndpoint() {

        $sql
            = "INSERT INTO $this->table (
                  id,
                  transport,
                  aors,
                  context,
                  dtls_ca_file,
                  dtls_cert_file,
                  dtls_verify,
                  dtls_setup,
                  outbound_auth,
                  disallow,
                  allow,
                  direct_media,
                  date_created
                )
                VALUES 
                (
                  '$this->id',
                  '$this->transport',
                  '$this->id',
                  '$this->context',
                  '$this->dtls_ca_file',
                  '$this->dtls_cert_file',
                  '$this->dtls_verify',
                  '$this->dtls_setup',
                  '$this->outbound_auth',
                  '$this->disallow',
                  '$this->allow',
                  '$this->direct_media',
                  '$this->date'
                );";

        $setDID = (strpos($this->id, '+') === false) ? "+$this->id" : $this->id;

        $sql_did = "INSERT INTO $this->table_ctn_did (id_endpoint, did, status) VALUES ('$this->id', '$setDID', 0)";

        //         echo $sql . '<br>';
        $this->doSql($sql);
        $this->doSql($sql_did);
    }

    /**
     * Add new Trunk (PjSIP Endpoint) and its configuration
     *
     */
    function addNewTrunk() {

        $sql
            = "INSERT INTO $this->table (
                  id,
                  transport,
                  aors,
                  context,
                  dtls_ca_file,
                  dtls_cert_file,
                  dtls_verify,
                  dtls_setup,
                  outbound_auth,
                  disallow,
                  allow,
                  direct_media,
                  date_created
                )
                VALUES 
                (
                  '$this->id',
                  '$this->transport',
                  '$this->id',
                  '$this->context',
                  '$this->dtls_ca_file',
                  '$this->dtls_cert_file',
                  '$this->dtls_verify',
                  '$this->dtls_setup',
                  '$this->outbound_auth',
                  '$this->disallow',
                  '$this->allow',
                  '$this->direct_media',
                  '$this->date'
                );";

        $setDID = (strpos($this->id, '+') === false) ? "+$this->id" : $this->id;

        $sql_trunk = "INSERT INTO ctn_trunks (id_endpoint, name, status) VALUES ('$this->id', '$this->name', 0)";

        //         echo $sql . '<br>';
        $this->doSql($sql);
        $this->doSql($sql_trunk);
    }

    /**
     * @return array
     */
    function getTrunks() {

        $sql = "SELECT
                  trunk.id_trunk AS id_trunk,
                  trunk.name AS trunk_name,
                  endpoint.id AS ext_id,
                  endpoint.id AS extension,
                  endpoint.transport AS ext_transport,
                  endpoint.context AS ext_context,
                  endpoint.id AS ext_login,
                  auth.password AS ext_password,
                  aors.contact AS ext_proxy,
                  endpoint.date_created AS ext_date_created
                FROM
                  ctn_trunks trunk
                  INNER JOIN ps_endpoints endpoint ON endpoint.outbound_auth = trunk.id_endpoint
                  INNER JOIN ps_auths auth ON endpoint.id = auth.id
                  INNER JOIN ps_aors aors ON endpoint.id = aors.id";

        return $this->doQueryArray($sql);

    }

    /**
     * @param $trunk_id
     * @return array
     */
    function getTrunkInfo($trunk_id) {

        $sql = "SELECT
                  trunk.name AS trunk_name,
                  endpoint.id AS ext_id,
                  endpoint.id AS extension,
                  endpoint.transport AS ext_transport,
                  endpoint.context AS ext_context,
                  endpoint.id AS ext_login,
                  auth.password AS ext_password,
                  identify.match AS ext_proxy,
                  endpoint.date_created AS ext_date_created
                FROM
                  ctn_trunks trunk
                  INNER JOIN ps_endpoints endpoint ON endpoint.outbound_auth = trunk.id_endpoint
                  INNER JOIN ps_auths auth ON endpoint.id = auth.id
                  INNER JOIN ps_endpoint_id_ips identify ON identify.endpoint = endpoint.id
                WHERE endpoint.id = '$trunk_id'";
        $result = $this->doQueryArray($sql);

        return $result;
    }

    /**
     *
     */
    function updateTrunk() {
        $sql
            = "UPDATE $this->table SET
                  transport = '$this->transport',
                  context = '$this->context',
                  date_updated = '$this->date'
                WHERE id = '$this->id'";

        $sql_trunk = "UPDATE ctn_trunks SET name = '$this->name' WHERE id_endpoint = '$this->id'";

        //                echo $sql;
        $this->doSql($sql_trunk);
        $this->doSql($sql);
    }

    /**
     *
     */
    function deleteTrunk() {
        $sql = "DELETE FROM $this->table WHERE id = '$this->id'";
        $sql_ctn = "DELETE FROM $this->table_ctn_extensions WHERE id = '$this->id'";
        $sql_ctn_trunk = "DELETE FROM ctn_trunks WHERE id_endpoint = '$this->id'";

        $this->doSql($sql_ctn_trunk);
        $this->doSql($sql_ctn);
        $this->doSql($sql);
    }

    /**
     *
     */
    function addDIDtoTrunk($trunk, $DIDNumber) {

        $sql = "INSERT INTO ctn_dids_temp3 (id_trunk, did_number, status) VALUES ($trunk, '$DIDNumber', 0)";
        $this->doSql($sql);
    }

    function updateEndpointInfo() {

        $sql
            = "UPDATE $this->table SET
                  transport = '$this->transport',
                  context = '$this->context',
                  disallow = '$this->disallow',
                  allow = '$this->allow',
                  date_updated = '$this->date'
                WHERE id = '$this->id'";

//                echo $sql;
        $this->doSql($sql);

    }

    function deleteEndpoint() {
        $sql = "DELETE FROM $this->table WHERE id = '$this->id'";
        $sql_ctn = "DELETE FROM $this->table_ctn_extensions WHERE id = '$this->id'";
        $sql_ctn_did = "DELETE FROM $this->table_ctn_did WHERE id_endpoint = '$this->id'";

        $this->doSql($sql_ctn_did);
        $this->doSql($sql_ctn);
        $this->doSql($sql);
    }

    function deleteSimpleEndpoint() {
        $sql = "DELETE FROM $this->table WHERE id = '$this->id'";
        $sql_ctn = "DELETE FROM $this->table_ctn_extensions WHERE id = '$this->id'";

        $this->doSql($sql_ctn);
        $this->doSql($sql);
    }

    function getAllEndpoints() {

        $sql = "SELECT
                  ps_end.id AS ext_id,
                  ps_end.id AS extension,
                  ps_end.context AS ext_context,
                  ps_end.id AS ext_login,
                  ps_auths.password AS ext_password,
                  ps_end.date_created AS ext_date_created
                FROM ctn_extensions AS exts
                INNER JOIN ps_endpoints AS ps_end ON ps_end.id = exts.id
                INNER JOIN ps_auths ON ps_end.id = ps_auths.id";

        return $this->doQueryArray($sql);

    }

    function getAllDIDEndpoints() {

        /*$sql = "SELECT
                  trunk.id_trunk AS trunk_id,
                  trunk.name AS trunk_name,
                  dids.did_number AS did_number,
                  dids.id_did AS id_did
                FROM
                  ctn_dids dids
                  INNER JOIN ctn_trunks trunk ON dids.id_trunk = trunk.id_trunk";*/

        $sql = "SELECT
                  trunk.id_trunk AS trunk_id,
                  trunk.name AS trunk_name,
                  dids.did_number AS did_number,
                  dids.id_did AS id_did,
                  users.user_id,
                  CONCAT(users.first_name, ' ', users.last_name) AS user_name
                FROM
                  ctn_dids_temp3 dids
                  INNER JOIN ctn_trunks trunk ON dids.id_trunk = trunk.id_trunk
                  INNER JOIN ctn_users_ctn_dids users_to_dids ON dids.id_did = users_to_dids.id_did
                  INNER JOIN ctn_users users ON users.user_id = users_to_dids.user_id";

        return $this->doQueryArray($sql);

    }

    function getAllDIDEndpointsList() {

        $sql = "SELECT 
                  did_number as ext_id
                FROM ctn_dids_temp3 dids
                WHERE status = 0;";

        return $this->doQueryArray($sql);

    }

    function getAllDIDEndpointsForCampaigns() {

        $sql = "SELECT
                  dids.id_did,
                  dids.id_endpoint,
                  dids.did
                FROM
                  ctn_dids_temp3 dids
                WHERE dids.id_did NOT IN (SELECT campaign.id_did FROM ctn_campaigns campaign);";

        return $this->doQueryArray($sql);

    }

    function getAllDIDs() {

        $sql = "SELECT
                  dids.id_did,
                  dids.did_number,
                  trunk.id_trunk,
                  campaign.id_campaign,
                  campaign.name AS name_campaign
                FROM
                  ctn_dids_temp3 dids
                INNER JOIN ctn_trunks trunk ON dids.id_trunk = trunk.id_trunk
                INNER JOIN ctn_campaigns campaign ON dids.id_campaign = campaign.id_campaign";

        return $this->doQueryArray($sql);

    }

    function checkIfDIDExists($didNumber) {

        $sql = "SELECT * FROM ctn_dids_temp3 WHERE did = '$didNumber' LIMIT 1";
        $result = $this->doQueryArray($sql);

        if($result) {
            return false;
        }
        return true;
    }

    function checkIfExtensionExists($extensionNumber) {

        $sql = "SELECT * FROM ps_endpoints WHERE id = '$extensionNumber' LIMIT 1";
        $result = $this->doQueryArray($sql);

        if($result) {
            return false;
        }
        return true;
    }

    function checkIfTrunkNameExists($trunkName) {

        $sql = "SELECT * FROM ctn_trunks WHERE name = '$trunkName' LIMIT 1";
        $result = $this->doQueryArray($sql);

        if($result) {
            return false;
        }
        return true;
    }

    function checkIfTrunkNumberExists($trunkNumber) {

        $sql = "SELECT * FROM ps_endpoints WHERE id = '$trunkNumber' LIMIT 1";
        $result = $this->doQueryArray($sql);

        if($result) {
            return false;
        }
        return true;
    }

    function getTrunkIDEndpoint($extNumber) {

        $sql = "SELECT id_endpoint
                FROM ctn_trunks trunk
                INNER JOIN ctn_dids_temp3 did ON trunk.id_trunk = did.id_trunk
                WHERE did.did_number = '$extNumber'";
        $result = $this->doQueryArray($sql);

        return $result[0]['id_endpoint'];

    }

    function getAllDIDInfoByDID($DID) {

        $sql = "SELECT * FROM ctn_dids_temp3 WHERE did_number = '$DID' LIMIT 1";
        $result = $this->doQueryArray($sql);

        return $result;

    }

    function getDIDInfo($did_id) {

        /*$sql = "SELECT
                  endpoint.id AS ext_id,
                  trunk.id_trunk AS trunk_id,
                  dids.did_number AS did_number,
                  trunk.name AS trunk_name,
                  campaign.name AS campaign_name,
                  endpoint.transport AS ext_transport,
                  endpoint.context AS ext_context,
                  endpoint.id AS ext_login,
                  auth.password AS ext_password,
                  aor.contact AS ext_proxy,
                  endpoint.date_created AS ext_date_created
                FROM
                  ctn_dids dids
                  INNER JOIN ctn_trunks trunk ON dids.id_trunk = trunk.id_trunk
                  INNER JOIN ctn_campaigns campaign ON dids.id_campaign = campaign.id_campaign
                  INNER JOIN ps_endpoints endpoint ON endpoint.id = trunk.id_endpoint
                  INNER JOIN ps_auths auth ON endpoint.id = auth.id
                  INNER JOIN ps_aors aor ON aor.id = auth.id
                WHERE dids.did_number = '$did_id'";*/

        $sql = "SELECT
                  trunk.id_trunk AS trunk_id,
                  trunk.name AS trunk_name,
                  dids.id_did AS id_did,
                  dids.did_number AS did_number
                FROM
                  ctn_dids_temp3 dids
                  INNER JOIN ctn_trunks trunk ON dids.id_trunk = trunk.id_trunk
                WHERE dids.did_number = '$did_id';";
        $result = $this->doQueryArray($sql);

        return $result;
    }

    function getExtensionInfo($extension_id) {

        $sql = "SELECT
                  ps_end.id AS ext_id,
                  ps_end.id AS extension,
                  ps_end.context AS ext_context,
                  ps_end.id AS ext_login,
                  ps_auths.password AS ext_password,
                  ps_end.date_created AS ext_date_created
                FROM ctn_extensions AS exts
                  INNER JOIN ps_endpoints AS ps_end ON ps_end.id = exts.id
                  INNER JOIN ps_auths ON ps_end.id = ps_auths.id
                WHERE ps_end.id = '$extension_id'";
        $result = $this->doQueryArray($sql);

        return $result;
    }

    function updateDID($didID, $trunkID) {

        $sql = "UPDATE ctn_dids_temp3 SET id_trunk = $trunkID WHERE id_did = $didID;";
        $this->doSql($sql);
    }

    function deleteDID($didID) {

        $sql = "DELETE FROM ctn_dids_temp3 WHERE id_did = $didID;";
        $this->doSql($sql);
    }

    function assignDIDToUser($didID, $userID) {

        $sql = "INSERT INTO ctn_users_ctn_dids (id_did, user_id) VALUES ($didID, $userID);";
        $this->doSql($sql);
    }

    function removeDIDFromUser($didID, $userID) {

        $sql = "DELETE FROM ctn_users_ctn_dids WHERE id_did = $didID AND user_id = $userID;";
        $this->doSql($sql);
    }


}