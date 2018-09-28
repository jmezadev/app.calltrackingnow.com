<?php

require_once('../../init.php');

error_reporting(E_ALL);
ini_set('display_errors', 0);

$callers = new Callers();

$action = $_REQUEST['filter'];

switch($action) {

    case 'value':

        $answeredCalls = $callers->getAnsweredCalls();

        header('Content-Type: application/json');
        echo json_encode($answeredCalls);
        exit;

        break;

    default:

        $allCallers = $callers->getCallers();

        header('Content-Type: application/json');
        echo json_encode($allCallers);
        exit;

        break;

}