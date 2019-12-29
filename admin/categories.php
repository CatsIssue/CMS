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
                        </h1>
                       
                        <div class="col-xs-6">
                            <?php
                               insert_categories();
                            ?> 

                            <form action="" method = "post">
                                <label for="cat-title">Add category</label>
                                <div class="form-group">
                                    <input type="text" name = "cat_title">
                                </div>
                                <div class="form-group">
                                    <input class = "btn btn-primary btn-lg" type="submit" name = "submit" value = "Add category">
                                </div>
                            </form>

                            <?php 
                                if (isset($_GET['edit'])) {
                                    $cat_id = $_GET['edit'];
                                    include "includes/update_categories.php";
                                }
                            ?>
                        </div>

                        <div class="col-xs-6">
                            <table class = "table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Category Title</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    findAllCategories();
                                    deleteCategories();
                                    
                                   
                                    ?>
                                   
                                </tbody>


                       
                            </table>
                        </div>
                        
                    </div>
                    
                </div>
                <!-- /.row -->
                                        
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

<?php
    include_once "includes/admin_footer.php";

?>