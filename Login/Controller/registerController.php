<?php
    require_once 'Login/Controller/userClass.php';

    if(isset($_POST['registerSubmit'])){
        
        $nsid = $_POST['form-nsidRegister'];
        $password = $_POST['form-passwordRegister'];
        
        $result = createUser($nsid, $password);
        
        // test for errors
        if($result){
            sendVerificationEmail($nsid);
            echo "<script type='text/javascript'>
                $(document).ready(function(){
                $('#id01').modal('show');
                });
            </script>";
        }
        else{
            echo "This NSID is already in use. Either sign in or use a different email. Thank you.";
        }   
    }
?>
