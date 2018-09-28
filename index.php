<?php

//initilize the page
require_once 'init.web.php';
session_start();

if($_SESSION['ctn_authenticated']){
	header('Location: main.php');
}
else{
	header('Location: login.php');	
}

?>