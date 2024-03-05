<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/libs/Session.php';

if(isset($_POST['logout'])){
    session_destroy();
    header('location: ../index.php');
}



