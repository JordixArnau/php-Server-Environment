<?php
session_start();

$user = "george@hmail.com";
$pass = password_hash("123456", PASSWORD_DEFAULT);


$nameArr = explode("@", $user);
$name = ucwords($nameArr[0]);

$loginUser = $_POST["user"];
$loginPass = $_POST["pass"];

if ($loginUser == $user && password_verify($loginPass, $pass)) {
    $_SESSION["email"] = $user;
    $_SESSION["username"] = $name;
    unset($_SESSION["error"]);

    header("Location: panel.php");
} else {
    $_SESSION["error"] = true;

    header("Location: index.php");
}
