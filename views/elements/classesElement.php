<style>
@media print {
    .scrollClass {
        overflow-y: visible;
    }
}
</style>
<!-- First Panel -->
<div class="col-md-auto m-1 rounded shadow-lg text-center scrollClass mh-100 d-print-none">
    <h4 class="p-2 mt-2">Klasy</h4>
    <hr>
    <section style="max-height: 200px;">
        <?php
            include_once $_SERVER['DOCUMENT_ROOT'].'/controllers/Classes.php';
            generateClassesList();
        ?>
    </section>
</div>     
<!-- Secound Panel -->
<div class="col rounded shadow-lg m-1 text-center scrollClass mh-100">
<section style="max-height: 500px;">
    <h4 id="classNamePrintText" class="m-3 d-none d-print-block">-</h4>
    <input onclick="window.print();return false;" class="btn btn-outline-info px-3 my-2 float-right d-print-none" style="right: 10px; top: 0px;" type="submit" value="Drukuj" name="print"></form>
    <table class="table" id="dataTable">
    <thead>
        <tr id="mainRow">
            <th scope="col">Imie</th>
            <th scope="col">Nazwisko</th>
            <th scope="col">Szafka</th>
            <th scope="col">Lokalizacja</th>
        </tr>
    </thead>
    <tbody>
        <?php
           getStudentsList();
        ?>
    </tbody>
    </table>
</section>
</div>

<script>
function searchTable($this) {
    var filter, found, table, td, i;
    filter = $this.value;
    table = document.getElementById("dataTable");
    tr = table.getElementsByTagName("tr");
    for (i = 1; i < tr.length; i++) 
    {
        if (tr[i].id == filter) {
            found = true;
        }
        if (found) {
            tr[i].style.display = "";
            found = false;
        } else {
            tr[i].style.display = "none";
        }
    }
    document.getElementById("classNamePrintText").innerText = $this.value;
}
</script>
