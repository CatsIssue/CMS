<?php
    include "includes/db.php";
    include "includes/header.php";
?>
<body>
<?php
    include "includes/navigation.php";
?>
    <!-- Page Content -->
    <div class="container">

        <div class="row">
            







            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <?php

                    if (isset($_GET['p_id'])) {
                        $the_post_id = $_GET['p_id'];
                    }
                    $query = "SELECT * FROM posts WHERE post_id = $the_post_id";
                    $select_all_posts_query = mysqli_query($connection, $query);
                    while($row = mysqli_fetch_assoc($select_all_posts_query)) {
                        $post_title = $row['post_title'];
                        $post_date = $row['post_date'];
                        $post_image = $row['post_image'];
                        $post_content = $row['post_content'];
                        $post_author = $row['post_author'];

                 
                
                ?>

                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>

                <!-- First Blog Post -->
                <h2>
                    <a href="#"><?php echo $post_title?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $post_author?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image;?>" alt="">
                <hr>
                <p><?php echo $post_content ?></p>
                <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>
                
                    <?php } ?>

                 <!-- Comments Block-->
                 <?php 
                    if(isset($_POST['create_comment'])) {
                        
                        $the_post_id = $_GET['p_id'];
                        $comment_author = $_POST['comment_author'];
                        $comment_email = $_POST['comment_email'];
                        $comment_content = $_POST['comment_content'];

                        $query = "INSERT INTO comments (comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date)";
                        $query .= "VALUES ($the_post_id, '{$comment_author}', '{$comment_email}', '{$comment_content}'
                        , 'unapproved', now())";

                        $comments_query = mysqli_query($connection, $query);
                        
                        if(!$comments_query){
                            die("Query failed" . mysqli_error($connection));
                        } else {
                            echo "Success";
                        }
                    }
                 ?>
                 <!-- Comments Form -->
                 <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form action = "" method = "post" role="form">
                        <div class="form-group">
                            <label for="comment_author">Author</label>
                            <input type="text" class = "form-control" name = "comment_author">
                        </div>
                        <div class="form-group">
                            <label for="comment_email">Email</label>
                            <input type="text" class = "form-control" name = "comment_email">
                        </div>
                        <div class="form-group">
                            <label for="comment_content">My comment</label>
                            <textarea class="form-control" name = "comment_content" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" name = "create_comment">Submit</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->
                <?php
                    $query = "SELECT * FROM comments WHERE comment_id = $the_post_id ";
                    $query .= "AND comment_status = 'approve' ";
                    $query .= "ORDER BY comment_id DESC ";
                    
                    $select_comment_query = mysqli_query($connection, $query);
                    
                    if (!$select_all_posts_query) {
                        die("QUERY FAILED " . mysqli_error($connection));
                    }

                    while ($row = mysqli_fetch_assoc($select_all_posts_query)) {
                        $comment_date = $row['comment_date'];
                        $comment_content = $row['comment_content'];
                        $comment_author = $row['comment_author'];
                ?>
                <!-- Comment -->
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading">Start Bootstrap
                            <small><?php echo $comment_date?></small>
                        </h4>
                            <?php echo $comment_content?>
                    </div>
                </div>
                <?php
                    }
                ?>
                <!-- Comment -->
             

            </div>
            


 <?php
    include "includes/sidebar.php";
    echo "<hr>";
    include "includes/footer.php";
 ?>
