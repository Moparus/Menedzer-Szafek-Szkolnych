<?php
include_once $_SERVER['DOCUMENT_ROOT']."/models/SessionModel.php";

$newSession= new SessionModel();

if((!isset($_SESSION['loginValidation'])) && (hash('sha256', $newSession->getSessionKey())!=$_SESSION['loginValidation'])){
     header('location: ../index.php');
     session_destroy();
}
