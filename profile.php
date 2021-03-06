<?php
    require_once 'Login/Controller/userClass.php';
    require_once 'Post/Controller/postClass.php';
    require_once 'Post/Controller/postTag.php';
    session_start();
    if (isset($_GET['nsid'])) {
      $NSID = $_GET['nsid'];
    } else {
      $NSID = $_SESSION["userNSID"];
    }
    
    if(getUserActiveStatus($NSID)==1){
        $FirstName = getFirstName($NSID);
        $LastName = getLastName($NSID);
        $ImagePath = getImagePath($NSID);
        $userImagePath = getImagePath($_SESSION["userNSID"]);
        $College = getCollege($NSID);
        $_SESSION["userCollege"] = $College;
        $upvotes = getUserUpvotes($NSID);
        $downvotes = getUserDownvotes($NSID);
        $Points = getPoints($NSID);
        $Followers = getUserFollowers($NSID);
        $Following = getUserFollowing($NSID);
    } else {
        header('Location: index.php');
        exit;
    }
?>
<!DOCTYPE html>
<html>
<title>Fraties</title>
<head>
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
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
    <a class="w3-padding-large w3-hover-white w3-large w3-theme-d2" href="javascript:void(0);" onclick="openNav()"><img src='<?php echo getImagePath($_SESSION["userNSID"]); ?>' class="w3-circle" style="height:25px;width:25px" alt="Avatar"></i></a>
  </li>
     <!-- Feed page  -->
  
  <li><a href="home.php" title="Go home!" class="w3-padding-large w3-theme-d4"><i class="fa fa-home w3-margin-right"></i>Fraties</a></li>
  
<!--Arts & Science-->
  <li class="w3-hide-small"><a href="Arts&Science.php" class="w3-padding-large w3-hover-white" title="Arts & Science"><i class="fa fa-paint-brush"></i><i class="fa fa-flask"></i></a></li>
<!--Agriculture and Bioresources-->
  <li class="w3-hide-small"><a href="Agriculture.php" class="w3-padding-large w3-hover-white" title="Agriculture and Bioresources"><i class="glyphicon glyphicon-grain"></i></a></li>
<!--Edwards School of Business-->
<li class="w3-hide-small"><a href="ESB.php" class="w3-padding-large w3-hover-white" title="Edwards School of Business"><i class="fa fa-usd"></i></a></li>
<!--Education-->
<li class="w3-hide-small"><a href="Education.php" class="w3-padding-large w3-hover-white" title="Education"><i class="fa fa-graduation-cap"></i></a></li>
<!--Engineering-->
<li class="w3-hide-small"><a href="Engineering.php" class="w3-padding-large w3-hover-white" title="Engineering"><i class="fa fa-cogs"></i></a></li>
<!--Kinesiology-->
<li class="w3-hide-small"><a href="Kinesiology.php" class="w3-padding-large w3-hover-white" title="Kinesiology"><i class="fa fa-heartbeat"></i></a></li>
<!--St. Thomas More-->
<li class="w3-hide-small"><a href="STM.php" class="w3-padding-large w3-hover-white" title="St. Thomas More"><i class="fa fa-university"></i></a></li>
<!--Followed users-->
<li class="w3-hide-small"><a href="following.php" class="w3-padding-large w3-hover-white" title="Users you follow"><i class="fa fa-users"></i></a></li>
    
     <!-- Profile picture on top right -->
  <li class="w3-dropdown-hover w3-hide-small w3-right">
      <div class="w3-padding-large w3-hover-white" title="My Account">
          <img src='<?php echo getImagePath($_SESSION["userNSID"]); ?>' class="w3-circle" style="height:25px;width:25px" alt="Avatar">
      </div>
        <div class="w3-padding-0 w3-dropdown-content w3-white w3-card-4">
          <a href="profile.php" style="font-size: 70%;">Profile</a>
          <a href="settings.php" style="font-size: 70%;">Settings</a>
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
  <ul class="w3-navbar w3-center-align w3-large w3-theme">
