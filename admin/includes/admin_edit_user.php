<?php


  if(isset($_GET['edit']))
  {
             // Fetch all the post rows : 
            $id = $_GET['edit'];
            $query = "SELECT * FROM users where user_id = '$id'";
            $all_users_row = mysqli_query($conn, $query);


            while($row = mysqli_fetch_assoc($all_users_row))
            {
                $user_id = $row['user_id'];
                $username = $row['username'];
                $user_firstname = $row['user_firstname'];
                $user_lastname = $row['user_lastname'];
                $user_image = $row['user_image'];
                $user_role = $row['user_role'];
                // $user_post_id = $row['user_post_id'];
                $user_email = $row['user_email'];
                $user_date = $row['user_date'];

                if($user_image == 'not set')
                {
                  $user_image = 'noimage.png';
                }

            }
  }

?>



<?php 

  if(isset($_POST['update_user_submit']))
  {
      $user_id = $id;
      $user_firstname = $_POST['user_firstname'];
      $user_lastname = $_POST['user_lastname'];
      $user_role = $_POST['user_role'];
      $user_email = $_POST['user_email'];


      if($_FILES['user_image']['name'] == "")
      {
          $new_image = false;
      }
      else
      {
          $new_image = true;

          $user_image_name = $_FILES['user_image']['name'];

          $user_image = $user_image_name;

          $user_temp_path = $_FILES['user_image']['tmp_name'];
          $user_new_path = "../images/users/$user_image_name";

          // echo $post_image_name . "<br>";
          // echo $post_temp_path . "<br>";
          // echo $post_new_path . "<br>";

          $file_upload = move_uploaded_file($user_temp_path, $user_new_path);

          if(!$file_upload)
          {
            echo "There was some problem in uploading image...";
          }
      }

      $query = "UPDATE users SET ";
      $query .= "user_firstname = '$user_firstname', ";
      $query .= "user_lastname = '$user_lastname', ";
      $query .= "user_email = '$user_email', ";
      if($new_image)
      {
        $query .= "user_image = '$user_image', ";
      }
      $query .= "user_role = '$user_role' ";
      $query .= "WHERE user_id = '$user_id'";

      $update_user = mysqli_query($conn, $query);

      if(!$update_user)
      {
        echo "Not Happened";
      }

  }

?>



<form action="" method="POST" enctype="multipart/form-data">
  <div class="form-group">
    <label for="username">Username</label>
    <input type="text" value="<?php echo $username ;?>" name="username" class="form-control" placeholder="Choose a username like usr32" disabled>
  </div>
  <div class="form-group">
    <label for="user_firstname">First Name</label>
    <input type="text" value="<?php echo $user_firstname ;?>" name="user_firstname" class="form-control" placeholder="like Jon">
  </div>
  <div class="form-group">
    <label for="user_lastname">Last Name</label>
    <input type="text" value="<?php echo $user_lastname ;?>" name="user_lastname" class="form-control" placeholder="like Doe">
  </div>
  <div class="form-group">
    <label for="user_email">Email</label>
    <input type="email" value="<?php echo $user_email ;?>" name="user_email" class="form-control" placeholder="like youSOme@fake.com">
  </div>
  <div class="form-group">
    <label for="user_image">Update your profile pic</label>
    <br>
    <img width="100px" class="img-responsive" src="../images/users/<?php echo $user_image; ?>">
    <input type="file" name="user_image" class="form-control">
  </div>
   <div class="form-group">
        <label for="user_role">Select a Role</label>
          <select name="user_role" class="form-control">

          <?php 

              $roles = ['subscriber', 'author', 'admin'];


              foreach($roles as $role)
              {
                $capRole = ucfirst($role);
                if($role == $user_role)
                {
                  echo "<option value='$role' selected>$capRole</option>";
                }
                else
                {
                  echo "<option value='$role'>$capRole</option>";
                }
              }


            ?>
          </select>
  </div>
   <div class="form-group">
    <input class="btn btn-primary btn-mb2" type="submit" name="update_user_submit" class="form-control">
  </div>
</form>




