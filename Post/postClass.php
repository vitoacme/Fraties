<?php
    // contains connect() and close() func for conenctions
    require_once 'Database/connectDB.php';

// creates user with nsid and passowrd
    function createPost($nsid, $password){
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
?>