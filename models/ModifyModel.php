<?php
include_once $_SERVER['DOCUMENT_ROOT']."/libs/Model.php";
class ModifyModel extends Model
{
    function __construct()
  {
    parent::__construct();
  }
  function __destruct()
  {
    parent::__destruct();
  }
  private function returnClassesToModify()
  {
    $sql = "SELECT klasa_id, nazwa, skrot FROM klasa ORDER BY klasa.skrot";
        $result = mysqli_query($this->conn,$sql);
    $rows = [];
        while($row = mysqli_fetch_array($result))
        {
            $rows[] = $row;
        }
        return $rows;
  }
    private function returnShelvesToModify()
  {
    $sql = "SELECT uczen.uczen_id ,uczen.imie, uczen.nazwisko, szafka.kod FROM uczen_szafka 
        INNER JOIN uczen ON uczen_szafka.uczen_id = uczen.uczen_id 
        LEFT JOIN szafka ON uczen_szafka.szafka_id = szafka.szafka_id
        ORDER BY uczen_szafka.szafka_id, uczen.nazwisko;";
        $result = mysqli_query($this->conn,$sql);
    $rows = [];
        while($row = mysqli_fetch_array($result))
        {
            $rows[] = $row;
        }
        return $rows;
  }
    private function returnStudentsToModify()
  {
    $sql = "SELECT uczen.uczen_id, uczen.imie, uczen.nazwisko, klasa.skrot FROM uczen
        INNER JOIN uczen_klasa ON uczen.uczen_id = uczen_klasa.uczen_id 
        INNER JOIN klasa ON uczen_klasa.klasa_id = klasa.klasa_id 
        ORDER BY klasa.skrot, uczen.nazwisko;";
        $result = mysqli_query($this->conn,$sql);
    $rows = [];
        while($row = mysqli_fetch_array($result))
        {
            $rows[] = $row;
        }
        return $rows;
  }
    private function returnClassesLockersToModify()
    {
        $sql = "SELECT uczen_szafka.klasa_id, klasa.nazwa, klasa.skrot, CONCAT('Nieprzypisane klucze: ', COUNT(uczen_szafka.klasa_id)) FROM uczen_szafka 
        LEFT JOIN szafka ON uczen_szafka.szafka_id = szafka.szafka_id 
        LEFT JOIN klasa ON uczen_szafka.klasa_id = klasa.klasa_id 
        WHERE uczen_szafka.uczen_id IS NULL 
        GROUP BY uczen_szafka.klasa_id ORDER BY klasa.nazwa;";
        $result = mysqli_query($this->conn,$sql);
    $rows = [];
        while($row = mysqli_fetch_array($result))
        {
            $rows[] = $row;
        }
        return $rows;
    }
    private function returnKeysToModify()
  {
    $sql = "SELECT szafka.szafka_id, szafka.kod, szafka.ilosc_kluczy, lokalizacja.pozycja FROM szafka 
        INNER JOIN szafka_lokalizacja ON szafka_lokalizacja.szafka_id = szafka.szafka_id 
        INNER JOIN lokalizacja ON lokalizacja.lokalizacja_id = szafka_lokalizacja.lokalizacja_id 
        ORDER BY lokalizacja.pozycja, szafka.szafka_id, szafka.kod;";
        $result = mysqli_query($this->conn,$sql);
        $rows = [];
        while($row = mysqli_fetch_array($result))
        {
            $rows[] = $row;
        }
        return $rows;
  }
    private function returnLocationsToModify()
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
    private function returnLockersStatusToModify()
    {
        $sql = "SELECT szafka_status.szafka_status_id, uczen.imie, uczen.nazwisko, szafka.kod, klasa.skrot, `status`.wartosc FROM szafka_status LEFT JOIN uczen_szafka ON uczen_szafka.uczen_szafka_id = szafka_status.uczen_szafka_id LEFT JOIN uczen ON uczen.uczen_id = uczen_szafka.uczen_id LEFT JOIN szafka ON szafka.szafka_id = uczen_szafka.szafka_id LEFT JOIN klasa ON klasa.klasa_id = uczen_szafka.klasa_id LEFT JOIN status ON status.status_id = szafka_status.status_id ORDER BY szafka.kod DESC;";
        $result = mysqli_query($this->conn,$sql);
        $rows = [];
        while($row = mysqli_fetch_array($result))
        {
            $rows[] = $row;
        }
        return $rows;
    }
    private function returnUsersToModify()
    {
        $sql = "SELECT uzytkownik_id, login FROM `uzytkownik`";
        $result = mysqli_query($this->conn,$sql);
        $rows = [];
        while($row = mysqli_fetch_array($result))
        {
            $rows[] = $row;
        }
        return $rows;
    }
  
    public function returnChosenToModify($chosenFunction)
  {
    switch($chosenFunction)
        {
            case 'Klasy':
                return $this->returnClassesToModify();
                break;
            case 'Uczen/Szafka':
                return $this->returnShelvesToModify();
                break;
            case 'Klasa/Szafki':
                return $this->returnClassesLockersToModify();
                break;
            case 'Status/Szafka':
                return $this->returnLockersStatusToModify();
                break;
            case 'Uczniowie':
                return $this->returnStudentsToModify();
                break;
            case 'Szafki':
                return $this->returnKeysToModify();
                break;
            case 'Lokalizacje':
                return $this->returnLocationsToModify();
                break;
            case 'Zmiana Hasła':
                return $this->returnUsersToModify();
                break;
            default:
                return $this->returnClassesToModify();
                break;
        }
  }
}

?>


<!-- 
SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = N'uczen';

-->

