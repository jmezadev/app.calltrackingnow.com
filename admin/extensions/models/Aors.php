<?php

class Aors extends Database {

    public $id = null;
    public $contact = null;
    public $default_expiration = null;
    public $mailboxes = null;
    public $max_contacts = 1;
    public $minimum_expiration = null;
    public $remove_existing = 'yes';
    public $qualify_frequency = 30;
    public $authenticate_qualify = 'yes';
    public $maximum_expiration = null;
    public $outbound_proxy = null;
    public $support_path = null;
    public $qualify_timeout = '5.0';
    public $voicemail_extension = null;

    public $table = 'ps_aors';

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
    public function getContact() {
        return $this->contact;
    }

    /**
     * @param null $contact
     */
    public function setContact($contact) {
        $this->contact = $contact;
    }

    /**
     * @return null
     */
    public function getDefaultExpiration() {
        return $this->default_expiration;
    }

    /**
     * @param null $default_expiration
     */
    public function setDefaultExpiration($default_expiration) {
        $this->default_expiration = $default_expiration;
    }

    /**
     * @return null
     */
    public function getMailboxes() {
        return $this->mailboxes;
    }

    /**
     * @param null $mailboxes
     */
    public function setMailboxes($mailboxes) {
        $this->mailboxes = $mailboxes;
    }

    /**
     * @return int
     */
    public function getMaxContacts() {
        return $this->max_contacts;
    }

    /**
     * @param int $max_contacts
     */
    public function setMaxContacts($max_contacts) {
        $this->max_contacts = $max_contacts;
    }

    /**
     * @return null
     */
    public function getMinimumExpiration() {
        return $this->minimum_expiration;
    }

    /**
     * @param null $minimum_expiration
     */
    public function setMinimumExpiration($minimum_expiration) {
        $this->minimum_expiration = $minimum_expiration;
    }

    /**
     * @return string
     */
    public function getRemoveExisting() {
        return $this->remove_existing;
    }

    /**
     * @param string $remove_existing
     */
    public function setRemoveExisting($remove_existing) {
        $this->remove_existing = $remove_existing;
    }

    /**
     * @return null
     */
    public function getQualifyFrequency() {
        return $this->qualify_frequency;
    }

    /**
     * @param null $qualify_frequency
     */
    public function setQualifyFrequency($qualify_frequency) {
        $this->qualify_frequency = $qualify_frequency;
    }

    /**
     * @return null
     */
    public function getAuthenticateQualify() {
        return $this->authenticate_qualify;
    }

    /**
     * @param null $authenticate_qualify
     */
    public function setAuthenticateQualify($authenticate_qualify) {
        $this->authenticate_qualify = $authenticate_qualify;
    }

    /**
     * @return null
     */
    public function getMaximumExpiration() {
        return $this->maximum_expiration;
    }

    /**
     * @param null $maximum_expiration
     */
    public function setMaximumExpiration($maximum_expiration) {
        $this->maximum_expiration = $maximum_expiration;
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
    public function getQualifyTimeout() {
        return $this->qualify_timeout;
    }

    /**
     * @param null $qualify_timeout
     */
    public function setQualifyTimeout($qualify_timeout) {
        $this->qualify_timeout = $qualify_timeout;
    }

    /**
     * @return null
     */
    public function getVoicemailExtension() {
        return $this->voicemail_extension;
    }

    /**
     * @param null $voicemail_extension
     */
    public function setVoicemailExtension($voicemail_extension) {
        $this->voicemail_extension = $voicemail_extension;
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

    function addEndpointAors() {
        $sql
            = "INSERT INTO $this->table (
                  id,
                  contact, 
                  max_contacts, 
                  remove_existing,
                  qualify_frequency,
                  authenticate_qualify,
                  qualify_timeout
                ) 
                VALUES 
                (
                  '$this->id', 
                  '$this->contact', 
                  '$this->max_contacts', 
                  '$this->remove_existing',
                  '$this->qualify_frequency',
                  '$this->authenticate_qualify',
                  '$this->qualify_timeout'
                );";

//                echo $sql . '<br>';
        $this->doSql($sql);
    }


    function deleteEndpointAors() {
        $sql = "DELETE FROM $this->table WHERE id = '$this->id'";

        $this->doSql($sql);
    }

}