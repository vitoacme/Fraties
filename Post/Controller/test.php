<pre>
<?php
    require_once 'postClass.php';


    $nsid = "vit655";
    $post = "this is a test";
//    print_r(createPost($nsid, $post));
    $result = displayPosts();
//    print_r(mysqli_fetch_all($result,MYSQLI_ASSOC));
            while($row = mysqli_fetch_assoc($result)) {
//                echo $row["userNSID"];
                print_r($row);
                echo "<hr />";
            }
?>
</pre>