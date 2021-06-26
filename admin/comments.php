<?php ob_start(); ?>
<?php require('./includes/admin_header.php'); ?>

<body>

    <div id="wrapper">

        <?php require('./includes/admin_navigation.php'); ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                           Welcome Admin
                            <small>Author</small>
                        </h1>

                        <!-- Show All Posts Here -->
                        <?php 

                            if(isset($_GET['source']))
                            {
                                $source = $_GET['source'];
                            }
                            else
                            {
                                $source = '';
                            }

        
                            switch($source)
                            {
                                case 'add_post' :
                                    require('./includes/admin_add_post_form.php');
                                    break;

                                case 'post_comments' :

                                    if(isset($_GET['c_p_id']))
                                    {
                                        $c_p_id = $_GET['c_p_id'];
                                    }
                                    else
                                    {
                                        break;
                                    }
                                    require('./includes/admin_post_comments.php');
                                    break;

                                default : 
                                    require('./includes/admin_show_comments.php');
                                    break;
                            }

                        ?>
                    
                    </div>
                </div>
                <!-- /.row -->

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
