<?php include('includes/admin_header.php');

if (isset($_SESSION['username'])) {

  $session_username =  $_SESSION['username'];

  $query = "SELECT * FROM users WHERE username='{$session_username}'";
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
   if(isset($_POST['update_profile'])) {

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
              $query = "SELECT user_image, user_role FROM users WHERE username='{$session_username}'";
              $run = mysqli_query($connection,$query);
              $row = mysqli_fetch_assoc($run);
              $user_image = $row['user_image'];
            }

            // for user_role
            if (empty($user_role)) {
              $query = "SELECT user_image, user_role FROM users WHERE username='{$session_username}'";
              $run = mysqli_query($connection,$query);
              $row = mysqli_fetch_assoc($run);
              $user_role = $row['user_role'];
            }

        move_uploaded_file($user_image_temp, "../images/users/$user_image" );


        $query = "UPDATE users SET username='".$username."', user_firstname='".$user_firstname."', user_lastname='".$user_lastname."',
                    user_email='".$user_email."', user_password='".$user_password."', user_image='".$user_image."', user_role='".$user_role."'
                     WHERE username='".$session_username."'";



        $update_user_query = mysqli_query($connection, $query);
        if (!$update_user_query) {
          die("Failed".mysqli_error($connection));
        } else {
          echo "<script>alert(updated);</script>";
        }
    }

?>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <?php  include('includes/navigation.php'); ?>
            <!-- /.navbar-collapse -->


        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                          Welcome to admin area
                            <small>
                              <?php
                                  echo $session_username;

                               ?>
                          </small>
                        </h1>

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
                              <input class="btn btn-primary" type="submit" name="update_profile" value="Update Profile">
                          </div>
                    </form>

                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
