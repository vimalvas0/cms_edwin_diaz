<?php 

// Putting all the db information in one file
$db = array(
    'db_host' => 'localhost',
    'db_user' => 'vimal',
    'db_password' => 'unme4ever',
    'db_name' => 'cms'
);


//Defining constants for db variables :

foreach($db as $key => $value){
    define(strtoupper($key), $value);
}


// Setting up database
// $conn = mysqli_connect('localhost', 'vimal', 'unme4ever', 'cms');

// Preferred way to do this
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);



if($conn)
{
    echo "We are connected";
}



?>