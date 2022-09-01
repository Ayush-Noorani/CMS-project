<table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>First name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Date</th>
                <th>Make Admin</th>
                <th>Make Subscriber</th>
                <th>Edit</th>
                <th>Delete</th>
               
            </tr>
        </thead>
        <tbody>
            <?php 
            $query = "SELECT * FROM users";
            $selectAll_users = mysqli_query($connection,$query);
            if(!$selectAll_users){
                die("Query Failed" . mysqli_error($connection));
            }
            else {
                while($row = mysqli_fetch_assoc($selectAll_users)){
                    $user_id = $row['user_id'];
                    $username = $row['username'];
                    $user_password = $row['user_password'];
                    $user_firstname = $row['user_firstname'];
                    $user_lastname = $row['user_lastname'];
                    $user_email = $row['user_email'];
                    $user_image = $row['user_image'];
                    $user_role = $row['user_role'];
  

                    echo "<tr>";
                    echo "<td>$user_id</td>";
                    echo "<td>$username</td>";
                    echo "<td>$user_firstname</td>";

                    // $query = "SELECT * FROM categories WHERE cat_id = $post_category";
                    // $select_categories_id = mysqli_query($connection,$query);
                    // while($row = mysqli_fetch_assoc($select_categories_id)){
                    // $cat_id = $row['cat_id'];
                    // $cat_title = $row['cat_title'];
                    
                    // echo "<td>$cat_title</td>";
                    // }

                    echo "<td>$user_lastname</td>";
                    echo "<td>$user_email</td>";
                    echo "<td>$user_role</td>";

                    // $query = "SELECT * FROM posts WHERE post_id = $comment_post_id";
                    // $select_post_id_query = mysqli_query($connection,$query);
                    // while($row = mysqli_fetch_assoc($select_post_id_query)){
                    // $post_title = $row['post_title'];
                    // $post_id = $row['post_id'];
                    // echo "<td><a href='../post.php?p_id=$post_id'>$post_title</a></td>";
                    // }          

                    echo "<td>user_date</td>";
                    echo "<td><a href='users.php?change_to_admin=$user_id'>Make Admin</a></td>";
                    echo "<td><a href='users.php?change_to_subscriber=$user_id'>Make Subscriber</a></td>";
                    echo "<td><a href='users.php?source=edit_user&user_id=$user_id'>Edit</a></td>";
                    echo "<td><a href='users.php?delete=$user_id'>Delete</a></td>";
                    echo "</tr>";
                
                }

            } ?>
            
        </tbody>
    </table>

    <?php 
     if(isset($_GET['change_to_admin'])){
        
        $user_id = $_GET['change_to_admin'];
        $query = "UPDATE users SET user_role = 'Admin' WHERE user_id = $user_id";
        $make_admin_query = mysqli_query($connection,$query);
        confirm($make_admin_query);
        header("Location: users.php");

    }

    if(isset($_GET['change_to_subscriber'])){
        
        $user_id = $_GET['change_to_subscriber'];
        $query = "UPDATE users SET user_role = 'Subscriber' WHERE user_id = $user_id";
        $make_subscriber_query = mysqli_query($connection,$query);
        confirm($make_subscriber_query);
        header("Location: users.php");

    }
    
    if(isset($_GET['delete'])){
        
        $user_id = $_GET['delete'];
        $query = "DELETE FROM users WHERE user_id = {$user_id}";
        $user_delete_query = mysqli_query($connection,$query);
        confirm($user_delete_query);
        header("Location: users.php");

    }
    ?>