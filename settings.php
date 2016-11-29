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
        $_SESSION["userCollege"] = $College;
        $upvotes = getUserUpvotes($NSID);
        $downvotes = getUserDownvotes($NSID);
        $Points = getPoints($NSID);
    } 
else {
        header('Location: login.php');
        exit;
    }
?>
<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Settings Fraties</title>
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
      <style>
      /* NOTE: The styles were added inline because Prefixfree needs access to your styles and they must be inlined if they are on local disk! */
      @import xurl(http://fonts.googleapis.com/css?family=Open+Sans);
.btn { display: inline-block; *display: inline; *zoom: 1; padding: 4px 10px 4px; margin-bottom: 0; font-size: 13px; line-height: 18px; color: #333333; text-align: center;text-shadow: 0 1px 1px rgba(255, 255, 255, 0.75); vertical-align: middle; background-color: #f5f5f5; background-image: -moz-linear-gradient(top, #ffffff, #e6e6e6); background-image: -ms-linear-gradient(top, #ffffff, #e6e6e6); background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#ffffff), to(#e6e6e6)); background-image: -webkit-linear-gradient(top, #ffffff, #e6e6e6); background-image: -o-linear-gradient(top, #ffffff, #e6e6e6); background-image: linear-gradient(top, #ffffff, #e6e6e6); background-repeat: repeat-x; filter: progid:dximagetransform.microsoft.gradient(startColorstr=#ffffff, endColorstr=#e6e6e6, GradientType=0); border-color: #e6e6e6 #e6e6e6 #e6e6e6; border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25); border: 1px solid #e6e6e6; -webkit-border-radius: 4px; -moz-border-radius: 4px; border-radius: 4px; -webkit-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05); -moz-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05); box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05); cursor: pointer; *margin-left: .3em; }
.btn:hover, .btn:active, .btn.active, .btn.disabled, .btn[disabled] { background-color: #e6e6e6; }
.btn-large { padding: 9px 14px; font-size: 15px; line-height: normal; -webkit-border-radius: 5px; -moz-border-radius: 5px; border-radius: 5px; }
.btn:hover { color: #333333; text-decoration: none; background-color: #e6e6e6; background-position: 0 -15px; -webkit-transition: background-position 0.1s linear; -moz-transition: background-position 0.1s linear; -ms-transition: background-position 0.1s linear; -o-transition: background-position 0.1s linear; transition: background-position 0.1s linear; }
select.btn-mini {
    height: auto;
    line-height: 14px;
}
p {color: white;text-align: center;}
label {color: white;}
.btn-primary, .btn-primary:hover { text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25); color: #ffffff; }
.btn-primary.active { color: rgba(255, 255, 255, 0.75); }
.btn-primary { background-color: #4a77d4; background-image: -moz-linear-gradient(top, #6eb6de, #4a77d4); background-image: -ms-linear-gradient(top, #6eb6de, #4a77d4); background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#6eb6de), to(#4a77d4)); background-image: -webkit-linear-gradient(top, #6eb6de, #4a77d4); background-image: -o-linear-gradient(top, #6eb6de, #4a77d4); background-image: linear-gradient(top, #6eb6de, #4a77d4); background-repeat: repeat-x; filter: progid:dximagetransform.microsoft.gradient(startColorstr=#6eb6de, endColorstr=#4a77d4, GradientType=0);  border: 1px solid #3762bc; text-shadow: 1px 1px 1px rgba(0,0,0,0.4); box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.5); }
.btn-primary:hover, .btn-primary:active, .btn-primary.active, .btn-primary.disabled, .btn-primary[disabled] { filter: none; background-color: #4a77d4; }
.btn-block { width: 100%; display:block; }

* { -webkit-box-sizing:border-box; -moz-box-sizing:border-box; -ms-box-sizing:border-box; -o-box-sizing:border-box; box-sizing:border-box; }

html { width: 100%; height:100%; overflow:hidden; }

body { 
	width: 100%;
	height:100%;
	font-family: 'Open Sans', sans-serif;
	background: #092756;
	background: -moz-radial-gradient(0% 100%, ellipse cover, rgba(104,128,138,.4) 10%,rgba(138,114,76,0) 40%),-moz-linear-gradient(top,  rgba(57,173,219,.25) 0%, rgba(42,60,87,.4) 100%), -moz-linear-gradient(-45deg,  #670d10 0%, #092756 100%);
	background: -webkit-radial-gradient(0% 100%, ellipse cover, rgba(104,128,138,.4) 10%,rgba(138,114,76,0) 40%), -webkit-linear-gradient(top,  rgba(57,173,219,.25) 0%,rgba(42,60,87,.4) 100%), -webkit-linear-gradient(-45deg,  #670d10 0%,#092756 100%);
	background: -o-radial-gradient(0% 100%, ellipse cover, rgba(104,128,138,.4) 10%,rgba(138,114,76,0) 40%), -o-linear-gradient(top,  rgba(57,173,219,.25) 0%,rgba(42,60,87,.4) 100%), -o-linear-gradient(-45deg,  #670d10 0%,#092756 100%);
	background: -ms-radial-gradient(0% 100%, ellipse cover, rgba(104,128,138,.4) 10%,rgba(138,114,76,0) 40%), -ms-linear-gradient(top,  rgba(57,173,219,.25) 0%,rgba(42,60,87,.4) 100%), -ms-linear-gradient(-45deg,  #670d10 0%,#092756 100%);
	background: -webkit-radial-gradient(0% 100%, ellipse cover, rgba(104,128,138,.4) 10%,rgba(138,114,76,0) 40%), linear-gradient(to bottom,  rgba(57,173,219,.25) 0%,rgba(42,60,87,.4) 100%), linear-gradient(135deg,  #670d10 0%,#092756 100%);
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#3E1D6D', endColorstr='#092756',GradientType=1 );
}
.login { 
	position: absolute;
	top: 50%;
	left: 50%;
	margin: -150px 0 0 -150px;
	width:300px;
	height:300px;
}
.login h1 { color: #fff; text-shadow: 0 0 10px rgba(0,0,0,0.3); letter-spacing:1px; text-align:center; }

input { 
	width: 100%; 
	margin-bottom: 10px; 
	background: rgba(0,0,0,0.3);
	border: none;
	outline: none;
	padding: 10px;
	font-size: 13px;
	color: #fff;
	text-shadow: 1px 1px 1px rgba(0,0,0,0.3);
	border: 1px solid rgba(0,0,0,0.3);
	border-radius: 4px;
	box-shadow: inset 0 -5px 45px rgba(100,100,100,0.2), 0 1px 1px rgba(255,255,255,0.2);
	-webkit-transition: box-shadow .5s ease;
	-moz-transition: box-shadow .5s ease;
	-o-transition: box-shadow .5s ease;
	-ms-transition: box-shadow .5s ease;
	transition: box-shadow .5s ease;
}
input:focus { box-shadow: inset 0 -5px 45px rgba(100,100,100,0.4), 0 1px 1px rgba(255,255,255,0.2); }

    </style>

   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
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
    
     <!-- Profile picture on top right -->
  <li class="w3-dropdown-hover w3-hide-small w3-right">
      <div class="w3-padding-large w3-hover-white" title="My Account">
          <img src='<?php echo $ImagePath; ?>' class="w3-circle" style="height:25px;width:25px" alt="Avatar">
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
<?php
    if(isset($_POST['submitUserInfo'])){
//        print_r($_POST);
        $FirstName = $_POST['FirstName'];
        $LastName = $_POST['LastName'];
        $college = $_POST['college'];
        setNameCollege($NSID,$FirstName,$LastName,$college);
        $imageName = basename($_FILES["fileToUpload"]["name"]);
        if($imageName != ""){
            include 'Login/imageUpdate.php';
        }
        echo "<script type='text/javascript'>window.location.href ='settings.php';</script>";
    }
?>
<body>
  <div class="login">
	<h1>Want to update your info?</h1>
    <p>Just edit the info below and press update</p>
    <form method="post" style="text-align:center;" enctype="multipart/form-data">
    	<input type="text" name="FirstName" placeholder="First Name" value="<?php echo $FirstName; ?>" required="required" />
    	<input type="text" name="LastName" placeholder="Last Name" value="<?php echo $LastName; ?>"  required="required" />
        <p>Choose a profile picture:</p>
        <sup style="color:#df6161;">Only jpg, jpeg, png & gif files under 5MB allowed.</sup>
        <input type="file" name="fileToUpload" id="fileToUpload" accept="image/*">
        <div class="form-group">
          <label for="college" name="college">Select your college:</label><br><br>
          <select class="btn btn-mini form-control" name="college" id="college">
            <option><?php echo $College; ?></option>
            <option>Arts & Science</option>
            <option>Agriculture and Bioresources</option>
            <option>Edwards School of Business</option>
            <option>Education</option>
            <option>Engineering</option>
            <option>Kinesiology</option>
            <option>St. Thomas More</option>
          </select>
        </div><br>
        <button type="submit" name="submitUserInfo" value="Submit" class="btn btn-primary btn-block btn-large">Update!</button>
    </form>
</div>
  
    <script src="Login/Controller/js/index.js"></script>

</body>
</html>