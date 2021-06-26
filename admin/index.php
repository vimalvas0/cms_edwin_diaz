<?php require('./includes/admin_header.php'); ?>
<?php ob_start(); ?>
<?php require('./functions.php'); ?>

<body>

    <div id="wrapper">

        <?php require('./includes/admin_navigation.php'); ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <?php


                ?>

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                <?php require('./includes/admin_dropdown.php'); ?>

                <!-- /.row -->

                <?php 
                        // Get all the data into widgets : 


                        // Posts 
                        // $query = "SELECT * FROM posts";
                        // $all_posts = mysqli_query($conn, $query);
                        // $num_posts = mysqli_num_rows($all_posts);

                        $num_posts = countRows('posts');


                        // // Comments : 
                        // $query2 = "SELECT * FROM comments";
                        // $all_comments = mysqli_query($conn, $query2);
                        // $num_comments = mysqli_num_rows($all_comments);

                        $num_comments = countRows('comments');

                        // // Categories : 
                        // $query3 = "SELECT * FROM category";
                        // $all_categories = mysqli_query($conn, $query3);
                        // $num_categories = mysqli_num_rows($all_categories);

                        $num_categories = countRows('category');

                        // // Users : 
                        // $query4 = "SELECT * FROM users";
                        // $all_users = mysqli_query($conn, $query4);
                        // $num_users = mysqli_num_rows($all_users);

                        $num_users = countRows('users');

                        $query = "SELECT * FROM posts WHERE post_status = 'published'";
                        $published_posts = mysqli_query($conn, $query);
                        $num_published_posts = mysqli_num_rows($published_posts);


                        $query2 = "SELECT * FROM comments WHERE comment_status = 'unapproved'";
                        $disapproved_comments = mysqli_query($conn, $query2);
                        $num_disapproved_comments = mysqli_num_rows($disapproved_comments);

                        // Users : 
                        $query4 = "SELECT * FROM users WHERE user_role = 'subscriber'";
                        $subscribed_users = mysqli_query($conn, $query4);
                        $num_subscribed_users = mysqli_num_rows($subscribed_users);


                ?>


                <!-- Admin Widget -->
                <div class="row">
                        <div class="col-lg-3 col-md-6">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-file-text fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                      <div class='huge'><?php echo $num_posts; ?></div>
                                            <div>Posts</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="posts.php">
                                    <div class="panel-footer">
                                        <span class="pull-left">View Details</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="panel panel-green">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-comments fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                         <div class='huge'><?php echo $num_comments; ?></div>
                                          <div>Comments</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="comments.php">
                                    <div class="panel-footer">
                                        <span class="pull-left">View Details</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="panel panel-yellow">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-user fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                        <div class='huge'><?php echo $num_users; ?></div>
                                            <div> Users</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="users.php">
                                    <div class="panel-footer">
                                        <span class="pull-left">View Details</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="panel panel-red">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-list fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <div class='huge'><?php echo $num_categories; ?></div>
                                             <div>Categories</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="categories.php">
                                    <div class="panel-footer">
                                        <span class="pull-left">View Details</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- / Admin Widget -->


                    <div class="row">


                         <script type="text/javascript">
                          google.charts.load('current', {'packages':['corechart']});
                          google.charts.setOnLoadCallback(drawChart);

                          function drawChart() {

                            var data = google.visualization.arrayToDataTable([
                              ['Data', 'Count'],
                              
                              <?php

                                $data_elements = ['Total Posts', 'Published Posts', 'Comments', 'Pending Comments', 'No. of Users', 'Total Subscribers', 'Categories'];
                                $data_count = [$num_posts, $num_published_posts, $num_comments, $num_disapproved_comments, $num_users, $num_subscribed_users, $num_categories];


                                for($i = 0; $i < 7; $i++)
                                {
                                    echo "['$data_elements[$i]', $data_count[$i]], ";
                                }

                              ?>
                            ]);

                            var options = {
                              title: 'Activities in Website : '
                            };

                            var chart = new google.visualization.ColumnChart(document.getElementById('column_chart'));

                            chart.draw(data, options);
                          }
                        </script>

                         <div id="column_chart" style="width: 900px; height: 500px;"></div>
                    </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <script src="js/scripts.js"></script>


</body>

</html>
