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

                    <?php 
                    
                    if(isset($_GET['source'])){
                        $source = $_GET['source'];
                    } else {
                        $source = '';
                    }

                    switch($source){
                        case 'add_post':        
                            include 'include/add_post.php';
                            break;
                        
                        case 'edit_post':
                            include 'include/edit_post.php';
                            break;

                        default:
                            include 'include/view_all_comments.php';
                            break;
                    }

                    ?>

                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    <?php include "include/admin_footer.php";?>
