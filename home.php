<?php
    require_once 'Login/Controller/userClass.php';
    require_once 'Post/Controller/postClass.php';
    session_start();
    $NSID = $_SESSION["userNSID"];
    if(getUserActiveStatus($NSID)==1){
        $FirstName = getFirstName($NSID);
        $LastName = getLastName($NSID);
        $ImagePath = getImagePath($NSID);
        $College = getCollege($NSID);
        $Followers = getFollowers($NSID);
        $Following = getFollowing($NSID);
        $Points = getPoints($NSID);
    } else {
        header('Location: login.php');
        exit;
    }
?>
<!DOCTYPE html>
<html>
<title>Fraties</title>
<head>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js" type="text/javascript"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--<link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">-->
    <link rel="stylesheet" href="CSS/homeTheme.css">
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
    <style>
    html,body,h1,h2,h3,h4,h5 {font-family: "Open Sans", sans-serif}
    </style>
</head>
<body class="w3-theme-l5">

<!-- Navbar -->
<div class="w3-top">
 <ul class="w3-navbar w3-theme-d5 w3-left-align w3-large">
  <li class="w3-hide-medium w3-hide-large w3-opennav w3-right">
    <a class="w3-padding-large w3-hover-white w3-large w3-theme-d2" href="javascript:void(0);" onclick="openNav()"><img src='<?php echo $ImagePath; ?>' class="w3-circle" style="height:25px;width:25px" alt="Avatar"></i></a>
  </li>
     <!-- Feed page/News  -->
  <li><a href="#" class="w3-padding-large w3-theme-d4"><i class="fa fa-home w3-margin-right"></i>Fraties</a></li>
  <li class="w3-hide-small"><a href="#" class="w3-padding-large w3-hover-white" title="News"><i class="fa fa-globe"></i></a></li>
     <!-- Account settings/Profile  -->
  <li class="w3-hide-small"><a href="#" class="w3-padding-large w3-hover-white" title="Account Settings"><i class="fa fa-user"></i></a></li>
     <!-- Message icon -->
  <li class="w3-hide-small"><a href="#" class="w3-padding-large w3-hover-white" title="Messages"><i class="fa fa-envelope"></i></a></li>
     <!-- Notification area -->
  <li class="w3-hide-small w3-dropdown-hover">
    <a href="#" class="w3-padding-large w3-hover-white" title="Notifications"><i class="fa fa-bell"></i><span class="w3-badge w3-right w3-small w3-green">3</span></a>
    <div class="w3-dropdown-content w3-white w3-card-4">
      <a href="#">One new friend request</a>
      <a href="#">John Doe posted on your wall</a>
      <a href="#">Jane likes your post</a>
    </div>
  </li>
     <!-- Profile picture on top right -->
  <li class="w3-dropdown-hover w3-hide-small w3-right">
      <div class="w3-padding-large w3-hover-white" title="My Account">
          <img src='<?php echo $ImagePath; ?>' class="w3-circle" style="height:25px;width:25px" alt="Avatar">
      </div>
        <div class="w3-padding-0 w3-dropdown-content w3-white w3-card-4">
          <a href="#" style="font-size: 70%;">Profile</a>
          <a href="#" style="font-size: 70%;">Settings</a>
          <a id="logout" href="Login/Controller/logout.php" style="font-size: 70%;">Logout</a>
<!--
            <script>
                document.getElementById("logout").onclick = function () {
                    location.href = "Controller/logout.php";
                };    
            </script>
-->
        </div>
  </li>
 </ul>
</div>

<!-- Navbar on small screens -->
<div id="navDemo" class="w3-hide w3-hide-large w3-hide-medium w3-top" style="margin-top:51px">
  <ul class="w3-navbar w3-left-align w3-large w3-theme">
    <li><a href="#" style="font-size: 70%;">Profile</a></li>
    <li><a href="#" style="font-size: 70%;">Settings</a></li>
    <li><a id="logout" href="Login/Controller/logout.php" style="font-size: 70%;">Logout</a></li>
  </ul>
</div>

<!-- Page Container -->
<div class="w3-container w3-content" style="max-width:1400px;margin-top:80px">
  <!-- The Grid -->
  <div class="w3-row">
   
    <!-- Profile data + Tags: Left Column -->
    <div class="w3-col m3">
      <!-- Profile -->
      <div class="w3-card-2 w3-round w3-white">
