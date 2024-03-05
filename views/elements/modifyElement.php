<!-- First Panel -->
<div class="col-md-auto m-1 rounded shadow-lg text-center mh-100 d-print-none">
  <form method="POST" action="elements/insertElement.php">
    <h4 class="p-2 mt-2">Dodawanie</h4>
    <hr>
    <input class="btn btn-outline-dark btn-block" type="submit" name="selectInsertButton" value="Lokalizacja"><br>
    <input class="btn btn-outline-dark btn-block" type="submit" name="selectInsertButton" value="Szafka"><br>
    <input class="btn btn-outline-dark btn-block" type="submit" name="selectInsertButton" value="Klasa"><br>
    <input class="btn btn-outline-dark btn-block" type="submit" name="selectInsertButton" value="Uczen"><br>
    <hr><br>
    <input class="btn btn-outline-dark btn-block" type="submit" name="selectInsertButton" value="Przypisz Szafke"><br>
    <input class="btn btn-outline-dark btn-block" type="submit" name="selectInsertButton" value="Przypisz Klasowe"><br>
    <input class="btn btn-outline-dark btn-block" type="submit" name="selectInsertButton" value="Przypisz Status"><br>
    <input class="btn btn-outline-dark btn-block" type="submit" name="selectInsertButton" value="Zamień Szafki"><br>
  </form>
</div>
<!-- Secound Panel -->
<div class="col-md-auto m-1 rounded shadow-lg text-center mh-100 d-print-none">
  <h4 class="p-2 mt-2">Modyfikacja</h4>
  <hr>
  <input onclick="changeSelectedModifyOption(this)" class="btn btn-outline-dark btn-block" type="button" name="selectModifyButton" value="Lokalizacje"><br>
  <input onclick="changeSelectedModifyOption(this)" class="btn btn-outline-dark btn-block" type="button" name="selectModifyButton" value="Szafki"><br>
  <input onclick="changeSelectedModifyOption(this)" class="btn btn-outline-dark btn-block" type="button" name="selectModifyButton" value="Klasy"><br>
  <input onclick="changeSelectedModifyOption(this)" class="btn btn-outline-dark btn-block" type="button" name="selectModifyButton" value="Uczniowie"><br>
  <hr><br>
  <input onclick="changeSelectedModifyOption(this)" class="btn btn-outline-dark btn-block" type="button" name="selectModifyButton" value="Uczen/Szafka"><br>
  <input onclick="changeSelectedModifyOption(this)" class="btn btn-outline-dark btn-block" type="button" name="selectModifyButton" value="Klasa/Szafki"><br>
  <input onclick="changeSelectedModifyOption(this)" class="btn btn-outline-dark btn-block" type="button" name="selectModifyButton" value="Status/Szafka"><br>
  <hr><br>
  <input onclick="changeSelectedModifyOption(this)" class="btn btn-outline-dark btn-block" type="button" name="selectModifyButton" value="Zmiana Hasła"><br>
</div>
<!-- Third Panel -->
<div class="col rounded shadow-lg m-1 text-center scrollClass mh-100">
  <section style="max-height: 500px;">
    <div class="form-outline m-3 d-print-none">
      <div class="input-group mb-3">
        <input type="text" onkeyup="searchTable()" class="form-control" id="dataSearchBar" placeholder="Wyszukaj...">
      </div>
    </div>
    <table class="table" id="dataTable">
      <?php
      include_once $_SERVER['DOCUMENT_ROOT'].'/controllers/Modify.php';
      generateModifyElements();
      ?>
    </table>
  </section>
</div>
<?php
generateScript();
?>