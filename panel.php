<?php
session_start();

if (!isset($_SESSION["email"])) {
    header('Location: /index.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" integrity="undefined" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/style/panel.css">
    <title>Dashboard</title>
</head>

<body>
    <header class="bg-dark text-white">
        <div>
            <img src="./assets/img/chtulu.png" alt="Primal Tech" class="me-2" />
            Primal Tech
        </div>
        <div class="right">
            <div class="panel-link"><?= $_SESSION["email"] ?></div>
            <div><a href="close_session.php">Log out</a></div>
        </div>
    </header>
    <div class="wrapper">
        <aside class="bg-light text-dark">
            <div class="aside-tab p-2 ps-4">Dashboard</div>
            <div class="aside-tab p-2 ps-4">Orders</div>
            <div class="aside-tab p-2 ps-4">Products</div>
            <div class="aside-tab p-2 ps-4">Customers</div>
            <div class="aside-tab p-2 ps-4">Reports</div>
            <div class="aside-tab p-2 ps-4">Integrations</div>
        </aside>
        <main>
            <article>
                Welcome to your Dashboard, <strong><?= $_SESSION["username"] ?></strong>
                <?php
                phpinfo();
                ?>
            </article>
        </main>
    </div>
</body>

</html>