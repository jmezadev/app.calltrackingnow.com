<?php

class CDR extends Database {

    private $calldate = '';
    private $clid = '';
    private $src = '';
    private $dst = '';
    private $dcontext = '';
    private $channel = '';
    private $dstchannel = '';
    private $lastapp = '';
    private $lastdata = '';
    private $duration = '';
    private $billsec = '';
    private $disposition = '';
    private $amaflags = '';
    private $accountcode = '';
    private $uniqueid = '';
    private $userfield = '';
    private $start = '';
    private $answer = '';
    private $end = '';
    private $linkedid = '';
    private $peeraccount = '';
    private $sequence = '';

    private $ANSWERED = 'ANSWERED';
    private $NO_ANSWER = 'NO ANSWER';
    private $BUSY = 'BUSY';
    private $CONGESTION = 'CONGESTION';

    private $table = 'ps_cdr';

    function __construct() {
        parent::__construct();
    }

    function getAnsweredCalls() {

        $sql = "SELECT
                  calldate,
                  clid AS callerid,
                  src,
                  dst,
                  dcontext AS context,
                  channel,
                  lastapp,
                  lastdata,
                  duration,
                  billsec,
                  uniqueid
                FROM $this->table 
                WHERE disposition = '$this->ANSWERED'
                ORDER BY calldate ASC";
        return $this->doQueryArray($sql);

    }

    function getNoAnsweredCalls() {

        $sql = "SELECT
                  calldate,
                  clid AS callerid,
                  src,
                  dst,
                  dcontext AS context,
                  channel,
                  lastapp,
                  lastdata,
                  duration,
                  billsec,
                  uniqueid
                FROM $this->table
                WHERE disposition = '$this->NO_ANSWER' ORDER BY calldate ASC";
        return $this->doQueryArray($sql);

    }

    function getBusyCalls() {

        $sql = "SELECT
                  calldate,
                  clid AS callerid,
                  src,
                  dst,
                  dcontext AS context,
                  channel,
                  lastapp,
                  lastdata,
                  duration,
                  billsec,
                  uniqueid
                FROM $this->table
                WHERE disposition = '$this->BUSY' ORDER BY calldate ASC";
        return $this->doQueryArray($sql);

    }

    function getCongestedCalls() {

        $sql = "SELECT
                  calldate,
                  clid AS callerid,
                  src,
                  dst,
                  dcontext AS context,
                  channel,
                  lastapp,
                  lastdata,
                  duration,
                  billsec,
                  uniqueid
                FROM $this->table
                WHERE disposition = '$this->CONGESTION' ORDER BY calldate ASC";
        return $this->doQueryArray($sql);

    }

    function getAllCalls() {

        $answeredCalls = $this->getAnsweredCalls();
        $noAnsweredCalls = $this->getNoAnsweredCalls();
        $busyCalls = $this->getBusyCalls();
        $congestedCalls = $this->getCongestedCalls();

        $calls = [
            'answered' => $answeredCalls,
            'no_answered' => $noAnsweredCalls,
            'congested' => $congestedCalls,
            'busy' => $busyCalls
        ];

        return $calls;

    }

}