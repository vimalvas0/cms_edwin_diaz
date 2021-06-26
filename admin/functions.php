<?php 

// Whereever you are storing information in db, you need to escape the string
function escape($string)
{
    global $conn;
    return mysqli_real_escape_string($conn, $string);
}


function sayHello()
{
    echo 'HELLO WORLD';
}


function countRows($table)
{
    global $conn;

    $query = "SELECT * FROM " . $table;
    $all_table_values = mysqli_query($conn, $query);
    $num_table_values = mysqli_num_rows($all_table_values);

    confirm($num_table_values);

    return $num_table_values;
}






function insert_category()
{
    global $conn;

    if($_POST['add-category'] == "")
    {
        echo "<h2>You have added <i>nothing?</i><h2>";
        
    }else
    {
        $cat_title = $_POST['add-category'];
        $query = "INSERT INTO category (cat_title) VALUES ('$cat_title')";
        $added_successfully = mysqli_query($conn, $query);
        if($added_successfully)
        {
            header('Location: categories.php');
        }
        else
        {
            die("There was some problem in adding...");
        }

    }

}



function update_category()
{

    global $conn;

    if($_POST['update-category'] == "")
    {
        echo "<h2>You have added <i>nothing?</i><h2>";
    }else
    {
        $cat_id = $_REQUEST['update'];
        $cat_title = $_POST['update-category'];
        echo $cat_id . " " . $cat_title;
        $query = "UPDATE category SET cat_title = '$cat_title' WHERE cat_id = '$cat_id'";
        $updated_successfully = mysqli_query($conn, $query);
        if($updated_successfully)
        {
            header('Location: categories.php');
        }
        else
        {
            die("There was some error updating category.");
        }

    }
}



function delete_category()
{
    global $conn;

    $id = $_GET['delete'];

    $query = "DELETE FROM category WHERE cat_id = '$id'";

    $delete_query = mysqli_query($conn, $query);

    if($delete_query)
    {
        $delete_successful = "Successfully Deleted.";
    }


    header('Location: categories.php');

}


function confirm($query_check)
{

    global $conn;
    if(!$query_check)
    {
        die("Query Failed ");
    }
}



function users_online()
{

    global $conn;


    $session = session_id();
    $time = time();
    $time_out_in_seconds = 60;
    $time_out = $time - $time_out_in_seconds;


    $query = "SELECT * FROM users_online WHERE session = '$session'";
    $send_query = mysqli_query($conn, $query);


    // If no result is found with such session : 
    if(mysqli_num_rows($send_query) == NULL)
    {   
        // Have this user in our online list : 
        mysqli_query($conn, "INSERT INTO users_online(session, time) VALUES('$session', '$time')");
    }else
    {
        // Otherwise update when he last came in.. that's it.
        mysqli_query($conn, "UPDATE users_online SET time = '$time' WHERE session = '$session'");
    }


    $users_online  = mysqli_query($conn, "SELECT * FROM users_online WHERE time > $time_out");

    $num_users_online = mysqli_num_rows($users_online);


    return $num_users_online;

}



function is_admin($username = '')
{
    global $conn;

    $query = "SELECT * FROM users WHERE username = '$username'";

    $result  = mysqli_query($conn, $query);

    $row = mysqli_fetch_assoc($result);

    if($row['user_role'] == 'admin')
    {
        return true;
    }
    else
    {
        return false;
    }
}


function username_already_taken($username = '')
{
    global $conn;

    $query = "SELECT * FROM users WHERE username = '$username'";

    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) > 0)
    {
        return true;
    }
    else
    {
        return false;
    }
}



function email_already_registered($user_email = '')
{
    global $conn;

    $query = "SELECT * FROM users WHERE user_email = '$user_email'";

    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) > 0)
    {
        return true;
    }
    else
    {
        return false;
    }
}


function register_user($username, $email, $password, $user_firstname, $user_lastname){

    global $conn;

    $username = mysqli_real_escape_string($conn, $username);
    $email = mysqli_real_escape_string($conn, $email);
    $password = mysqli_real_escape_string($conn, $password);

    $password = password_hash($password, PASSWORD_DEFAULT, array('cost' => 12));

    $query = "INSERT INTO users (username, user_firstname, user_lastname, user_email, password, user_role, user_image, user_date) ";
    $query .= "VALUES ('$username', '$user_firstname', '$user_lastname', '$email', '$password', 'subscriber', 'not set', now())";

    $register_user = mysqli_query($conn, $query);


    if($register_user)
    {
        return array(
            'message' => "User successfully registered. You can go into profile option modify your profile.", 
            'status' => 'success'
        );
    }
    else
    {
        return array(
            'message' => "User Registation failed. Query Error", 
            'status' => 'failure'
        );
    }

}


function validate_user($username, $email, $password, $user_firstname, $user_lastname){

    $errors = array();
    
    if(!empty($username) && !empty($email)  && !empty($password) && !empty($user_firstname) && !empty($user_lastname))
    {
        $errors[] = "Please fill all fields. All are necessary to be filled.";
    }

    if(strlen($username) < 4)
    {
        $errors[] = "Username must be atleast 4 digit long";
    }
    if(!username_already_taken($username))
    {
        $errors[] = "This Username is already taken. Please try with different username.";
    }

    if(!email_already_registered($email))
    {

        $errors[] = "This email is already registered with one of our accounts. Please use another email.";
    }


    if(sizeof($errors) > 0) 
    {
        $any_error = true;
    }
    {
        $any_error = false;
    }


    return [
        'any_error' => $any_error,
        'errors' => $errors
    ];

}





?>