<?php
    require_once '../../Database/connectDB.php';
    session_start();
    $NSID = $_SESSION["userNSID"];

//echo "Water";
if(isset($_POST["id"])){
    $postID = $_POST["id"];
    setDownVote($postID);
    echo getDownVotes($postID);
    
    // ToDo add the userNSID to new table which holds all the upvotes with postID and userID to avoid moltiple upvoting and downvoting
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