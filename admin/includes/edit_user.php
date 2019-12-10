
<?php
if (isset($_GET['edit_user_id'])) {
  $edit_user= $_GET['edit_user_id'];
  $query = "SELECT * FROM users WHERE user_id={$edit_user}";
  $run = mysqli_query($connection,$query);
  $row = mysqli_fetch_assoc($run);
    $username         =  $row['username'];
    $user_firstname   =  $row['user_firstname'];
    $user_lastname    =  $row['user_lastname'];
    $user_email       =  $row['user_email'];
    $user_password    = $row['user_password'];
    $user_image       =  $row['user_image'];
    $user_role       =  $row['user_role'];
}
   if(isset($_POST['update_user'])) {

            $username        = $_POST['username'];

            // $post_id           = $_POST['post_id'];

            $user_firstname         = $_POST['user_firstname'];
            $user_lastname        =   $_POST['user_lastname'];
            $user_password      =      $_POST['user_password'];

            $user_image        = $_FILES['image']['name'];
            $user_image_temp   = $_FILES['image']['tmp_name'];


            $user_email         = $_POST['user_email'];
            $user_role      = $_POST['user_role'];

              // for image
            if (empty($user_image)) {
              $query = "SELECT user_image, user_role FROM users WHERE user_id={$edit_user}";
              $run = mysqli_query($connection,$query);
              $row = mysqli_fetch_assoc($run);
              $user_image = $row['user_image'];
            }

            // for user_role
            if (empty($user_role)) {
              $query = "SELECT user_image, user_role FROM users WHERE user_id={$edit_user}";
              $run = mysqli_query($connection,$query);
              $row = mysqli_fetch_assoc($run);
              $user_role = $row['user_role'];
            }

        move_uploaded_file($user_image_temp, "../images/users/$user_image" );


        $query = "UPDATE users SET username='".$username."', user_firstname='".$user_firstname."', user_lastname='".$user_lastname."',
                    user_email='".$user_email."', user_password='".$user_password."', user_image='".$user_image."', user_role='".$user_role."'
                     WHERE user_id='".$edit_user."'";



        $update_user_query = mysqli_query($connection, $query);
        if (!$update_user_query) {
          die("Failed".mysqli_error($connection));
        } else {
          echo "<script>alert(updated);</script>";
        }


      // confirmQuery($create_post_query);
      //
      // $the_post_id = mysqli_insert_id($connection);
      //
      //
      // echo "<p class='bg-success'>Post Created. <a href='../post.php?p_id={$the_post_id}'>View Post </a> or <a href='posts.php'>Edit More Posts</a></p>";



   }




?>

    <form action="" method="post" enctype="multipart/form-data">


      <div class="form-group">
         <label for="username">User</label>
          <input type="text" class="form-control" name="username" value="<?php echo $username;  ?>">
      </div>

      <div class="form-group">
         <label for="user_role">User Role</label>
         <select class="form-control" name="user_role">
           <option value="<?php $user_role;  ?>"> <?php echo $user_role;  ?> </option>
           <option value="admin"> Admin </option>
           <option value="subscriber"> Subscriber </option>
         </select>
      </div>


      <div class="form-group">
         <label for="user_firstname">First Name</label>
          <input type="text" class="form-control" name="user_firstname" value="<?php echo $user_firstname;  ?>">
      </div>

      <div class="form-group">
         <label for="user_lastname">Last Name</label>
          <input type="text" class="form-control" name="user_lastname" value="<?php echo $user_lastname;  ?>">
      </div>


      <div class="form-group">
         <label for="user_email">Email</label>
          <input type="email" class="form-control" name="user_email" value="<?php echo $user_email;  ?>">
      </div>

      <div class="form-group">
         <label for="user_password">Password</label>
          <input type="password" class="form-control" name="user_password" value="<?php echo $user_password;  ?>">
      </div>

    <div class="form-group">
        <img src="../images/users/<?php echo $user_image; ?>" alt="<?php echo $username; ?>" width="50">
         <label for="user_image">Change Image</label>
          <input type="file"  name="image">
      </div>


       <div class="form-group">
          <input class="btn btn-primary" type="submit" name="update_user" value="Update User">
      </div>


</form>
