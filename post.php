<?php
include "includes/db.php"; 
include "includes/header.php";
?>
    <?php include "includes/nav.php"; ?>

    <div class="container">

        <div class="row">

            <div class="col-md-8">
                <?php 
                if(isset($_GET['p_id'])){
                $post_id = $_GET['p_id'];

                $view_query = "UPDATE postS SET post_views_count = post_views_count + 1 WHERE post_id = $post_id";
                $update_view_count = mysqli_query($connection,$view_query);
                $query = "SELECT * FROM posts where post_id = $post_id";
                $showAll_posts_query = mysqli_query($connection,$query);

                while($row = mysqli_fetch_assoc($showAll_posts_query)){
                    $post_title = $row['post_title'];
                    $post_author = $row['post_author'];
                    $post_user = $row['post_user'];
                    $post_date = $row['post_date'];
                    $post_image = $row['post_image'];
                    $post_content = $row['post_content'];

                ?>

                <h1 class="page-header"></h1>

                <h2>
                    <a href="#"><?php echo $post_title?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $post_user?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span><?php echo $post_date?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image ?>" alt="">
                <hr>
                <p><?php echo $post_content?></p>
                <hr>
            
                <?php }
            }
            else
            {
                header("Location: index.php");
            } ?>

                <?php 
                if(isset($_POST['create_comment'])){
                    $post_id = $_GET['p_id'];
                    $comment_author = $_POST['comment_author'];
                    $comment_email = $_POST['comment_email'];
                    $comment_content = $_POST['comment_content'];

                    if(!empty($comment_author) && !empty($comment_email) && !empty($comment_content)){

                    $query = "INSERT INTO comments(comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date)";
                    $query .= "VALUES ($post_id, '$comment_author', '$comment_email', '$comment_content', 'Unapproved', now())";

                    $create_comment_query = mysqli_query($connection,$query);
                    if(!$create_comment_query){
                        die("Query Failed" . mysqli_error($connection));
                    }

                    // $query = "UPDATE posts SET post_comment_count = post_comment_count + 1 WHERE post_id = $post_id";
                    // $increment_comment_count = mysqli_query($connection,$query);
                 }
                 else{
                     echo "<script>alert('FIELDS CANNOT BE EMPTY')</script>";
                 }
                }
                ?>


                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form role="form" action="" method="POST">
                    <div class="form-group">
                        <label for="comment_author">Author</label>
                            <input type="text" class="form-control" name="comment_author">
                        </div>
                        <div class="form-group">
                        <label for="comment_email">Email</label>
                            <input type="email" class="form-control" name="comment_email">
                        </div>
                        <div class="form-group">
                        <label for="comment">Your comment</label>
                            <textarea class="form-control" name="comment_content" rows="3"></textarea>
                        </div>
                        <button type="submit" name="create_comment" class="btn btn-primary">Submit</button>
                    </form>

                </div>

                    <?php 
                    $query = "SELECT * FROM comments WHERE comment_post_id = $post_id AND comment_status = 'Approved' ORDER BY comment_id DESC";
                    $select_all_comments = mysqli_query($connection,$query);
                    if(!$select_all_comments){
                        die("QUERY FAILED" . mysqli_error($connection));
                    }
                     else {
                        while($row = mysqli_fetch_assoc($select_all_comments)){
                            $comment_id = $row['comment_id'];
                            $comment_author = $row['comment_author'];
                            $comment_post_id = $row['comment_post_id'];
                            $comment_content = $row['comment_content'];
                            $comment_date = $row['comment_date']; 
                    ?>

                    <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $comment_author ?>
                            <small><?php echo $comment_date ?></small>
                        </h4>
                        <?php echo $comment_content ?>
                    </div>
                    </div>

                     <?php   }
                    }
                    
                    ?>

            </div>

           <?php include "includes/sidebar.php" ?>

        </div>

        <hr>

        <?php 
        include "includes/footer.php"; 
        ?>
       