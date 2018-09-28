<?php

require_once('../../init.php');

error_reporting(E_ALL);
ini_set('display_errors', 0);

$calls = new Calls();

$action = $_REQUEST['filter'];

switch($action) {

    case 'answered':

        $answeredCalls = $calls->getAnsweredCalls();

        header('Content-Type: application/json');
        echo json_encode($answeredCalls);
        exit;

        break;


    default:

        $allCalls = $calls->getCalls();

        header('Content-Type: application/json');
        echo json_encode($allCalls);
        exit;

        break;

}