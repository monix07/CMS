<?php

if(isset($_POST['create_post'])) {
    $post_title = $_POST['post_title'];
    $post_author = $_POST['post_author'];
    $post_category_id = $_POST['post_category'];
    $post_status = $_POST['post_status'];
    
    $post_image = $_FILES['image']['name'];
    $post_image_temp = $_FILES['image']['tmp_name']; // this enables a folder to contain temp files
    $post_tags = $_POST['post_tags'];
    $post_content = $_POST['post_content'];
    $post_date = date('d-m-y');
    $post_comment_count = 4;
                                         
     move_uploaded_file($post_image_temp, "../images/$post_image");
    //function to move the file to the image folder. Make sure to change permissions. Go to this link https://stackoverflow.com/questions/9046977/xampp-permissions-on-mac-os-x
    $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_comment_count, post_status) ";
    //this query for posts table in cms database
    $query .= "VALUES('{$post_category_id}', '{$post_title}', '{$post_author}', now(), '{$post_image}', '{$post_content}', '{$post_tags}', {$post_comment_count}, '{$post_status}' ) ";
    
    $create_post_query = mysqli_query($connection, $query);
    confirmQuery($create_post_query); //this function is in  the functions file
    }
   
?>


<form action="" method="post" enctype="multipart/form-data">
<!--   add the enctype to make image upload work-->
    <div class="form-group">
        <label for="post_title">Post Title</label>
        <input type="text" class="form-control" name="post_title">
    </div>

   
   <div class="form-group">
    <label for="">Categories</label>
        <select name="post_category" id="">
            <?php 
            $query = "SELECT * FROM categories"; 
            $select_categories = mysqli_query($connection, $query);  

            confirmQuery($select_categories);

            while($row = mysqli_fetch_assoc($select_categories)) {
            $cat_id = $row['cat_id'];
            $cat_title = $row['cat_title'];

            echo "<option value=''>{$cat_title}</option>";

            }
            ?>

        </select>
    </div>
    
    <div class="form-group">
    <label for="post_author">Post Author</label>
    <input type="text" class="form-control" name="post_author">
    </div>
    
    <div class="form-group">
    <label for="post_status">Post Status</label>
    <input type="text" class="form-control" name="post_status">
    </div>
    
    <div class="form-group">
    <label for="post_image">Post Image</label>
    <input type="file" name="image">
    </div>
    
    <div class="form-group">
    <label for="post_tags">Post Tags</label>
    <input type="text" name="post_tags" class="form-control">
    </div>
    
    
    <div class="form-group">
    <label for="post_content">Post Content</label>
    <textarea name="post_content" id="" cols="30" rows="10" class="form-control"></textarea>
    </div>
    
    <input type="submit" role="button" class="btn btn-md btn-primary" name="create_post" value="Publish Post">
    
    
    
    
</form>