<!--   profile-->
    <li>
        <a href="profile.php" class="w3-btn-block w3-theme-d4" title="Go to your profile"><i class="fa fa-user fa-fw w3-margin-right"></i> Profile</a>
    </li>
    <hr style="margin-top: 0px;
    margin-bottom: 0px;
    width: 1px;
    border-top-width: 0px;
    height: 1px;">
<!--    sort by college-->
    <li>
        <div class="w3-accordion w3-white">
          <button title="sort feeds by college" onclick="myFunction('Demo4')" class="w3-btn-block w3-theme-d4"><i class="fa fa-filter fa-fw w3-margin-right"></i> Sort</button>
          <div id="Demo4" class="w3-accordion-content w3-container">
            <a href="Arts&Science.php" class="w3-padding-large w3-hover-white" title="Arts & Science"><i class="fa fa-paint-brush"></i><i class="fa fa-flask"></i> Arts & Science</a>
            <a href="Agriculture.php" class="w3-padding-large w3-hover-white" title="Agriculture and Bioresources"><i class="glyphicon glyphicon-grain"></i> Agriculture and Bioresources</a>
            <a href="ESB.php" class="w3-padding-large w3-hover-white" title="Edwards School of Business"><i class="fa fa-usd"></i> Edwards School of Business</a>
            <a href="Education.php" class="w3-padding-large w3-hover-white" title="Education"><i class="fa fa-graduation-cap"></i> Education</a>
            <a href="Engineering.php" class="w3-padding-large w3-hover-white" title="Engineering"><i class="fa fa-cogs"></i> Engineering</a>
            <a href="Kinesiology.php" class="w3-padding-large w3-hover-white" title="Kinesiology"><i class="fa fa-heartbeat"></i> Kinesiology</a>
            <a href="STM.php" class="w3-padding-large w3-hover-white" title="St. Thomas More"><i class="fa fa-university"></i> St. Thomas More</a>
            <a href="following.php" class="w3-padding-large w3-hover-white" title="Users you follow"><i class="fa fa-user-plus"></i> Users you follow</a>
          </div>
        </div>
    </li>
    <hr style="margin-top: 0px;
    margin-bottom: 0px;
    width: 1px;
    border-top-width: 0px;
    height: 1px;">
<!--    settings-->
    <li>
        <a href="settings.php" title="change account info" class="w3-btn-block w3-theme-d4"><i class="fa fa-cog fa-fw w3-margin-right"></i> Settings</a>
    </li>
    <hr style="margin-top: 0px;
    margin-bottom: 0px;
    width: 1px;
    border-top-width: 0px;
    height: 1px;">
