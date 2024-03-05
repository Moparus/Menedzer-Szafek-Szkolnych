<?php
include_once $_SERVER['DOCUMENT_ROOT']."/libs/Session.php";
function OpenCon()
{
    $dbhost = "localhost";
    $dbuser = "root";
    $dbpass = "";
    $dbname = "klucze";
  try {
      $conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
      mysqli_set_charset($conn, "utf8");
      return $conn;
    } catch(\Exception $e) {
      echo('Nie udało się połączyć z bazą ');
  }
}
function CloseCon($conn)
{
    mysqli_close($conn);
}
