<?php

require_once 'Controller/userClass.php';

    if( isset($_GET['Email']) && !empty($_GET['Email']) 
            AND isset($_GET['Password']) && !empty($_GET['Password']) 
            AND isset($_GET['NSID']) && !empty($_GET['NSID'])){
        
        // Verify data
        $email = mysql_escape_string($_GET['Email']); // Set email variable
        $password = mysql_escape_string($_GET['Password']); // Set password variable
        $nsid = mysql_escape_string($_GET['NSID']); // Set nsid variable       
        
        $result = isRegisteredUser($nsid, $password);
        
        // test for errors
        if($result){
            session_start();
            $_SESSION["userNSID"] = $nsid;
            setUserToActive($nsid);

            echo "<script type='text/javascript'>window.location.href ='./homeForVerifiedUser.php';</script>";
        }
        else{
            echo "Incorrect link. Something went wrong. Please contact the webmaster.";
        }   
    } else{
        echo "Please verify your email to access Fraties.";
    }
?>
