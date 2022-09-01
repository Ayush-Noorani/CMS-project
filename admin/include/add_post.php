<?php 
if(isset($_POST['create_post'])){
    $post_title = $_POST['title'];
    $post_category_id = $_POST['post_category'];
    $post_user = $_POST['user'];
    $post_status = $_POST['post_status'];
    $post_image = $_FILES['image']['name'];
    $post_img_temp = $_FILES['image']['tmp_name'];
    $post_tags = $_POST['post_tags'];
    $post_content = $_POST['post_content'];
    $post_date = date('d-m-y');

    move_uploaded_file($post_img_temp, "../images/$post_image");

    $query = "INSERT INTO posts(post_category_id, post_title, post_user, post_date, post_image, post_content, post_tags, post_status) ";
    $query .= "VALUES ({$post_category_id},'{$post_title}','{$post_user}',now(),'{$post_image}','{$post_content}','{$post_tags}', '{$post_status}')";
    
    $create_post_query = mysqli_query($connection,$query);

    confirm($create_post_query);
}
?>

<form action="" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Post Title</label> 
        <input type="text" class="form-control" name="title">
    </div>
    <div class="form-group">
        <label for="title">Post Category</label><br>
        <select name="post_category" id="post_category">
            <?php 
            $query = "SELECT * FROM categories";
            $select_categories_id = mysqli_query($connection,$query);
            while($row = mysqli_fetch_assoc($select_categories_id)){
                $cat_id = $row['cat_id'];
                $cat_title = $row['cat_title'];

                echo "<option value=$cat_id>$cat_title</option>";
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="users">Users</label><br>
        <select name="user" id="user">
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

    <div class="form-group">
        <label for="post_status">Post Status</label><br>
       <select name="post_status" id="">
           <option value="draft">Select an option</option>
           <option value="Published">Publish</option>
           <option value="draft">Draft</option>
       </select>
    </div>
    <div class="form-group">
        <label for="title">Post Image</label>
        <input type="file"  name="image">
    </div>
    <div class="form-group">
        <label for="title">Post Tags</label>
        <input type="text" class="form-control" name="post_tags">
    </div>
    <div class="form-group">
        <label for="title">Post Content</label>
        <textarea class="form-control" name="post_content" id="" cols="30" rows="10"></textarea>
    </div>
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="create_post" value="Publish">
    </div>
</form>