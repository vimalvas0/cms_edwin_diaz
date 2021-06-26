 <!-- Dynamically Load the Category Rows from the database -->
<?php
    // Get all rows
    $query = "SELECT * FROM category";
    $all_categories = mysqli_query($conn, $query);

    while($row = mysqli_fetch_assoc($all_categories))
    {   
?>
            <tr>
                <td><?php echo $row['cat_id']; ?></td>
                <td><?php echo $row['cat_title']; ?></td>
                <td><a href="categories.php?delete=<?php echo $row['cat_id']; ?>">Delete</a>
                <a href="categories.php?edit=<?php echo $row['cat_id']; ?>">Edit</a></td>
            </tr>
<?php } ?>