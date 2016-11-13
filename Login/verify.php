<?php

require_once 'Controller/userClass.php';

    session_start();
    $nsid = $_SESSION["userNSID"];

    if($nsid==""){
        echo "<script type='text/javascript'>window.location.href ='./login.php';</script>";
    }
    else if(getUserActiveStatus($nsid)==1){
        echo "<script type='text/javascript'>window.location.href ='./homeForVerifiedUser.php';</script>";
    } 
    else if( isset($_GET['Email']) && !empty($_GET['Email']) 
            AND isset($_GET['Password']) && !empty($_GET['Password']) 
            AND isset($_GET['NSID']) && !empty($_GET['NSID'])){
        
        // Verify data
        $email = mysql_escape_string($_GET['Email']); // Set email variable
        $password = mysql_escape_string($_GET['Password']); // Set password variable
        $nsid = mysql_escape_string($_GET['NSID']); // Set nsid variable       
        
        $result = isRegisteredUser($nsid, $password);
        
        if(getUserActiveStatus($nsid)==1){
            
            echo "<script type='text/javascript'>window.location.href ='./homeForVerifiedUser.php';</script>";
        }
        
        // test for errors
        if($result){
            $_SESSION["userNSID"] = $nsid;
            setUserToActive($nsid);
            
             echo "<script type='text/javascript'>window.location.href ='./homeForVerifiedUser.php';</script>";
        }  else{
            echo "wrong link.";
        }
    } 
    else {
        echo "Please verify your email to access Fraties. Or " ?> <a href="Controller/resendVerification.php">Click here</a> <?php echo "here to resend the email confirmation to ".$nsid;
    }
?>