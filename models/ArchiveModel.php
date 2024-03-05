<?php
include_once $_SERVER['DOCUMENT_ROOT']."/libs/Model.php";
class ArchiveModel extends Model
{
    function __construct()
  {
    parent::__construct();
  }
  function __destruct()
  {
    parent::__destruct();
  }
  public function returnArchiveList()
  {
    $sql = "SELECT * FROM archiwum ORDER BY archiwum.data DESC, archiwum.archiwum_id DESC;";
        $result = mysqli_query($this->conn,$sql);
    $rows = [];
        while($row = mysqli_fetch_array($result))
        {
            $rows[] = $row;
        }
        return $rows;
  }
  public function cleanArchive30days()
  {
    mysqli_query($this->conn, "DELETE FROM archiwum WHERE data < NOW() - INTERVAL 30 DAY");
  }  
  public function cleanArchive()
  {
    mysqli_query($this->conn, "DELETE FROM archiwum");
  }  
}