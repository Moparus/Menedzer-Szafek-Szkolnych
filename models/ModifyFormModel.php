<?php
include_once $_SERVER['DOCUMENT_ROOT']."/libs/Model.php";
class ModifyFormModel extends Model
{
    function __construct()
  {
    parent::__construct();
  }
  function __destruct()
  {
    parent::__destruct();
  }
  function modifyClass($classId, $className, $classShort)
  {
    $classId = mysqli_real_escape_string($this->conn, $classId);
    $className = mysqli_real_escape_string($this->conn, $className);
    $classShort = mysqli_real_escape_string($this->conn, $classShort);
    mysqli_query($this->conn, "INSERT INTO `archiwum` (`archiwum_id`, `opis`, `data`) VALUES (NULL, CONCAT('Zmieniono dane klasy: ', (SELECT kla.nazwa FROM (SELECT * FROM klasa) AS kla WHERE kla.klasa_id = '$classId'), ' na: $className $classShort'), NOW());");
    mysqli_query($this->conn, "UPDATE `klasa` SET `nazwa` = '$className', `skrot` = '$classShort' WHERE `klasa`.`klasa_id` = '$classId';");
  }
  function modifyKey($keyId, $keyAmount, $location)
  {
    $location = mysqli_real_escape_string($this->conn, $location);
    $keyId = mysqli_real_escape_string($this->conn, $keyId);
    $keyAmount = mysqli_real_escape_string($this->conn, $keyAmount);
    mysqli_query($this->conn, "INSERT INTO archiwum (archiwum_id, opis, `data`) VALUES (NULL, CONCAT('Zmieniono ilość kluczy szafki ', (SELECT CONCAT(szaf.kod, ': ', szaf.ilosc_kluczy) FROM (SELECT * FROM szafka) AS szaf WHERE  szaf.szafka_id = '$keyId'), '->$keyAmount'), NOW());");
    mysqli_query($this->conn, "UPDATE szafka SET ilosc_kluczy = '$keyAmount' WHERE szafka.szafka_id = '$keyId';");
    mysqli_query($this->conn, "UPDATE szafka_lokalizacja SET lokalizacja_id = '$location' WHERE szafka_lokalizacja.szafka_id = $keyId;");
  }
  function modifyLocker($studentId, $lockerId)
  {
    mysqli_query($this->conn, "INSERT INTO `archiwum` (`archiwum_id`, `opis`, `data`) VALUES (NULL, CONCAT('Zmieniono przypisanie szafki dla ', (SELECT CONCAT(ucz.imie, ' ', ucz.nazwisko, ': ') FROM (SELECT * FROM uczen) AS ucz WHERE ucz.uczen_id = '$studentId'), (SELECT szaf.kod FROM (SELECT * FROM szafka) AS szaf INNER JOIN uczen_szafka ON uczen_szafka.szafka_id = szaf.szafka_id WHERE uczen_szafka.uczen_id = '$studentId'), '->', (SELECT szaf1.kod FROM (SELECT * FROM szafka) AS szaf1 WHERE szaf1.szafka_id = '$lockerId')), NOW());");
    mysqli_query($this->conn, "UPDATE uczen_szafka SET uczen_szafka.szafka_id = '$lockerId' WHERE uczen_szafka.uczen_id = '$studentId';");
  }
  function modifyStudent($studentId, $studentName, $studentSurname, $classId)
  {
    $studentName = mysqli_real_escape_string($this->conn, $studentName);
    $studentSurname = mysqli_real_escape_string($this->conn, $studentSurname);
    mysqli_query($this->conn, "INSERT INTO `archiwum` (`archiwum_id`, `opis`, `data`) VALUES (NULL, CONCAT('Zmieniono dane ucznia: ', (SELECT CONCAT(ucz.imie, ' ', ucz.nazwisko, ' ', kla.skrot) FROM (SELECT * FROM uczen) AS ucz INNER JOIN (SELECT * FROM uczen_klasa) AS uczkla ON uczkla.uczen_id = ucz.uczen_id INNER JOIN (SELECT * FROM klasa) AS kla ON uczkla.klasa_id = kla.klasa_id WHERE ucz.uczen_id = '$studentId'), ' na $studentName $studentSurname ', (SELECT klas.skrot FROM (SELECT * FROM klasa) AS klas WHERE klas.klasa_id = $classId)), NOW());");
    mysqli_query($this->conn, "UPDATE uczen SET imie = '$studentName', nazwisko = '$studentSurname' WHERE uczen.uczen_id = '$studentId';");
    mysqli_query($this->conn, "UPDATE uczen_klasa SET klasa_id = '$classId' WHERE uczen_klasa.uczen_id = '$studentId';");
  }
  function modifyClassLockers($classId, $lockerId, $keysAmount)
  {
    $keysAmount = mysqli_real_escape_string($this->conn, $keysAmount);
    $result = mysqli_query($this->conn, "SELECT COUNT(uczen_szafka.uczen_szafka_id) FROM `uczen_szafka` INNER JOIN szafka ON uczen_szafka.szafka_id = szafka.szafka_id WHERE szafka.kod = '$lockerId' AND klasa_id = $classId;");
    $count = mysqli_fetch_array($result, MYSQLI_NUM);
    if($count[0]>$keysAmount){
      $limit = $count[0]-$keysAmount;
      mysqli_query($this->conn, "DELETE FROM uczen_szafka WHERE uczen_szafka.szafka_id = (SELECT szaf.szafka_id FROM (SELECT * FROM szafka) AS szaf WHERE szaf.kod = '$lockerId') AND klasa_id = $classId ORDER BY uczen_szafka_id LIMIT $limit;");
    }
    else if($count[0]<$keysAmount){
      $countKeys = mysqli_query($this->conn, "SELECT COUNT(*) FROM `uczen_szafka` WHERE szafka_id = (SELECT szaf.szafka_id FROM (SELECT * FROM szafka) AS szaf WHERE szaf.kod = '$lockerId');");
      $countK = mysqli_fetch_array($countKeys, MYSQLI_NUM);
      if($countK[0]<2){
        mysqli_query($this->conn, "INSERT INTO `uczen_szafka` (`uczen_szafka_id`, `uczen_id`, `szafka_id`, `klasa_id`) VALUES (NULL, NULL, (SELECT szaf.szafka_id FROM (SELECT * FROM szafka) AS szaf WHERE szaf.kod = '$lockerId'), '$classId');");
      }
      else{
        //wysłać ciasteczko że się nie da zmienic bo 
      }
    }
  }
  function addModifyClassLockerToArchive($classId, $number)
  {
    mysqli_query($this->conn, "INSERT INTO `archiwum` (`archiwum_id`, `opis`, `data`) VALUES (NULL, CONCAT('Zmieniono liczbę przypisanych kluczy dla klasy: ', (SELECT klas.nazwa FROM (SELECT * FROM klasa) AS klas WHERE klas.klasa_id=$classId), ' na: $number'), NOW());");
  }
  function modifyLocation($locationId, $locationName)
  {
    $locationName = mysqli_real_escape_string($this->conn, $locationName);
    mysqli_query($this->conn, "INSERT INTO `archiwum` (`archiwum_id`, `opis`, `data`) VALUES (NULL, CONCAT('Zmieniono lokalizacje: ', (SELECT lok.pozycja FROM (SELECT * FROM lokalizacja) AS lok WHERE lok.lokalizacja_id='$locationId'), ' -> $locationName'), NOW());");
    mysqli_query($this->conn, "UPDATE `lokalizacja` SET `pozycja` = '$locationName' WHERE `lokalizacja`.`lokalizacja_id` = $locationId;");
  }
  function modifyLockerStatus($lockerStatusId, $statusId)
  {
    mysqli_query($this->conn, "INSERT INTO `archiwum` (`archiwum_id`, `opis`, `data`) VALUES (NULL, CONCAT('Zmieniono status klucza szafki: ',(SELECT szaf.kod FROM (SELECT * FROM `szafka`) AS szaf WHERE szaf.szafka_id = (SELECT szafka_id FROM (SELECT * FROM `uczen_szafka`) AS uczszaf WHERE uczszaf.uczen_szafka_id = (SELECT szafstat.uczen_szafka_id FROM (SELECT * FROM szafka_status) AS szafstat WHERE szafstat.szafka_status_id = $lockerStatusId))), ' na: ', (SELECT stat.wartosc FROM (SELECT * FROM `status`) AS stat WHERE status_id = $statusId)) , NOW())");
    mysqli_query($this->conn, "UPDATE `szafka_status` SET `status_id` = $statusId WHERE `szafka_status`.`szafka_status_id` = $lockerStatusId;");
  }
  function modifyUserPassword($userId,$oldPassword,$newPassword)
  {
    $oldPassword = mysqli_real_escape_string($this->conn, $oldPassword);
    $oldPassword = hash('sha256', $oldPassword);
    $newPassword = mysqli_real_escape_string($this->conn, $newPassword);
    $newPassword = hash('sha256', $newPassword );
    $oldPasswordResult = mysqli_query($this->conn, "SELECT haslo FROM `uzytkownik` WHERE uzytkownik_id = $userId;");
    $oldPasswordCheck = mysqli_fetch_array($oldPasswordResult, MYSQLI_NUM);
    if($oldPassword==$oldPasswordCheck[0]){
       mysqli_query($this->conn, "UPDATE uzytkownik SET haslo = '$newPassword' WHERE uzytkownik.uzytkownik_id = $userId");
       mysqli_query($this->conn, "INSERT INTO `archiwum` (`archiwum_id`, `opis`, `data`) VALUES (NULL, 'Pomyślnie zmieniono hasło.', NOW());");
    }
    else{
      mysqli_query($this->conn, "INSERT INTO `archiwum` (`archiwum_id`, `opis`, `data`) VALUES (NULL, 'Nie udało się zmienić hasła.', NOW());");
    }
  }
  function deleteClass($classId)
  {
    mysqli_query($this->conn, "INSERT INTO `archiwum` (`archiwum_id`, `opis`, `data`) VALUES (NULL, (SELECT CONCAT('Usunięto klasę: ',klas.nazwa) FROM (SELECT * FROM klasa) AS klas WHERE klas.klasa_id = '$classId'), NOW());");
    mysqli_query($this->conn, "DELETE FROM uczen WHERE uczen_id IN (SELECT uczklas.uczen_id FROM (SELECT * FROM uczen_klasa) AS uczklas WHERE uczklas.klasa_id = '$classId');");
    mysqli_query($this->conn, "DELETE FROM klasa WHERE klasa.klasa_id = '$classId'");
  }
  function deleteKey($keyId)
  {
    mysqli_query($this->conn, "INSERT INTO `archiwum` (`archiwum_id`, `opis`, `data`) VALUES (NULL, (SELECT CONCAT('Usunięto szafkę: ',szaf.kod) FROM (SELECT * FROM szafka) AS szaf WHERE szaf.szafka_id = '$keyId'), NOW());");
    mysqli_query($this->conn, "DELETE FROM szafka WHERE szafka.szafka_id = '$keyId'");
  }
  function deleteLocker($studentId)
  {
    mysqli_query($this->conn, "INSERT INTO `archiwum` (`archiwum_id`, `opis`, `data`) VALUES (NULL, CONCAT('Usunięto przypisanie klucza dla ucznia: ',(SELECT CONCAT(ucz.imie, ' ', ucz.nazwisko, ' z klasy ' , klasa.skrot) FROM (SELECT * FROM uczen) AS ucz INNER JOIN uczen_klasa ON ucz.uczen_id = uczen_klasa.uczen_id INNER JOIN klasa ON uczen_klasa.klasa_id = klasa.klasa_id WHERE ucz.uczen_id = '$studentId')), NOW());");
    mysqli_query($this->conn, "UPDATE uczen_szafka SET uczen_szafka.uczen_id = NULL WHERE uczen_szafka.uczen_id = '$studentId';");
  }
  function deleteStudent($studentId)
  {
    mysqli_query($this->conn, "INSERT INTO `archiwum` (`archiwum_id`, `opis`, `data`) VALUES (NULL, CONCAT('Usunięto ucznia: ',(SELECT CONCAT(ucz.imie, ' ', ucz.nazwisko, ' z klasy ' , klasa.skrot) FROM (SELECT * FROM uczen) AS ucz INNER JOIN uczen_klasa ON ucz.uczen_id = uczen_klasa.uczen_id INNER JOIN klasa ON uczen_klasa.klasa_id = klasa.klasa_id WHERE ucz.uczen_id = '$studentId')), NOW());");
    mysqli_query($this->conn, "DELETE FROM uczen WHERE uczen.uczen_id = '$studentId'");
  }
  function deleteLocation($locationId)
  {
    mysqli_query($this->conn, "INSERT INTO `archiwum` (`archiwum_id`, `opis`, `data`) VALUES (NULL, CONCAT('Usunięto lokalizacje: ', (SELECT lok.pozycja FROM (SELECT * FROM lokalizacja) AS lok WHERE lok.lokalizacja_id='$locationId')), NOW());");
    mysqli_query($this->conn, "DELETE FROM lokalizacja WHERE lokalizacja.lokalizacja_id = '$locationId'");
  }
  function deleteClassLocker($classId)
  {
    mysqli_query($this->conn, "INSERT INTO `archiwum` (`archiwum_id`, `opis`, `data`) VALUES (NULL, CONCAT('Usunięto nieprzypisane klucze dla klasy: ', (SELECT klas.nazwa FROM (SELECT * FROM klasa) AS klas WHERE klas.klasa_id='$classId')), NOW());");
    mysqli_query($this->conn, "DELETE FROM uczen_szafka WHERE szafka_id IN (SELECT uczklas.szafka_id FROM (SELECT * FROM uczen_szafka) AS uczklas WHERE uczklas.klasa_id = $classId AND uczklas.uczen_id IS NULL GROUP BY uczklas.szafka_id) AND klasa_id = $classId;");
  }
  function deleteLockerStatus($lockerStatusId)
  {
    $result = mysqli_query($this->conn, "SELECT status_id FROM szafka_status WHERE szafka_status_id = $lockerStatusId");
    $count = mysqli_fetch_array($result, MYSQLI_NUM);
    if($count[0]==3)
    {
      mysqli_query($this->conn, "INSERT INTO `archiwum` (`archiwum_id`, `opis`, `data`) VALUES (NULL, CONCAT('Wymieniono zamek szafki: ', (SELECT szafka.kod FROM (SELECT * FROM szafka_status) AS szafstat LEFT JOIN uczen_szafka ON uczen_szafka.uczen_szafka_id = szafstat.uczen_szafka_id LEFT JOIN szafka ON szafka.szafka_id = uczen_szafka.szafka_id WHERE szafstat.szafka_status_id = $lockerStatusId)), NOW());");
    }
    if($count[0]==4)
    {
      mysqli_query($this->conn, "INSERT INTO `archiwum` (`archiwum_id`, `opis`, `data`) VALUES (NULL, CONCAT('Dorobiono klucze do szafki: ', (SELECT szafka.kod FROM (SELECT * FROM szafka_status) AS szafstat LEFT JOIN uczen_szafka ON uczen_szafka.uczen_szafka_id = szafstat.uczen_szafka_id LEFT JOIN szafka ON szafka.szafka_id = uczen_szafka.szafka_id WHERE szafstat.szafka_status_id = $lockerStatusId)), NOW());");
    }
    $result1 = mysqli_query($this->conn, "SELECT COUNT(*) FROM szafka_status WHERE uczen_szafka_id IN (SELECT uczklas.uczen_szafka_id FROM (SELECT * FROM uczen_szafka) AS uczklas WHERE uczklas.szafka_id = (SELECT uczklas1.szafka_id FROM (SELECT * FROM uczen_szafka) AS uczklas1 WHERE uczklas1.uczen_szafka_id = (SELECT szafstat.uczen_szafka_id FROM (SELECT * FROM szafka_status) AS szafstat WHERE szafstat.szafka_status_id = $lockerStatusId)));");
    $keysAmount = mysqli_fetch_array($result1, MYSQLI_NUM);
    mysqli_query($this->conn, "UPDATE szafka SET szafka.ilosc_kluczy = szafka.ilosc_kluczy + $keysAmount[0] WHERE szafka.szafka_id = (SELECT uczklas.szafka_id FROM (SELECT * FROM uczen_szafka) AS uczklas WHERE uczklas.uczen_szafka_id = (SELECT szafstat.uczen_szafka_id FROM (SELECT * FROM szafka_status) AS szafstat WHERE szafstat.szafka_status_id = $lockerStatusId));");
    mysqli_query($this->conn, "DELETE FROM szafka_status WHERE szafka_status.uczen_szafka_id IN (SELECT uczklas.uczen_szafka_id FROM (SELECT * FROM uczen_szafka) AS uczklas WHERE uczklas.szafka_id = (SELECT uczklas1.szafka_id FROM (SELECT * FROM uczen_szafka) AS uczklas1 WHERE uczklas1.uczen_szafka_id = (SELECT szafstat.uczen_szafka_id FROM (SELECT * FROM szafka_status) AS szafstat WHERE szafstat.szafka_status_id = $lockerStatusId)));");
  }
  public function getStudent($studentId)
  {
        $sql = "SELECT uczen.uczen_id, uczen.imie, uczen.nazwisko, klasa.skrot FROM uczen 
        LEFT JOIN uczen_klasa ON uczen_klasa.uczen_id = uczen.uczen_id 
        LEFT JOIN klasa ON klasa.klasa_id = uczen_klasa.klasa_id 
    WHERE uczen.uczen_id = $studentId;";
        $result = mysqli_query($this->conn,$sql);
    $rows = [];
        while($row = mysqli_fetch_array($result))
        {
            $rows[] = $row;
        }
        return $rows;
  }
  public function getLockers()
  {
        $sql = "SELECT szafka.szafka_id,szafka.kod,szafka.ilosc_kluczy, COUNT(uczen_szafka.uczen_szafka_id) FROM uczen_szafka 
        RIGHT JOIN szafka ON uczen_szafka.szafka_id = szafka.szafka_id 
        GROUP BY szafka.szafka_id 
        HAVING (COUNT(uczen_szafka.uczen_szafka_id)<szafka.ilosc_kluczy) AND (COUNT(uczen_szafka.uczen_szafka_id)<2);";
        $result = mysqli_query($this->conn,$sql);
    $rows = [];
        while($row = mysqli_fetch_array($result))
        {
            $rows[] = $row;
        }
        return $rows;
  }
  public function getClasses()
  {
        $sql = "SELECT * FROM `klasa`;";
        $result = mysqli_query($this->conn,$sql);
    $rows = [];
        while($row = mysqli_fetch_array($result))
        {
            $rows[] = $row;
        }
        return $rows;
  }
  public function getClassLockers($classId)
  {
    $sql = "SELECT uczen_szafka.szafka_id, szafka.kod, COUNT(uczen_szafka.uczen_szafka_id) FROM uczen_szafka 
    LEFT JOIN szafka ON uczen_szafka.szafka_id = szafka.szafka_id 
    WHERE uczen_szafka.klasa_id = '$classId' AND uczen_szafka.uczen_id IS NULL 
    GROUP BY uczen_szafka.szafka_id;";
    $result = mysqli_query($this->conn,$sql);
    $rows = [];
        while($row = mysqli_fetch_array($result))
        {
            $rows[] = $row;
        }
        return $rows;
  }
  public function getLocation()
  {
    $sql = "SELECT * FROM lokalizacja;";
    $result = mysqli_query($this->conn,$sql);
    $rows = [];
        while($row = mysqli_fetch_array($result))
        {
            $rows[] = $row;
        }
        return $rows;
  }
  public function getStatus()
  {
    $sql = "SELECT * FROM `status` WHERE status_id NOT IN (3, 4);";
    $result = mysqli_query($this->conn,$sql);
    $rows = [];
        while($row = mysqli_fetch_array($result))
        {
            $rows[] = $row;
        }
        return $rows;
  }
}

?>