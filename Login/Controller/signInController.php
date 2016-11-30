<?php 
require_once 'Login/Controller/userClass.php';

    if(isset($_POST['signInSubmit'])){
        
        $nsid = $_POST['form-nsid'];
        $password = $_POST['form-password'];
    
        
        if(!isRegisteredUser($nsid, $password)){
            echo "Incorrect login info. Please enter correct info and try again.";
        }
        else{
            
            session_start();
            $_SESSION["userNSID"] = $nsid;

            echo "<script type='text/javascript'>window.location.href ='verify.php';</script>";
        }       
    }
?>
