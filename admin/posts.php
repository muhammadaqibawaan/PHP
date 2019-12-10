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

                              default:
                                include('includes/view_all_posts.php');
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

    <!-- Function to delete post -->
    <?php
      if(isset($_POST['delete'])){
        $post_delete_id = $_POST['post_id'];
          $delete_query = "DELETE FROM posts WHERE post_id='".$post_delete_id."'";
          if (mysqli_query($connection,$delete_query)) {
            header('location:posts.php');
          }

      }
     ?>


     <!-- Reset Post View -->
     <?php
       if(isset($_GET['reset_views'])){
         $reset_views = $_GET['reset_views'];
         $view_count_query = "UPDATE posts SET post_views_count=0 WHERE post_id={$reset_views}";
         $result = mysqli_query($connection, $view_count_query);
         if ($result) {
           header('location:posts.php');
         }

       }
      ?>

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
