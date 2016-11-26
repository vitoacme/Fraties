<?php
    // contains connect() and close() func for conenctions
    require_once 'Database/connectDB.php';
//require_once '../../Database/connectDB.php';

// creates user with nsid and passowrd
    function createPost($nsid, $post){
        // connect to database
        $connection = connect();
        
        $nsid = mysqli_real_escape_string($connection, $nsid);
        $password = mysqli_real_escape_string($connection, $password);
        
        $query = "INSERT INTO `posts`";
        $query .="(`postID`, `userNSID`, `postText`, `postUpVotes`, `postDownVotes`, `postComments`, `postTime`) ";
        $query .= "VALUES ";
        $query .= "(NULL, '{$nsid}', '{$post}', '0', '0', '0', CURRENT_TIMESTAMP)";
        
        $result = mysqli_query($connection, $query);
        
        
        // test for errors
        if(mysqli_affected_rows($connection) == 0){
            echo "No post added to db!";
            return false;
        }
        else if($result){
            return true;
        }
        else{
            die("Database update query for post failed! ".mysqli_error($connection));
            return false;
        }
        
        /* close connection uses close() func from dbConnect file */
        mysqli_free_result($result);
        close($connection);
        return $result;
    }
// return assoc array of all posts order by DESC time
    function displayPosts(){
        $connection = connect();

        // perform query
        $query = "SELECT * FROM `posts`";
        $query .= "ORDER BY `postTime` DESC";

        $result = mysqli_query($connection, $query);

        // test for errors
        if(!$result){
            die("Database display query failed!");
            return false;
        }
        if (mysqli_num_rows($result) > 0) {
            return $result;
            // output data of each row (_assoc for assoc array, _row for indexed array)
//            while($row = mysqli_fetch_assoc($result)) {
//                print_r($row);
//                echo "<hr />";
//            }
        } else {
//            echo "0 results";
            return false;
        }

        mysqli_free_result($result);
        close($connection);
    }
?>