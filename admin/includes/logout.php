<?php

session_start();
$_SESSION['username']       = null;
$_SESSION['user_password']  = null;
$_SESSION['user_role']      = null;

header('location:../index.php');

?>
