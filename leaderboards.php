<!-- Leaderboards, JavaScripts, Footer-->
   
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