<?php
include_once $_SERVER['DOCUMENT_ROOT']."/libs/View.php";
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Klucze</title>
    <link rel="icon" type="image/x-icon" href="../resources/icon.png">
    <link rel="stylesheet" href="../resources/mainPanelStyle.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>
<body>
    <div class="container-fluid h-100 mh-100">
        <div class="row justify-content-center h-100">
            <!-- Side Menu Panel -->
            <div class="col-md-auto rounded shadow-lg m-1 text-center d-print-none mh-100">
                <a href="../views/MainPanel.php?sideMenuButton=main"><img class="m-2" src="../resources/lockersText.png" alt="LOCKERS"></a>
                <form method="GET" action="">
                    <div class="container">
                        <!-- Lockers -->
                        <hr>
                        <input type="button" class="btn" href="#lockersMenu" data-toggle="collapse" value="Szafki">
                        <div id="lockersMenu" class="collapse">
                            <?php
                                include_once $_SERVER['DOCUMENT_ROOT'].'/controllers/MainPanel.php';
                                generateLocations();
                            ?>
                        </div>
                        <!-- Students -->
                        <hr>
                        <input class="btn" type="submit" value="Klasy" name="sideMenuButton">
                        <!-- Data -->
                        <hr>
                        <input class="btn" type="submit" value="Dane" name="sideMenuButton">
                        <!-- Archive -->
                        <hr>
                        <input class="btn" type="submit" value="Archiwum" name="sideMenuButton">
                        <!-- Modification -->
                        <hr>
                        <input class="btn" type="submit" value="Modyfikacja" name="sideMenuButton">
                        <hr>
                    </div>
                </form>
                <br><br><br>
                <form method="POST" action="">
                    <input class="btn btn-outline-danger px-2 my-2 w-75" type="submit" value="Wyloguj" name="logout">
                </form>
            </div>
            <!-- INCLUDE PAGE CONTENT -->
            <?php
                 include_once $_SERVER['DOCUMENT_ROOT'].'/controllers/Panel.php';
            ?>
        </div>
    </div>
    <?php
        include_once $_SERVER['DOCUMENT_ROOT'].'/libs/Bootstrap.php';
    ?>
</body>
</html>
<?php 
include_once $_SERVER['DOCUMENT_ROOT']."/libs/Session.php";
?>
