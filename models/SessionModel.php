<?php
include_once $_SERVER['DOCUMENT_ROOT']."/libs/Model.php";
class SessionModel extends Model
{
    function __construct()
	{
		parent::__construct();
		if (session_status() === PHP_SESSION_NONE) {
        	session_start();
		}
	}
	function __destruct()
	{
		parent::__destruct();
	}
	public function setSession()
	{
		$sql = "SELECT `szyfr` FROM `sesja` WHERE `sesja_id` = 1";
        $result = mysqli_query($this->conn,$sql);
		$row = mysqli_fetch_assoc($result);
        $_SESSION['loginValidation'] = $row['szyfr'];
	}
    public function getSessionKey()
	{
		$sql = "SELECT `klucz` FROM `sesja` WHERE `sesja_id` = 1";
        $result = mysqli_query($this->conn,$sql);
		$row = mysqli_fetch_assoc($result);
        return $row['klucz'];
	}
}