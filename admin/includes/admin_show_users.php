
<table class="table table-bordered">
        <thead>
            <tr>
                <th>Id</th>
                <th>Username</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>User Image</th>
                <th>Role</th>
                <th>Enrolling Date</th>
                <th>Action</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>


            <?php
                    if(isset($_GET['delete']))
                    {
                        if(isset($_SESSION['role']))
                        {
                            if($_SESSION['role'] == 'admin')
                            {
                                $id = mysqli_real_escape_string($_GET['delete']);
                                $query = "DELETE FROM users WHERE user_id = '$id'";
                                $delete_user = mysqli_query($conn, $query);
                             }
                        } 

                    }
             ?>


            <?php 
                  // Fetch all the post rows : 
            $query = "SELECT * FROM users";
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


                // $query2 = "SELECT * FROM category WHERE cat_id = '$post_cat_id'";
                // $get_category = mysqli_query($conn, $query2);
                // $category  = mysqli_fetch_assoc($get_category);
                // $category_title = $category['cat_title']; 

            ?>
            <tr>
                <td><?php echo $user_id; ?></td>
                <td><?php echo $username; ?></td>
                <td><?php echo $user_firstname; ?></td>
                <td><?php echo $user_lastname; ?></td>
                <td><?php echo $user_email; ?></td>
                <td><img width="40px" class="img-responsive" src="../images/users/<?php echo $user_image; ?>"> </td>
                <td><?php echo $user_role; ?></td>
                <td><?php echo $user_date; ?></td>
                <td><a href="users.php?delete=<?php echo $user_id; ?>">Delete</a></td>
                <td><a href="users.php?source=edit_user&edit=<?php echo $user_id; ?>">Edit</a></td>
           </tr>
            <?php } ?>
        </tbody>
</table> 