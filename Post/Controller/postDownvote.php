<?php
    require_once '../../Database/connectDB.php';
    session_start();
    $NSID = $_SESSION["userNSID"];

//echo "Water";
if(isset($_POST["id"])){    
    $postID = $_POST["id"];
    if(createDownVote($NSID, $postID)){
        setDownVote($postID);
        
        $downvotes = getUserDownvotes($NSID) - 1;
        setUserDownvotes($NSID,$downvotes);
        
        $points = getPoints($NSID) + 1;
        setPoints($NSID, $points);
    }
    echo getDownVotes($postID);
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


// creates upvote with nsid and postid
    function createDownVote($NSID, $postID){
        // connect to database
        $connection = connect();
        $nsid = mysqli_real_escape_string($connection, $nsid);
        $postID = mysqli_real_escape_string($connection, $postID);
        $query = "INSERT INTO `votes`";
        $query .="(`postID`, `userNSID`, `vote`) ";
        $query .= "VALUES ";
        $query .= "('{$postID}', '{$NSID}', '0')";
        $result = mysqli_query($connection, $query);
        // test for errors
        if(mysqli_affected_rows($connection) == 0){
//            echo "No post added to db!";
            return false;
        } else if($result){
            return true;
        } else{
//            die("Cannon insert into table votes! ".$NSID.$postID.mysqli_error($connection));
            return false;
        }
        mysqli_free_result($result);
        close($connection);
        return $result;
    }
// decrese downvotes of post by one
    function setDownVote($postID){
        $downvotes = getDownVotes($postID) - 1;
        $connection = connect();
        $query = "UPDATE `posts` SET ";
        $query .= "`postDownVotes` = '{$downvotes}' ";
        $query .= "WHERE `postID` = '{$postID}'";
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
// returns value of downvotes of post with postID
    function getDownVotes($postID){
        $connection = connect();
        $nsid = mysqli_real_escape_string($connection, $nsid);
        $query = "SELECT * ";
        $query .= "FROM `posts` ";
        $query .= "WHERE `postID` = '$postID' ";
        $result = mysqli_query($connection, $query);
        if(!$result){
            return false;
        }
        if (mysqli_num_rows($result) == 1) {
            while($row = mysqli_fetch_assoc($result)) {
                return $row["postDownVotes"];
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