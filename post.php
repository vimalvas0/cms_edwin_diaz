<?php require('./includes/db.php'); ?>
<?php require('./includes/header.php'); ?>

<body>

   <?php require('./includes/navigation.php'); ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Post Content Column -->
            <div class="col-lg-8">

                <!-- Blog Post -->



                <?php

                if(isset($_GET['p_id']))
                {
                    $id = $_GET['p_id'];

                     // Fetch all the post rows : 
                    $query = "SELECT * FROM posts WHERE post_id = '$id'";
                    $get_post = mysqli_query($conn, $query);

                    $row = mysqli_fetch_assoc($get_post);

                    $post_title = $row['post_title'];
                    $post_id = $row['post_id'];
                    $post_author = $row['post_author'];
                    $post_date = $row['post_date'];
                    $post_content = $row['post_content'];
                    $post_image = $row['post_image'];

                ?>

                <!-- Title -->
                <h1><?php echo $post_title;?></h1>

                <!-- Author -->
                <p class="lead">
                    by <a href="#"><?php echo $post_author;?></a>
                </p>

                <hr>

                <!-- Date/Time -->
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date;?></p>

                <hr>

                <!-- Preview Image -->
                <img class="img-responsive" src="./images/<?php echo $post_image;?>" alt="">

                <hr>

                <!-- Post Content -->
                <p class="lead"><?php echo $post_content;?></p>

                <hr>

                <!-- Blog Comments -->


                <?php

                if(isset($_POST['create_comment_submit']))
                {

                    $p_id = $_GET['p_id'];

                    $comment_author = $_POST['comment_author'];
                    $comment_email = $_POST['comment_email'];
                    $comment_content = $_POST['comment_content'];
                    $comment_date = date('d-m-y');

                    if(!empty($comment_author) && !empty($comment_email) && !empty($comment_content)){
                        $query = "INSERT INTO comments (comment_post_id, comment_author, comment_email, comment_content, comment_date, comment_status) ";

                        $query .= "VALUES ('$p_id', '$comment_author', '$comment_email', '$comment_content', now(), 'unapproved')";

                        $save_comment = mysqli_query($conn, $query);

                        if(!$save_comment)
                        {
                            die("Unsuccessful Attempt to make a comment. Backend Error.");
                        }

                        $query4 = "UPDATE posts SET post_comment_count = post_comment_count + 1 WHERE post_id = '$p_id'";

                        $update_comment_count_in_posts = mysqli_query($conn, $query4);
                    }
                    else
                    {
                        echo "<script> alert('Please provide a name and a valide email');</script>";
                    }
                    
                }

                ?>

                <!-- Comments Form -->
                <div class="well">
                    <form action="" method="POST">
                        <div class="form-group">
                            <label for="comment_author">Enter Your Name<span style="color : red;">*</span></label>
                            <input name="comment_author" type="text" class="form-control" placeholder="Jon Doe">
                        </div>
                        <div class="form-group">
                            <label for="comment_email">Enter Your Email<span style="color : red;">*</span></label>
                            <input name="comment_email" type="email" class="form-control" placeholder="jondoefake@xyz.com">
                        </div>
                        <div class="form-group">
                            <h4>Leave your Comment:</h4>
                            <textarea name="comment_content" class="form-control" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <button name="create_comment_submit" type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->

                <?php 

                    $post_id = $_GET['p_id'];
                    $query3 = "SELECT * FROM comments WHERE comment_post_id = '$post_id' ";
                    $query3 .= "AND comment_status = 'approved'";

                    $get_all_comments = mysqli_query($conn, $query3);

                    while($row = mysqli_fetch_assoc($get_all_comments))
                    {
                        $comment_author = $row['comment_author'];
                        $comment_date = $row['comment_date'];
                        $comment_content = $row['comment_content'];

                ?>

                     <!-- Comment -->
                    <div class="media">
                        <a class="pull-left" href="#">
                            <img class="media-object" src="http://placehold.it/64x64" alt="">
                        </a>
                        <div class="media-body">
                            <h4 class="media-heading"><?php echo $comment_author; ?>
                                <small><?php echo $comment_date; ?></small>
                            </h4>
                            <?php echo $comment_content; ?>
                        </div>
                    </div>


              <?php } ?>



           
               <!--  <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading">Start Bootstrap
                            <small>August 25, 2014 at 9:30 PM</small>
                        </h4>
                        Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus. -->
                        <!-- Nested Comment -->
                        <!-- <div class="media">
                            <a class="pull-left" href="#">
                                <img class="media-object" src="http://placehold.it/64x64" alt="">
                            </a>
                            <div class="media-body">
                                <h4 class="media-heading">Nested Start Bootstrap
                                    <small>August 25, 2014 at 9:30 PM</small>
                                </h4>
                                Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                            </div>
                        </div> -->
                        <!-- End Nested Comment -->
                    <!-- </div>
                </div>
 -->




            <?php 

                $query = "UPDATE posts SET post_view_count = post_view_count + 1 WHERE post_id = '$id'";
                $update_view_count = mysqli_query($conn, $query);

            }  ?>

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <div class="col-md-4">

                <!-- Blog Search Well -->
                <div class="well">
                    <h4>Blog Search</h4>
                    <div class="input-group">
                        <input type="text" class="form-control">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button">
                                <span class="glyphicon glyphicon-search"></span>
                        </button>
                        </span>
                    </div>
                    <!-- /.input-group -->
                </div>

                <!-- Blog Categories Well -->
                <div class="well">
                    <h4>Blog Categories</h4>
                    <div class="row">
                        <div class="col-lg-6">
                            <ul class="list-unstyled">
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-lg-6">
                            <ul class="list-unstyled">
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- /.row -->
                </div>

                <!-- Side Widget Well -->
                <div class="well">
                    <h4>Side Widget Well</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, perspiciatis adipisci accusamus laudantium odit aliquam repellat tempore quos aspernatur vero.</p>
                </div>

            </div>

        </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; Your Website 2014</p>
                </div>
            </div>
            <!-- /.row -->
        </footer>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <script src="js/scripts.js"></script>

</body>

</html>
