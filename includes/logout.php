<?php 

session_start();

$_SESSION['user_id'] = null;
$_SESSION['username'] = null;
$_SESSION['firstname'] = null;
$_SESSION['lastname'] = null;
$_SESSION['role'] = null;
$_SESSION['login'] = NULL;


header('Location: ../index.php');