<?php

    require('./functions.php');
/*
    **  CATEGORIES CRUD **
    Logic to Handle Add, Update and Delete A cateogry
    To be Exported to : cms/admin/categories.php

*/
    if(isset($_POST['add-submit']))
    {   
        insert_category();
    }
    elseif(isset($_POST['update-submit']))
    {
        update_category();
    }
    elseif(isset($_GET['delete']))
    {
        delete_category();
    }
?>
