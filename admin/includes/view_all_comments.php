<?php
    include_once "includes/admin_header.php";
?>
<body>

    <div id="wrapper">





    <?php
        include_once "includes/admin_navigation.php";

    ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                                Blank Page
                        <small>Subheading</small>

                        <table class="table table-bordered table-hover">
                            <thead>
                                <th>ID</th>
                                <th>Author</th>
                                <th>Content</th>
                                <th>Email</th>
                                <th>In responce to</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Approve</th>
                                <th>Unapprove</th>
                                <th>Delete</th>

                            </thead>
                            <tbody>
                            <?php 
                                $query = "SELECT * FROM comments";
                                $select_posts = mysqli_query($connection, $query);
                                while ($row = mysqli_fetch_assoc($select_posts)) {
                                        $comment_id = $row['comment_id'];
                                        $comment_post_id = $row['comment_post_id'];
                                        $comment_author = $row['comment_author'];
                                        $comment_date = $row['comment_date'];
                                        $comment_email = $row['comment_email'];
                                        $comment_content = $row['comment_content'];
                                        $comment_status = $row['comment_status'];

                                        echo "<tr>";
                                        echo "<td>{$comment_id}</td>";
                                        echo "<td>{$comment_author}</td>";
                                        echo "<td>{$comment_content}</td>";
                                        echo "<td>{$comment_email}</td>";
                                        // echo "<td>{$comment_post_id}</td>";
                                        
                                        $query = "SELECT * FROM posts WHERE post_id = $comment_post_id";
                                        $select_post_id_query = mysqli_query($connection, $query);

                                        while($row = mysqli_fetch_assoc($select_post_id_query)) {
                                             $post_id = $row['post_id'];
                                             $post_title = $row['post_title'];
                                             echo "<td><a href = '../post.php?p_id=$post_id'>{$post_title}</a></td>";
                                        }

                                        echo "<td>{$comment_status}</td>";

                                    

                                        echo "<td>{$comment_date}</td>";
                                        echo "<td><a href='comments.php?approve={$comment_id}'>Approve</a></td>";
                                        echo "<td><a href='comments.php?unapprove={$comment_id}'>Unapprove</a></td>";
                                        echo "<td><a href='comments.php?delete={$comment_id}'>Delete</a></td>";
                                }
                                ?>
                            </tbody>
                        </table>

                        <?php
                            if(isset($_GET['unapprove'])) {
                                $the_comment_id = $_GET['unapprove'];

                                $query = "UPDATE comments set comment_status = 'unapprove'  WHERE comment_id = $the_comment_id ";
                                $unapprove_comment = mysqli_query($connection, $query);
                                
                                header("Location: comments.php");
                                
                                if(!$unapprove_query) {
                                    die("Query failed " . mysqli_error($connection));
                                } else {
                                    echo "Success";
                                }
                            }
                             
                            if(isset($_GET['approve'])) {
                                $the_comment_id = $_GET['approve'];

                                $query = "UPDATE comments set comment_status = 'approve' WHERE comment_id = $the_comment_id";
                                $approve_comment = mysqli_query($connection, $query);
                                
                                header("Location: comments.php");
                                
                                if(!$approve_comment) {
                                    die("Query failed " . mysqli_error($connection));
                                } else {
                                    echo "Success";
                                }
                            }       
                            if(isset($_GET['delete'])) {
                                $the_comment_id = $_GET['delete'];

                                $query = "DELETE FROM comments WHERE comment_id = $the_comment_id";
                                $delete_comment = mysqli_query($connection, $query);
                                
                                header("Location: comments.php");
                                
                                if(!$delete_query) {
                                    die("Query failed " . mysqli_error($connection));
                                } else {
                                    echo "Success";
                                }
                            }
                        ?>
                    </div>
                    
                </div>
                <!-- /.row -->
                                        
            <!-- /.container-fluid -->

<?php 
    if (isset($_GET['delete'])) {
        $the_post_id = $_GET['delete'];
        $query = "DELETE FROM posts WHERE post_id = {$the_post_id}";

        $delete_query = mysqli_query($connection, $query);
        
    }
?>
        </div>
        <!-- /#page-wrapper -->

<?php
    include_once "includes/admin_footer.php";

?>