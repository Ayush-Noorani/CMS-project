<?php 
$user_id = $_GET['user_id'];
$query = "SELECT * FROM users WHERE user_id = $user_id";
$edit_user_get_query = mysqli_query($connection,$query);


while($row = mysqli_fetch_assoc($edit_user_get_query)){
    $username = $row['username'];
    $user_password = $row['user_password'];
    $user_firstname = $row['user_firstname'];
    $user_lastname = $row['user_lastname'];
    $user_email = $row['user_email'];
    $user_role = $row['user_role'];
}

if(isset($_POST['edit_user'])){
    $username = $_POST['username'];
    $user_password = $_POST['user_password'];
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_email = $_POST['user_email'];
    $user_role = $_POST['user_role'];

    $hash = '$2y$10$';
    $salt = 'iusesomecrazystrings22';
    $user_password = crypt($user_password,$salt);
    

    $query = "UPDATE users SET username = '{$username}', user_password = '{$user_password}', user_firstname = '{$user_firstname}', user_lastname = '{$user_lastname}', user_email = '{$user_email}', user_role = '{$user_role}' WHERE user_id = $user_id";

    $update_user_query = mysqli_query($connection,$query);
    if(!$update_user_query){
        die("QUERY FAILED" . mysqli_error($connection));
    }
    header("Location: users.php");
}
?>


<form action="" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Username</label> 
        <input type="text" class="form-control" name="username" value="<?php echo $username ?>">
    </div>
    <div class="form-group">
        <label for="title">Password</label><br>
        <input type="password" class="form-control" name="user_password" value="<?php echo $user_password ?>">
    </div>
    <div class="form-group">
        <label for="title">First Name</label>
        <input type="text" class="form-control" name="user_firstname" value="<?php echo $user_firstname ?>">
    </div>
    <div class="form-group">
        <label for="title">Last Name</label>
        <input type="text" class="form-control" name="user_lastname" value="<?php echo $user_lastname ?>">
    </div>
    <div class="form-group">
        <label for="title">Email</label>
        <input type="email" class="form-control" name="user_email" value="<?php echo $user_email ?>">
    </div>
    <!-- <div class="form-group">
        <label for="title">User Image</label>
        <input type="file"  name="user_image">
    </div> -->
    <div class="form-group">
        <label for="user_role">User Role</label><br>
        <select name="user_role" id="">
            <option value="<?php echo $user_role ?>"><?php echo $user_role ?></option>
            <?php 
            if($user_role == 'Admin'){
                echo "<option value='subscriber'>Subscriber</option>";
            } else {
                echo "<option value='admin'>Admin</option>";
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="edit_user" value="Edit user">
    </div>
</form>
 