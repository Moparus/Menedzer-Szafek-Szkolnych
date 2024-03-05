<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/controllers/Lockers.php';
?>
<!-- Lockers Panel -->
<div class="col-md-auto m-1 rounded shadow-lg text-center">
    <h3 class="my-3"><?php echo($_COOKIE['lockers']);?></h3>
    <form id="lockerForm" action="<?=$_SERVER['PHP_SELF']?>" method="POST" class="m-1 p-3 rounded shadow-lg border">
        <div class="lockersOverflow">
            <?php generateLockers($_COOKIE['lockers']) ?>
        </div>
        <input class="btn btn-outline-success px-5 my-2" type="submit" name="submit" value="Wybierz"/>
        <input class="btn btn-outline-danger px-5 my-2" type="reset" value="Reset" id="reset">
    </form>
</div>     
<!-- Secound Panel -->
<div class="col rounded shadow-lg m-1 text-center scrollClass mh-100">
    <div id="selectedData">
        <h3 class="my-3">Przypisz do klasy</h3>
        <form id="classesLockersForm" action="../controllers/Lockers.php" method="POST" class="m-1 p-3 rounded shadow-lg border">
            <?php  if(isset($_COOKIE['selectedData'])&&$_COOKIE['selectedData']!=""){generateForm($_COOKIE['selectedData']);} else {echo("<h3>Wybrane</h3>");}?>
        </form>
    </div>
</div>
<?php
generateScript();
?>
