<?php
include_once $_SERVER['DOCUMENT_ROOT']."/libs/Model.php";
class MainPanel extends Model
{
    function __construct()
	{
		parent::__construct();
	}
	function __destruct()
	{
		parent::__destruct();
	}
	public function returnLocationsList()
	{
		$sql = "SELECT * FROM lokalizacja";
        $result = mysqli_query($this->conn,$sql);
		$rows = [];
        while($row = mysqli_fetch_array($result))
        {
            $rows[] = $row;
        }
        return $rows;
	}
}