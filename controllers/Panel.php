<?php
include_once $_SERVER['DOCUMENT_ROOT']."/libs/Session.php";
include_once $_SERVER['DOCUMENT_ROOT'].'/libs/Cookie.php';
setLockersCookie("");

if ($_SERVER["REQUEST_METHOD"] == "GET"){
    if(isset($_GET['sideMenuButton'])){
        switch($_GET['sideMenuButton'])
        {
            case "Klasy":
                include_once $_SERVER['DOCUMENT_ROOT'].'/views/elements/classesElement.php';
                break;
            case "Dane":
                include_once $_SERVER['DOCUMENT_ROOT'].'/views/elements/dataElement.php';
                break;
            case "Archiwum":
                include_once $_SERVER['DOCUMENT_ROOT'].'/views/elements/archiveElement.php';
                break;
            case "Modyfikacja":
                include_once $_SERVER['DOCUMENT_ROOT'].'/views/elements/modifyElement.php';
                break;
            case "main":
                include_once $_SERVER['DOCUMENT_ROOT'].'/views/elements/mainElement.php';
                break;
            default:
                $_COOKIE['lockers'] = $_GET['sideMenuButton'];
                include_once $_SERVER['DOCUMENT_ROOT'].'/views/elements/lockersElement.php';
            break;
        }
    }
    else {
        include_once $_SERVER['DOCUMENT_ROOT'].'/views/elements/mainElement.php';
    }
} else {
    include_once $_SERVER['DOCUMENT_ROOT'].'/views/elements/mainElement.php';
}
?>