<?php include('includes/admin_header.php'); ?>

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
                            <small>Author</small>
                        </h1>
                        <?php
                          if (isset($_GET['source'])) {
                            $source = $_GET['source'];
                          } else {
                            $source = '';
                          }
                          switch ($source) {
                              case 'add_user':
                              include('includes/add_user.php');
                                break;
                                case 'edit_user':
                                include('includes/edit_user.php');
                                  break;

                              default:
                                include('includes/view_all_users.php');
                                break;
                            }

                         ?>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Function to approve post -->
    <?php
      if(isset($_GET['subscriber'])){
        $subscriber = $_GET['subscriber'];
          $subscriber_query = "UPDATE users SET user_role='subscriber' WHERE user_id=$subscriber";
          if (mysqli_query($connection,$subscriber_query)) {
            header('location:users.php');
          }

      }
     ?>


     <!-- Function to unapprove post -->
     <?php
       if(isset($_GET['admin'])){
         $admin = $_GET['admin'];
          $admin_query = "UPDATE users SET user_role='admin' WHERE user_id=$admin";
           if (mysqli_query($connection,$admin_query)) {
             header('location:users.php');
           }

       }
      ?>




    <!-- Function to delete post -->
    <?php
      if(isset($_GET['delete_user'])){
        $delete_user = $_GET['delete_user'];
          $delete_query = "DELETE FROM users WHERE user_id=$delete_user";
          if (mysqli_query($connection,$delete_query)) {
            header('location:users.php');
          }

      }
     ?>


    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
