<?php
    // session_start();
    require "config.php";

    // if(isset($_POST['submit']))
    // {
    //     $text = trim(htmlspecialchars($_POST['text']));
    //     $id = $_SESSION['id'];
    //     $query4 = mysqli_query($db, "INSERT INTO message (user_id, message) VALUES ('$id', '$text')");

    //     if($query4)
    //     {
    //         header("Location:../index.php");
    //     }
    // }
    if(isset($_POST['text'])) {
        $param1 = json_decode($_POST['text']);
        $text = $_POST['text'];
        $param2 = json_decode($_POST['sess_id']);
        $id = $_POST['sess_id'];
        $query4 = mysqli_query($db, "INSERT INTO message (user_id, message) VALUES ('$id', '$text')");
        
        exit();
       }
?>