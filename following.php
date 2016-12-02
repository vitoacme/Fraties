<?php
    require_once 'header.php';
?>
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
          <div id="Demo5" class="w3-accordion-content w3-container">
            <a href="grid.php?type=following"><p><?php echo $Following; ?></p></a>
          </div>
          <button title="Followers recieved" onclick="myFunction('Demo6')" class="w3-btn-block w3-theme-d4 w3-left-align"><i class="fa fa-arrow-circle-left fa-fw w3-margin-right"></i> Followers</button>
          <div id="Demo6" class="w3-accordion-content w3-container">
            <a href="grid.php?type=followers"><p><?php echo $Followers; ?></p></a>
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
            <label class="w3-opacity" style="font-size: 2em;">Just the Fraties you follow!</label>
            </div>
          </div>
        </div>
      </div>
      
<!-- display the feed-->
<?php
$result = displayPostsOfFollowing($NSID);
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
<?php
    require_once 'leaderboards.php';
?>