<!--       Name, college, nsid, image-->
        <div class="w3-container">

         <h4 class="w3-center"><?php echo $FirstName." ".$LastName; ?></h4>
         <p class="w3-center w3-text-grey w3-slim">@<?php echo $NSID; ?></p>
         <h5 class="w3-center"><?php echo $College; ?></h5>
         <p class="w3-center"><img src='<?php echo $ImagePath; ?>' class="w3-circle" style="height:130px;width:130px" alt="Avatar"></p>
        </div>
      </div>

      <!-- Followers/Points/Following -->
      <div class="w3-card-2 w3-round">
        <div class="w3-accordion w3-white">
          <button onclick="myFunction('Demo1')" class="w3-btn-block w3-theme-d4 w3-left-align"><i class="fa fa-circle-o-notch fa-fw w3-margin-right"></i> Points</button>
          <div id="Demo1" class="w3-accordion-content w3-container">
            <p><?php echo $Points; ?></p>
          </div>
          <button onclick="myFunction('Demo2')" class="w3-btn-block w3-theme-d4 w3-left-align"><i class="fa fa-user fa-fw w3-margin-right"></i> Followers</button>
          <div id="Demo2" class="w3-accordion-content w3-container">
            <p><?php echo $Followers; ?></p>
          </div>
          <button onclick="myFunction('Demo3')" class="w3-btn-block w3-theme-d4 w3-left-align"><i class="fa fa-users fa-fw w3-margin-right"></i> Following</button>
          <div id="Demo3" class="w3-accordion-content w3-container">
            <p><?php echo $Following; ?></p>
          </div>
        </div>
      </div>
      <br>
      
      <!-- Top tags -->
      <div class="w3-card-2 w3-round w3-white w3-hide-small">
        <div class="w3-container">
          <p>Top Tags</p>
          <p>
            <span class="w3-tag w3-small w3-theme-d5">News</span>
            <span class="w3-tag w3-small w3-theme-d4">W3Schools</span>
            <span class="w3-tag w3-small w3-theme-d3">Labels</span>
            <span class="w3-tag w3-small w3-theme-d2">Games</span>
            <span class="w3-tag w3-small w3-theme-d1">Friends</span>
            <span class="w3-tag w3-small w3-theme">Games</span>
            <span class="w3-tag w3-small w3-theme-l1">Friends</span>
            <span class="w3-tag w3-small w3-theme-l2">Food</span>
            <span class="w3-tag w3-small w3-theme-l3">Design</span>
            <span class="w3-tag w3-small w3-theme-l4">Art</span>
          </p>
        </div>
      </div>
      <br>
    <!-- End Left Column -->
    </div>  
    
    <!-- Feed + Post: Middle Column -->
    <div class="w3-col m7">
    
        <!-- create a post-->
      <div class="w3-row-padding">
        <div class="w3-col m12">
          <div class="w3-card-2 w3-round w3-white">
            <div class="w3-container w3-padding">
                <form class="w3-container" autocomplete="off" method="post">
                    <?php 
                            // post the post
                            if(isset($_POST['post'])){
                                $post =$_POST['post'];
                                createPost($NSID, $post);
                                echo "<script type='text/javascript'>window.location.href ='home.php';</script>";
                                exit;
                            }
                    ?>
                    <label class="w3-opacity">Say something I'm giving up on you!</label>
                    <input placeholder="type here..." class="w3-input" name="post" type="text" required>
                    <button type="submit" class="w3-btn w3-theme-d5"><i class="fa fa-pencil"></i> Post</button>
                </form>
            </div>
          </div>
        </div>
      </div>
      
