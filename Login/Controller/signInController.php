<?php 
require_once 'userClass.php';

    if(isset($_POST['signInSubmit'])){
        
        $nsid = $_POST['form-nsid'];
        $password = $_POST['form-password'];
    
        
        if(!isRegisteredUser($nsid, $password)){
            echo "Incorrect login info. Please enter correct info and try again.";
        }
        else{
            
                if(getUserActiveStatus($nsid)==0){
                    echo "Please verify your email to access Fraties.";
                } else{
                    session_start();
                    $_SESSION["userNSID"] = $nsid;
                    echo "<script type='text/javascript'>window.location.href ='./verify.php';</script>";
                }
        }       
    }
?>
