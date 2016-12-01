<?php
    // contains connect() and close() func for conenctions
    require_once 'Database/connectDB.php';
//require_once '../../Database/connectDB.php';

// creates tag with post id and tag
    function createTag($postID, $tag){
        // connect to database
        $connection = connect();
        
        $postID = mysqli_real_escape_string($connection, $postID);
        $tag = mysqli_real_escape_string($connection, $tag);
        
        $query = "INSERT INTO `tags`";
        $query .="(`postID`, `tagText`) ";
        $query .= "VALUES ";
        $query .= "('{$postID}', '{$tag}')";
        
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

    //gets the tags of a post
    function getTags($postID) {
        $connection = connect();

        $postID = mysqli_real_escape_string($connection, $postID);

        $query = "SELECT * ";
        $query .= "FROM `tags` ";
        $query .= "WHERE `postID` = '$postID' ";

        $result = mysqli_query($connection, $query);
        if(!$result){
            die("Database display query failed!");
            return false;
        }
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $tags .= '<span class="w3-tag w3-small w3-theme-l1 w3-margin-right"><a href="tag.php?tag='.$row["tagText"].'">'.$row["tagText"].'</a></span>';
            }
            return $tags;
        } else {
            return false;
        }

        mysqli_free_result($result);
        close($connection);
    }

    //gets the top tags
    function getTopTags() {
        $connection = connect();

        $postID = mysqli_real_escape_string($connection, $postID);

        $query = "SELECT `tagText` ";
        $query .= "FROM `tags` ";
        $query .= "GROUP BY `tagText`";
        $query .= "ORDER BY COUNT(*) DESC LIMIT 10";

        $result = mysqli_query($connection, $query);
        if(!$result){
            die("Database display query failed!");
            return false;
        }
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $topTags .= '<span class="w3-tag w3-small w3-theme-l2" style="margin-right:5px;"><a href="tag.php?tag='.$row["tagText"].'">'.$row["tagText"].'</a></span>';
            }
            return $topTags;
        } else {
            return false;
        }

        mysqli_free_result($result);
        close($connection);
    }

    // displays posts with a certain tag
    function displaySpecificTagPosts($tag){
        $connection = connect();
        $query = "SELECT * FROM `posts` AS p JOIN `tags` AS t ON p.postID = t.postID WHERE t.tagText = 'b' GROUP BY p.postID ORDER BY `postTime` DESC";

        $result = mysqli_query($connection, $query);
        if(!$result){
            die("Database display query failed!");
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
?>