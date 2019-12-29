<?php 
    function insert_categories() {
        global $connection;
        if(isset($_POST['submit'])) {
            $cat_title = $_POST['cat_title']; 

            if (empty($cat_title)) {
                echo "<h1> cannot be empty </h1>"; 
            } else {
                echo $cat_title;
                $query = "INSERT INTO categories VALUES (NULL, '{$cat_title}') ";

                $create_category_query = mysqli_query($connection, $query);

                if (!$create_category_query) {
                    die("cannot add category" . mysqli_error($connection) );
                } else {
                    echo "<h1> SUCCESS </h1>";
                }
            }
        }
    }


    function findAllCategories() { 
        global $connection;                                                         
        $query = "SELECT * FROM categories";
        $select_categories = mysqli_query($connection, $query);

        while($row = mysqli_fetch_assoc($select_categories)) {
            echo "<tr>";
            $cat_id = $row['cat_id'];
            $cat_title = $row['cat_title'];
            echo "<td>{$cat_id}</td>";
            echo "<td>{$cat_title}</td>";
            echo "<td><a href = 'categories.php?delete={$cat_id}'>DELETE</a></td>";
            echo "<td><a href = 'categories.php?edit={$cat_id}'>EDIT</a></td>";
            echo "</tr>";
        }

    }

    function deleteCategories(){ 
        global $connection;
        if(isset($_GET['delete'])) {
            $the_cat_id = $_GET['delete'];
            $query = "DELETE FROM categories WHERE cat_id = {$the_cat_id}";
            $delete_query = mysqli_query($connection, $query);
            header("Location: categories.php");
            if(!$delete_query) {
                die("Cannot delete" . mysqli_error($connection));
            } else {
                echo "DELETED";
            }
        }
    }


    function confirm($result) {
        global $connection;
        if (!$result) {
            die ("Query failed " . mysqli_error($connection));
        }

        return $result;
    }
?>