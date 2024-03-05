<?php
include_once $_SERVER['DOCUMENT_ROOT']."/libs/Model.php";
class DataModel extends Model
{
    function __construct()
	{
		parent::__construct();
	}
	function __destruct()
	{
		parent::__destruct();
	}
	public function returnDataList()
	{
		$sql = "SELECT uczen.imie, uczen.nazwisko, klasa.skrot, szafka.kod, lokalizacja.pozycja FROM uczen 
        LEFT JOIN uczen_klasa ON uczen_klasa.uczen_id = uczen.uczen_id 
        LEFT JOIN klasa ON klasa.klasa_id = uczen_klasa.klasa_id 
        LEFT JOIN uczen_szafka ON uczen_szafka.uczen_id = uczen.uczen_id 
        LEFT JOIN szafka ON uczen_szafka.szafka_id = szafka.szafka_id 
        LEFT JOIN szafka_lokalizacja ON szafka_lokalizacja.szafka_id = szafka.szafka_id 
        LEFT JOIN lokalizacja ON lokalizacja.lokalizacja_id = szafka_lokalizacja.lokalizacja_id 
        ORDER BY uczen.nazwisko;";
        $result = mysqli_query($this->conn,$sql);
		$rows = [];
        while($row = mysqli_fetch_array($result))
        {
            $rows[] = $row;
        }
        return $rows;
	}
}

