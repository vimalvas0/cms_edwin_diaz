<?php

  require('./functions.php');

  if(isset($_GET['edit']))
  {
             // Fetch all the post rows : 
            $id = $_GET['edit'];
            $query = "SELECT * FROM posts where post_id = '$id'";
            $all_posts_row = mysqli_query($conn, $query);


            while($row = mysqli_fetch_assoc($all_posts_row))
            {
                $the_post_id = $row['post_id'];
                $post_title = $row['post_title'];
                $post_author = $row['post_author'];
                $post_content = $row['post_content'];
                $post_image = $row['post_image'];
                $post_tags = $row['post_tags'];
                $post_cat_id = $row['post_category_id'];
                $post_status = $row['post_status'];

            }
  }

?>



<?php 

  if(isset($_POST['update_post_submit']))
  {
      $post_title = $_POST['post_title'];
      $post_author = $_POST['post_author'];
      $post_content = $_POST['post_content'];
      $post_tags = $_POST['post_tags'];
      $post_cat_id = $_POST['post_cat_id'];
      $post_status = $_POST['post_status'];


      if($_FILES['post_image']['name'] == "")
      {
          $new_image = false;
      }
      else
      {
          $new_image = true;

          $post_image_name = $_FILES['post_image']['name'];

          $post_image = $post_image_name;

          $post_temp_path = $_FILES['post_image']['tmp_name'];
          $post_new_path = "../images/$post_image_name";

          // echo $post_image_name . "<br>";
          // echo $post_temp_path . "<br>";
          // echo $post_new_path . "<br>";

          $file_upload = move_uploaded_file($post_temp_path, $post_new_path);

          if(!$file_upload)
          {
            echo "There was some problem in uploading image...";
          }
      }

      $query = "UPDATE posts SET ";
      $query .= "post_title = '$post_title', ";
      $query .= "post_author = '$post_author', ";
      $query .= "post_content = '$post_content', ";
      $query .= "post_tags = '$post_tags', ";
      $query .= "post_category_id = '$post_cat_id', ";
      $query .= "post_status = '$post_status' ";
      if($new_image)
      {
        $query .= ", post_image = '$post_image' ";
      }
      $query .= "WHERE post_id = '$the_post_id'";


      $update_post = mysqli_query($conn, $query);

      if(!$update_post)
      {
        echo "Not Happened";
      }else
      {
        echo "<h3>Post is updated. " . "<a href='posts.php'>View all posts</a></h3>"; 
      }

  }

?>





<form action="" method="POST" enctype="multipart/form-data">
  <div class="form-group">
    <label for="post_title">Post Title</label>
    <input type="text" value="<?php echo $post_title ;?>"  name="post_title" class="form-control" placeholder="Add a Post Title">
  </div>
  
  <div class="form-group">
    <label for="post_author">Post Author</label>
    <input type="text" value="<?php echo $post_author ;?>" name="post_author" class="form-control" placeholder="Your Name...">
  </div>


  <div class="form-group">
        <label for="post_cat_id">Select a Category</label>
          <select name="post_cat_id" class="form-control">
            <?php
                
                $query = "SELECT * FROM category";
                $all_categories = mysqli_query($conn, $query);

                while($row = mysqli_fetch_assoc($all_categories))
                {

                  if($row['cat_id'] == $post_cat_id):
                  
            ?>
                      <option selected value="<?php echo $row['cat_id']; ?>"><?php echo $row['cat_title']; ?></option>

                  <?php else: ?>

                     <option value="<?php echo $row['cat_id']; ?>"><?php echo $row['cat_title']; ?></option>

                  <?php endif; ?>

          
          <?php } ?>

          </select>
  </div>


  <div class="form-group">
        <label for="post_status">Post Status</label>
          <select name="post_status" class="form-control">
            <?php
                
                $statuses = ['draft', 'finished', 'published'];

                foreach($statuses as $status)
                {

            ?>

                  <?php if($status == $post_status):  ?>


                      <option selected value="<?php echo $status; ?>"><?php echo ucfirst($status); ?></option>


                    <?php else: ?>

                      <option value="<?php echo $status; ?>"><?php echo ucfirst($status); ?></option>


                    <?php endif; ?>
         
          <?php } ?>

          </select>
  </div>
  
  <div class="form-group">
    <label for="post_tags">Post Tages</label>
    <input type="text" value="<?php echo $post_tags ;?>" name="post_tags" class="form-control" placeholder="Tags, i.e. health? tech? art?">
  </div>


  <div class="form-group">
    <label for="post_image">Update an cover art.</label>
    <br>
    <img width="100px" class="img-responsive" src="../images/<?php echo $post_image; ?>">
    <input type="file" name="post_image" class="form-control">
  </div>
  <div class="form-group">
    <label for="post_content">Post Content</label>
    <textarea name="post_content" id="summernote" class="form-control" rows="7" placeholder="Start Typing..."><?php echo $post_content ;?></textarea>
  </div>
   <div class="form-group">
    <input class="btn btn-primary btn-mb2" type="submit" name="update_post_submit" class="form-control">
  </div>
</form>