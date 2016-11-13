<?php
    require_once 'userClass.php';

    if(isset($_POST['registerSubmit'])){
        
        $nsid = $_POST['form-nsidRegister'];
        $password = $_POST['form-passwordRegister'];
        
        $result = createUser($nsid, $password);
        
        // test for errors
        if($result){
            session_start();
            $_SESSION["userNSID"] = $nsid;
            
            sendVerificationEmail($nsid);

            echo "<script type='text/javascript'>window.location.href ='./homeFromRegister.php';</script>";
            echo "<script type='text/javascript'>window.location.href ='./verify.php';</script>";
        }
        else{
            echo "This email is already in use. Either sign in or use a different email. Thank you.";
        }   
    }
?>