<?php
    require_once '../../Database/connectDB.php';

    session_start();
    $NSID = $_SESSION["userNSID"];

if(isset($_POST["id"]) && isset($_POST["comment"])){    
    $postID = $_POST["id"];
    $comment = $_POST["comment"];
    if(createComment($NSID, $postID, $comment)){
        setCommentCount($postID);
    }
    echo getCommentCount($postID);
} else if (isset($_POST["commentID"])) {
    $postID = $_POST["commentID"];
    echo getCommentList($postID);
} else if (isset($_POST["countID"])) {
    $postID = $_POST["countID"];
    echo getCommentCount($postID);
}

// creates comment with nsid and postid
    function createComment($NSID, $postID, $comment){
        // connect to database
        $connection = connect();
        $nsid = mysqli_real_escape_string($connection, $nsid);
        $postID = mysqli_real_escape_string($connection, $postID);
        $comment = mysqli_real_escape_string($connection, $comment);

        $query = "INSERT INTO `comments`";
        $query .="(`postID`, `userNSID`, `commentText`, commentTime) ";
        $query .= "VALUES ";
        $query .= "('{$postID}', '{$NSID}', '{$comment}', CURRENT_TIMESTAMP)";

        $result = mysqli_query($connection, $query);
        // test for errors
        if(mysqli_affected_rows($connection) == 0){
            return false;
        } else if($result){
            $points = getPoints($NSID) + 1;
            setPoints($NSID, $points);

            $postNSID = getUserOfPost($postID);

            $points = getPoints($postNSID) + 1;
            setPoints($postNSID, $points);
            return true;
        } else{
            return false;
        }
        mysqli_free_result($result);
        close($connection);
        return $result;
    }

    //gets the comment count of a post
    function getCommentCount($postID) {
        $connection = connect();

        $postID = mysqli_real_escape_string($connection, $postID);

        $query = "SELECT * ";
        $query .= "FROM `posts` ";
        $query .= "WHERE `postID` = '$postID' ";

        $result = mysqli_query($connection, $query);
        if(!$result){
            return false;
        }
        if (mysqli_num_rows($result) == 1) {
            while($row = mysqli_fetch_assoc($result)) {
                return $row["postComments"];
            }
        } else if(mysqli_num_rows($result) > 1){
            return false;
        } else {
            return false;
        }
        mysqli_free_result($result);
        close($connection);
    }


// Increase comment count
    function setCommentCount($postID){
        $commentCount = getCommentCount($postID) + 1;
        $connection = connect();
        $query = "UPDATE `posts` SET ";
        $query .= "`postComments` = '{$commentCount}' ";
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

    //gets the comments of a post
    function getCommentList($postID) {
        $connection = connect();

        $postID = mysqli_real_escape_string($connection, $postID);

        $query = "SELECT * ";
        $query .= "FROM `comments` ";
        $query .= "WHERE `postID` = '$postID' ";
        $query .= "ORDER BY commentTime DESC";

        $result = mysqli_query($connection, $query);
        if(!$result){
            die("Database display query failed!");
            return false;
        }
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $comments .= '<li>'.$row["userNSID"].': '.$row["commentText"].'</li>';
            }
            return $comments;
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

    // returns owner of post with id
    function getUserOfPost($postID){
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
                return $row["userNSID"];
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