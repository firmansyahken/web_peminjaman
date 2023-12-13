<?php

session_start();

$user_session = $_SESSION["user"];

if(!isset($_SESSION["login"])) {
    header("Location: /login.php");
    exit;
}

if($_SESSION["level"] != "0") {
    header("Location: /login.php");
    exit;
}
