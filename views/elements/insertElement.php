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
            <div class="col rounded shadow-lg m-1 mh-100 scrollClass">
                <script>
                    document.write('<a class="position-absolute btn btn-dark m-3" href="../MainPanel.php?sideMenuButton=Modyfikacja" style="right: 0;">Strona Główna</a>');
                </script>
                <section id="amountPickerSection">
                    <h3 class="my-3">Dodawanie "<?php echo($_POST['selectInsertButton'])?>"</h3>
                    <div class="form-group">
                        <label for="amountPicker">Wybierz ilość obiektów</label>
                        <select class="form-control" id="amountPicker">
                            <option>-</option>
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                            <option>6</option>
                            <option>7</option>
                            <option>8</option>
                            <option>9</option>
                            <option>10</option>
                            <option>11</option>
                            <option>12</option>
                            <option>13</option>
                            <option>14</option>
                            <option>15</option>
                        </select>
                    </div>
                </section>
                <ul class="list-group" style="max-height: 500px;">
                    <hr>
                    <form method="POST" action="../../controllers/Insert.php">
                        <?php
                            include_once $_SERVER['DOCUMENT_ROOT'].'/controllers/Insert.php';
                        ?>
                        <br><button type="submit" name="<?php echo($_POST['selectInsertButton']) ?>" class="btn btn-success mb-3">Zatwierdź</button>
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
<script>
    const amountPicker = document.querySelector("#amountPicker");
    amountPicker.addEventListener("change", (event) => {
        const d = new Date();
        d.setTime(d.getTime() + (3600));
        let expires = "expires="+ d.toUTCString();
        document.cookie = "insertAmountCookie" + "=" + amountPicker.value + ";" + expires + ";path=/";
        location.reload();
    });
    const classPicker = document.querySelector("#classPicker");
    if(classPicker!=null)
        classPicker.addEventListener("change", (event) => {
            const d = new Date();
            d.setTime(d.getTime() + (3600));
            let expires = "expires="+ d.toUTCString();
            if(classPicker.value!="-")
                document.cookie = "classPickerCookie" + "=" + classPicker.value + ";" + expires + ";path=/";
            location.reload();
        });
</script>
