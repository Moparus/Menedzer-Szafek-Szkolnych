<?php
include_once $_SERVER['DOCUMENT_ROOT']."/libs/Model.php";
class ClassesModel extends Model
{
    function __construct()
	{
		parent::__construct();
	}
	function __destruct()
	{
		parent::__destruct();
	}
    public function returnClassesList()
	{
		$sql = "SELECT * FROM `klasa` ORDER BY klasa.skrot";
        $result = mysqli_query($this->conn,$sql);
		$rows = [];
        while($row = mysqli_fetch_array($result))
        {
            $rows[] = $row;
        }
        return $rows;
	}
	public function returnStudentsList()
	{
		$sql = "SELECT uczen.imie, uczen.nazwisko, szafka.kod, lokalizacja.pozycja, klasa.skrot FROM uczen_szafka 
        LEFT JOIN uczen ON uczen_szafka.uczen_id = uczen.uczen_id 
        LEFT JOIN szafka ON szafka.szafka_id = uczen_szafka.szafka_id 
        INNER JOIN szafka_lokalizacja ON szafka_lokalizacja.szafka_id = uczen_szafka.szafka_id 
        INNER JOIN lokalizacja ON szafka_lokalizacja.lokalizacja_id = lokalizacja.lokalizacja_id 
        LEFT JOIN klasa ON uczen_szafka.klasa_id = klasa.klasa_id 
        ORDER BY uczen.nazwisko, lokalizacja.pozycja, szafka.kod;";
        $result = mysqli_query($this->conn,$sql);
		$rows = [];
        while($row = mysqli_fetch_array($result))
        {
            $rows[] = $row;
        }
        return $rows;
	}
}

