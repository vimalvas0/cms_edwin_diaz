<?php include('./db.php');

    session_start();


if(isset($_POST['login']))
{
    $user_email = $_POST['user_email'];
    $password = $_POST['password'];

    $user_email = mysqli_real_escape_string($conn, $user_email);
    $password = mysqli_real_escape_string($conn, $password);

    // $salt = '$2y$10$iapplyacrazystring2021';

    // $password = crypt($password, $salt);


    $query = "SELECT * FROM users WHERE user_email = '$user_email'";
    $select_user = mysqli_query($conn, $query);

    if(!$select_user)
    {
        die("Query Failed : " . mysqli_error($conn));
    }


    while($row = mysqli_fetch_assoc($select_user))
    {
        $db_user_id = $row['user_id'];
        $db_username = $row['username'];
        $db_user_email = $row['user_email'];
        $db_password = $row['password'];
        $db_firstname = $row ['user_firstname'];
        $db_lastname = $row['user_lastname'];
        $db_user_role  = $row['user_role'];
        $db_user_image = $row['user_image'];

        if(!password_verify($password, $db_password))
        {
            header('Location: ../index.php');
        }
        else
        {
            $_SESSION['user_id'] = $db_user_id;
            $_SESSION['email'] = $db_user_email;
            $_SESSION['username'] = $db_username;
            $_SESSION['firstname'] = $db_firstname;
            $_SESSION['lastname'] = $db_lastname;
            $_SESSION['role'] = $db_user_role;
            $_SESSION['userimage'] = $db_user_image;
            $_SESSION['login'] = true;


            header('Location: ../admin/index.php');
        }
    }

}

?>