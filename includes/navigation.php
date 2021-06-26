<?php session_start(); ?> 

 <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">CMS</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">

                    <?php 

                        // Get all rows
                        $query = "SELECT * FROM category";
                        $all_rows_query = mysqli_query($conn, $query);


                        $pageName = basename($_SERVER['PHP_SELF']);

                        $registration_class = '';
                        $category_class = '';

                        while($row = mysqli_fetch_assoc($all_rows_query))
                        {
 
                        if(isset($_GET['cat_id']))
                        {
                            if($_GET['cat_id'] == $row['cat_id'])
                            {
                                $category_class = 'active';
                            }
                            else
                            {
                                $category_class = '';
                            }
                        }

                           echo "<li class='". $category_class . "'>
                                    <a href='./index.php?cat_id=" . $row['cat_id'] . "'>" . $row['cat_title'] . "</a>
                                </li>";
                        }


                        if($pageName == 'registration.php')
                        {
                            $registration_class = 'active';
                        }

                    ?>

                    <li>
                        <a href="./includes/admin_header.php">Admin</a>
                    </li>


                    <li class="<?php echo $registration_class; ?>">
                        <a href="./registration.php">Register</a>
                    </li>



                    <?php 

                    if(isset($_SESSION['role']))
                    {
                        if(isset($_GET['p_id']))
                        {
                            $p_id = $_GET['p_id'];
                            echo "<li><a href='./admin/posts.php?source=edit_post&edit=$p_id'>Edit this post</a></li>";
                        }
                    }

                    ?>

                    
                   <!--  <li>
                        <a href="#">Services</a>
                    </li>
                    <li>
                        <a href="#">Contact</a>
                    </li> -->
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
