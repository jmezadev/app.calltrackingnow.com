<?php

require_once('../../init.php');
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 0);

$transcriptions = new Transcriptions();
$calls = new Calls();

$recording_id = $_POST['recording_id'];

$transcriptions = $transcriptions->getTranscriptions($recording_id);

$call = $calls->getCalInfoByID($recording_id);

$info = [
    'user_name' => $_SESSION['ctn_first_name'] . " " . $_SESSION['ctn_last_name'],
    'call_info' => [
        'caller_name' => $call[0]['name'],
        'duration' => $call[0]['duration'],
        'date' => $call[0]['call_date'],
        'time' => $call[0]['call_time']
    ]
];

$data = [
    'info' => $info,
    'transcriptions' => $transcriptions
];

header('Content-Type: application/json');
echo json_encode($data);