<?php
    if (isset($_POST['create_post'])) {
        $post_title = $_POST['title'];
        $post_author = $_POST['author'];
        $post_category_id = $_POST['post_category_id'];
        $post_status = $_POST['post_status'];

        $post_image = $_FILES['post_image']['name'];
        $post_image_temp = $_FILES['post_image']['tmp_name'];

        $post_tags = $_POST['post_tags'];
        $post_content = $_POST['post_content'];
        $post_date = date('d-m-y');
        $post_comment_count = 4;

        move_uploaded_file($post_image_temp, "../images/$post_image");
        
        $query = "INSERT INTO posts(post_category_id, post_title, post_author, ";
        $query .= "post_date, post_image, post_content, post_tags, post_comment_count, ";
        $query .= "post_status) VALUES('{$post_category_id}', '{$post_title}', '{$post_author}', now(), '{$post_image}',";
        $query .= " '{$post_content}', '{$post_tags}', '{$post_comment_count}', '{$post_status}')";

        $create_post_query = mysqli_query($connection, $query);

       confirm($create_post_query);
    }
?>
<form action="" method = "post" enctype = "multipart/form-data">
    <div class="form-group">
        <label for="title">Post title</label>
        <input type="text" name = "title" class = "form-control">
    </div>

    <div class="form-group">
        <select name="post_category_id" id="">
        <?php
            $query = "SELECT * FROM categories";
            $select_categories = mysqli_query($connection, $query);
            
            confirm($select_categories);
            while($row = mysqli_fetch_assoc($select_categories)) {
                $cat_id = $row['cat_id'];
                $cat_title = $row['cat_title'];       
                echo "<option value='{$cat_id}'>{$cat_title}</option>";
            }
        ?>
        </select>
    </div>

    <div class="form-group">
        <label for="author">Post Author</label>
        <input type="text" name = "author" class = "form-control">
    </div>

    <div class="form-group">
        <label for="post_status">Post Status</label>
        <input type="text" name = "post_status" class = "form-control">
    </div>

    <div class="form-group">
        <label for="post_image">Post image</label>
        <input type="file" name = "post_image" class = "form-control">
    </div>

    <div class="form-group">
        <label for="post_tags">Post tags</label>
        <input type="text" name = "post_tags" class = "form-control">
    </div>

    <div class="form-group">
        <label for="post_content">Post content</label>
        <textarea type="text" name = "post_content" id = ""cols = "30" 
        rows = "10" class = "form-control"> </textarea>
    </div>

    <div class="form-group">
        <input type="submit" class = "btn btn-primary btn-lg" name = "create_post" value = "publish post">
    </div>
</form>
