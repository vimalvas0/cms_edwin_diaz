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

                    if(isset($_GET['cat_id']))
                    {
                        $arrange_by_category = true;
                        $cat_id = $_GET['cat_id'];
                    }else
                    {
                        $arrange_by_category = false;
                    }

                ?>

                <?php 


                    $post_per_page = 6;

                    if(isset($_GET['page']))
                    {
                        $page = $_GET['page'];
                    }
                    else
                    {
                        $page = "";
                    }


                    if($page == "" || $page == 1)
                    {
                        $page_offset = 0;
                    }
                    else
                    {
                        $page_offset = ($page  - 1) * $post_per_page;
                    }


                ?>


                <?php 


                    if($arrange_by_category)
                    {
                        $query = "SELECT * FROM posts WHERE post_status = 'published' AND post_category_id = '$cat_id'";
                        if(isset($_SESSION['role']))
                        {
                            if($_SESSION['role'] == 'admin')
                            {
                                $query = "SELECT * FROM posts WHERE post_category_id = '$cat_id'";
                            }
                        }
                    }else
                    {
                        // Fetch all the post rows : 
                        $query = "SELECT * FROM posts WHERE post_status = 'published'"; 
                        if(isset($_SESSION['role']))
                        {
                            if($_SESSION['role'] == 'admin')
                            {
                                $query = "SELECT * FROM posts";
                            }
                        }
                    }


                    // echo $query;

                                      
                    $all_posts_row = mysqli_query($conn, $query);


                    // echo mysqli_num_rows($all_posts_row);


                    if(mysqli_num_rows($all_posts_row) > 0)
                    {



                    $total_posts = mysqli_num_rows($all_posts_row);

                    $total_pages = ceil($total_posts/$post_per_page);

                    // Fetch all the post rows : 
                    $query_limit = " LIMIT $page_offset, $post_per_page";
                    $query .= $query_limit;


                    // echo $query;

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


            <ul class ="pager">

                <?php

                    for($i = 1; $i <= $total_pages; $i++)
                    {
                        echo "<li><a href='index.php?page=" . $i . "'>$i</a></li>";
                    }

                ?>


            <?php }else{
                
                    echo "<h1>No Posts Found.</h1>";
                } ?>

            </ul>

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
