<?php
// contains connect() and close() func for conenctions
//    require_once '../../Database/connectDB.php';
    require_once 'Database/connectDB.php';
    require_once 'Login/Controller/PHPMailer/PHPMailerAutoload.php';

// creates user with nsid and passowrd
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

// updates password of user with nsid
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
    
// sets user's upvotes
    function setUserUpvotes($nsid,$upvotes){
        $connection = connect();
        $nsid = mysqli_real_escape_string($connection, $nsid);
        $query = "UPDATE `users` SET ";
        $query .= "`userUpvotes` = '{$upvotes}' ";
        $query .= "WHERE `userNSID` = '{$nsid}'";
        $result = mysqli_query($connection, $query);
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
// return number of upvotes of user with nsid
    function getUserUpvotes($nsid){
        $connection = connect();
        $nsid = mysqli_real_escape_string($connection, $nsid);
        
        $query = "SELECT * ";
        $query .= "FROM `users` ";
        $query .= "WHERE `userNSID` = '$nsid' ";
       
        $result = mysqli_query($connection, $query);

        if(!$result){
            return false;
        }
        if (mysqli_num_rows($result) == 1) {
            while($row = mysqli_fetch_assoc($result)) {
                return $row["userUpvotes"];
            }
        } else if(mysqli_num_rows($result) > 1){
            return false;
        } else {
            return false;
        }
        mysqli_free_result($result);
        close($connection);
    }

// sets user's points
    function setPoints($nsid,$points){
        $connection = connect();
        $nsid = mysqli_real_escape_string($connection, $nsid);
        $query = "UPDATE `users` SET ";
        $query .= "`userPoints` = '{$points}' ";
        $query .= "WHERE `userNSID` = '{$nsid}'";
        $result = mysqli_query($connection, $query);
        if(mysqli_affected_rows($connection) == 0){
//            echo "No password change in DB!";
            return false;
        } else if($result){
            return true;
        } else{
//            die("Database update query for setUserPassword failed! ".mysqli_error($connection));
            return false;
        }
        close($connection);
    }
// return points of user with nsid
    function getPoints($nsid){
        $connection = connect();
        $nsid = mysqli_real_escape_string($connection, $nsid);
        
        $query = "SELECT * ";
        $query .= "FROM `users` ";
        $query .= "WHERE `userNSID` = '$nsid' ";
       
        $result = mysqli_query($connection, $query);

        if(!$result){
            return false;
        }
        if (mysqli_num_rows($result) == 1) {
            while($row = mysqli_fetch_assoc($result)) {

                return $row["userPoints"];
            }
        } else if(mysqli_num_rows($result) > 1){
            return false;
        } else {
            return false;
        }
        mysqli_free_result($result);
        close($connection);
    }

// sets user's downvotes
    function setUserDownvotes($nsid,$downvotes){
        $connection = connect();
        $nsid = mysqli_real_escape_string($connection, $nsid);
        $query = "UPDATE `users` SET ";
        $query .= "`userDownvotes` = '{$downvotes}' ";
        $query .= "WHERE `userNSID` = '{$nsid}'";
        $result = mysqli_query($connection, $query);
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
// return number of downvotes of user with nsid
    function getUserDownvotes($nsid){
        $connection = connect();
        $nsid = mysqli_real_escape_string($connection, $nsid);
        
        $query = "SELECT * ";
        $query .= "FROM `users` ";
        $query .= "WHERE `userNSID` = '$nsid' ";
       
        $result = mysqli_query($connection, $query);

        if(!$result){
            return false;
        }
        if (mysqli_num_rows($result) == 1) {
            while($row = mysqli_fetch_assoc($result)) {
                return $row["userDownvotes"];
            }
        } else if(mysqli_num_rows($result) > 1){
            return false;
        } else {
            return false;
        }
        mysqli_free_result($result);
        close($connection);
    }

// sets user of nsid to active
    function setUserToActive($nsid){
        
        $connection = connect();
        $nsid = mysqli_real_escape_string($connection, $nsid);

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

// sets image path, college, first and last name of the user with nsid
    function setImageNameCollegeActive($nsid, $imagePath,$FirstName,$LastName,$college ){
        $connection = connect();
        $nsid = mysqli_real_escape_string($connection, $nsid);
        $FirstName = mysqli_real_escape_string($connection, $FirstName);
        $LastName = mysqli_real_escape_string($connection, $LastName);
        $college = mysqli_real_escape_string($connection, $college);
        $query = "UPDATE `users` SET ";
        $query .= "`userActive` = '1', `userFirstName` = '{$FirstName}', `userLastName` = '{$LastName}', `userCollege` = '{$college}', `userImagePath` = '{$imagePath}' ";
        $query .= "WHERE `userNSID` = '{$nsid}'";
        $result = mysqli_query($connection, $query);
        if(mysqli_affected_rows($connection) == 0){
            return false;
        } else if($result){
            return true;
        } else{
            return false;
        }
        close($connection);
    }

// set image
    function setImage($nsid, $imagePath){
        $connection = connect();
        $nsid = mysqli_real_escape_string($connection, $nsid);
        $query = "UPDATE `users` SET ";
        $query .= "`userImagePath` = '{$imagePath}' ";
        $query .= "WHERE `userNSID` = '{$nsid}'";
        $result = mysqli_query($connection, $query);
        if(mysqli_affected_rows($connection) == 0){
            return false;
        } else if($result){
            return true;
        } else{
            return false;
        }
        close($connection);
    }

// sets fname, lname and college
    function setNameCollege($nsid,$FirstName,$LastName,$college){
        $connection = connect();
        $nsid = mysqli_real_escape_string($connection, $nsid);
        $FirstName = mysqli_real_escape_string($connection, $FirstName);
        $LastName = mysqli_real_escape_string($connection, $LastName);
        $college = mysqli_real_escape_string($connection, $college);
        $query = "UPDATE `users` SET ";
        $query .= "`userFirstName` = '{$FirstName}', `userLastName` = '{$LastName}', `userCollege` = '{$college}' ";
        $query .= "WHERE `userNSID` = '{$nsid}'";
        $result = mysqli_query($connection, $query);
        if(mysqli_affected_rows($connection) == 0){
            return false;
        } else if($result){
            return true;
        } else{
            return false;
        }
        close($connection);
    }

// checks if user with this nsid and password is in db or not
    function isRegisteredUser($nsid, $password){
        $connection = connect();
        
        $nsid = mysqli_real_escape_string($connection, $nsid);
        $password = mysqli_real_escape_string($connection, $password);
        // perform query
        $query = "SELECT * ";
        $query .= "FROM `users` ";
        $query .= "WHERE `userNSID` = '$nsid' ";
       
        $result = mysqli_query($connection, $query);
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

// checks if this nsid is in db or not
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

// sends verification email
    function sendVerificationEmail($nsid){
        $password = getUserPassword($nsid);
        $email = $nsid."@mail.usask.ca";
        $mail = new PHPMailer;
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'mail.privateemail.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'noreply@fraties.me';                 // SMTP username
        $mail->Password = '9891438250';                           // SMTP password
        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587;                                    // TCP port to connect to

        $mail->setFrom('noreply@fraties.me');
        $mail->addAddress($email);     // Add a recipient

        $mail->isHTML(true);                                  // Set email format to HTML

        $mail->Subject = 'Welcome to Fraties!!!';
        $mail->Body    = 'Thanks for signing up!
Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.
                    ------------------------
                    Username: '.$nsid.'
                    Password: '.$password.'
                    ------------------------
Please click this link to activate your account:
http://fraties.me/verify.php?Email='.$email.'&Password='.$password.'&NSID='.$nsid.'
                    ';
        $mail->AltBody = 'Thanks for signing up!
Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.
                    ------------------------
                    Username: '.$nsid.'
                    Password: '.$password.'
                    ------------------------
Please click this link to activate your account:
http://fraties.me/verify.php?Email='.$email.'&Password='.$password.'&NSID='.$nsid.'
                    ';

        if(!$mail->send()) {
            echo 'Fraties Signup Verification';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            echo 'Message has been sent';
        }
    }

// resturns activation status of user with nsid
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

// deletes user with nsid
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
    
// displays all users
    function displayUserDB(){
        $connection = connect();
        $query = "SELECT * ";
        $query .= "FROM `users` ";
        $query .= "ORDER BY userPoints DESC";
        $result = mysqli_query($connection, $query);
        if(!$result){
            return false;
        }
        if (mysqli_num_rows($result) > 0) {
            return $result;
        } else {
            return false;
        }
        mysqli_free_result($result);
        close($connection);
    }

// displays results from SQL statement
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

// returns userID of nsid
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

// returns result of user with nsid
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

// returns password of user with nsid
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

// return first name of user with nsid
    function getFirstName($nsid){
        $connection = connect();
        $nsid = mysqli_real_escape_string($connection, $nsid);
        
        $query = "SELECT * ";
        $query .= "FROM `users` ";
        $query .= "WHERE `userNSID` = '$nsid' ";
       
        $result = mysqli_query($connection, $query);

        if(!$result){
            return false;
        }
        if (mysqli_num_rows($result) == 1) {
            while($row = mysqli_fetch_assoc($result)) {

                return $row["userFirstName"];
            }
        } else if(mysqli_num_rows($result) > 1){
            return false;
        } else {
            return false;
        }
        mysqli_free_result($result);
        close($connection);
    }

// return last name of user with nsid
    function getLastName($nsid){
        $connection = connect();
        $nsid = mysqli_real_escape_string($connection, $nsid);
        
        $query = "SELECT * ";
        $query .= "FROM `users` ";
        $query .= "WHERE `userNSID` = '$nsid' ";
       
        $result = mysqli_query($connection, $query);

        if(!$result){
            return false;
        }
        if (mysqli_num_rows($result) == 1) {
            while($row = mysqli_fetch_assoc($result)) {

                return $row["userLastName"];
            }
        } else if(mysqli_num_rows($result) > 1){
            return false;
        } else {
            return false;
        }
        mysqli_free_result($result);
        close($connection);
    }

// return image path of user with nsid
    function getImagePath($nsid){
        $connection = connect();
        $nsid = mysqli_real_escape_string($connection, $nsid);
        
        $query = "SELECT * ";
        $query .= "FROM `users` ";
        $query .= "WHERE `userNSID` = '$nsid' ";
       
        $result = mysqli_query($connection, $query);

        if(!$result){
            return false;
        }
        if (mysqli_num_rows($result) == 1) {
            while($row = mysqli_fetch_assoc($result)) {

                return $row["userImagePath"];
            }
        } else if(mysqli_num_rows($result) > 1){
            return false;
        } else {
            return false;
        }
        mysqli_free_result($result);
        close($connection);
    }

// return college of user with nsid
    function getCollege($nsid){
        $connection = connect();
        $nsid = mysqli_real_escape_string($connection, $nsid);
        
        $query = "SELECT * ";
        $query .= "FROM `users` ";
        $query .= "WHERE `userNSID` = '$nsid' ";
       
        $result = mysqli_query($connection, $query);

        if(!$result){
            return false;
        }
        if (mysqli_num_rows($result) == 1) {
            while($row = mysqli_fetch_assoc($result)) {

                return $row["userCollege"];
            }
        } else if(mysqli_num_rows($result) > 1){
            return false;
        } else {
            return false;
        }
        mysqli_free_result($result);
        close($connection);
    }

// return number of users user is following with nsid
    function getFollowing($nsid){
        $connection = connect();
        $nsid = mysqli_real_escape_string($connection, $nsid);
        
        $query = "SELECT * ";
        $query .= "FROM `users` ";
        $query .= "WHERE `userNSID` = '$nsid' ";
       
        $result = mysqli_query($connection, $query);

        if(!$result){
            return false;
        }
        if (mysqli_num_rows($result) == 1) {
            while($row = mysqli_fetch_assoc($result)) {

                return $row["userFollowing"];
            }
        } else if(mysqli_num_rows($result) > 1){
            return false;
        } else {
            return false;
        }
        mysqli_free_result($result);
        close($connection);
    }
?>