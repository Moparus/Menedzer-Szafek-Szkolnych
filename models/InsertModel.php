<?php
include_once $_SERVER['DOCUMENT_ROOT']."/libs/Model.php";
class InsertModel extends Model
{
    function __construct()
  {
    parent::__construct();
  }
  function __destruct()
  {
    parent::__destruct();
  }
  public function addClass($name, $short)
  {
        $name = mysqli_real_escape_string($this->conn, $name);
        $short = mysqli_real_escape_string($this->conn, $short);
        $short = str_replace(' ', '', $short);
        mysqli_query($this->conn, "INSERT INTO `archiwum` (`archiwum_id`, `opis`, `data`) VALUES (NULL, CONCAT('Dodano klasę: $name $short'), NOW());");
    mysqli_query($this->conn, "INSERT INTO klasa (klasa_id, nazwa, skrot) VALUES (NULL, '$name', '$short');");
  }
    public function addLocation($location)
  {
        $location = mysqli_real_escape_string($this->conn, $location);
        mysqli_query($this->conn, "INSERT INTO `archiwum` (`archiwum_id`, `opis`, `data`) VALUES (NULL, CONCAT('Dodano lokalizacje: $location'), NOW());");
    mysqli_query($this->conn, "INSERT INTO lokalizacja (lokalizacja_id, pozycja) VALUES (NULL, '$location');");
  }
    public function addLocker($code, $amount, $location)
    {
        $code = mysqli_real_escape_string($this->conn, $code);
        $amount = mysqli_real_escape_string($this->conn, $amount);
        $location = mysqli_real_escape_string($this->conn, $location);
        mysqli_query($this->conn, "INSERT INTO szafka (szafka_id, kod, ilosc_kluczy) VALUES (NULL, '$code', '$amount');");
        $sql = "SELECT szafka_id FROM szafka WHERE kod = '$code';";
        $result = mysqli_query($this->conn,$sql);
        $value = $result->fetch_column();
        mysqli_query($this->conn, "INSERT INTO szafka_lokalizacja (szafka_lokalizacja_id, szafka_id, lokalizacja_id) VALUES (NULL, '$value', '$location');");
        mysqli_query($this->conn, "INSERT INTO `archiwum` (`archiwum_id`, `opis`, `data`) VALUES (NULL, CONCAT('Dodano szafkę: $code'), NOW());");
    }
    public function addStudent($name, $surname, $class)
    {
        $name = mysqli_real_escape_string($this->conn, $name);
        $surname = mysqli_real_escape_string($this->conn, $surname);
        $class = mysqli_real_escape_string($this->conn, $class);
        mysqli_query($this->conn, "INSERT INTO uczen (uczen_id, imie, nazwisko) VALUES (NULL, '$name', '$surname');");
        $sql = "SELECT uczen_id FROM uczen WHERE (imie = '$name' AND nazwisko = '$surname');";
        $result = mysqli_query($this->conn,$sql);
        $value = $result->fetch_column();
        mysqli_query($this->conn, "INSERT INTO uczen_klasa (uczen_klasa_id, uczen_id, klasa_id) VALUES (NULL, '$value', '$class');");
      mysqli_query($this->conn, "INSERT INTO `archiwum` (`archiwum_id`, `opis`, `data`) VALUES (NULL, CONCAT('Dodano ucznia: $name $surname do klasy: ', (SELECT klas.skrot FROM (SELECT * FROM klasa) AS klas WHERE klas.klasa_id = $class)), NOW());");
    }
    public function addStudentLocker($student, $locker)
    {
        $sql = "SELECT klasa_id FROM uczen_klasa WHERE uczen_id='$student';";
        $result = mysqli_query($this->conn,$sql);
        $value = $result->fetch_column();
        mysqli_query($this->conn, "INSERT INTO uczen_szafka (uczen_szafka_id, uczen_id, szafka_id, klasa_id) VALUES (NULL, '$student', '$locker', '$value');");
        mysqli_query($this->conn, "INSERT INTO `archiwum` (`archiwum_id`, `opis`, `data`) VALUES (NULL, CONCAT('Przypisano ucznia: ', (SELECT CONCAT(ucze.imie, ' ', ucze.nazwisko) FROM (SELECT * FROM uczen) AS ucze WHERE ucze.uczen_id = $student), ' do szafki: ', (SELECT szaf.kod FROM (SELECT * FROM szafka) AS szaf WHERE szaf.szafka_id = $locker)), NOW());");
    }
    public function addStudentLockerStatus ($studentLocker, $status)
    {
        mysqli_query($this->conn, "INSERT INTO `szafka_status` (`szafka_status_id`, `uczen_szafka_id`, `status_id`) VALUES (NULL, '$studentLocker', '$status');");
        mysqli_query($this->conn, "UPDATE szafka SET ilosc_kluczy = ilosc_kluczy - 1 WHERE szafka.szafka_id = (SELECT uczszaf.szafka_id FROM (SELECT * FROM uczen_szafka) AS uczszaf WHERE uczszaf.uczen_szafka_id = $studentLocker);");
        $result1 = mysqli_query($this->conn, "SELECT COUNT(uczen_szafka.uczen_szafka_id) FROM uczen_szafka WHERE uczen_szafka.szafka_id = (SELECT uczszaf.szafka_id FROM (SELECT * FROM uczen_szafka) AS uczszaf WHERE uczszaf.uczen_szafka_id = $studentLocker);");
    $studentLockerCount = mysqli_fetch_array($result1, MYSQLI_NUM);
        $result2 = mysqli_query($this->conn, "SELECT COUNT(*) FROM szafka_status WHERE szafka_status.uczen_szafka_id IN (SELECT uczszaf.uczen_szafka_id FROM (SELECT * FROM uczen_szafka) AS uczszaf WHERE uczszaf.szafka_id = (SELECT uczszaf1.szafka_id FROM (SELECT * FROM uczen_szafka) AS uczszaf1 WHERE uczszaf1.uczen_szafka_id = $studentLocker));");
    $studentLockerStatusCount = mysqli_fetch_array($result2, MYSQLI_NUM);
        if($studentLockerCount[0]==$studentLockerStatusCount[0])
        {
            $result3 = mysqli_query($this->conn, "SELECT szafka.ilosc_kluczy FROM szafka WHERE szafka.szafka_id = (SELECT uczszaf.szafka_id FROM (SELECT * FROM uczen_szafka) AS uczszaf WHERE uczszaf.uczen_szafka_id = $studentLocker);");
            $lockerKeysAmount = mysqli_fetch_array($result3, MYSQLI_NUM);
            if($lockerKeysAmount[0]==0){
                mysqli_query($this->conn, "UPDATE szafka_status SET status_id = '3' WHERE szafka_status.uczen_szafka_id IN (SELECT uczszaf.uczen_szafka_id FROM (SELECT * FROM uczen_szafka) AS uczszaf WHERE uczszaf.szafka_id = (SELECT uczszaf1.szafka_id FROM (SELECT * FROM uczen_szafka) AS uczszaf1 WHERE uczszaf1.uczen_szafka_id = $studentLocker));");
            }
            else{
                mysqli_query($this->conn, "UPDATE szafka_status SET status_id = '4' WHERE szafka_status.uczen_szafka_id IN (SELECT uczszaf.uczen_szafka_id FROM (SELECT * FROM uczen_szafka) AS uczszaf WHERE uczszaf.szafka_id = (SELECT uczszaf1.szafka_id FROM (SELECT * FROM uczen_szafka) AS uczszaf1 WHERE uczszaf1.uczen_szafka_id = $studentLocker));");
            }
        }
       mysqli_query($this->conn, "INSERT INTO `archiwum` (`archiwum_id`, `opis`, `data`) VALUES (NULL, CONCAT('Ustawiono status: ', (SELECT stat.wartosc FROM (SELECT * FROM `status`) AS stat WHERE stat.status_id = $status), ', dla szafki: ', (SELECT szaf.kod FROM (SELECT * FROM szafka) AS szaf WHERE szaf.szafka_id = (SELECT uczszaf.szafka_id FROM (SELECT * FROM `uczen_szafka`) AS uczszaf WHERE uczszaf.uczen_szafka_id = $studentLocker)), ', ucznia: ', (SELECT CONCAT(ucz.imie, ' ', ucz.nazwisko) FROM (SELECT * FROM uczen) AS ucz WHERE ucz.uczen_id = (SELECT uczszaf.uczen_id FROM (SELECT * FROM `uczen_szafka`) AS uczszaf WHERE uczszaf.uczen_szafka_id = $studentLocker))), NOW());");
    }
    public function changeStudentsLockers($student1, $student2)
    {
        $sql = "SELECT szafka_id FROM uczen_szafka WHERE uczen_id='$student1';";
        $result = mysqli_query($this->conn,$sql);
        $value = $result->fetch_column();
        mysqli_query($this->conn, "UPDATE uczen_szafka SET szafka_id = (SELECT uczszaf.szafka_id FROM (SELECT * FROM uczen_szafka) AS uczszaf WHERE uczszaf.uczen_id='$student2') WHERE uczen_szafka.uczen_id = '$student1'");
        mysqli_query($this->conn, "UPDATE uczen_szafka SET szafka_id = '$value' WHERE uczen_szafka.uczen_id = '$student2'");
        mysqli_query($this->conn, "INSERT INTO `archiwum` (`archiwum_id`, `opis`, `data`) VALUES (NULL, CONCAT('Zamieniono szafki dla uczniów: ', (SELECT CONCAT(imie, ' ', nazwisko) FROM `uczen` WHERE uczen_id = $student1), ' - ', (SELECT CONCAT(imie, ' ', nazwisko) FROM `uczen` WHERE uczen_id = $student2)), NOW());");
    }
    public function instertStudentsToClassLockers($classLockerId, $studentId)
    {
        mysqli_query($this->conn, "UPDATE uczen_szafka SET uczen_id = $studentId WHERE uczen_szafka.uczen_szafka_id = $classLockerId;");
    }
    public function archiveInstertStudentsToClassLockers($studentId, $value)
    {
        mysqli_query($this->conn, "INSERT INTO `archiwum` (`archiwum_id`, `opis`, `data`) VALUES (NULL, CONCAT('Przypisano $value uczniów do szafek z klasy: ', (SELECT klas.nazwa FROM (SELECT * FROM klasa) AS klas WHERE klas.klasa_id = (SELECT uczklas.klasa_id FROM (SELECT * FROM uczen_klasa) AS uczklas WHERE uczklas.uczen_id = $studentId))), NOW());");
    }
    public function getLocations()
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
  public function getClasses()
  {
        $sql = "SELECT klasa_id, nazwa FROM klasa ORDER BY nazwa;";
        $result = mysqli_query($this->conn,$sql);
    $rows = [];
        while($row = mysqli_fetch_array($result))
        {
            $rows[] = $row;
        }
        return $rows;
  }
    public function getStudents()
  {
        $sql = "SELECT uczen.uczen_id, uczen.imie, uczen.nazwisko, klasa.skrot FROM `uczen` 
        LEFT JOIN uczen_klasa ON uczen_klasa.uczen_id = uczen.uczen_id 
        LEFT JOIN klasa ON klasa.klasa_id = uczen_klasa.klasa_id 
        WHERE uczen.uczen_id NOT IN (SELECT uczszaf.uczen_id FROM (SELECT * FROM uczen_szafka) AS uczszaf WHERE uczszaf.uczen_id NOT LIKE 'NULL') 
        ORDER BY klasa.skrot, uczen.nazwisko;";
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
    public function getStudentsWithLockers()
    {
        $sql = "SELECT uczen.uczen_id, uczen.imie, uczen.nazwisko, klasa.skrot, szafka.kod FROM `uczen` 
        LEFT JOIN uczen_klasa ON uczen_klasa.uczen_id = uczen.uczen_id 
        LEFT JOIN klasa ON klasa.klasa_id = uczen_klasa.klasa_id 
        LEFT JOIN uczen_szafka ON uczen_szafka.uczen_id = uczen.uczen_id 
        LEFT JOIN szafka ON uczen_szafka.szafka_id = szafka.szafka_id 
        WHERE uczen.uczen_id IN (SELECT uczszaf.uczen_id FROM (SELECT * FROM uczen_szafka) AS uczszaf) ORDER BY klasa.skrot, uczen.nazwisko;";
        $result = mysqli_query($this->conn,$sql);
    $rows = [];
        while($row = mysqli_fetch_array($result))
        {
            $rows[] = $row;
        }
        return $rows;
    }
    public function getClassesWithLockers()
    {
        $sql = "SELECT * FROM klasa WHERE klasa.klasa_id IN (SELECT uczszaf.klasa_id FROM (SELECT * FROM uczen_szafka) AS uczszaf WHERE (uczszaf.uczen_id IS NULL) OR (uczszaf.klasa_id IS NULL)) GROUP BY klasa.klasa_id;";
        $result = mysqli_query($this->conn,$sql);
    $rows = [];
        while($row = mysqli_fetch_array($result))
        {
            $rows[] = $row;
        }
        return $rows;
    }
    public function getClassStudents($classId)
    {
        $sql = "SELECT uczen_klasa.uczen_id, uczen.imie, uczen.nazwisko FROM uczen_klasa INNER JOIN uczen ON uczen_klasa.uczen_id = uczen.uczen_id WHERE uczen_klasa.klasa_id = $classId AND uczen.uczen_id NOT IN (SELECT uczszaf.uczen_id FROM (SELECT * FROM uczen_szafka) AS uczszaf WHERE uczszaf.uczen_id IS NOT NULL) ORDER BY uczen.nazwisko;";
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
        $sql = "SELECT uczen_szafka.uczen_szafka_id, szafka.kod FROM uczen_szafka LEFT JOIN szafka ON uczen_szafka.szafka_id=szafka.szafka_id WHERE klasa_id = '$classId' AND uczen_szafka.uczen_id IS NULL ORDER BY szafka.kod";
        $result = mysqli_query($this->conn,$sql);
    $rows = [];
        while($row = mysqli_fetch_array($result))
        {
            $rows[] = $row;
        }
        return $rows;
    }
    public function getStudentsNumber($classId)
    {
        $result = mysqli_query($this->conn, "SELECT COUNT(*) FROM uczen_szafka WHERE klasa_id = '$classId' AND uczen_id IS NULL");
    $count = mysqli_fetch_array($result, MYSQLI_NUM);
    return $count[0];
    }
    public function getStudentsLockers()
    {
        $sql = "SELECT uczen_szafka.uczen_szafka_id, uczen.imie, uczen.nazwisko, szafka.kod, klasa.skrot FROM uczen_szafka 
        LEFT JOIN uczen ON uczen.uczen_id = uczen_szafka.uczen_id 
        LEFT JOIN szafka ON szafka.szafka_id = uczen_szafka.szafka_id 
        LEFT JOIN klasa ON klasa.klasa_id = uczen_szafka.klasa_id 
        WHERE uczen.uczen_id IS NOT NULL 
        AND uczen_szafka.uczen_szafka_id NOT IN (SELECT szafstat.uczen_szafka_id FROM (SELECT * FROM szafka_status) AS szafstat) 
        ORDER BY klasa.skrot, szafka.kod, uczen.nazwisko;";
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