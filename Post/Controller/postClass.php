<?php
    // contains connect() and close() func for conenctions
    require_once 'Database/connectDB.php';
//require_once '../../Database/connectDB.php';

    function createPost($nsid, $post, $College){
        // connect to database
        $connection = connect();
        
        $nsid = mysqli_real_escape_string($connection, $nsid);
        $College = mysqli_real_escape_string($connection, $College);
        $post = mysqli_real_escape_string($connection, $post);
        
        $query = "INSERT INTO `posts`";
        $query .="(`postID`, `userNSID`, `postText`, `userCollege`, `postUpVotes`, `postDownVotes`, `postComments`, `postTime`) ";
        $query .= "VALUES ";
        $query .= "(NULL, '{$nsid}', '{$post}', '{$College}', '0', '0', '0', CURRENT_TIMESTAMP)";
        
        $result = mysqli_query($connection, $query);

        $postID = mysqli_insert_id($connection);
        
        // test for errors
        if(mysqli_affected_rows($connection) == 0){
            echo "No post added to db!";
            return false;
        }
        else if($result){
            return $postID;
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
        $query = "SELECT * FROM `posts`";
        $query .= "ORDER BY `postTime` DESC";
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
// displays posts of user with id
    function displayPostsOfID($nsid){
        $connection = connect();
        $query = "SELECT * FROM `posts`";
        $query .= "WHERE `userNSID` = '$nsid' ";
        $query .= "ORDER BY `postTime` DESC";
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
// displays posts of arts
    function displayPostsOf($college){
        $connection = connect();
        $query = "SELECT * FROM `posts`";
        $query .= "WHERE `userCollege` = '{$college}' ";
        $query .= "ORDER BY `postTime` DESC";
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

// displays posts of Agriculture
    function displayPostsOfAgri(){
        $connection = connect();
        $query = "SELECT * FROM `posts`";
        $query .= "WHERE `userCollege` = 'Agriculture and Bioresources' ";
        $query .= "ORDER BY `postTime` DESC";
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
// displays posts of ESB
    function displayPostsOfESB(){
        $connection = connect();
        $query = "SELECT * FROM `posts`";
        $query .= "WHERE `userCollege` = 'Edwards School of Business' ";
        $query .= "ORDER BY `postTime` DESC";
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
// displays posts of Education
    function displayPostsOfEdu(){
        $connection = connect();
        $query = "SELECT * FROM `posts`";
        $query .= "WHERE `userCollege` = 'Education' ";
        $query .= "ORDER BY `postTime` DESC";
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
// displays posts of Engineering
    function displayPostsOfEng(){
        $connection = connect();
        $query = "SELECT * FROM `posts`";
        $query .= "WHERE `userCollege` = 'Engineering' ";
        $query .= "ORDER BY `postTime` DESC";
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
// displays posts of Kinesiology
    function displayPostsOfKin(){
        $connection = connect();
        $query = "SELECT * FROM `posts`";
        $query .= "WHERE `userCollege` = 'Kinesiology' ";
        $query .= "ORDER BY `postTime` DESC";
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
// displays posts of St. Thomas More
    function displayPostsOfSTM(){
        $connection = connect();
        $query = "SELECT * FROM `posts`";
        $query .= "WHERE `userCollege` = 'St. Thomas More' ";
        $query .= "ORDER BY `postTime` DESC";
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

// displays posts of St. Thomas More
    function displayPostsOfFollowing($nsid){
        $connection = connect();
        $query = "SELECT p.userNSID, p.userCollege, p.postText, p.postUpVotes, p.postDownVotes, p.postComments, p.postTime FROM `posts` AS p JOIN `followers` AS f ON p.userNSID = f.followingNSID WHERE f.userNSID = '$nsid' ORDER BY `postTime` DESC";

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

// displays users that the user with nsid is following
    function displayFollowing($nsid){
        $connection = connect();

        $query = "SELECT u.userNSID, u.userFirstName, u.userLastName, u.userCollege, u.userImagePath, u.userPoints FROM `users` AS u JOIN `followers` AS f ON u.userNSID = f.followingNSID WHERE f.userNSID = '$nsid'";

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

// displays users that the user with nsid is following
    function displayFollowers($nsid){
        $connection = connect();

        $query = "SELECT u.userNSID, u.userFirstName, u.userLastName, u.userCollege, u.userImagePath, u.userPoints FROM `users` AS u JOIN `followers` AS f ON u.userNSID = f.userNSID WHERE f.followingNSID = '$nsid'";

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

// takes difference in seconds and returns time in words
    function secondsToString($secs){
    $bit = array(
        'y' => $secs / 31556926 % 12,
        'w' => $secs / 604800 % 52,
        'd' => $secs / 86400 % 7,
        'h' => $secs / 3600 % 24,
        'm' => $secs / 60 % 60,
        's' => $secs % 60
        );
        
    foreach($bit as $k => $v)
        if($v > 0)$ret[] = $v . $k;
        
    return join('', $ret);
}
?>