<?php
include_once $_SERVER['DOCUMENT_ROOT']."/libs/Model.php";
class MainModel extends Model
{
    function __construct()
  {
    parent::__construct();
  }
  function __destruct()
  {
    parent::__destruct();
  }
  public function returnShelfOccupancy()
  {
    $result1 = mysqli_query($this->conn, "SELECT COUNT(szafka_id) FROM uczen_szafka");
    $count1 = mysqli_fetch_array($result1, MYSQLI_NUM);
    $result2 = mysqli_query($this->conn, "SELECT SUM(szafka.ilosc_kluczy) FROM szafka");
    $count2 = mysqli_fetch_array($result2, MYSQLI_NUM);
    $result = intval(($count1[0]/$count2[0])*100);
    return $result;
  }
  public function endangeredLockers()
  {
    $sql = "SELECT * FROM `szafka` WHERE ilosc_kluczy<2 ORDER BY ilosc_kluczy;";
    $result = mysqli_query($this->conn,$sql);
    $rows = [];
    while($row = mysqli_fetch_array($result))
    {
      $rows[] = $row;
    }
    return $rows;
  }
  public function endangeredStudents()
  {
    $sql = "SELECT uczen.imie, uczen.nazwisko, klasa.skrot FROM uczen LEFT JOIN uczen_klasa ON uczen_klasa.uczen_id = uczen.uczen_id LEFT JOIN klasa ON klasa.klasa_id = uczen_klasa.klasa_id WHERE uczen.uczen_id NOT IN (SELECT uczen_szafka.uczen_id FROM uczen_szafka WHERE uczen_szafka.uczen_id IS NOT NULL GROUP BY uczen_szafka.uczen_id) ORDER BY klasa.skrot DESC;";
    $result = mysqli_query($this->conn,$sql);
    $rows = [];
    while($row = mysqli_fetch_array($result))
    {
      $rows[] = $row;
    }
    return $rows;
  }
  
}