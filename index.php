<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Klucze</title>
    <link rel="icon" type="image/x-icon" href="resources/icon.png">
    <link rel="stylesheet" href="resources/indexStyle.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>
<body>
    <section class="container">
        <form action="controllers\Login.php" method="POST" class="rounded shadow-lg">
            <img src="resources/lockersText.png" alt="LOCKERS">
            <!-- <h6>Login</h6> -->
            <input class="form-control" placeholder="Login" type="text" name="userName" required/><br>
            <!-- <h6>Hasło</h6> -->
            <input class="form-control" placeholder="Hasło" type="password" name="userPassword" required/><br>
            <input class="btn btn-outline-dark px-5 my-2" type="submit" name="submit" value="Zaloguj"/>
            <?php
                include_once $_SERVER['DOCUMENT_ROOT'].'/libs/Cookie.php';
                if(isset($_COOKIE['alert'])) {
                    echo "<p class='text-danger'>".$_COOKIE['alert']."</p>";
                }
                clearAlertCookie();
            ?>
        </form>
    </section>
    <?php
        include_once $_SERVER['DOCUMENT_ROOT'].'/libs/Bootstrap.php';
    ?>
</body>
</html>