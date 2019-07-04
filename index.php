<?php
session_start();
require "server/config.php";
if(isset($_SESSION['id']))
{
    header("Location:modules/feed.php");
}
else
{
    header("Location:modules/auth.php");
}
?>