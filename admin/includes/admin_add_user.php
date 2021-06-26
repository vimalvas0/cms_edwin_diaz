<?php

  if(isset($_POST['add_user_submit']))
  {
      $username = $_POST['username'];
      $user_firstname = $_POST['user_firstname'];
      $user_lastname = $_POST['user_lastname'];
      $user_role = $_POST['user_role'];
      $user_email = $_POST['user_email'];
      $user_date = date('d-m-y');
      $user_randSalt = 'user';
      $password = $_POST['password'];


      // Old functionality to encrypt passwords : 
      // $salt = '$2y$10$iapplyacrazystring2021';
      // $password = crypt($password, $salt);



      $password = password_hash($password, PASSWORD_DEFAULT, array('cost' => 12));

      $user_image_name = $_FILES['user_image']['name'];
     

      $user_temp_path = $_FILES['user_image']['tmp_name'];
      $user_new_path = "../images/users/$user_image_name";

      $file_upload = move_uploaded_file($user_temp_path, $user_new_path);

      if(!$file_upload)
      {
        echo "There was some problem in uploading image...";
      }


      // Store into database
      $query = "INSERT INTO users (username, password, user_firstname, user_lastname, user_email, user_role, user_image, user_randSalt, user_date) VALUES ('$username', '$password', '$user_firstname', '$user_lastname', '$user_email', '$user_role', '$user_image_name', '$user_randSalt', '$user_date')";

      $user_upload_db = mysqli_query($conn, $query);

      if(!$user_upload_db)
      {
        echo "There was some problem in db query. <br>";
      }
      else
      {
        echo "<h3>User is Created. " . "<a href='users.php'>View Users.</a></h3>"; 
      }





  }

?>



<form action="" method="POST" enctype="multipart/form-data">
  <div class="form-group">
    <label for="username">Username</label>
    <input type="text" name="username" class="form-control" placeholder="Choose a username like usr32">
  </div>
  <div class="form-group">
    <label for="user_firstname">First Name</label>
    <input type="text" name="user_firstname" class="form-control" placeholder="like Jon">
  </div>
  <div class="form-group">
    <label for="user_lastname">Last Name</label>
    <input type="text" name="user_lastname" class="form-control" placeholder="like Doe">
  </div>
  <div class="form-group">
    <label for="user_email">Email</label>
    <input type="email" name="user_email" class="form-control" placeholder="like youSOme@fake.com">
  </div>
  <div class="form-group">
    <label for="password">Password</label>
    <input type="password" name="password" class="form-control" placeholder="a secure password....">
  </div>

  <div class="form-group">
    <label for="user_image">Add a profile pic</label>
    <input type="file" name="user_image" class="form-control">
  </div>
   <div class="form-group">
        <label for="user_role">Select a Role</label>
          <select name="user_role" class="form-control">
                      <option value="author">Author</option>
                      <option value="subscriber">Subscriber</option>
                      <option value="admin">Admin</option>
          </select>
  </div>
   <div class="form-group">
    <input class="btn btn-primary btn-mb2" type="submit" name="add_user_submit" class="form-control">
  </div>
</form>