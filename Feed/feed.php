<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Fraties Home</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  </head>
  <body>
  	<?php
  		session_start();
  		if(isset($_SESSION[userNSID])) {
  			$nsid = $_SESSION[userNSID];
  			require_once 'Controller/profileClass.php';
  		}
  	?>
  	<div class="container-fluid text-center">
	  <div class="row">
	    <div class="col-sm-4">
	      <div class="well">
	      	<div class="row">
		      <div class="col-sm-4">
		      	<p><img style="border-radius: 50px;" <?php echo getUsersPicture($nsid) ?> width=100px height=100px /><p>
		      </div> 
		       <div class="col-sm-8">
		      		<h1><?php echo getUsersName($nsid) ?></h1>
		      		<p>@<?php echo $nsid; ?></p>
		      		<p><?php echo getUsersCollege($nsid) ?></p>
		      </div> 
		    </div>
		    <hr />
		    <div class="row">
		      <div class="col-sm-4">
		      	<h4>Points</h4>
		      	<p><?php echo getUsersPoints($nsid) ?></p>
		      </div> 
		      <div class="col-sm-4">
		      	<h4>Followers</h4>
		      	<p><?php echo getUsersFollowers($nsid) ?></p>
		      </div>
		      <div class="col-sm-4">
		      	<h4>Following</h4>
		      	<p><?php echo getUsersFollowing($nsid) ?></p>
		      </div>
		    </div>
	      </div>
	    </div>
	    <div class="col-sm-6 text-left">
	      <h3>FEED</h3>
	    </div>
	    <div class="col-sm-2">
	      <div class="well">
	        <h3 style="margin-top: 0;">Top Users</h3>
	        <ol><?php echo getTopUsers($nsid) ?></ol>
	      </div>
	    </div>
	  </div>
	</div>
  </body>
</html>