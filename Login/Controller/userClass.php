<?php
// contains connect() and close() func for conenctions
    require_once 'connectDB.php';

    function createUser($nsid, $password){
        // connect to database
        $connection = connect();
        
        $nsid = mysqli_real_escape_string($connection, $nsid);
        $password = mysqli_real_escape_string($connection, $password);

        $query = "INSERT INTO `users`";
        $query .="(`userNSID`, `userPassword`) ";
        $query .= "VALUES ";
        $query .= "('{$nsid}','{$password}')";
        
        $result = mysqli_query($connection, $query);
        // id of current inserted user
        $id = mysqli_insert_id($connection);
        
       /* close connection uses close() func from dbConnect file */
        close($connection);

        // test for errors
        return $result;
    }

    function sendVerificationEmail($nsid){
        $password = getUserPassword($nsid);
        $email = $nsid."@mail.usask.ca";
        $to      = $email; // Send email to our user
        $subject = 'Fraties Signup Verification'; // Give the email a subject 
        $message = 'Thanks for signing up!
Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.
                    ------------------------
                    Username: '.$nsid.'
                    Password: '.$password.'
                    ------------------------
Please click this link to activate your account:
http://localhost/Fraties/Login/verify.php?Email='.$email.'&Password='.$password.'&NSID='.$nsid.'
                    '; // Our message above including the link
                     
        $headers = 'From:noreply@fraties.com' . "\r\n"; // Set from headers
        mail($to, $subject, $message, $headers); // Send our email
    }
    
    function setUserToActive($nsid){
        
        $connection = connect();
        $nsid = mysqli_real_escape_string($connection, $nsid);
        $id = getUserID($fromEmail);

        $query = "UPDATE `users` SET ";
        $query .= "`userActive` = '1' ";
        $query .= "WHERE `userNSID` = '{$nsid}'";

        $result = mysqli_query($connection, $query);
        //$id = mysqli_insert_id($connection);
        //echo "Your userID is: ".$id."\n";

        // test for errors
        if(mysqli_affected_rows($connection) == 0){
//            echo "No user email change in DB!";
            return false;
        }
        else if($result){
            return true;
        }
        else{
//            die("Database update for setUserEmail query failed! ".mysqli_error($connection));
            return false;
        }
        close($connection);
    }

    function getUserActiveStatus($nsid){
        $connection = connect();
        $nsid = mysqli_real_escape_string($connection, $nsid);
        // perform query
        $query = "SELECT * ";
        $query .= "FROM `users` ";
        $query .= "WHERE `userNSID` = '$nsid' ";
       
        $result = mysqli_query($connection, $query);

        // test for errors
        if(!$result){
//            die("Database getUserID functions query failed!");
            return false;
        }

        if (mysqli_num_rows($result) == 1) {
            // output data of each row (_assoc for assoc array, _row for indexed array)
            while($row = mysqli_fetch_assoc($result)) {

                return $row["userActive"];
            }
        } 
        else if(mysqli_num_rows($result) > 1){
//            echo "There are more than 2 entries with same email! Please contact the owner of this site about this.";
            return false;
        }
        else {
            
//            echo "There is no account registered with this email. Please make sure your sign in info is correct or register a new account. Thank you.";
            return false;
        }

        mysqli_free_result($result);
        
        close($connection);
    }

    function deleteUser($nsid){
        $connection = connect();
        
        $nsid = mysqli_real_escape_string($connection, $nsid);

        $query = "DELETE FROM `users` ";
        $query .= "WHERE `userNSID` = '{$nsid}' ";
        $query .= "LIMIT 1";

        $result = mysqli_query($connection, $query);

        // test for errors
        if(mysqli_affected_rows($connection) == 0){
//            echo "No deletion in DB!";
            return false;
        }
        else if($result){
            return true;
        }
        else{
//            die("Database delete query failed! ".mysqli_error($connection));
            return false;
        }
        close($connection);
    }
    
    function displayDB(){

        $connection = connect();

        // perform query
        $query = "SELECT * ";
        $query .= "FROM `users` ";
        //$query .= "WHERE userType = 'Employer' ";
        //$query .= "WHERE userType = 'Student' ";
        $query .= "ORDER BY userNSID ASC";

        $result = mysqli_query($connection, $query);

        // test for errors
        if(!$result){
//            die("Database display query failed!");
            return false;
        }
        if (mysqli_num_rows($result) > 0) {
            // output data of each row (_assoc for assoc array, _row for indexed array)
            while($row = mysqli_fetch_assoc($result)) {
                print_r($row);
                echo "<hr />";
            }
        } else {
//            echo "0 results";
            return false;
        }

        mysqli_free_result($result);

        close($connection);
    }

    function displayResult($result){
        if(!$result){
//            die("Database display query failed!");
            return false;
        }
        if (mysqli_num_rows($result) > 0) {
            // output data of each row (_assoc for assoc array, _row for indexed array)
            while($row = mysqli_fetch_assoc($result)) {
                print_r($row);
                echo "<hr />";
            }
        } else {
//            echo "0 results";
            return false;
        }
    }

    function getUserID($nsid){
        $connection = connect();
        $nsid = mysqli_real_escape_string($connection, $nsid);
        // perform query
        $query = "SELECT * ";
        $query .= "FROM `users` ";
        $query .= "WHERE `userNSID` = '$nsid' ";
       
        $result = mysqli_query($connection, $query);

        // test for errors
        if(!$result){
//            die("Database getUserID functions query failed!");
            return false;
        }

        if (mysqli_num_rows($result) == 1) {
            // output data of each row (_assoc for assoc array, _row for indexed array)
            while($row = mysqli_fetch_assoc($result)) {

                return $row["userID"];
            }
        } 
        else if(mysqli_num_rows($result) > 1){
//            echo "There are more than 2 entries with same email! Please contact the owner of this site about this.";
            return false;
        }
        else {
            
//            echo "There is no account registered with this email. Please make sure your sign in info is correct or register a new account. Thank you.";
            return false;
        }

        mysqli_free_result($result);
        
        close($connection);
    }

    function isRegisteredNSID($nsid){
        $connection = connect();
        $nsid = mysqli_real_escape_string($connection, $nsid);
        // perform query
        $query = "SELECT * ";
        $query .= "FROM `users` ";
        $query .= "WHERE `userNSID` = '$nsid' ";
       
        $result = mysqli_query($connection, $query);

        // test for errors
        if(!$result){
//            die("Database isRegisteredMail functions query failed!");
            return false;
        }

        if (mysqli_num_rows($result) == 1) {
          return true;
        } 
        else if(mysqli_num_rows($result) > 1){
//            echo "There are more than 2 entries with same email! Please contact the owner of this site about this.";
            return false;
        }
        else {
            return false;
        }

        mysqli_free_result($result);
        close($connection);
    }

    function getResult($nsid){
        $connection = connect();
        $nsid = mysqli_real_escape_string($connection, $nsid);
        // perform query
        $query = "SELECT * ";
        $query .= "FROM `users` ";
        $query .= "WHERE `userNSID` = '$nsid' ";
       
        $result = mysqli_query($connection, $query);

        // test for errors
        if(!$result){
//            die("Database getResult functions query failed!");
            return false;
        }

        if (mysqli_num_rows($result) == 1) {
          return $result;
        } 
        else if(mysqli_num_rows($result) > 1){
//            echo "There are more than 2 entries with same email! Please contact the owner of this site about this.";
            return false;
        }
        else {
            return false;
        }

        mysqli_free_result($result);
        close($connection);
        
    }

    function isRegisteredUser($nsid, $password){
        $connection = connect();
        
        $nsid = mysqli_real_escape_string($connection, $nsid);
        $password = mysqli_real_escape_string($connection, $password);
        // perform query
        $query = "SELECT * ";
        $query .= "FROM `users` ";
        $query .= "WHERE `userNSID` = '$nsid' ";
       
        $result = mysqli_query($connection, $query);
//        echo $query;

        // test for errors
        if(!$result){
//            die("Database userAuthenticate query failed!");
            return false;
        }

        if (mysqli_num_rows($result) == 1) {
            // output data of each row (_assoc for assoc array, _row for indexed array)
            while($row = mysqli_fetch_assoc($result)) {

                if($password != $row["userPassword"]){
//                    echo "Incorrect password. Please try again.";
                    return false;
                }
                else{
                    return true;
                }
            }
        } 
        else if(mysqli_num_rows($result) > 1){
//            echo "There are more than 2 entries with same email! Please contact the owner of this site about this.";
            return false;
        }
        else {
            
//            echo "There is no account registered with this email. Please make sure your sign in info is correct or register a new account. Thank you.";
            return false;
        }
        mysqli_free_result($result);
        close($connection);
        
        return false;
    }

    function getUserPassword($nsid){
        $connection = connect();
        $nsid = mysqli_real_escape_string($connection, $nsid);
        // perform query
        $query = "SELECT * ";
        $query .= "FROM `users` ";
        $query .= "WHERE `userNSID` = '$nsid' ";
       
        $result = mysqli_query($connection, $query);

        // test for errors
        if(!$result){
//            die("Database getUserPassword functions query failed!");
            return false;
        }

        if (mysqli_num_rows($result) == 1) {
            // output data of each row (_assoc for assoc array, _row for indexed array)
            while($row = mysqli_fetch_assoc($result)) {

                return $row["userPassword"];
            }
        } 
        else if(mysqli_num_rows($result) > 1){
//            echo "There are more than 2 entries with same email! Please contact the owner of this site about this.";
            return false;
        }
        else {
            
//            echo "There is no account registered with this email. Please make sure your sign in info is correct or register a new account. Thank you.";
            return false;
        }

        mysqli_free_result($result);
        
        close($connection);
    }

    function setUserEmail($fromEmail, $toEmail){
        $connection = connect();
        $nsid = mysqli_real_escape_string($connection, $nsid);
        $id = getUserID($fromEmail);

        $query = "UPDATE `users` SET ";
        $query .= "`userNSID` = '{$toEmail}' ";
        $query .= "WHERE `userID` = '{$id}'";

        $result = mysqli_query($connection, $query);
        //$id = mysqli_insert_id($connection);
        //echo "Your userID is: ".$id."\n";

        // test for errors
        if(mysqli_affected_rows($connection) == 0){
//            echo "No user email change in DB!";
            return false;
        }
        else if($result){
            return true;
        }
        else{
//            die("Database update for setUserEmail query failed! ".mysqli_error($connection));
            return false;
        }
        close($connection);
    }

    function setUserPassword($nsid,$newPassword){
        $connection = connect();
        $nsid = mysqli_real_escape_string($connection, $nsid);
        $query = "UPDATE `users` SET ";
        $query .= "`userPassword` = '{$newPassword}' ";
        $query .= "WHERE `userNSID` = '{$nsid}'";

        $result = mysqli_query($connection, $query);
        //$id = mysqli_insert_id($connection);
        //echo "Your userID is: ".$id."\n";

        // test for errors
        if(mysqli_affected_rows($connection) == 0){
//            echo "No password change in DB!";
            return false;
        }
        else if($result){
            return true;
        }
        else{
//            die("Database update query for setUserPassword failed! ".mysqli_error($connection));
            return false;
        }
        close($connection);
    }
?>