<?php include "includes/admin_header.php"; ?>  
    <div id="wrapper">
        <!-- Navigation -->
        <?php include "includes/admin_navigation.php"; ?>

        <div id="page-wrapper">
            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to the Admin Page
                            <small>Author</small>
                        </h1>
                        
                        <div class="col-xs-6">
                        <!-- function detects data from form below placed in functions file-->
                           <?php insert_categories(); ?>
                           
                            <form action="" method="post">
                                <div class="form-group">
                                   <label for="">Add category</label>
                                    <input class="form-control" type="text" name="cat_title">
                                    
                                </div>
                                <div class="form-group">
                                    <input type="submit" name="submit" value="Add category" class="btn btn-primary">
                                </div>
                            </form>
                            
                            <?php // UPDATE and INCLUDE - adds the form from separate file to appear here when updating the categories
    
                            if(isset($_GET['edit'])) {
                                $cat_id = $_GET['edit'];
                                include "includes/update_categories.php";
                            }
                            ?>
                            
                            
                        </div>
                        <div class="col-xs-6">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Category Title</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                       
                            <?php findAllCategories();?> 
<!--                            FInd All Categories query-->
                            <?php deleteCategories(); ?> 
<!--                                        Delete query-->
                                       
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                        
                        

                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
<?php include "includes/admin_footer.php"; ?>