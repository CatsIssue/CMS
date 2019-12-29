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
                    <?php
                        if (isset($_GET['source'])) {
                            $source = $_GET['source'];
                        } else { 
                            $source = "";
                        }

                        switch ($source) {
                            case 'add_post':
                                include_once "includes/add_post.php";
                                break;
                            case 'edit_post':
                                include_once "includes/edit_post.php";
                                break;
                                    
                            case '200':
                                echo "Nice 200";
                                break;
                            default:
                                include_once "includes/view_all_comments.php";
                        }

                    ?>
                    </div>
                    
                </div>
                <!-- /.row -->
                                        
            <!-- /.container-fluid -->

<?php 
    $query = "SELECT * FROM categories";
    $select_categories = mysqli_query($connection, $query);
    while ($row = mysqli_fetch_assoc($select_categories)) {

    }
?>
        </div>
        <!-- /#page-wrapper -->

<?php
    include_once "includes/admin_footer.php";

?>