<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 0);

require_once('../../extensions/users/Database.php');
require_once('../../extensions/users/Users.php');

$action = $_REQUEST['action'];
$first_name = $_POST['first_name'];
$last_name  = $_POST['last_name'];
$email      = $_POST['email'];
$phone      = $_POST['phone'];
$password   = $_POST['password'];
$date       = date("Y-m-d")." ".date("h:i:sa");
$user = new Users();

switch($action) {
    case 'add_user':
        $user->setFirstName($first_name);
        $user->setLastName($last_name);
        $user->setEmail($email);
        $user->setPhone($phone);
        $user->setPassword($password);
        $user->setCreatedDate($date);
        $user->addUser();
        exit;

        break;
    case 'login':
        $user->login($email, $password);
        exit;

        break;
    case 'get_user_info':
        $userID = $_POST['id_user'];
        $userArray = $user->getUserInfo($userID);
        echo json_encode($userArray);
        exit;

        break;
    default:
        $UsersArray = $user->getAllEndpoints();
        header('Content-Type: application/json');
        echo json_encode([$UsersArray]);
        exit;

}



?>


