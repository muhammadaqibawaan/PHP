
<?php

   if(isset($_POST['create_user'])) {

            $username        = $_POST['username'];

            // $post_id           = $_POST['post_id'];

            $user_firstname         = $_POST['user_firstname'];
            $user_lastname        =   $_POST['user_lastname'];
            $user_password      =      $_POST['user_password'];

            $user_password = password_hash($user_password, PASSWORD_DEFAULT);

            $user_image        = $_FILES['image']['name'];
            $user_image_temp   = $_FILES['image']['tmp_name'];


            $user_email         = $_POST['user_email'];
            $user_role      = $_POST['user_role'];



        move_uploaded_file($user_image_temp, "../images/users/$user_image" );


      $query = "INSERT INTO users(username,user_firstname,user_lastname,user_email,user_password,user_image,user_role)";

      $query .= "VALUES('{$username}','{$user_firstname}','{$user_lastname}','{$user_email}','{$user_password}','{$user_image}','{$user_role}')";

      $create_user_query = mysqli_query($connection, $query);
      if (!$create_user_query) {
        die("Failed".mysqli_error($connection));
      } else {
        echo "User Created <a href='users.php'>View Users</a>";
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
          <input type="text" class="form-control" name="username">
      </div>

      <div class="form-group">
         <label for="user_role">User Role</label>
         <input type="text" class="form-control" name="user_role">
      </div>


      <div class="form-group">
         <label for="user_firstname">First Name</label>
          <input type="text" class="form-control" name="user_firstname">
      </div>

      <div class="form-group">
         <label for="user_lastname">Last Name</label>
          <input type="text" class="form-control" name="user_lastname">
      </div>


      <div class="form-group">
         <label for="user_email">Email</label>
          <input type="text" class="form-control" name="user_email">
      </div>

      <div class="form-group">
         <label for="user_password">Password</label>
          <input type="password" class="form-control" name="user_password">
      </div>

    <div class="form-group">
         <label for="user_image">User Image</label>
          <input type="file"  name="image">
      </div>


       <div class="form-group">
          <input class="btn btn-primary" type="submit" name="create_user" value="Create User">
      </div>


</form>
