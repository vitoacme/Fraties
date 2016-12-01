<?php
    require_once '../../Database/connectDB.php';
    session_start();
    $NSID = $_SESSION["userNSID"];

    if(isset($_POST["following"]) && isset($_POST["buttonType"])){ 
        //nsid of user to follow or unfollow  
        $userFollowing = $_POST["following"];
        $button = $_POST["buttonType"];

        if($button == 'Follow'){
           createFollower($NSID, $userFollowing); 
        } else {
            deleteFollower($NSID, $userFollowing);
        }
        
    }

    // creates follower entry
    function createFollower($nsid, $follower){
        $connection = connect();
        $nsid = mysqli_real_escape_string($connection, $nsid);
        $follower = mysqli_real_escape_string($connection, $follower);

        $query = "INSERT INTO `followers`";
        $query .="(`userNSID`, `followingNSID`) ";
        $query .= "VALUES ";
        $query .= "('{$nsid}', '{$follower}')";

        $result = mysqli_query($connection, $query);
        // test for errors
        if(mysqli_affected_rows($connection) == 0){
            return false;
        } else if($result){
            // increase user following number
            $following = getUserFollowing($nsid) + 1;
            setUserFollowing($nsid, $following);
            
            // increase followers of user being followed
            $followers = getUserFollowers($nsid) + 1;
            setUserFollowers($follower, $followers);
            return true;
        } else{
            return false;
        }
        mysqli_free_result($result);
        close($connection);
        return $result;
    }

    // creates follower entry
    function deleteFollower($nsid, $follower){
        echo "<script type='text/javascript'>alert('delete:".$nsid."');</script>";
        $connection = connect();
        $nsid = mysqli_real_escape_string($connection, $nsid);
        $follower = mysqli_real_escape_string($connection, $follower);

        $query = "DELETE FROM `followers` WHERE userNSID = '{$nsid}' AND followingNSID = '{$follower}' LIMIT 1";

        $result = mysqli_query($connection, $query);

        // test for errors
        if(mysqli_affected_rows($connection) == 0){
            return false;
        }
        else if($result){
            // decrease user following number
            $following = getUserFollowing($nsid) - 1;
            setUserFollowing($nsid, $following);
            
            // idecrease followers of user being followed
            $followers = getUserFollowers($nsid) - 1;
            setUserFollowers($follower, $followers);
            return true;
        }
        else{
            return false;
        }
        close($connection);
    }

// sets user's followers
    function setUserFollowers($nsid, $followers){
        $connection = connect();
        $nsid = mysqli_real_escape_string($connection, $nsid);
        $query = "UPDATE `users` SET ";
        $query .= "`userFollowers` = '{$followers}' ";
        $query .= "WHERE `userNSID` = '{$nsid}'";
        $result = mysqli_query($connection, $query);
        if(mysqli_affected_rows($connection) == 0){
            return false;
        }
        else if($result){
            return true;
        }
        else{
            return false;
        }
        close($connection);
    }
// return number of followers of user with nsid
    function getUserFollowers($nsid){
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
                return $row["userFollowers"];
            }
        } else if(mysqli_num_rows($result) > 1){
            return false;
        } else {
            return false;
        }
        mysqli_free_result($result);
        close($connection);
    }

    // sets user's following user with nsid
    function setUserFollowing($nsid, $following){
        $connection = connect();
        $nsid = mysqli_real_escape_string($connection, $nsid);
        $query = "UPDATE `users` SET ";
        $query .= "`userFollowing` = '{$following}' ";
        $query .= "WHERE `userNSID` = '{$nsid}'";
        $result = mysqli_query($connection, $query);
        if(mysqli_affected_rows($connection) == 0){
            return false;
        }
        else if($result){
            return true;
        }
        else{
            return false;
        }
        close($connection);
    }
// return number of users following user with nsid
    function getUserFollowing($nsid){
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