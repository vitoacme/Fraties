<?php
    require_once 'Login/Controller/userClass.php';
    require_once 'Post/Controller/postClass.php';
    require_once 'Post/Controller/postTag.php';
    session_start();

    $NSID = $_SESSION["userNSID"];

    if (isset($_GET['nsid'])) {
    $NSID = $_GET['nsid'];
      $postsToDisplay = displayPostsOfID($_GET['nsid']);
    } else if (isset($_GET['following'])) {
        $postsToDisplay = displayPostsOfFollowing($NSID);
    } else if (isset($_GET['college'])) {
      $college = $_GET['college'];
        if($college == "Arts And Science"){
            $college = "Arts & Science";
        }
       $postsToDisplay = displayPostsOf($college);
    } else {
      $postsToDisplay = displayPosts();
    }


if(getUserActiveStatus($NSID)==1){
        $FirstName = getFirstName($NSID);
        $LastName = getLastName($NSID);
        $ImagePath = getImagePath($NSID);
        $userCollege = getCollege($NSID);
        $_SESSION["userCollege"] = $userCollege;
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
  <li><a href="home.php" title="Go home!" class="w3-padding-large w3-theme-d4"><i class="fa fa-home w3-margin-right"></i> Fraties</a></li>
  
<!--Arts & Science-->
  <li class="w3-hide-small"><a href="home.php?college=Arts And Science" class="w3-padding-large w3-hover-white" title="Arts & Science"><i class="fa fa-paint-brush"></i><i class="fa fa-flask"></i></a></li>
<!--Agriculture and Bioresources-->
  <li class="w3-hide-small"><a href="home.php?college=Agriculture and Bioresources" class="w3-padding-large w3-hover-white" title="Agriculture and Bioresources"><i class="glyphicon glyphicon-grain"></i></a></li>
<!--Edwards School of Business-->
<li class="w3-hide-small"><a href="home.php?college=Edwards%20School%20of%20Business" class="w3-padding-large w3-hover-white" title="Edwards School of Business"><i class="fa fa-usd"></i></a></li>
<!--Education-->
<li class="w3-hide-small"><a href="home.php?college=Education" class="w3-padding-large w3-hover-white" title="Education"><i class="fa fa-graduation-cap"></i></a></li>
<!--Engineering-->
<li class="w3-hide-small"><a href="home.php?college=Engineering" class="w3-padding-large w3-hover-white" title="Engineering"><i class="fa fa-cogs"></i></a></li>
<!--Kinesiology-->
<li class="w3-hide-small"><a href="home.php?college=Kinesiology" class="w3-padding-large w3-hover-white" title="Kinesiology"><i class="fa fa-heartbeat"></i></a></li>
<!--St. Thomas More-->
<li class="w3-hide-small"><a href="home.php?college=St. Thomas More" class="w3-padding-large w3-hover-white" title="St. Thomas More"><i class="fa fa-university"></i></a></li>
<!--Followed users-->
<li class="w3-hide-small"><a href="home.php?following" class="w3-padding-large w3-hover-white" title="Users you follow"><i class="fa fa-users"></i></a></li>
    
     <!-- Profile picture on top right -->
  <li class="w3-dropdown-hover w3-hide-small w3-right">
      <div class="w3-padding-large w3-hover-white" title="My Account">
          <img src='<?php echo getImagePath($_SESSION["userNSID"]);; ?>' class="w3-circle" style="height:25px;width:25px" alt="Avatar">
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
            <a href="home.php?college=Arts And Science" class="w3-padding-large w3-hover-white" title="Arts & Science"><i class="fa fa-paint-brush"></i><i class="fa fa-flask"></i> Arts & Science</a>
            <a href="home.php?college=Agriculture and Bioresources" class="w3-padding-large w3-hover-white" title="Agriculture and Bioresources"><i class="glyphicon glyphicon-grain"></i> Agriculture and Bioresources</a>
            <a href="home.php?college=Edwards%20School%20of%20Business" class="w3-padding-large w3-hover-white" title="Edwards School of Business"><i class="fa fa-usd"></i> Edwards School of Business</a>
            <a href="home.php?college=Education" class="w3-padding-large w3-hover-white" title="Education"><i class="fa fa-graduation-cap"></i> Education</a>
            <a href="home.php?college=Engineering" class="w3-padding-large w3-hover-white" title="Engineering"><i class="fa fa-cogs"></i> Engineering</a>
            <a href="home.php?college=Kinesiology" class="w3-padding-large w3-hover-white" title="Kinesiology"><i class="fa fa-heartbeat"></i> Kinesiology</a>
            <a href="home.php?college=St. Thomas More" class="w3-padding-large w3-hover-white" title="St. Thomas More"><i class="fa fa-university"></i> St. Thomas More</a>
            <a href="home.php?following" class="w3-padding-large w3-hover-white" title="Users you follow"><i class="fa fa-users"></i> Following</a>
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