<!-- <?php  include "includes/db.php"; ?> -->
 <?php  include "includes/header.php"; ?>


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


                $username = mysqli_real_escape_string($conn, $username);
                $email = mysqli_real_escape_string($conn, $email);
                $password = mysqli_real_escape_string($conn, $password);



                if(!empty($username) && !empty($email)  && !empty($password) && !empty($user_firstname) && !empty($user_lastname))
                {
                    // $salt = '$2y$10$iapplyacrazystring2021';
                    // $password = crypt($password, $salt);


                    // Using password_hash instead :
                    $password = password_hash($password, PASSWORD_DEFAULT, array('cost' => 12));

                    $query = "INSERT INTO users (username, user_firstname, user_lastname, user_email, password, user_role, user_image, user_date) ";
                    $query .= "VALUES ('$username', '$user_firstname', '$user_lastname', '$email', '$password', 'subscriber', 'not set', now())";

                    $register_user = mysqli_query($conn, $query);


                    if($register_user)
                    {
                        $message = "User successfully registered. You can go into profile option modify your profile."; 
                    }
                    else
                    {
                        die("QUERY FAILED " . mysqli_error($conn));
                    }
                }
                else
                {
                    $message = "Please fill all fields. All are necessary to be filled.";
                }
            }
            else
            {
                $message = "";
            }

    ?>
    
 
    <!-- Page Content -->
    <div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Contact Me</h1>
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                        <div style="text-align: center;"><b><?php echo $message; ?></b></div>     
                        <div class="form-group">
                            <label for="inquistor_name" class="sr-only">Your Name</label>
                            <input type="text" name="inquistor_name" id="username" class="form-control" placeholder="Enter your name">
                        </div>
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
                        </div>
                         <div class="form-group">
                            <label for="body" class="sr-only">Password</label>
                            <textarea width='100%' name="body" placeholder="I would love to hear you!"
                            style="margin: 0px; width: 555px; height: 57px;"></textarea>
                        </div>
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Send">
                    </form>
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>
