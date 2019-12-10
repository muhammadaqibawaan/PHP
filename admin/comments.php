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
                              case 'add_posts':
                              include('includes/add_posts.php');
                                break;

                                case 'edit_post':
                                include('includes/edit_post.php');
                                  break;

                                  case 'all_posts':
                                  include('includes/view_post_comments.php');
                                    break;

                              default:
                                include('includes/view_all_comments.php');
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
      if(isset($_GET['approve'])){
        $approve = $_GET['approve'];
          $approve_query = "UPDATE comment SET comment_status='approved' WHERE comment_id=$approve";
          if (mysqli_query($connection,$approve_query)) {
            header('location:comments.php');
          }

      }
     ?>


     <!-- Function to unapprove post -->
     <?php
       if(isset($_GET['unapprove'])){
         $unapprove = $_GET['unapprove'];
          $unapprove_query = "UPDATE comment SET comment_status='unapproved' WHERE comment_id=$unapprove";
           if (mysqli_query($connection,$unapprove_query)) {
             header('location:comments.php');
           }

       }
      ?>




    <!-- Function to delete post -->
    <?php
      if(isset($_GET['comment_delete_id'])){
        $comment_delete_id = $_GET['comment_delete_id'];
          $delete_query = "DELETE FROM comment WHERE comment_id=$comment_delete_id";
          if (mysqli_query($connection,$delete_query)) {
            header('location:comments.php');
          }

      }
     ?>


    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
