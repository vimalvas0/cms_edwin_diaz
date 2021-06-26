<?php require('./functions.php'); ?>


<?php 

if(isset($_POST['checkBoxArray']))
{

    $bulk_options = $_POST['bulk_options'];
    foreach($_POST['checkBoxArray'] as $selected)
    {

        switch($bulk_options)
        {
            case 'draft' :
                $query  = "UPDATE posts SET post_status = 'draft' WHERE post_id = $selected";
                $update_db = mysqli_query($conn, $query);
                if(!$update_db)
                {
                    echo "Query Failed... <br>";
                }
                break;
            case 'published' :
                $query  = "UPDATE posts SET post_status = 'published' WHERE post_id = $selected";
                $update_db = mysqli_query($conn, $query);
                if(!$update_db)
                {
                    echo "Query Failed... <br>";
                }
                break;
            case 'delete' :
                $query  = "DELETE FROM posts WHERE post_id = $selected";
                $update_db = mysqli_query($conn, $query);
                if(!$update_db)
                {
                    echo "Query Failed... <br>";
                }
                break;

            case 'clone':

                $query = "SELECT * FROM posts WHERE post_id = $selected";
                $all_posts_row = mysqli_query($conn, $query);

                $row = mysqli_fetch_assoc($all_posts_row);

                $post_title = $row['post_title'];
                $post_author = $row['post_author'];
                $post_date = $row['post_date'];
                $post_content = $row['post_content'];
                $post_image = $row['post_image'];
                $post_tags = $row['post_tags'];
                $post_comments = $row['post_comment_count'];
                $post_cat_id = $row['post_category_id'];
                $post_status = $row['post_status'];

                $query2 = "INSERT INTO posts (post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_comment_count, post_status) VALUES ($post_cat_id, '$post_title', '$post_author', '$post_date', '$post_image', '$post_content', '$post_tags', $post_comments, '$post_status')";

                $post_upload_db = mysqli_query($conn, $query2);

                break;


            default : 
                break;
        
        }


    }


}


?>





<form action="" method="POST">

<div class="form-group">
<div id="bulkOptionContainer" class="col-xs-4">

    <label for="bulk_options">Options</label>
    <select class="form-control" name="bulk_options">
        <option value="">Select Option</option>
        <option value="published">Publish</option>
        <option value="draft">Draft</option>
        <option value="delete">Delete</option>
        <option value="clone">Clone</option>
    </select>
</div>
<br>

<div class="col-xs-4">
    <input type="submit" name="submit" class="btn btn-success" value="Apply">

    <a class="btn btn-primary" href="posts.php?source=add_post">Add New</a>
</div>
<br>
<br>
</div>



<table class="table table-bordered">

        <thead>
            <tr>
                <th>Select All <input id="selectAllBoxes" type="checkbox"></th>
                <th>Id</th>
                <th>Author</th>
                <th>Title</th>
                <th>Category</th>
                <th>Status</th>
                <th>Image</th>
                <th>Tags</th>
                <th>Comments</th>
                <th>Seen</th>
                <th>Date</th>
                <th>View Post</th>
                <th>Delete Post</th>
                <th>Edit Post</th>
            </tr>
        </thead>
        <tbody>


            <?php
                    if(isset($_GET['delete']))
                    {
                        $id = $_GET['delete'];
                        $query = "DELETE FROM posts WHERE post_id = '$id'";
                        $delete_post= mysqli_query($conn, $query);
                    }

             ?>


            <?php 
                  // Fetch all the post rows : 
            $query = "SELECT * FROM posts";
            $all_posts_row = mysqli_query($conn, $query);


            while($row = mysqli_fetch_assoc($all_posts_row))
            {

                $post_title = $row['post_title'];
                $post_id = $row['post_id'];
                $post_author = $row['post_author'];
                $post_date = $row['post_date'];
                $post_content = $row['post_content'];
                $post_image = $row['post_image'];
                $post_tags = $row['post_tags'];
                $post_comments = $row['post_comment_count'];
                $post_cat_id = $row['post_category_id'];
                $post_status = $row['post_status'];
                $post_view_count = $row['post_view_count'];


                $query2 = "SELECT * FROM category WHERE cat_id = '$post_cat_id'";
                $get_category = mysqli_query($conn, $query2);
                $category  = mysqli_fetch_assoc($get_category);
                $category_title = $category['cat_title']; 


                // Alternative way of counting the comments : 
                $query3 = "SELECT * FROM comments WHERE comment_post_id = '$post_id'";
                $total_comments_of_post = mysqli_query($conn, $query3);
                $comment = mysqli_fetch_assoc($total_comments_of_post);
                $total_comments_post = mysqli_num_rows($total_comments_of_post);

                // Now above total_comments_post is as post_comments


            ?>
            <tr>
                <td><input class="checkBoxes" type="checkbox" name="checkBoxArray[]" value="<?php echo $post_id; ?>"></td>
                <td><?php echo $post_id; ?></td>
                <td><?php echo $post_author; ?></td>
                <td><?php echo $post_title; ?></td>
                <td><?php echo $category_title; ?></td>
                <td><?php echo $post_status; ?></td>
                <td><img width="40px" class="img-responsive" src="../images/<?php echo $post_image; ?>"> </td>
                <td><?php echo $post_tags; ?></td>
                <td><a href="comments.php?source=post_comments&c_p_id=<?php echo $post_id; ?>"><?php echo $total_comments_post; ?></a></td>
                <td><?php echo $post_view_count . " <i>times</i>"; ?></td>
                <td><?php echo $post_date; ?></td>
                <td><a href="../post.php?p_id=<?php echo $post_id; ?>">View</a></td>
                <td><a onClick="javascript : return confirm('You sure you want to delete this post');" href="posts.php?delete=<?php echo $post_id; ?>">Delete</a></td>
                <td><a href="posts.php?source=edit_post&edit=<?php echo $post_id; ?>">Edit</a></td>
           </tr>
            <?php } ?>
        </tbody>
</table> 
</form>

