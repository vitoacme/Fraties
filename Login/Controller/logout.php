<?php
    session_start();
    if(!isset($_SESSION["userNSID"])){
       header('Location: ../../verify.php');
       exit;
    } else {
        $_SESSION["userNSID"] = null;
        header('Location: ../../login.php');
        exit;
    }
?>