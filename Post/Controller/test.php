<?php
//    require_once 'postClass.php';

    $nsid = "vit655";
    $post = "this is a test";
//    echo getUpVotes(15);
//    setUpVote(15);
//    echo getUpVotes(15);


//    print_r(createPost($nsid, $post));
//    $result = displayPosts();
//$nowtime = date(time());
//echo $nowtime, "\n";
//echo date('Y-m-d H:i:s', $nowtime),"\n\n"; 
//
//echo "old time","\n";
//$oldtime = strtotime("2016-11-27 01:51:31");
//echo $oldtime, "\n";
//echo date('Y-m-d h:i:s', $oldtime),"\n"; 
//
//$localtime = localtime();
//$localtime_assoc = localtime(time(), true);
//print_r($localtime);
//print_r($localtime_assoc);
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<!--<input type='submit' value='1' id='upVote' onclick="upVote(this)" method='post'>-->
<p id="demo"></p>


<button type='submit' id='id' class='downvote' name='this is post data' value='24' onclick='upVote(this)'><i class='fa fa-thumbs-down'></i>".$postDownVotes."</button>

<!--
<script>
$(document).ready(function(){
    $('#id').click(function(){
        var method = $(this).;
        document.getElementById("demo").innerHTML = method;
    });
});
</script> 
-->
<script>
    function upVote(ele) {
        var str2 = parseInt (ele.value);
        var str1 = "up";
        var res = str1.concat(str2);
//        document.getElementById(id).value = value+1;
        myFunction(res);
    }
    
    function myFunction(str) {
        document.getElementById("demo").innerHTML = str;
    }
</script>