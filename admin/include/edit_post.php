<?php 
$post_id = $_GET['p_id'];
$query = "SELECT * FROM posts WHERE post_id = $post_id";
$edit_post_get_query = mysqli_query($connection,$query);


while($row = mysqli_fetch_assoc($edit_post_get_query)){
    $post_id = $row['post_id'];
    $post_user = $row['post_user'];
    $post_title = $row['post_title'];
    $post_category_id = $row['post_category_id'];
    $post_status = $row['post_status'];
    $post_image = $row['post_image'];
    $post_tags = $row['post_tags'];
    $post_content = $row['post_content'];
}

if(isset($_POST['update_post'])){
    $post_user = $_POST['user'];
    $post_title = $_POST['post_title'];
    $post_category_id = $_POST['post_category_id'];
    $post_status = $_POST['post_status'];
    $post_image = $_FILES['image']['name'];
    $post_image_temp = $_FILES['image']['tmp_name'];
    $post_tags = $_POST['post_tags'];
    $post_content = $_POST['post_content'];

    move_uploaded_file($post_image_temp, "../images/$post_image");
    if(empty($post_image)){
        $query = "SELECT * FROM posts WHERE post_id = $post_id";
        $select_image = mysqli_query($connection,$query);
        while($row = mysqli_fetch_assoc($select_image)){
            $post_image = $row['post_image'];
        }
    }

    $query = "UPDATE posts SET post_title = '{$post_title}', post_category_id = {$post_category_id}, post_date = now(), post_user = '{$post_user}', post_status = '{$post_status}', post_tags = '{$post_tags}', post_content = '{$post_content}', post_image = '{$post_image}' WHERE post_id = $post_id";

    $update_post_query = mysqli_query($connection,$query);
    if(!$update_post_query){
        die("QUERY FAILED" . mysqli_error($connection));
    }
    
    echo "<p class='bg-success'>Post Updated. <a href='../post.php?p_id=$post_id'>View Post</a> or <a href='./posts.php'>Edit other post</a></p>";
}
?>


<form action="" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Post Title</label> 
        <input type="text" class="form-control" name="post_title" value="<?php echo $post_title?>">
    </div>
    <div class="form-group">
        <label for="title">Post Category</label><br>
        <select name="post_category_id" id="">
            <?php 
            $query = "SELECT * FROM categories";
            $select_categories_id = mysqli_query($connection,$query);
            while($row = mysqli_fetch_assoc($select_categories_id)){
                $cat_id = $row['cat_id'];
                $cat_title = $row['cat_title'];

                echo "<option value={$cat_id}>$cat_title</option>";
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="users">Users</label><br>
        <select name="user" id="user">
        <?php echo "<option value=$post_user>$post_user</option>"; ?>
            <?php 
            $query = "SELECT * FROM users";
            $select_users = mysqli_query($connection,$query);

            while($row = mysqli_fetch_assoc($select_users)){
                $user_id = $row['user_id'];
                $username = $row['username'];

                echo "<option value=$username>$username</option>";
            }
            ?>
        </select>
    </div>

    <!-- <div class="form-group">
        <label for="title">Post Author</label>
        <input type="text" class="form-control" name="post_user" value="<?php echo $post_user?>">
    </div> -->
    <div class="form-group">
        <label for="title">Post Status</label><br>
        <select name="post_status" id="">
            <option value="<?php echo $post_status?>"><?php echo $post_status?></option>
            <?php 
            if($post_status == 'Published'){
                echo "<option value='draft'>Draft</option>";
            } else {
                echo "<option value='Published'>Publish</option>";
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="title">Post Image</label><br>
        <img width="100" src="../images/<?php $post_image ?>">
        <input type="file"  name="image">
    </div>
    <div class="form-group">
        <label for="title">Post Tags</label>
        <input type="text" class="form-control" name="post_tags" value="<?php echo $post_tags?>">
    </div>
    <div class="form-group">
        <label for="title">Post Content</label>
        <textarea class="form-control" name="post_content" id="" cols="30" rows="10" ><?php echo $post_content?></textarea>
    </div>
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="update_post" value="Update">
    </div>
</form>
 