<!--    logout-->
    <li>
        <a id="logout" href="Login/Controller/logout.php" title="logout" class="w3-btn-block w3-theme-d4"><i class="fa fa-sign-out fa-fw w3-margin-right"></i> Logout</a>
    
    </li>
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
         <?php
          if ($NSID !== $_SESSION["userNSID"]) {
            if (!isUserFollowing($_SESSION["userNSID"], $NSID)) {
              echo "<button id='followButton' value='Follow' type='submit' onclick=\"follow(this, '".$NSID."')\" class='w3-btn w3-theme-d5 w3-margin-bottom' style='width:100%;'><i class='fa fa-user-plus'></i> Follow</button>";
            } else {
              echo "<button id='followButton' value='Unfollow' type='submit' onclick=\"follow(this, '".$NSID."')\" class='w3-btn w3-theme-d5 w3-margin-bottom' style='width:100%;'><i class='fa fa-user-times'></i> Unfollow</button>";
            }
            
          } 
         ?>
        </div>
      </div>

      <!-- Followers/Points/Following -->
      <div class="w3-card-2 w3-round">
        <div class="w3-accordion w3-white">
          <button title="Your total points" onclick="myFunction('Demo1')" class="w3-btn-block w3-theme-d4 w3-left-align"><i class="fa fa-circle-o-notch fa-fw w3-margin-right"></i> Points</button>
          <div id="Demo1" class="w3-accordion-content w3-container">
            <p><?php echo $Points; ?></p>
          </div>
          <button title="Upvotes recieved" onclick="myFunction('Demo2')" class="w3-btn-block w3-theme-d4 w3-left-align"><i class="fa fa-arrow-circle-up  fa-fw w3-margin-right"></i> Upvotes</button>
          <div id="Demo2" class="w3-accordion-content w3-container">
            <p><?php echo $upvotes; ?></p>
          </div>
          <button title="Downvotes recieved" onclick="myFunction('Demo3')" class="w3-btn-block w3-theme-d4 w3-left-align"><i class="fa fa-arrow-circle-down  fa-fw w3-margin-right"></i> Downvotes</button>
          <div id="Demo3" class="w3-accordion-content w3-container">
            <p><?php echo $downvotes; ?></p>
          </div>
           <button title="Following recieved" onclick="myFunction('Demo5')" class="w3-btn-block w3-theme-d4 w3-left-align"><i class="fa fa-arrow-circle-right fa-fw w3-margin-right"></i> Following</button>
           <?php 
              if (!isset($_GET['nsid']) || $NSID == $_SESSION["userNSID"]) {
                $link = "<a href='grid.php?type=following'><p>".$Following."</p></a>";
              } else {
                $link = "<p>".$Following."</p>";
              }
           ?>
          <div id="Demo5" class="w3-accordion-content w3-container">
            <?php echo $link; ?>
          </div>
          <?php 
              if (!isset($_GET['nsid']) || $NSID == $_SESSION["userNSID"]) {
                $link2 = "<a href='grid.php?type=followers'><p>".$Followers."</p></a>";
              } else {
                $link2 = "<p>".$Followers."</p>";
              }
           ?>
          <button title="Followers recieved" onclick="myFunction('Demo6')" class="w3-btn-block w3-theme-d4 w3-left-align"><i class="fa fa-arrow-circle-left fa-fw w3-margin-right"></i> Followers</button>
          <div id="Demo6" class="w3-accordion-content w3-container">
            <?php echo $link2; ?>
          </div>
        </div>
      </div>
      <br>
      
      <!-- Top tags -->
      <div class="w3-card-2 w3-round w3-white w3-hide-small">
        <div class="w3-container">
          <p>Top Tags</p>
          <p>
            <?php echo getTopTags(); ?>
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
            <div class="w3-container w3-center w3-padding"><br>
            <?php
              if (isset($_GET['nsid'])) {
                $title = $FirstName.'\'s';
              } else {
                $title = 'your';
              }
            ?>
            <label class="w3-opacity" style="font-size: 2em;">Welcome to <?php echo $title; ?> profile!</label>
            </div>
          </div>
        </div>
      </div>
      
