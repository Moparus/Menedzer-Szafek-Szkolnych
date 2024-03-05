<?php
include_once $_SERVER['DOCUMENT_ROOT']."/libs/Model.php";
class LockersModel extends Model
{
    function __construct()
  {
    parent::__construct();
  }
  function __destruct()
  {
    parent::__destruct();
  }
  public function returnLockersList($lockersLocation)
  {
        $sql = "SELECT szafka.szafka_id, szafka.kod, IF(IF(szafka.ilosc_kluczy>2,2,szafka.ilosc_kluczy)-COUNT(uczen_szafka.uczen_szafka_id)<0,0,IF(szafka.ilosc_kluczy>2,2,szafka.ilosc_kluczy)-COUNT(uczen_szafka.uczen_szafka_id)) FROM szafka_lokalizacja 
        INNER JOIN szafka ON szafka.szafka_id = szafka_lokalizacja.szafka_id 
        INNER JOIN lokalizacja ON szafka_lokalizacja.lokalizacja_id = lokalizacja.lokalizacja_id 
        LEFT JOIN uczen_szafka ON uczen_szafka.szafka_id = szafka.szafka_id 
        WHERE lokalizacja.pozycja = '$lockersLocation' 
        GROUP BY szafka.szafka_id 
        ORDER BY szafka_lokalizacja.lokalizacja_id, szafka.szafka_id, szafka.kod;";
        $result = mysqli_query($this->conn,$sql);
    $rows = [];
        while($row = mysqli_fetch_array($result))
        {
            $rows[] = $row;
        }
        return $rows;
  }
    public function checkIfKeysAvailable($lockerId)
  {
    $sql = "SELECT szafka.szafka_id, szafka.ilosc_kluczy, COUNT(uczen_szafka.uczen_szafka_id) FROM szafka 
        LEFT JOIN uczen_szafka ON szafka.szafka_id = uczen_szafka.szafka_id 
        WHERE szafka.szafka_id = '".$lockerId."' GROUP BY szafka.szafka_id;";
        $result = mysqli_query($this->conn,$sql);
    $rows = [];
        while($row = mysqli_fetch_array($result))
        {
            $rows[] = $row;
        }
        if($rows[0][1]>=2){
            if(2>$rows[0][2])
                return true;
            else
                return false;
        }
        else{
            if($rows[0][1]<=$rows[0][2])
                return false;
            else
                return true;
        }
  }
    public function returnSumOFKeys($lockerArray)
  {
    $sql = "SELECT szafka.szafka_id, IF(szafka.ilosc_kluczy>2,2,szafka.ilosc_kluczy)-COUNT(uczen_szafka.uczen_szafka_id) FROM szafka 
        LEFT JOIN uczen_szafka ON uczen_szafka.szafka_id = szafka.szafka_id 
        WHERE szafka.szafka_id IN ($lockerArray) GROUP BY szafka.szafka_id;";
        $result = mysqli_query($this->conn,$sql);
    $rows = [];
        while($row = mysqli_fetch_array($result))
        {
            $rows[] = $row;
        }
        $sum = 0;
        for($i=0;$i<sizeof($rows);$i++)
        {
            $sum += (int)$rows[$i][1];
        }
        return $sum;
  }
    public function returnChoosenLockersList($lockersId)
  {
        $sql = "SELECT szafka.szafka_id, szafka.kod, IF(szafka.ilosc_kluczy>2,2,szafka.ilosc_kluczy)-COUNT(uczen_szafka.uczen_szafka_id) FROM szafka 
        LEFT JOIN uczen_szafka ON uczen_szafka.szafka_id = szafka.szafka_id 
        WHERE szafka.szafka_id IN ($lockersId) 
        GROUP BY szafka.szafka_id;";
        $result = mysqli_query($this->conn,$sql);
    $rows = [];
        while($row = mysqli_fetch_array($result))
        {
            $rows[] = $row;
        }
        return $rows;
  }
    public function returnAvailableClassesList()
  {
        $sql = "SELECT klasa.klasa_id, klasa.nazwa, klasa.skrot, 
        (SELECT COUNT(*) FROM uczen_klasa WHERE uczen_klasa.klasa_id = klasa.klasa_id GROUP BY uczen_klasa.klasa_id), COUNT(uczen_szafka.klasa_id) 
        FROM klasa LEFT JOIN uczen_szafka ON uczen_szafka.klasa_id = klasa.klasa_id 
        GROUP BY klasa.klasa_id 
        ORDER BY klasa.nazwa;";
        $result = mysqli_query($this->conn,$sql);
    $rows = [];
        while($row = mysqli_fetch_array($result))
        {
            $rows[] = $row;
        }
        return $rows;
  }
    public function occupyLockersByClass($classId, $lockerId, $numOfKeys)
  {
        $numOfKeys = mysqli_real_escape_string($this->conn, $numOfKeys);
        for($i=0;$i<$numOfKeys; $i++)
        mysqli_query($this->conn, "INSERT INTO `uczen_szafka` (`uczen_szafka_id`, `uczen_id`, `szafka_id`, `klasa_id`) VALUES (NULL, NULL, '$lockerId', '$classId');");
  }
  public function addOccupyLockersArchive($classId, $numOfLockers)
  {
     mysqli_query($this->conn, "INSERT INTO archiwum (archiwum_id, opis, `data`) VALUES (NULL, CONCAT('Przypisano $numOfLockers szafek do klasy: ', (SELECT skrot FROM klasa WHERE klasa_id = $classId)), NOW());");
  }
}
?>


