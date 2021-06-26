 <?php  include "includes/db.php"; ?> 
 <?php  include "includes/header.php"; ?>
 <?php  include "./admin/functions.php"; ?>


    <!-- Navigation -->
    <?php  include "includes/navigation.php"; ?>

    <?php 

            if(isset($_POST['submit']))
            {
                $username =  $_POST['username'];
                $email =  $_POST['email'];
                $password =  $_POST['password'];
                $user_firstname = $_POST['user_firstname'];
                $user_lastname = $_POST['user_lastname'];

                $errors = array();

                $validated_user = validate_user($username, $email, $password, $user_firstname, $user_lastname);

                echo "pre";
                print_r($validated_user);
                echo "</pre>";

                // if($validated_user['any_error']){
                //     echo 'Yes';
                // }
                // else
                // {
                //     echo 'NO';
                // }

                // if(!$validated_user['any_error'])
                // {
                //     $errors_present = false;
                //     $registered_user = register_user($username, $email, $password, $user_firstname, $user_lastname);
                // }
                // else
                // {
                //     $errors_present = true;
                //     $errors = $validated_user['errors'];
                // }

            }

    ?>
    
 
    <!-- Page Content -->
    <div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Register</h1>
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">

                        <?php if(isset($_POST['submit']))
                        {
                                if($errors_present):

                                echo "<h3> There were few problems : </h3>";

                                foreach($errors as $error)
                                {

                        ?>
                                <div style="text-align: center;"><b><?php echo $error; ?></b></div>

                            <?php } ?>


                        <?php else: ?>
                                <div style="text-align: center;"><b><?php echo $registered_user['message']; ?></b></div>
                        <?php endif; ?>

                    <?php } ?>

                        <div class="form-group">
                            <label for="username" class="sr-only">username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Enter a username">
                        </div>
                        <div class="form-group">
                            <label for="user_firstname" class="sr-only">First Name</label>
                            <input type="text" name="user_firstname" id="username" class="form-control" placeholder="Enter your Firstname">
                        </div>
                        <div class="form-group">
                            <label for="user_lastname" class="sr-only">Last Name</label>
                            <input type="text" name="user_lastname" id="username" class="form-control" placeholder="Enter your Lastname">
                        </div>
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
                        </div>
                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="Password">
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>
