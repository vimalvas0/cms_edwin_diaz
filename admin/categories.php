<?php ob_start(); ?>
<?php require('./includes/admin_header.php'); ?>
s
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


                        <!-- Adding the Add, Update and Delete a Category -->
                        <?php require('./includes/admin_categories_crud.php'); ?>


                        <div class="col-xs-6">
                            <form action="categories.php" method="POST">
                                <div class="form-group">
                                    <label for="cat-title"class="">Add a Category</label>
                                    <input class="form-control" type="text" name="add-category">
                                </div>
                                <div class="form-group">
                                    <input class="btn btn-primary" type="submit" name="add-submit">
                                </div>
                            </form>


                            <?php 

                            if(isset($_GET['edit']))
                            {
                                // Show Update Form here if edit is requested....
                                require('./includes/admin_show_update_form.php');
                            }

                            ?>

                        </div>
                
                        <div class="col-xs-6">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Category</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <!-- Load Categories Rows From This File -->
                                    <?php require('./includes/admin_load_categories.php'); ?>

                                </tbody>
                            </table> 
                            

                            <?php
                            // Some messages if 
                                if(isset($delete_successful))
                                {
                                    echo $delete_successful;
                                }
                             ?>
                        </div>

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
