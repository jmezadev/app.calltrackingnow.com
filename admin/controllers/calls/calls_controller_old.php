<?php

require_once('../../init.php');

error_reporting(E_ALL);
ini_set('display_errors', 0);

$cdr = new CDR();

$action = $_REQUEST['filter'];

switch($action) {

    case 'answered':

        $answeredCalls = $cdr->getAnsweredCalls();

        header('Content-Type: application/json');
        echo json_encode($answeredCalls);
        exit;

    break;

    case 'no_answer':

        $noAnsweredCalls = $cdr->getNoAnsweredCalls();

        header('Content-Type: application/json');
        echo json_encode($noAnsweredCalls);
        exit;

    break;

    case 'busy':

        $busyCalls = $cdr->getBusyCalls();

        header('Content-Type: application/json');
        echo json_encode($busyCalls);
        exit;

    break;

    case 'congested':

        $congestedCalls = $cdr->getCongestedCalls();

        header('Content-Type: application/json');
        echo json_encode($congestedCalls);
        exit;

    break;

    default:

        $allCalls = $cdr->getAllCalls();

        header('Content-Type: application/json');
        echo json_encode($allCalls);
        exit;

    break;

}