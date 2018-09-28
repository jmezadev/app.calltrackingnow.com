<?php

require_once('../../init.php');

error_reporting(E_ALL);
ini_set('display_errors', 0);

$campaigns = new Campaigns();
$endpoint  = new Endpoint();

$action = $_REQUEST['action'];

switch($action) {

    case 'value':

        $answeredCalls = $campaigns->getAnsweredCalls();

        header('Content-Type: application/json');
        echo json_encode($answeredCalls);
        exit;

        break;

    case 'get_campaign_info':

        $idCampaign = $_POST['id_campaign'];

        $campaignInfo = $campaigns->getCampaignInfo($idCampaign);

        header('Content-Type: application/json');
        echo json_encode($campaignInfo);
        exit;

        break;

    case 'add_campaign':

        function formatDate($date) {

            $arrayDate = explode("/", $date);
            $day = $arrayDate[1];
            $month = $arrayDate[0];
            $year = $arrayDate[2];

            $formatDate = $year . "-" . $month  . "-" . "$day";

            return $formatDate;
        }

        $campaignName = $_POST['camp_name'];
        $campaignDescription = $_POST['camp_description'];
        $campaignStartDate = $_POST['camp_start_date'];
        $campaignEndDate = $_POST['camp_end_date'];
        $campaignDID = $_POST['camp_did'];

        $campaigns->setName($campaignName);
        $campaigns->setDescription($campaignDescription);
        $campaigns->setStartDate(formatDate($campaignStartDate));
        $campaigns->setEndDate(formatDate($campaignEndDate));

        /*$DIDid    = "";
        $arrayDID = $endpoint->getAllDIDInfoByDID($campaignDID);
        $DIDid = $arrayDID[0]['id_did'];

        $campaigns->setIdDid($DIDid);*/

        $campaigns->addCampaign();

        $info = array('code' => 0, 'title' => 'Successful!', 'msg' => 'The campaign has been add successfully.');

        header('Content-Type: application/json');
        echo json_encode($info);
        exit;

        break;

    case 'delete_campaign':

        $campaignID = $_POST['campaignID'];

        $campaigns->setIdCampaign($campaignID);
        $campaigns->deleteCampaign();

        $info = array('code' => 0, 'title' => 'Successful!', 'msg' => 'The campaign has been delete successfully.');

        header('Content-Type: application/json');
        echo json_encode($info);
        exit;

        break;

    case 'del_route':

        $idCampaign = $_POST['id'];

        $campaigns->setIdCampaign($idCampaign);
        $campaigns->deleteCampaign();

        $info = array('code' => 0, 'title' => 'Successful!', 'msg' => 'The campaign has been deleted successfully.');

        header('Content-Type: application/json');
        echo json_encode($info);
        exit;

        break;

    case 'upd_campaign':

        $campaignID          = $_POST['id_campaign'];
        $campaignName        = $_POST['camp_name'];
        $campaignDescription = $_POST['camp_description'];
        $campaignDID         = $_POST['did'];

        /*$DIDid    = "";
        $arrayDID = $endpoint->getAllDIDInfoByDID($campaignDID);
        $DIDid = $arrayDID[0]['id_did'];*/

        $campaigns->setIdCampaign($campaignID);
        $campaigns->setName($campaignName);
        $campaigns->setDescription($campaignDescription);
        $campaigns->updateCampaign();

        $info = array('code' => 0, 'title' => 'Successful!', 'msg' => 'The campaign has been updated successfully.');

        header('Content-Type: application/json');
        echo json_encode($info);
        exit;

        break;

    default:

        $allCallers = $campaigns->getCampaigns();

        header('Content-Type: application/json');
        echo json_encode($allCallers);
        exit;

        break;

}