<!-- display the feed-->
<?php
$result = displayPosts();
while($row = mysqli_fetch_assoc($result)) {
    $postID = $row["postID"];
    $postNsid = $row["userNSID"];
    $postText = $row["postText"];
    $postUpVotes = " ".$row["postUpVotes"];
    $postDownVotes = " ".$row["postDownVotes"];
    $postCommentCount = " ".$row["postComments"];
    $nowtime = date(time());
    $postTime = strtotime($row["postTime"]);
    
        echo "<div class='w3-container w3-card-2 w3-white w3-round w3-margin'><br>";
        echo "<img src='".getImagePath($postNsid)."' alt='Avatar' class='w3-left w3-circle w3-margin-right' style='width:60px'>";
        echo "<span class='w3-right w3-opacity'>".secondsToString($nowtime-$postTime)."</span>";
        echo "<h4>";
            echo getFirstName($postNsid)." ".getLastName($postNsid);
        echo "</h4><br>";
        echo "<hr class='w3-clear'>";
        echo "<p>";
            echo $postText;
        echo "</p>";
            echo "<button type='submit' onclick='upVote(this)' value='".$postID."' class='upvote w3-btn w3-theme-d5 w3-margin-bottom'><i class='fa fa-thumbs-up'></i><span id='up".$postID."'>".$postUpVotes."</span></button> ";
    
            echo "<button type='submit' onclick='downVote(this)' value='".$postID."' class='downvote w3-btn w3-theme-d5 w3-margin-bottom'><i class='fa fa-thumbs-down'></i><span id='down".$postID."'>".$postDownVotes."</span></button> ";
//        echo "<button type='button' class='w3-btn w3-theme-d5 w3-margin-bottom'><i class='fa fa-comment'></i>".$postCommentCount."</button>";
        echo "</div>";
}
?>    
    <!-- End Middle Column -->
    </div>
    
    <!-- Leaderboards : Rigth Column -->
    <div class="w3-col m2">
      <div class="w3-card-2 w3-round w3-white w3-center">
        <div class="w3-container">
          <h2>Top Fraties</h2>
          <p>List of fraties with the highest points:</p>

          <ul class="w3-ul">
            <li class="w3-padding-16">
              <img src="Images/curls.jpg" class="w3-left w3-circle w3-margin-right" style="width:60px">
              <span class="w3-xlarge">John</span><br>
              <span>451 points</span>
            </li>
            <li class="w3-padding-16">
              <img src="Images/14115073_10157326867470463_6479636924758928947_o.jpg" class="w3-left w3-circle w3-margin-right" style="width:60px">
              <span class="w3-xlarge">Jane</span><br>
              <span>378 points</span>
            </li>
            <li class="w3-padding-16">
              <img src='<?php echo $ImagePath; ?>' class="w3-left w3-circle w3-margin-right" style="width:60px">
              <span class="w3-xlarge">Vito</span><br>
              <span>240 points</span>
            </li>
          </ul>
        </div>
      </div>
      <br>
      
    <!-- End Right Column -->
    </div>
    
  <!-- End Grid -->
  </div>
  
<!-- End Page Container -->
</div>
<br>

<!-- Footer -->
<footer class="w3-container">
  <p>&copy; Fraties <?php echo date("Y");?>.</p>
</footer>
 
<script>
// logout function
    document.getElementById("logout").onclick = function () {
        location.href = "Controller/logout.php";
    };    
// update upvotes of the post in db and on page without reloading
function upVote(ele) {
    var id = parseInt (ele.value);
//        document.getElementById("demo").innerHTML = value;
    $.ajax({
         url:"Post/Controller/postUpvote.php",
         method:"POST",
         data:{id:id},
         success: function(data){
         
            var str2 = id;
            var str1 = "up";
            var res = str1.concat(str2);
            document.getElementById(res).innerHTML = " "+data;
         }
    });
}
// update downvotes of the post in db and on page without reloading
function downVote(ele) {
    var id = parseInt (ele.value);
//        document.getElementById("demo").innerHTML = value;
    $.ajax({
         url:"Post/Controller/postDownvote.php",
         method:"POST",
         data:{id:id},
         success: function(data){
         
            var str2 = id;
            var str1 = "down";
            var res = str1.concat(str2);
            document.getElementById(res).innerHTML = " "+data;
         }
    });
}
// Accordion
function myFunction(id) {
    var x = document.getElementById(id);
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
        x.previousElementSibling.className += " w3-theme-d1";
    } else {
        x.className = x.className.replace("w3-show", "");
        x.previousElementSibling.className =
        x.previousElementSibling.className.replace(" w3-theme-d1", "");
    }
}
// Used to toggle the menu on smaller screens when clicking on the menu button
function openNav() {
    var x = document.getElementById("navDemo");
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
    } else {
        x.className = x.className.replace(" w3-show", "");
    }
}
</script>

</body>
</html>
