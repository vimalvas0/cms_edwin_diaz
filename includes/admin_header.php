<?php include('./db.php');

    session_start();

    if(!isset($_SESSION['role']))
    {
        header('Location: ../index.php');
    }
    elseif($_SESSION['role'] == 'admin')
    {
        header('Location: ../admin/index.php');
    }
    else
    {
        header('Location: ../index.php');
    }

?>