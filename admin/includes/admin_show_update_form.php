<?php

    $id = $_GET['edit'];

    $query = "SELECT * FROM category WHERE cat_id = '$id'";

    $get_result_query = mysqli_query($conn, $query);


    if(!$get_result_query)
    {
        die("There was some problem");
    }

    while($row = mysqli_fetch_assoc($get_result_query))
    {      ?>

        <form action="categories.php?update=<?php echo $row['cat_id']; ?>" method="POST">
            <div class="form-group">
                <label for="cat-title"class="">Update Category</label>
                <input value="<?php echo $row['cat_title']; ?>" class="form-control" type="text" name="update-category">
            </div>
            <div class="form-group">
                <input class="btn btn-primary" type="submit" name="update-submit">
            </div>
        </form>

<?php }   ?>