<?php require('./functions.php'); ?>

<table class="table table-bordered">
        <thead>
            <tr>
                <th>Id</th>
                <th>On Post</th>
                <th>Author</th>
                <th>Comment</th>
                <th>Email</th>
                <th>Status</th>
                <th>Approve</th>
                <th>Dissapprove</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>


            <?php
            if(isset($_GET['delete']))
            {
                $id = $_GET['delete'];
                $query = "DELETE FROM comments WHERE comment_id = '$id'";
                $delete_comment= mysqli_query($conn, $query);

                if($delete_comment)
                {
                    header('Location: comments.php');
                }
            }elseif(isset($_GET['approve']))
            {
                $id = $_GET['approve'];
                $query = "UPDATE comments SET comment_status = 'approved' WHERE comment_id = '$id'";
                $approved_comment= mysqli_query($conn, $query);

                if($approved_comment)
                {
                    header('Location: comments.php');
                }

            }elseif(isset($_GET['disapprove']))
            {
                $id = $_GET['disapprove'];
                $query = "UPDATE comments SET comment_status = 'disapproved' WHERE comment_id = '$id'";
                $disapproved_comment= mysqli_query($conn, $query);

                if($disapproved_comment)
                {
                    header('Location: comments.php');
                }
            }

             ?>


            <?php 
                  // Fetch all the post rows : 
            $query = "SELECT * FROM comments";
            $all_comments_row = mysqli_query($conn, $query);


            while($row = mysqli_fetch_assoc($all_comments_row))
            {

                $comment_id = $row['comment_id'];
                $comment_author = $row['comment_author'];
                $comment_date = $row['comment_date'];
                $comment_content = $row['comment_content'];
                $comment_email = $row['comment_email'];
                $comment_status = $row['comment_status'];
                $comment_post_id = $row['comment_post_id'];

                $query2 = "SELECT * FROM posts WHERE post_id = '$comment_post_id'";
                $get_post = mysqli_query($conn, $query2);
                $post  = mysqli_fetch_assoc($get_post);
                $get_post_title = $post['post_title'];
                $get_post_id = $post['post_id'];

            ?>
            <tr>
                <td><?php echo $comment_id; ?></td>
                <td><a href="../post.php?p_id=<?php echo $get_post_id; ?>"><?php echo $get_post_title; ?></a></td>
                <td><?php echo $comment_author; ?></td>
                <td><?php echo $comment_content; ?></td>
                <td><?php echo $comment_email; ?></td>
                <td><?php echo $comment_status; ?></td>
                <td><a href="comments.php?approve=<?php echo $comment_id; ?>">Approve</a></td>
                <td><a href="comments.php?disapprove=<?php echo $comment_id; ?>">Disapprove</a></td>
                <td><a href="comments.php?delete=<?php echo $comment_id; ?>">Delete</a></td>
           </tr>
            <?php } ?>
        </tbody>
</table> 