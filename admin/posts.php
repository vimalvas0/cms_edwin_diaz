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
                                case 'add_post' :
                                    require('./includes/admin_add_post_form.php');
                                    break;

                                case 'edit_post' :
                                    require('./includes/admin_edit_post.php');
                                    break;

                                default : 
                                    require('./includes/admin_show_post_table.php');
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

    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

    <script src="js/scripts.js"></script>


    <script>
        const selectAll = document.getElementById('selectAllBoxes');
        const allBoxes = document.querySelectorAll('.checkBoxes');
        selectAll.addEventListener('click', function(e)
        {
            if(selectAll.checked)
            {
                allBoxes.forEach(function(box){
                    box.checked = true;
                });
            }else if(!selectAll.checked)
            {
                allBoxes.forEach(function(box){
                    box.checked = false;
                });
            } 
        });

</script>

</body>

</html>
