<?php


if(isset($_SESSION['userimage']))
{
  $image = $_SESSION['userimage'];
  if($image == 'not set')
  {
    $image = 'noimage.png';
  }
}

?>



<form action="" method="POST" enctype="multipart/form-data">
  <div class="form-group">
    <label for="user_image">Your profile pic</label>
    <br>
    <img width="110px" class="img-responsive" src="../images/users/<?php echo $_SESSION['userimage'] ; ?>">
  </div>

  <div class="form-group">
    <label for="username">Username - (<small><?php echo " " .$_SESSION['role'] . " "; ?></small>)</label>
    <input type="text" value="<?php echo $_SESSION['username'] ;?>" name="username" class="form-control" placeholder="Choose a username like usr32" disabled>

  </div>
  <div class="form-group">
    <label for="user_firstname">First Name</label>
    <input type="text" value="<?php echo $_SESSION['firstname'] ;?>" name="user_firstname" class="form-control" placeholder="like Jon" disabled>
  </div>
  <div class="form-group">
    <label for="user_lastname">Last Name</label>
    <input type="text" value="<?php echo $_SESSION['lastname']; ?>" name="user_lastname" class="form-control" placeholder="like Doe" disabled>
  </div>
  <div class="form-group">
    <label for="user_email">Email</label>
    <input type="email" value="<?php echo $_SESSION['email'] ;?>" name="user_email" class="form-control" placeholder="like youSOme@fake.com" disabled>
  </div> 
</form>




