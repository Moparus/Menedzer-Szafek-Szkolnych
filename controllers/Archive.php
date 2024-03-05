<?php
 include_once $_SERVER['DOCUMENT_ROOT']."/libs/Session.php";
 include_once $_SERVER['DOCUMENT_ROOT'].'/models/ArchiveModel.php';

 function generateArchiveList()
 {
   $ArchiveModel = new ArchiveModel();
   $archive = $ArchiveModel->returnArchiveList();
   for($i=0; $i<sizeof($archive); $i++)
   {
      echo('<li class="list-group-item">
      <span class="badge badge-dark badge-pill">'.$archive[$i][2].'</span> '.$archive[$i][1].'  
      </li>');
   }
 }

 $ArchiveModel = new ArchiveModel();
 if ($_SERVER["REQUEST_METHOD"] == "POST"){
   if(isset($_POST['cleanArchive'])){
      if($_POST['cleanArchive']=="Wyczyść całość"){
         $ArchiveModel->cleanArchive();
         header('location: ../views/MainPanel.php?sideMenuButton=Archiwum');
      }
      else{
         $ArchiveModel->cleanArchive30days();
         header('location: ../views/MainPanel.php?sideMenuButton=Archiwum');
      }
   }
}

?>