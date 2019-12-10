<?php  include "includes/connection.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Blog Home - Start Bootstrap Template</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/blog-home.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
<?php

function check_field($field_name, $field_value) {
  global $connection;

  $field_query = "SELECT * FROM users WHERE '".$field_name."' = '".$field_value."'";
  $field_res   =   mysqli_query($connection, $field_query);
  $field_count = mysqli_num_rows($field_res);
  if ($field_count >= 1) {
    return true;
  } else {
    return false;
  }

}


?>


    <!-- Navigation -->

    <?php  include "includes/navigation.php"; ?>


    <!-- Page Content -->
    <div class="container">
<?php
    if (isset($_POST['submit'])) {

      $username       =  mysqli_escape_string($connection, $_POST['username']);
      $user_email     =  mysqli_escape_string($connection, $_POST['user_email']);
      $user_password  =  mysqli_escape_string($connection, $_POST['user_password']);


      // if (check_field('username', $username)) {
      //   $error_message = "That username is being used. Pick another";
      // }


      $user_password = password_hash($user_password, PASSWORD_DEFAULT);

        if (!empty($username) && !empty($user_email) && !empty($user_password)) {

          $register_query = "INSERT INTO users (username, user_email, user_password,user_role)
                                      VALUES ('$username', '$user_email', '$user_password','admin')";

            $reg_query_run = mysqli_query($connection,$register_query);

          if ($reg_query_run) {
            header('location:registration.php');
          } else {
            die('Query Failed'.mysqli_error($connection));
          }
        } else {
          $error_message = "Please fill out all fields!";
        }

    } else {
        $error_message = "";
    }

?>
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Register</h1>
                <p style="color:red"> <?php  if (isset($error_message)) {
                  echo $error_message;
                }  ?> </p>
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                        <div class="form-group">
                            <label for="username" class="sr-only">username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username">
                        </div>
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="user_email" id="email" class="form-control" placeholder="somebody@example.com">
                        </div>
                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="user_password" id="key" class="form-control" placeholder="Password">
                        </div>

                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                    </form>

                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>


</body>
</html>
