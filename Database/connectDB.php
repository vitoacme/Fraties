<?php

function connect(){
    // declare databse variables
    $db_host = "localhost";
    $db_name = "fraties";
    $db_username = "root";
    $db_password = "root";

    // create connection
    $connection = mysqli_connect($db_host, $db_username, $db_password, $db_name);
    
    // check connection
    if(mysqli_connect_errno()){
        die("Database connection failed: ".mysqli_connect_error()."(".mysqli_connect_errno().")");
        exit();
    } else {
//        echo "conected";
    }

    /* check if server is alive */
    if (mysqli_ping($connection)) {
        //printf ("Our connection is ok!\n");
    } else {
        printf ("Error: %s\n", mysqli_error($connection));
    }
    
    return $connection;
}

function close($connection){
    /* close connection */
    mysqli_close($connection);
}
?>