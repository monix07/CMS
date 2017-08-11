<?php
if(isset($_GET['p_id'])) {
    $the_post_id = $_GET['p_id'];
}

$query = "SELECT * FROM posts WHERE post_id = $the_post_id "; 
$select_posts_by_id = mysqli_query($connection, $query);  

        while($row = mysqli_fetch_assoc($select_posts_by_id)) {
            $post_id = $row['post_id'];
            $post_author = $row['post_author'];
            $post_title = $row['post_title'];
            $post_category_id = $row['post_category_id'];
            $post_status = $row['post_status'];
            $post_image = $row['post_image'];
            $post_tags = $row['post_tags'];
            $post_comment_count = $row['post_comment_count'];
            $post_date = $row['post_date'];
            $post_content = $row['post_content']; // added later not in view all posts
        }

if(isset($_POST['update_post'])) {
    $post_title = $_POST['post_title'];
    $post_author = $_POST['post_author'];
    $post_category_id = $_POST['post_category_id'];
    $post_status = $_POST['post_status'];
    $post_image = $_FILES['image']['name'];
    $post_image_temp = $_FILES['image']['tmp_name']; // this enables a folder to contain temp files
    $post_tags = $_POST['post_tags'];
    $post_content = $_POST['post_content'];

    move_uploaded_file($post_image_temp, "../images/$post_image"); // this places images in temp file
    
    if(empty($post_image)) {
        //this fixes the broken image issue in the edit post
        $query = "SELECT * FROM posts WHERE post_id = $the_post_id ";
        $select_image = mysqli_query($connection, $query);
        
        while($row = mysqli_fetch_array($select_image)) {
            $post_image = $row['post_image'];
        }
    }
    
    $query = "UPDATE posts SET ";
    $query .= "post_title = '{$post_title}', ";
    $query .= "post_category_id = '{$post_category_id}', ";
    $query .= "post_author = '{$post_author}', ";
    $query .= "post_date = now(), ";
    $query .= "post_status = '{$post_status}', ";
    $query .= "post_tags = '{$post_tags}', ";
    $query .= "post_content = '{$post_content}', "; //make sure space after comma
    $query .= "post_image = '{$post_image}' "; //make sure no comma here
    $query .= "WHERE post_id = '{$the_post_id}' ";
    
    $update_post = mysqli_query($connection, $query);
    confirmQuery($update_post);
    
}

?>

<form action="" method="post" enctype="multipart/form-data">
<!--   add the enctype to make image upload work-->
   <h2 class="text-danger">Edit post</h2>
    <div class="form-group">
        <label for="post_title">Post Title</label>
        <input value="<?php echo $post_title; ?>" type="text" class="form-control" name="post_title">
    </div>
    
    <div class="form-group">
    <label for="post_category_id">Post Category ID</label>
    <input value="<?php echo $post_category_id; ?>" type="text" class="form-control" name="post_category_id">
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
    <input value="<?php echo $post_author; ?>" type="text" class="form-control" name="post_author">
    </div>
    
    <div class="form-group">
    <label for="post_status">Post Status</label>
    <input value="<?php echo $post_status; ?>" type="text" class="form-control" name="post_status">
    </div>
    
    <div class="form-group">
    <img src="..//images/<?php echo $post_image;?>" alt="" width=200>
    <input type="file" name="image">
    </div>
    
    <div class="form-group">
    <label for="post_tags">Post Tags</label>
    <input value="<?php echo $post_tags; ?>" type="text" name="post_tags" class="form-control">
    </div>
    
    
    <div class="form-group">
    <label for="post_content">Post Content</label>
    <textarea name="post_content" id="" cols="30" rows="10" class="form-control"><?php echo $post_content; ?></textarea>
    </div>
    
    <input type="submit" role="button" class="btn btn-md btn-primary" name="update_post" value="Update Post">
    
</form>