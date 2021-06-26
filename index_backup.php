<!-- Include the header -->

<?php require('./includes/db.php'); ?>
<?php require('./includes/header.php'); ?>

<body>

   <?php require('./includes/navigation.php'); ?>



    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <h1 class="page-header">
                    Welcome To CMS
                    <small>A lot of awesome posts</small>
                </h1>

                <!-- First Blog Post -->


                <?php 

                    // Fetch all the post rows : 
                    $query = "SELECT * FROM posts WHERE post_status = 'published'";
                    $all_posts_row = mysqli_query($conn, $query);

                    while($row = mysqli_fetch_assoc($all_posts_row))
                    {

                        $post_title = $row['post_title'];
                        $post_id = $row['post_id'];
                        $post_author = $row['post_author'];
                        $post_date = $row['post_date'];
                        $post_content = $row['post_content'];
                        $post_image = $row['post_image'];

                ?>
                        <h2>
                            <a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title; ?></a>
                        </h2>
                        <p class="lead">
                            by <a href="posts_author.php?author=<?php echo $post_author; ?>&p_id=<?php echo $post_id; ?>"><?php echo $post_author; ?></a>
                        </p>
                        <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date; ?></p>
                        <hr>
                        <a href="post.php?p_id=<?php echo $post_id; ?>">
                        <img class="img-responsive" src="./images/<?php echo $post_image; ?>" alt="">
                        </a>
                        <hr>
                        <p><?php echo $post_content; ?></p>
                        <a class="btn btn-primary" href= "post.php?p_id=<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                        <hr>


                <?php  } ?>

            </div>

            <!-- Blog Sidebar Widgets Column -->
           <?php require('./includes/sidebar.php'); ?>

        </div>
        <!-- /.row -->

        <hr>


    <!-- Include the footer -->
       <?php require('./includes/footer.php'); ?>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
