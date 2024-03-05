<div class="col rounded shadow-lg m-1 scrollClass mh-100">
    <div class="row m-2">
      <h3>Archiwum</h3>
      <div class="ml-auto">
        <form method="POST" action="../../controllers/Archive.php">
            <input class="btn btn-outline-info px-2" type="submit" name="cleanArchive" value="Wyczyść do miesiąca">
            <input class="btn btn-outline-danger px-2" type="submit" name="cleanArchive" value="Wyczyść całość">
        </form>
      </div>
    </div>
    <ul class="list-group" style="max-height: 1000px;">
        <?php
            include_once $_SERVER['DOCUMENT_ROOT'].'/controllers/Archive.php';
            generateArchiveList();
        ?>
    </ul>
</div>
