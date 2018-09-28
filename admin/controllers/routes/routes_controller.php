<?php

require_once('../../init.php');

error_reporting(E_ALL);
ini_set('display_errors', 0);

$extID       = $_POST['ext_id'];
$extNumber   = $_POST['ext_number'];
$extUsername = $_POST['ext_username'];

$action = isset($_POST['action']) ? $_POST['action'] : $_REQUEST['action'];
$list   = $_REQUEST['list'];

$endpoint  = new Endpoint();
$routes    = new Routes();
$campaigns = new Campaigns();

switch($action) {

    case 'add_route':

        $extensionFrom = $_POST['did_from'];
        $extensionTo   = $_POST['did_to'];
        $context       = "default";
        $app           = "Dial";
        $campaign_id   = $_POST['camp_id'];

        $trunkIDEndpoint = $endpoint->getTrunkIDEndpoint($extensionFrom);

        $appdata = "PJSIP/$extensionTo@$trunkIDEndpoint,30";

        /* NoOp App */
        /*$routes->setContext($context);
        $routes->setExten("_$extensionFrom");
        $routes->setPriority(1);
        $routes->setApp("NoOp");
        $routes->setAppdata("Calling from DB Dialplan");
        $routes->addRule();*/


        /* Route Config */
        $routes->setContext($context);
        $routes->setExten($extensionFrom);
        $routes->setPriority(1);
        $routes->setApp($app);
        $routes->setAppdata($appdata);
        $routes->setCampaignID($campaign_id);
        $routes->addRule();

        $routes->setDIDStatus($extensionFrom);

        /* Hangup Config */
        /*$routes->setContext($context);
        $routes->setExten("_$extensionFrom");
        $routes->setPriority(3);
        $routes->setApp("Hangup");
        $routes->setAppdata("16");
        $routes->addRule();*/

        $info = array('code' => 0, 'title' => 'Successful!', 'msg' => 'The bridge has been add successfully.');

        header('Content-Type: application/json');
        echo json_encode($info);
        exit;

        break;

    case 'del_route':

        $id = $_POST['id'];
        $id_did = $_POST['id_did'];

        $routes->setId($id);
        $routes->deleteRule($id_did);

        $info = array('code' => 0, 'title' => 'Successful!', 'msg' => 'The bridge has been deleted successfully.');

        header('Content-Type: application/json');
        echo json_encode($info);
        exit;

        break;

    case 'upd_route':

        $extenNew    = $_POST['exten_num'];
        $bridgeNew   = $_POST['bridge'];
        $campaign_id = $_POST['campaign_id'];
        $id          = $_POST['id'];

        $DIDExtensionfrom = $endpoint->getTrunkIDEndpoint($extenNew);

        $appData = "PJSIP/$bridgeNew@$DIDExtensionfrom,30";

        $routes->setId($id);
        $routes->setExten($extenNew);
        $routes->setAppdata($appData);
        $routes->updateRoute($campaign_id);

        $info = array('code' => 0, 'title' => 'Successful!', 'msg' => 'The bridge has been updated successfully.');

        header('Content-Type: application/json');
        echo json_encode($info);
        exit;

        break;

    case 'get_route':

        $id_route       = $_POST['id_route'];
        $routeArray     = $routes->getRouteById($id_route);
        $didsArray      = $endpoint->getAllDIDs();
        $campaignsArray = $campaigns->getCampaigns();

        $array = ['routes' => $routeArray, 'dids' => $didsArray, 'campaigns' => $campaignsArray];

        header('Content-Type: application/json');
        echo json_encode($array);
        exit;

        break;

    default:

        $rulesArray = $routes->getExtensionsRules();
        $didsArray  = $endpoint->getAllDIDs();

        $array = ['routes' => $rulesArray, 'dids' => $didsArray];

        header('Content-Type: application/json');
        echo json_encode($array);
        exit;

}