<?php
    include_once $_SERVER['DOCUMENT_ROOT']."/libs/Session.php";
    include_once $_SERVER['DOCUMENT_ROOT'].'/models/DataModel.php';
    $DataModel = new DataModel();
    $data = $DataModel->returnDataList();
?>
<style>
@media print {
    .scrollClass {
        overflow-y: visible;
    }
}
</style>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"><script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script><script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script><script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script><link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css"><script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script><script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
<div class="row text-center">
    <div class="col">
      <input onclick="window.print();return false;" class="btn btn-outline-info px-2 d-print-none w-25" type="submit" value="Drukuj" name="print">
      <input class="btn btn-outline-info px-2 d-print-none w-25" type="submit" value="Export do pliku" id="btnExport">
    </div>
</div>
<table class="table" id="dataTable">
  <thead>
    <tr id="mainRow">
      <th scope="col" class="namePrint">Imie <input class="d-print-none" type="checkbox" onchange="hidePrintElement(this.checked, 0)" checked/></th>
      <th scope="col" class="surnamePrint">Nazwisko <input class="d-print-none" type="checkbox" onchange="hidePrintElement(this.checked, 1)" checked/></th>
      <th scope="col" class="classPrint">Klasa <input class="d-print-none" type="checkbox" onchange="hidePrintElement(this.checked, 2)" checked/></th>
      <th scope="col" class="lockerPrint">Szafka <input class="d-print-none" type="checkbox" onchange="hidePrintElement(this.checked, 3)" checked/></th>
      <th scope="col" class="locationPrint">Lokalizacja <input class="d-print-none" type="checkbox" onchange="hidePrintElement(this.checked, 4)" checked/></th>
    </tr>
  </thead>
  <tbody>
    <?php
    for($i=0; $i<sizeof($data); $i++)
    {
        echo('<tr>
            <td class="namePrint">'.$data[$i][0].'</td>
            <td class="surnamePrint">'.$data[$i][1].'</td>
            <td class="classPrint">'.$data[$i][2].'</td>
            <td class="lockerPrint">'.$data[$i][3].'</td>
            <td class="locationPrint">'.$data[$i][4].'</td>
        </tr>');
    }
    ?>
  </tbody>
</table>
<br>
<script src="../resources/dataScript.js"></script>
<script src="../resources/exportCsvScript.js"></script>