<?php

function confirmQuery($result) {
    global $connection;
    if(!$result) {
        die("Query failed" . mysqli_error($connection));
}
    
}

function insert_categories() {
   global $connection; //always check to make connection function available 
    if(isset($_POST['submit'])) {
      $cat_title =  $_POST['cat_title'];

        if($cat_title == "" || empty($cat_title)) {
            echo "Field should not be empty";
        } else {
            $query = "INSERT INTO categories(cat_title) ";
            //cat_title is the table in the db
            $query .= "VALUES('{$cat_title}') ";

            $create_category_query = mysqli_query($connection, $query);

            if(!$create_category_query) {
                die('The query failed' . mysqli_error($connection));
            }
        }
    }
}


function findAllCategories() {
global $connection;
$query = "SELECT * FROM categories "; //add LIMIT 3 to limit the number of categories 
            $select_categories = mysqli_query($connection, $query);  
            while($row = mysqli_fetch_assoc($select_categories)) {
            $cat_id = $row['cat_id'];
            $cat_title = $row['cat_title'];

            echo "<tr>";
            echo "<td>{$cat_id}</td>";
            echo "<td>{$cat_title}</td>";
            echo "<td><a href='categories.php?delete={$cat_id}'>Delete</a></td>";
            echo "<td><a href='categories.php?edit={$cat_id}'>Edit</a></td>";
            echo "</tr>";
                //this creates the table on the right on the categories page
            }
}

function deleteCategories() {
global $connection;
if(isset($_GET['delete'])) {
                $the_cat_id = $_GET['delete'];
                $query = "DELETE FROM categories WHERE cat_id = {$the_cat_id} ";
                $delete_query = mysqli_query($connection, $query);
                header("Location: categories.php"); // refreshes the page automatically, if not you have to delete twice the cat ID
                    }
}

















?>
