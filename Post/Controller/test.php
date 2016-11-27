<pre>
<?php
//    require_once 'postClass.php';


    $nsid = "vit655";
    $post = "this is a test";
//    print_r(createPost($nsid, $post));
//    $result = displayPosts();
$nowtime = date(time());
echo $nowtime, "\n";
echo date('Y-m-d H:i:s', $nowtime),"\n\n"; 

echo "old time","\n";
$oldtime = strtotime("2016-11-27 01:51:31");
echo $oldtime, "\n";
echo date('Y-m-d h:i:s', $oldtime),"\n"; 

$localtime = localtime();
$localtime_assoc = localtime(time(), true);
print_r($localtime);
print_r($localtime_assoc);
?>
</pre>