<?php
    require_once 'userClass.php';

            session_start();
            $nsid = $_SESSION["userNSID"];
            sendVerificationEmail($nsid);
            echo "<script type='text/javascript'>window.location.href ='../verify.php';</script>";
?>