<?php 
    

    // WE are going to learn about the password_hash()


    echo password_hash('secret', PASSWORD_DEFAULT, array('cost' => 12));



?>