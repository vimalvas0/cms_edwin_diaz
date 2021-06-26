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
                    Page Heading
                    <small>Secondary Text</small>
                </h1>

                <!-- First Blog Post -->

                <?php 

                     
                    if(isset($_POST['submit']))
                    {


                        $search = $_POST['search-box'];

                        $query = "SELECT * FROM posts WHERE post_tags LIKE '%$search%'";

                        $search_results_rows = mysqli_query($conn, $query);


                        if(!$search_results_rows)
                        {
                            die("Query failed : " . mysql_error($conn));
                        }

                        $num_results = mysqli_num_rows($search_results_rows);



                        if(!$num_results)
                        {
                            echo "<h1> No Result Found. </h1>";
                        }


                        while($row = mysqli_fetch_assoc($search_results_rows))
                        {

                            $post_title = $row['post_title'];
                            $post_id = $row['post_id'];
                            $post_author = $row['post_author'];
                            $post_date = $row['post_date'];
                            $post_content = $row['post_content'];
                            $post_image = $row['post_image'];

                    ?>

                        <h2>
                            <a href="#"><?php echo $post_title; ?></a>
                        </h2>
                        <p class="lead">
                            by <a href="index.php"><?php echo $post_author; ?></a>
                        </p>
                        <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date; ?></p>
                        <hr>
                        <img class="img-responsive" src="./images/<?php echo $post_image; ?>" alt="">
                        <hr>
                        <p><?php echo $post_content; ?></p>
                        <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                        <hr>

                <?php  
                        } 

                    }

                ?>

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
