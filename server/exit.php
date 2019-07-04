<?php
    session_start();
    require("config.php");

    unset($_SESSION['id']);
    header("Location:/index.php");
?>