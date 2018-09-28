<?php

class Transcriptions extends Database {

    private $transcription_id = null;
    private $recording_id = null;
    private $phrase = '';
    private $audio_file_phrase = '';
    private $condifence = null;
    private $start_time = null;
    private $end_time = null;
    private $speaker = '';
    private $language_id = null;
    private $date = null;

    private $table = "ctn_transcriptions";

    function __construct() {
        parent::__construct();
    }

    function getTranscriptions($recording_id) {

        $sql = "SELECT 
                  transcription_id, 
                  phrase, 
                  speaker, 
                  confidence, 
                  audio_file_phrase 
                FROM $this->table 
                WHERE recording_id = $recording_id
                ORDER BY end_time";
        //echo $sql;
        $data = $this->doQueryArray($sql);
        return $data;
    }

}