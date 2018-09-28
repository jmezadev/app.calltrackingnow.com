<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 0);

require_once('../../extensions/users/Database.php');
require_once('../../extensions/users/Users.php');

$action         = $_REQUEST['action'];
$id             = $_POST['id'];
$first_name     = $_POST['first_name'];
$last_name      = $_POST['last_name'];
$email          = $_POST['email'];
$phone          = $_POST['phone'];
$password       = $_POST['password'];
$changePassword = $_POST['edit_password'];
$date           = date("Y-m-d") . " " . date("h:i:sa");
$user           = new Users();

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

    case 'upd_user':

        $editPass = false;

        $user->setId($id);
        $user->setFirstName($first_name);
        $user->setLastName($last_name);
        $user->setEmail($email);
        $user->setPhone($phone);
        if(isset($changePassword) || !is_null($changePassword)) {
            $editPass = true;
            $user->setPassword($password);
        }
        $user->updateUser($editPass);

        $info = array('code' => 0, 'title' => 'Successful!', 'msg' => 'The user has been updated successfully.');

        header('Content-Type: application/json');
        echo json_encode($info);

        exit;

    case 'del_user':

        $user->setId($id);
        $user->deleteUser();

        $info = array('code' => 0, 'title' => 'Successful!', 'msg' => 'The user has been delete successfully.');

        header('Content-Type: application/json');
        echo json_encode($info);

        exit;

        break;
    case 'login':
        $user->login($email, $password);
        exit;

        break;
    case 'get_user_info':
        $userID    = $_POST['id_user'];
        $userArray = $user->getUserInfo($userID);
        header('Content-Type: application/json');
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


