<?php include "include/admin_header.php";?>

    <div id="wrapper">
       
    <?php include "include/admin_nav.php";?>
    

        <div id="page-wrapper">

            <div class="container-fluid">

                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to Admin
                            
                        </h1>

                        <div class="col-xs-6">

                        <?php insert_categories();?>
                        <form method="POST">
                                <div class="form-group">
                                    <label for="cat_title">Add Category</label>
                                    <input type="text" class="form-control" name="cat_title">
                                </div>
                                <div class="form-group">
                                    <input class="btn btn-primary" type="submit" name="submit" value="Add category">
                                </div>
                            </form>

                            <?php 
                            if(isset($_GET['edit'])){
                                include "include/update_categories.php";
                            }
                            ?>
                             
                        </div>
                       

                        <div class="col-xs-6">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Category Title</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>

                                    <!-- Find all categories and display in a table -->
                                    <?php findAllcategories()?>

                                <!--  // Delete category -->    
                                <?php deleteCategory();?>
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

    <?php include "include/admin_footer.php";?>
