<?php
session_start();

if (isset($_SESSION["email"])) {
    header('Location: panel.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/style/index.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" integrity="undefined" crossorigin="anonymous">
    <title>Page you want to log in</title>
</head>

<body>
    <div class="d-flex flex-column align-items-center justify-content-center vh-100 bg-light">
        <div class="bg-primary text-white main-container rounded-2">
            <form class="d-flex flex-column" method="POST" action="validate.php">
                <label for="user" class="form-label">
                    Username
                </label>
                <input type="text" id="user" name="user">
                <label for="pass" class="form-label">
                    Password
                </label>
                <input type="password" id="pass" name="pass">

                <?php
                if (isset($_SESSION["error"])) {
                    echo "<div class='bg-danger mb-3 p-2 text-center rounded'>Incorrect email or password</div>";
                } elseif (isset($_GET["logout"])) {
                    echo "<div class='bg-info mb-3 p-2 text-center rounded'>You have logged out correctly</div>";
                }
                ?>

                <button type="submit" class="btn btn-secondary">Log in</button>
            </form>
        </div>
        <p class="mt-4 text-muted">® 2021</p>
    </div>

    </footer>

</html>