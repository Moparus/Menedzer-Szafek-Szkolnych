<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Klucze</title>
    <link rel="icon" type="image/x-icon" href="../../resources/icon.png">
    <link rel="stylesheet" href="../../resources/mainPanelStyle.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>
<body>
    <div class="container-fluid h-100 mh-100">
        <div class="row justify-content-center h-100">
            <div class="col rounded shadow-lg">
                <script>
                    document.write('<a class="position-absolute btn btn-dark m-3" href="../MainPanel.php?sideMenuButton=Modyfikacja" style="right: 0;">Strona Główna</a>');
                </script>
                <ul class="list-group" style="max-height: 100px;">
                    <hr>
                    <form method="POST" action="../../controllers/ModifyForm.php" class="m-2">
                        <?php 
                            include_once $_SERVER['DOCUMENT_ROOT'].'/controllers/ModifyForm.php'; 
                            generateElementToModify();   
                            if(isset($_POST['edit'])){
                                echo '<br><button type="submit" name="selectedTable" value="'.$_POST['table'].'" class="btn btn-outline-success mr-1">Zatwierdź</button><button type="reset" class="btn btn-outline-danger mr-1">Reset</button>';
                            }
                            else {
                                echo '<br><h5>Czy na pewno chcesz usunąć ten rekord?</h5><button type="submit" name="deleteTable" value="'.$_POST['table'].'" class="btn btn-outline-success px-5 mr-1">Tak</button><button name="deleteTable" value="cancel" type="submit" class="btn btn-outline-danger px-5 mr-1">Nie</button>';
                            }                    
                        ?>
                        
                    </form>
                </ul>
            </div>
        </div>
    </div>
    <?php
        include_once $_SERVER['DOCUMENT_ROOT'].'/libs/Bootstrap.php';
    ?>
</body>
</html>



