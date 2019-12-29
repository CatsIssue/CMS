
    <form action="" method = "post">
        <label for="cat-title">Edit category</label>
        <?php
            $query = "SELECT * FROM categories WHERE cat_id = {$cat_id}";
            $select_categories_id = mysqli_query($connection, $query);

            while($row = mysqli_fetch_assoc($select_categories_id)) {
                $cat_id = $row['cat_id'];
                $cat_title = $row['cat_title'];       

        ?>
        <input value = "<?php if(isset($cat_title)) {echo $cat_title;} ?>" type = "text"   
        class = "form-control" name = "cat_title">

        <?php }  ?>

        <div class="form-group">
            <input class = "btn btn-primary btn-lg" type="submit" name = "update_category" value = "Update category">
        </div>
    </form>


    <?php // UPDATING
        if(isset($_POST['update_category'])) {
            $the_cat_title = $_POST['cat_title'];
            $query = "UPDATE categories SET cat_title = '{$the_cat_title}' WHERE cat_id = {$cat_id}";
            $update_query = mysqli_query($connection, $query);
            if(!$update_query) {
                die("Cannot update" . mysqli_error($connection));
            }
        }
    ?>
