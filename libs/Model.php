<?php
include_once $_SERVER['DOCUMENT_ROOT']."/libs/Session.php";
include_once $_SERVER['DOCUMENT_ROOT'].'/libs/Database.php';

class Model
{
  public $conn;
  function __construct()
  {
    $this->conn = OpenCon();
    ini_set('display_errors', 0);
  }
  function __destruct()
  {
    CloseCon($this->conn);
  }
}