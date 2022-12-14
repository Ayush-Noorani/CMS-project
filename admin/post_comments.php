
<?php include "include/admin_header.php";?>

<div id="wrapper">

    <!-- Navigation -->
<?php include "include/admin_nav.php";?>


    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                <h1 class="page-header">
                        Welcome to Comments
                        <small>Author name</small>
                </h1>
                <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Author</th>
                <th>Comment</th>
                <th>Author</th>
                <th>Status</th>
                <th>In respopnse to</th>
                <th>Date</th>
                <th>Approve</th>
                <th>Unapprove</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $query = "SELECT * FROM comments WHERE comment_post_id = ". mysqli_real_escape_string($connection,$_GET['id']) ."";;
            $selectAll_comments = mysqli_query($connection,$query);
            if(!$selectAll_comments){
                die("Query Failed" . mysqli_error($connection));
            }
            else {
                while($row = mysqli_fetch_assoc($selectAll_comments)){
                    $comment_id = $row['comment_id'];
                    $comment_author = $row['comment_author'];
                    $comment_post_id = $row['comment_post_id'];
                    $comment_email = $row['comment_email'];
                    $comment_status = $row['comment_status'];
                    $comment_content = $row['comment_content'];
                    $comment_date = $row['comment_date'];   

                    echo "<tr>";
                    echo "<td>$comment_id</td>";
                    echo "<td>$comment_author</td>";
                    echo "<td>$comment_content</td>";

                    // $query = "SELECT * FROM categories WHERE cat_id = $post_category";
                    // $select_categories_id = mysqli_query($connection,$query);
                    // while($row = mysqli_fetch_assoc($select_categories_id)){
                    // $cat_id = $row['cat_id'];
                    // $cat_title = $row['cat_title'];
                    
                    // echo "<td>$cat_title</td>";
                    // }

                    echo "<td>$comment_email</td>";
                    echo "<td>$comment_status</td>";

                    $query = "SELECT * FROM posts WHERE post_id = $comment_post_id";
                    $select_post_id_query = mysqli_query($connection,$query);
                    while($row = mysqli_fetch_assoc($select_post_id_query)){
                    $post_title = $row['post_title'];
                    $post_id = $row['post_id'];
                    echo "<td><a href='../post.php?p_id=$post_id'>$post_title</a></td>";
                    }          

                    echo "<td>$comment_date</td>";
                    echo "<td><a href='comments.php?approve=$comment_id'>Approve</a></td>";
                    echo "<td><a href='comments.php?unapprove=$comment_id'>Unapprove</a></td>";
                    echo "<td><a href='comments.php?delete=$comment_id'>Delete</a></td>";
                    echo "</tr>";
                
                }

            } ?>
            
        </tbody>
    </table>

    <?php 
     if(isset($_GET['approve'])){
        
        $comment_id = $_GET['approve'];
        $query = "UPDATE comments SET comment_status = 'Approved' WHERE comment_id = $comment_id";
        $approve_comment_query = mysqli_query($connection,$query);
        confirm($approve_comment_query);
        header("Location: comments.php");

    }

    if(isset($_GET['unapprove'])){
        
        $comment_id = $_GET['unapprove'];
        $query = "UPDATE comments SET comment_status = 'Unapproved' WHERE comment_id = $comment_id";
        $unapprove_comment_query = mysqli_query($connection,$query);
        confirm($unapprove_comment_query);
        header("Location: comments.php");

    }
    
    if(isset($_GET['delete'])){
        
        $comment_id = $_GET['delete'];
        $query = "DELETE FROM comments WHERE comment_id = {$comment_id}";
        $post_delete_query = mysqli_query($connection,$query);
        confirm($post_delete_query);
        header("Location: comments.php");

    }
    ?>
      <?php 
        include "../includes/footer.php"; 
        ?>