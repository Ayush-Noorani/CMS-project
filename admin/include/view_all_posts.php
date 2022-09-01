<?php 
include("delete_modale.php");
if(isset($_POST['checkBoxArray'])){
    foreach($_POST['checkBoxArray'] as $checkBoxValue){
       $bulk_options = $_POST['bulk_options'];
       switch($bulk_options){
           case 'Published':
            $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = $checkBoxValue";
            $update_to_published = mysqli_query($connection,$query);
            break;

           case 'draft':
            $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = $checkBoxValue";
            $update_to_draft = mysqli_query($connection,$query);
            break;

           case 'delete':
            $query = "DELETE FROM posts WHERE post_id = $checkBoxValue";
            $delete_bulk_posts = mysqli_query($connection,$query);

       }
    }
}


if(isset($_GET['reset'])){
    $post_id = $_GET['reset'];
    $query = "UPDATE posts SET post_views_count = 0 WHERE post_id = $post_id";
    $reset_view_query = mysqli_query($connection,$query);
    if($reset_view_query)
        header("Location: posts.php");
}

?>

<form action="" method="POST">
<table class="table table-bordered table-hover">
    <div style="padding: 0px;" id="bulkOptionContainer" class="col-xs-4">
        <select class="form-control" name="bulk_options" id="">
            <option value="">Select Options</option>
            <option value="Published">Published</option>
            <option value="draft">Draft</option>
            <option value="delete">Delete</option>
        </select>
    </div>
    <div class="col-xs-4">
        <input type="submit" name="submit" class="btn btn-success" value="Apply" id="">
        <a class="btn btn-primary" href="posts.php?source=add_post">Add New</a>
    </div>
        <thead>
            <tr>
                <th><input type='checkbox' id='selectAllBoxes'></th>
                <th>ID</th>
                <th>User</th>
                <th>Title</th>
                <th>Category</th>
                <th>Status</th>
                <th>Image</th>
                <th>Tags</th>
                <th>Date</th>
                <th>Comments</th>
                <th>View post</th>
                <th>Edit</th>
                <th>Delete</th>
                <th>Views</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $query = "SELECT * FROM posts";
            $selectAll_posts = mysqli_query($connection,$query);
            if(!$selectAll_posts){
                die("Query Failed" . mysqli_error($connection));
            }
            else {
                while($row = mysqli_fetch_assoc($selectAll_posts)){
                    $post_id = $row['post_id'];
                    $post_user = $row['post_user']; 
                    $post_author = $row['post_author'];
                    $post_title = $row['post_title'];
                    $post_category = $row['post_category_id'];
                    $post_status = $row['post_status'];
                    $post_image = $row['post_image'];
                    $post_tags = $row['post_tags'];
                    $post_comments = $row['post_comment_count'];
                    $post_date = $row['post_date'];
                    $view_count = $row['post_views_count'];

                    echo "<tr>";
                    ?>
                    <td><input type='checkbox' class='checkBoxes' name="checkBoxArray[]" value="<?php echo $post_id ?>"></td>
                    <?php
                    echo "<td>$post_id</td>";
                    if(!empty($post_author)){
                        echo "<td>$post_author</td>";
                    }
                    elseif(!empty($post_user)){
                        echo "<td>$post_user</td>";
                    }

                    echo "<td>$post_title</td>";

                    $query = "SELECT * FROM categories WHERE cat_id = $post_category";
                    $select_categories_id = mysqli_query($connection,$query);
                    while($row = mysqli_fetch_assoc($select_categories_id)){
                    $cat_id = $row['cat_id'];
                    $cat_title = $row['cat_title'];
                    
                    echo "<td>$cat_title</td>";
                    }

                    echo "<td>$post_status</td>";
                    echo "<td><img width='100' src='../images/$post_image' alt='image'></td>";
                    echo "<td>$post_tags</td>";
                    echo "<td>$post_date</td>";

                    $query = "SELECT * FROM comments WHERE comment_post_id = $post_id";
                    $send_comment_query = mysqli_query($connection,$query);
                    $row = mysqli_fetch_assoc($send_comment_query);
                    $count_comments = mysqli_num_rows($send_comment_query);
                    echo "<td><a href='post_comments.php?id=$post_id'>$count_comments<a></td>";

                    echo "<td><a href='../post.php?p_id={$post_id}'>View post</a></td>";
                    echo "<td><a href='posts.php?source=edit_post&p_id={$post_id}'>Edit</a></td>";
                    echo "<td><a rel='$post_id' href='javascript: void(0)' class='delete_link'>Delete</a></td>";
                    // echo "<td><a onClick=\" javascript: return confirm('Are you sure you want to delete?');\" href='posts.php?delete={$post_id}'>Delete</a></td>";
                    echo "<td><a href='posts.php?reset=$post_id'>$view_count</a></td>";
                    echo "</tr>";
                
                }

            } ?>
            
        </tbody>
    </table>
    </form>

    <?php 
    
    if(isset($_GET['delete'])){

        if(isset($_SESSION['user_role'])){
            if($_SESSION['user_role'] == 'Admin'){
                $post_id = mysqli_real_escape_string($connection,$_GET['delete']);
                $query = "DELETE FROM posts WHERE post_id = {$post_id}";
                $post_delete_query = mysqli_query($connection,$query);
                confirm($post_delete_query);
                header("Location: posts.php");
            }
        }
    }
    ?>
    <script>
        $(document).ready(function(){
            $(".delete_link").on('click', function(){
                var id = $(this).attr("rel");
                var delete_url = "posts.php?delete="+ id +" ";
                $(".modale_delete_link").attr("href", delete_url);
                $("#myModal").modal('show');
            });
        });
    </script>