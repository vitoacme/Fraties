<?php
	require_once '../Login/Controller/connectDB.php';

    function selectFromDB($nsid) {
        $connection = connect();
        $nsid = mysqli_real_escape_string($connection, $nsid);
        $query = "SELECT * ";
        $query .= "FROM `profile` ";
        $query .= "WHERE `userNSID` = '$nsid' ";
        $result = mysqli_query($connection, $query);
        if(!$result){
            return false;
        }
        else {
            return $result;
        }
    }

	function getUsersName($nsid){
        $result = selectFromDB($nsid);

        if (mysqli_num_rows($result) == 1) {
            while($row = mysqli_fetch_assoc($result)) {
                return $row["userName"];
            }
        }else if(mysqli_num_rows($result) > 1){
            return false;
        }else {
            return false;
        }
        mysqli_free_result($result);
        
        close($connection); 
    }

    function getUsersCollege($nsid){
        $result = selectFromDB($nsid);

        if (mysqli_num_rows($result) == 1) {
            while($row = mysqli_fetch_assoc($result)) {
                return $row["userCollege"];
            }
        }else if(mysqli_num_rows($result) > 1){
            return false;
        }else {
            return false;
        }
        mysqli_free_result($result);
        
        close($connection); 
    }

     function getUsersPicture($nsid){
        $result = selectFromDB($nsid);

        if (mysqli_num_rows($result) == 1) {
            while($row = mysqli_fetch_assoc($result)) {
                return 'src="data:image/jpeg;base64,'.base64_encode( $row["userPicture"] ).'"';
            }
        }else if(mysqli_num_rows($result) > 1){
            return false;
        }else {
            return false;
        }
        mysqli_free_result($result);
        
        close($connection); 
    }

    function getUsersFollowers($nsid){
        $result = selectFromDB($nsid);

        if (mysqli_num_rows($result) == 1) {
            while($row = mysqli_fetch_assoc($result)) {
                return $row["userFollowers"];
            }
        }else if(mysqli_num_rows($result) > 1){
            return false;
        }else {
            return false;
        }
        mysqli_free_result($result);
        
        close($connection); 
    }

    function getUsersFollowing($nsid){
        $result = selectFromDB($nsid);

        if (mysqli_num_rows($result) == 1) {
            while($row = mysqli_fetch_assoc($result)) {
                return $row["userFollowing"];
            }
        }else if(mysqli_num_rows($result) > 1){
            return false;
        }else {
            return false;
        }
        mysqli_free_result($result);
        
        close($connection); 
    }

    function getUsersPoints($nsid){
        $result = selectFromDB($nsid);

        if (mysqli_num_rows($result) == 1) {
            while($row = mysqli_fetch_assoc($result)) {
                return $row["userPoints"];
            }
        }else if(mysqli_num_rows($result) > 1){
            return false;
        }else {
            return false;
        }
        mysqli_free_result($result);
        
        close($connection); 
    }

    function getTopUsers($nsid){
        $connection = connect();
        $nsid = mysqli_real_escape_string($connection, $nsid);
        $query = "SELECT * ";
        $query .= "FROM `profile` ";
        $query .= "ORDER BY userPoints DESC";
        $result = mysqli_query($connection, $query);
        if(!$result){
            echo 'none';
            return false;
        }

        if (mysqli_num_rows($result) > 0) {
            $users = "";
            while($row = mysqli_fetch_assoc($result)) {
                $users .= '<li>'.$row["userNSID"].' - '.$row["userPoints"].'</li>';
            }
            return $users;
        }else {
            return false;
        }
        mysqli_free_result($result);
        
        close($connection); 
    }
?>