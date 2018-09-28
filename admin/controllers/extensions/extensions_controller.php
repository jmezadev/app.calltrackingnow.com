<?php

require_once('../../init.php');

error_reporting(E_ALL);
ini_set('display_errors', 0);

$extID        = $_POST['ext_id'];
$extNumber    = $_POST['ext_number'];
$extName      = $_POST['trunk_name'];
$extUsername  = $_POST['ext_username'];
$extPassword  = $_POST['ext_password'];
$extContext   = $_POST['ext_context'];
$extDisallow  = $_POST['ext_disallow'];
$extAllow     = $_POST['ext_allow'];
$extTransport = $_POST['ext_transport'];
$extProxy     = $_POST['ext_proxy'];
$extPort      = $_POST['ext_port'];

$action = isset($_POST['action']) ? $_POST['action'] : $_REQUEST['action'];
$list   = $_REQUEST['list'];

$endpoint     = new Endpoint();
$aors         = new Aors();
$auths        = new Auths();
$registration = new Registration();
$identify     = new Identify();
$routes       = new Routes();

switch($action) {
    case 'add_ext':

        $endpoint->setId($extNumber);
        $endpoint->setUsername($extUsername);
        $endpoint->setTransport($extTransport);
        $endpoint->setContext($extContext);
        /*$endpoint->setDisallow($extDisallow);
        $endpoint->setAllow($extAllow);*/
        $endpoint->addNewEndpoint();

        $aors->setId($extNumber);
        $aors->addEndpointAors();

        $auths->setId($extNumber);
        $auths->setPassword($extPassword);
        $auths->setUsername($extUsername);
        $auths->addEndpointAuths();


        $info = array('code' => 0, 'title' => 'Successful!', 'msg' => 'The extension has been registered successfully.');

        header('Content-Type: application/json');
        echo json_encode($info);
        exit;

        break;

    case 'add_trunk':

        $identifies = $_POST['identifies'];

        $URI         = 'sip:' . $extUsername . '@' . $extProxy . (!is_null($extPort) ? $port = ":$extPort" : $port = '');
        $URI_contact = 'sip:' . $extProxy . (!is_null($extPort) ? ($extPort != "") ? $port = ":$extPort" : $port = '' : $port = '');
        $URI_client  = 'sip:' . $extUsername . '@' . $extProxy . (!is_null($extPort) ? ($extPort != "") ? $port = ":$extPort" : $port = '' : $port = '');

        if(isset($extTransport)) {
            $endpoint->setTransport($extTransport);
        }

        $endpoint->setId($extUsername);
        $endpoint->setUsername($extUsername);
        $endpoint->setContext($extContext);
        $endpoint->setOutboundAuth($extUsername);
        $endpoint->setDirectMedia('yes');
        $endpoint->setDtlsVerify('fingerprint');
        $endpoint->setName($extName);
        $endpoint->addNewTrunk();

        $aors->setId($extUsername);
        $aors->setContact($URI_contact);
        $aors->setRemoveExisting('false');
        $aors->setAuthenticateQualify('yes');
        $aors->addEndpointAors();

        $auths->setId($extUsername);
        $auths->setPassword($extPassword);
        $auths->setUsername($extUsername);
        $auths->addEndpointAuths();

        $count = count($identifies);

        for ($i = 1; $i <= $count; $i++) {
            $identify->setId($extUsername);
            $identify->setEndpoint($extUsername);
            $identify->setMatch($identifies['identify_trunk_'.$i]);

            $identify->addNewDIDEndpointIdentify();
        }

        $registration->setId($extUsername);
        $registration->setOutboundAuth($extUsername);
        $registration->setServerUri("sip:$extProxy");
        $registration->setClientUri($URI_client);
        $registration->setEndpoint($extUsername);
        $registration->setTransport($extTransport);

        $registration->addNewDIDEndpointRegistration();

        $info = array('code' => 0, 'title' => 'Successful!', 'msg' => 'The trunk has been registered successfully.');

        header('Content-Type: application/json');
        echo json_encode($info);
        exit;

        break;

    case 'upd_ext':

        $auths->setId($extID);
        $auths->setPassword($extPassword);
        $auths->setUsername($extID);
        $auths->updateEndpointAuths();

        $endpoint->setId($extNumber);
        $endpoint->setContext($extContext);
        $endpoint->updateEndpointInfo();

        $info = array('code' => 0, 'title' => 'Successful!', 'msg' => 'The extension has been updated successfully.');

        header('Content-Type: application/json');
        echo json_encode($info);
        exit;

        break;

    case 'upd_trunk':

        $URI        = 'sip:' . $extID . '@' . $extProxy . (!is_null($extPort) ? $port = ":$extPort" : $port = '');
        $URI_server = 'sip:' . $extProxy . (!is_null($extPort) ? ($extPort != "") ? $port = ":$extPort" : $port = '' : $port = '');
        $URI_client = 'sip:' . $extID . '@' . $extProxy . (!is_null($extPort) ? ($extPort != "") ? $port = ":$extPort" : $port = '' : $port = '');

        $auths->setId($extID);
        $auths->setPassword($extPassword);
        $auths->setUsername($extID);
        $auths->updateEndpointAuths();

        $endpoint->setId($extID);
        $endpoint->setContext($extContext);
        $endpoint->setName($extName);
        $endpoint->updateTrunk();

        $identify->setId($extID);
        $identify->setMatch($extProxy);
        $identify->updateEndpointIdentify();

        $registration->setId($extID);
        $registration->setTransport($extTransport);
        $registration->setClientUri($URI_client);
        $registration->setServerUri($URI_server);
        $registration->updateEndpointRegistration();

        $info = array('code' => 0, 'title' => 'Successful!', 'msg' => 'The DID extension has been updated successfully.');

        header('Content-Type: application/json');
        echo json_encode($info);
        exit;

        break;

    case 'del_ext':

        $auths->setId($extNumber);
        $auths->deleteEndpointAuths();

        $aors->setId($extNumber);
        $aors->deleteEndpointAors();

        $registration->setId($extNumber);
        $registration->deleteEndpointRegistration();

        $identify->setId($extNumber);
        $identify->deleteEndpointIdentify();

        $endpoint->setId($extNumber);
        $endpoint->deleteEndpoint();


        $info = array('code' => 0, 'title' => 'Successful!', 'msg' => 'The extension has been deleted successfully.');

        header('Content-Type: application/json');
        echo json_encode($info);
        exit;

        break;

    case 'del_ext_simple':

        $auths->setId($extNumber);
        $auths->deleteEndpointAuths();

        $aors->setId($extNumber);
        $aors->deleteEndpointAors();

        $registration->setId($extNumber);
        $registration->deleteEndpointRegistration();

        $identify->setId($extNumber);
        $identify->deleteEndpointIdentify();

        $endpoint->setId($extNumber);
        $endpoint->deleteSimpleEndpoint();


        $info = array('code' => 0, 'title' => 'Successful!', 'msg' => 'The extension has been deleted successfully.');

        header('Content-Type: application/json');
        echo json_encode($info);
        exit;

        break;

    case 'del_trunk':

        $auths->setId($extNumber);
        $auths->deleteEndpointAuths();

        $aors->setId($extNumber);
        $aors->deleteEndpointAors();

        $registration->setId($extNumber);
        $registration->deleteEndpointRegistration();

        $identify->setId($extNumber);
        $identify->deleteEndpointIdentify();

        $endpoint->setId($extNumber);
        $endpoint->deleteTrunk();

        $info = array('code' => 0, 'title' => 'Successful!', 'msg' => 'The trunk has been deleted successfully.');

        header('Content-Type: application/json');
        echo json_encode($info);
        exit;

        break;

    case 'check_did_number':

        $didNumber = $_POST['did_number'];

        $exists = $endpoint->checkIfDIDExists($didNumber);

        $info = array('code' => ($exists) ? 0 : 1);

        header('Content-Type: application/json');
        echo json_encode($info);
        exit;

        break;

    case 'check_if_exists':

        $value = $_POST['value'];
        $checkType = $_POST['check'];

        if($checkType == "simple_extension") {

            $exists = $endpoint->checkIfExtensionExists($value);

        } else if ($checkType == "trunk") {

            $valueTrunk = $_POST['value_trunk'];
            $valueUsername = $_POST['value_username'];

            if (isset($valueTrunk) || !is_null($valueTrunk)) {
                $trunkNameExists = $endpoint->checkIfTrunkNameExists($valueTrunk);
            }

            if (isset($valueUsername) || !is_null($valueUsername)) {
                $trunkNumberExists = $endpoint->checkIfTrunkNumberExists($valueUsername);
            }

            $info = [
                'trunk_name' => ['code' => ($trunkNameExists) ? 0 : 1],
                'trunk_number' => ['code' => ($trunkNumberExists) ? 0 : 1]
            ];

            header('Content-Type: application/json');
            echo json_encode($info);
            exit;
        }

        $info = array('code' => ($exists) ? 0 : 1);

        header('Content-Type: application/json');
        echo json_encode($info);
        exit;

        break;

    case 'add_did_to_trunk':

        $trunk = $_POST['id_trunk'];
        $DIDNumber = $_POST['did_number'];

        $endpoint->addDIDtoTrunk($trunk, $DIDNumber);

        $info = array('code' => 0, 'title' => 'Successful!', 'msg' => 'The DID has been associated to the trunk successfully.');

        header('Content-Type: application/json');
        echo json_encode($info);
        exit;

        break;

    case 'get_trunk_info':

        $idTrunk = $_POST['id_trunk'];

        $DIDInfo = $endpoint->getTrunkInfo($idTrunk);

        header('Content-Type: application/json');
        echo json_encode($DIDInfo);
        exit;

        break;

    case 'get_did_info':

        $didNumber = $_POST['did_number'];

        $DIDInfo = $endpoint->getDIDInfo($didNumber);
        $trunksData = $endpoint->getTrunks();

        $data = [
            'did_info' => $DIDInfo,
            'trunks' => $trunksData
        ];

        header('Content-Type: application/json');
        echo json_encode($data);
        exit;

        break;

    case 'get_extension_info':

        $extensionID = $_POST['id_extension'];

        $extensionInfo = $endpoint->getExtensionInfo($extensionID);

        header('Content-Type: application/json');
        echo json_encode($extensionInfo);
        exit;

        break;

    case 'upd_did_ext':

        $didID = $_POST['did_id'];
        $trunkID = $_POST['trunk_id'];
        $endpoint->updateDID($didID, $trunkID);

        $info = array('code' => 0, 'title' => 'Successful!', 'msg' => 'The DID has been updated successfully.');

        header('Content-Type: application/json');
        echo json_encode($info);
        exit;

        break;

    case 'del_did':

        $didID = $_POST['did_id'];
        $endpoint->deleteDID($didID);

        $info = array('code' => 0, 'title' => 'Successful!', 'msg' => 'The DID has been deleted successfully.');

        header('Content-Type: application/json');
        echo json_encode($info);
        exit;

        break;


    case 'assign_to_user':

        $userID = $_POST['user_id'];
        $didID = $_POST['did_id'];

        $endpoint->assignDIDToUser($didID, $userID);

        $info = array('code' => 0, 'title' => 'Successful!', 'msg' => 'The DID has been assigned to user successfully.');

        header('Content-Type: application/json');
        echo json_encode($info);
        exit;

        break;

    case 'remove_from_user':

        $userID = $_POST['user_id'];
        $didID = $_POST['did_id'];

        $endpoint->removeDIDFromUser($didID, $userID);

        $info = array('code' => 0, 'title' => 'Successful!', 'msg' => 'The DID has been removed from user successfully.');

        header('Content-Type: application/json');
        echo json_encode($info);
        exit;

        break;

    default:

        if($list == 'simple') {
            $endpointsArray = $endpoint->getAllDIDEndpointsList();
        } elseif ($list == 'dids_for_campaigns') {
            $endpointsArray = $endpoint->getAllDIDEndpointsForCampaigns();
        } elseif ($list == 'did') {
            $endpointsArray = $endpoint->getAllDIDEndpoints();
        }  elseif ($list == 'trunks') {
            $endpointsArray = $endpoint->getTrunks();
        } else {
            $endpointsArray = $endpoint->getAllEndpoints();
        }


        header('Content-Type: application/json');
        echo json_encode([$endpointsArray]);
        exit;

}