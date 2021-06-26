<?php

  require('./functions.php');

  if(isset($_POST['add_post_submit']))
  {
      $post_title = $_POST['post_title'];
      // $post_id = $_POST['post_id'];
      $post_author = $_POST['post_author'];
      $post_content = $_POST['post_content'];
      $post_tags = $_POST['post_tags'];
      $post_cat_id = $_POST['post_category_id'];
      $post_status = $_POST['post_status'];
      $post_date = date('d-m-y');
      $post_comment_count = 0;


      // echo $post_title . "<br>"; 
      // echo $post_content . "<br>"; 
      // echo $post_tags . "<br>"; 
      // echo $post_cat_id . "<br>"; 
      // echo $post_status . "<br>"; 
      // echo $post_author . "<br>"; 
      // echo $post_date . "<br>";


      $post_image_name = $_FILES['post_image']['name'];
     

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



      // Store into database
      $query = "INSERT INTO posts (post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_comment_count, post_status) VALUES ($post_cat_id, '$post_title', '$post_author', '$post_date', '$post_image_name', '$post_content', '$post_tags', $post_comment_count, '$post_status')";

        $post_upload_db = mysqli_query($conn, $query);

        confirm($post_upload_db);

  }

?>





<form action="" method="POST" enctype="multipart/form-data">
  <div class="form-group">
    <label for="post_title">Post Title</label>
    <input type="text" name="post_title" class="form-control" placeholder="Add a Post Title">
  </div>
  <!-- <div class="form-group">
    <label for="post_author">Post Author</label>
    <input type="text" name="post_author" class="form-control" placeholder="Your Name...">
  </div> -->

   <div class="form-group">
      <label for="post_author">Select a user</label>
        <select name="post_author" class="form-control">
             <?php
                
                $query = "SELECT * FROM users";
                $all_users = mysqli_query($conn, $query);

                while($row = mysqli_fetch_assoc($all_users))
                {

            ?>
                      <option value="<?php echo $row['user_firstname'] . ' ' . $row['user_lastname']; ?>"><?php echo $row['user_firstname'] . " " . $row['user_lastname']; ?></option>
          
          <?php } ?>

        </select>
  </div>


 <div class="form-group">
        <label for="post_category_id">Select a Category</label>
          <select name="post_category_id" class="form-control">
            <?php
                
                $query = "SELECT * FROM category";
                $all_categories = mysqli_query($conn, $query);

                while($row = mysqli_fetch_assoc($all_categories))
                {

            ?>
                      <option value="<?php echo $row['cat_id']; ?>"><?php echo $row['cat_title']; ?></option>
          
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
                      <option value="<?php echo $status; ?>"><?php echo ucfirst($status); ?></option>
          
          <?php } ?>

          </select>
  </div>
  <div class="form-group">
    <label for="post_tags">Post Tages</label>
    <input type="text" name="post_tags" class="form-control" placeholder="Tags, i.e. health? tech? art?">
  </div>
  <div class="form-group">
    <label for="post_image">Add an cover art.</label>
    <input type="file" name="post_image" class="form-control">
  </div>
  <div class="form-group">
    <label for="post_content">Post Content</label>
    <textarea name="post_content" id = "summernote" class="form-control" rows="7" placeholder="Start Typing..."></textarea>
  </div>
   <div class="form-group">
    <input class="btn btn-primary btn-mb2" type="submit" name="add_post_submit" class="form-control">
  </div>
</form>