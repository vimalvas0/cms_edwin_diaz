<?php ob_start(); ?>
<?php require('./includes/admin_header.php'); ?>

<body>

    <div id="wrapper">

        <?php require('./includes/admin_navigation.php'); ?>


        <?php require('./functions.php'); 

        // if(!is_admin($_SESSION['username']))
        // {
        //     header('Location: ./index.php');
        // }

        if(!is_admin($_SESSION['username']))
        {
            header('Location: ./index.php');
        }

    ?>

        <div id="page-wrapper">

            <div class="container-fluid">

               <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <?php require('./includes/admin_dropdown.php'); ?>

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
                                case 'add_user' :
                                    require('./includes/admin_add_user.php');
                                    break;

                                case 'edit_user' :
                                    require('./includes/admin_edit_user.php');
                                    break;

                                default : 
                                    require('./includes/admin_show_users.php');
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
