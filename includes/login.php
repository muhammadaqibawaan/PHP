<?php
session_start();
include('connection.php');
if (isset($_POST['login_btn'])) {

  $login_username = mysqli_real_escape_string($connection,$_POST['login_username']);
  $login_password = mysqli_real_escape_string($connection,$_POST['login_password']);

  // $login_password = password_hash($login_password, PASSWORD_DEFAULT);

  $login_query = "SELECT * FROM users WHERE username='{$login_username}'";

  $login_result = mysqli_query($connection,$login_query);
  // while ($row = mysqli_fetch_assoc($login_result)) {
  //   print_r($row);
  // }

      $row = mysqli_fetch_assoc($login_result);
      $db_username = $row['username'];
      $db_password = $row['user_password'];
      $db_role = $row['user_role'];


      if (password_verify($login_password, $db_password)) {
        $_SESSION['username'] = $db_username;
        $_SESSION['user_password'] = $db_password;
        $_SESSION['user_role'] = $db_role;
        header('location:../admin/index.php');
      } else {
        header('location:../index.php');
      }
}

 ?>
