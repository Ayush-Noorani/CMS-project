<?php 
if(isset($_POST['create_user'])){
    $username = escape($_POST['username']);
    $user_password = escape($_POST['user_password']);
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    // $post_image = $_FILES['image']['name'];
    // $post_img_temp = $_FILES['image']['tmp_name'];
    $user_email = $_POST['user_email'];
    $user_role = $_POST['user_role'];
    // $post_date = date('d-m-y');

   // move_uploaded_file($post_img_temp, "../images/$post_image");

    $query = "INSERT INTO users (username, user_password, user_firstname, user_lastname, user_email, user_role) ";
    $query .= "VALUES ('{$username}','{$user_password}','{$user_firstname}','{$user_lastname}','{$user_email}', '{$user_role}')";
    
    $add_user_query = mysqli_query($connection,$query);

    confirm($add_user_query);

    echo "User created: " . " " . "<a href='users.php'>View users</a>";
}
?>


<form action="" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Username</label> 
        <input type="text" class="form-control" name="username">
    </div>
    <div class="form-group">
        <label for="title">Password</label><br>
        <input type="password" class="form-control" name="user_password">
    </div>
    <div class="form-group">
        <label for="title">First Name</label>
        <input type="text" class="form-control" name="user_firstname">
    </div>
    <div class="form-group">
        <label for="title">Last Name</label>
        <input type="text" class="form-control" name="user_lastname">
    </div>
    <div class="form-group">
        <label for="title">Email</label>
        <input type="email" class="form-control" name="user_email">
    </div>
    <!-- <div class="form-group">
        <label for="title">User Image</label>
        <input type="file"  name="user_image">
    </div> -->
    <div class="form-group">
        <label for="user_role">User Role</label><br>
        <select name="user_role" id="">
            <option value="subscriber">Select Options</option>
            <option value="admin">Admin</option>
            <option value="subscriber">Subscriber</option>
        </select>
    </div>
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="create_user" value="Add user">
    </div>
</form>