<!-- display the feed-->
<?php
$result = displayPostsOfID($NSID);
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
        echo "<img src='".getImagePath($postNsid)."' alt='Avatar' class='w3-left w3-circle w3-margin-right' style='width:60px; height:60px;'>";
        echo "<span class='w3-right w3-opacity'>".secondsToString($nowtime-$postTime)."</span>";
        echo "<h4>";
            echo "<a href=profile.php?nsid=".$postNsid.">".getFirstName($postNsid)." ".getLastName($postNsid)."</a>".getUserTag($postID);
        echo "</h4><br>";
        echo "<p>";
          echo getTags($postID);
        echo "</p>";
        echo "<hr class='w3-clear'>";
        echo "<p>";
            echo $postText;
        echo "</p>";
            echo "<button type='submit' onclick='upVote(this)' value='".$postID."' class='upvote w3-btn w3-theme-d5 w3-margin-bottom'><i class='fa fa-thumbs-up'></i><span id='up".$postID."'>".$postUpVotes."</span></button> ";
    
            echo "<button type='submit' onclick='downVote(this)' value='".$postID."' class='downvote w3-btn w3-theme-d5 w3-margin-bottom'><i class='fa fa-thumbs-down'></i><span id='down".$postID."'>".$postDownVotes."</span></button> ";
            echo "<hr class='w3-clear'>";
            echo "<div class='w3-margin-right'><input id='comment".$postID."' placeholder='comment...' class='w3-input' name='comment' type='text' required></div>";
            echo "<button type='submit' onclick='comment(this)' value='".$postID."' class='w3-btn w3-theme-d5 w3-margin-bottom'><i class='fa fa-pencil'></i> Post</button>";
              echo "<button id='count".$postID."' onclick='commentList(this)' value='".$postID."' class='w3-btn w3-theme-d5 w3-margin-bottom w3-margin-left'".(($postCommentCount==0)?'style="display:none;"':'')."'>See all ".$postCommentCount." comments</button>";
            echo "<ul id='list".$postID."' class='w3-ul w3-margin-bottom'></ul>";
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
<?php
$leaders = displayUserDB();
while($row = mysqli_fetch_assoc($leaders)) {
    $imagePath = $row["userImagePath"];
    $points = $row["userPoints"];
    $name = $row["userFirstName"];
    $nsid = $row["userNSID"];
    if(getUserActiveStatus($nsid)){
        echo "<li class='w3-padding-16'>";
          echo "<img src='{$imagePath}' class='w3-left w3-circle w3-margin-right' style='width:60px; height:60px;'>";
          echo "<span class='w3-xlarge'><a href='home.php?nsid={$nsid}'>{$name}</a></span><br>";
          echo "<span>{$points} points</span>";
        echo "</li>";
    }
}
?>
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
// update comments of the post in db and on page without reloading
function comment(ele) {
    var id = parseInt (ele.value);
    if (document.getElementById('comment'+id+'').value !== '') {
      var comment = document.getElementById('comment'+id+'').value
    }
    
    $.ajax({
         url:"Post/Controller/postComment.php",
         method:"POST",
         data:{id:id, comment:comment},
         success: function(data){
            document.getElementById('comment'+id+'').value = '';
            if (document.getElementById('list'+id+'').innerHTML == '') {
               document.getElementById('count'+id+'').innerHTML = "See all "+data+" comments";
            } else {
              document.getElementById('count'+id+'').innerHTML = "Hide all comments";
            }
            document.getElementById('count'+id+'').style.display = "inline-block";
            commentList(ele, 'new');
         }
    });
}
// load comment list
function commentList(ele, source) {
  var commentID = parseInt (ele.value);
  if (document.getElementById('list'+commentID+'').innerHTML == '' ||  source == 'new') {
     $.ajax({
           url:"Post/Controller/postComment.php",
           method:"POST",
           data:{commentID:commentID},
           success: function(data){
              document.getElementById('list'+commentID+'').innerHTML = data;
              document.getElementById('count'+commentID+'').innerHTML = "Hide all comments";
           }
      });
  } else {
    $.ajax({
           url:"Post/Controller/postComment.php",
           method:"POST",
           data:{countID:commentID},
           success: function(data){
              document.getElementById('list'+commentID+'').innerHTML = '';
              document.getElementById('count'+commentID+'').innerHTML = "See all "+data+" comments";
           }
      });
  }
}
//Follow user
function follow(ele, following) {
    var buttonType = ele.value;
    $.ajax({
         url:"Post/Controller/postFollow.php",
         method:"POST",
         data:{buttonType: buttonType, following:following},
         success: function(data){
            if (buttonType == 'Follow') {
              document.getElementById('followButton').innerHTML ='<i class="fa fa-user-times"></i> Unfollow';
               document.getElementById('followButton').value = 'Unfollow';
            } else {
              document.getElementById('followButton').innerHTML ='<i class="fa fa-user-plus"></i> Follow';
              document.getElementById('followButton').value = 'Follow';
            }
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