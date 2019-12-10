<?php  include_once('includes/connection.php');  ?>
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

    <!-- Navigation -->
    <?php include('includes/navigation.php'); ?>
    <!-- Page Content -->
    <div class="container">

        <div class="row">
          <!-- Blog Entries Column -->
          <div class="col-md-8">
            <?php

              if (isset($_GET['post_id'])) {
                $post_id = $_GET['post_id'];
              }

              $view_count_query = "UPDATE posts SET post_views_count=post_views_count + 1 WHERE post_id={$post_id}";
              mysqli_query($connection, $view_count_query);

              $query = "SELECT * FROM posts WHERE post_id=$post_id";

              $fecth_all_posts = mysqli_query($connection,$query);
              while ($row = mysqli_fetch_assoc($fecth_all_posts)) {
                $post_id  = $row['post_id'];
                $title  = $row['post_title'];
                $author = $row['post_author'];
                $date   = $row['post_date'];
                $image  = $row['post_image'];
                $content = $row['post_content'];

              ?>
                  <h1 class="page-header">
                      Page Heading
                      <small>Secondary Text</small>
                  </h1>

                  <!-- First Blog Post -->
                  <h2>
                      <a href="post.php?post_id=<?php echo $post_id; ?>"><?php echo $title; ?></a>
                  </h2>
                  <p class="lead">
                      by <a href="index.php"><?php echo $author; ?></a>
                  </p>
                  <p><span class="glyphicon glyphicon-time"></span> <?php echo $date; ?></p>
                  <hr>
                  <img class="img-responsive" src="images/<?php  echo $image; ?>" alt="">
                  <hr>
                  <p><?php echo $content; ?></p>

                  <hr>

              <?php }

             ?>

             <!-- Blog Comments -->

             <?php
                if (isset($_POST['create_comment'])) {
                  $comment_post_id = $_GET['post_id'];

                  $comment_author = $_POST['comment_author'];
                  $comment_email = $_POST['comment_email'];
                  $comment_content = $_POST['comment_content'];
                  if (!empty($comment_author) && !empty($comment_email) && !empty($comment_content)) {

                    $query = "INSERT INTO comment(comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date)";
                    $query .= "VALUES($comment_post_id, '{$comment_author}', '{$comment_email}', '{$comment_content}', 'unapproved', now())";
                    $comment_query = mysqli_query($connection, $query);

                    if (!$comment_query) {

                      die("Falied".mysqli_error());

                    }
                  } else {
                    $error = "Please fill out all fields!";
                  }




                  $update_comment_count = "UPDATE posts SET post_comment_count = (post_comment_count + 1) WHERE post_id = $comment_post_id";
                  mysqli_query($connection, $update_comment_count);

                }


              ?>

             <!-- Comments Form -->
             <div class="well">
                 <h4>Leave a Comment:</h4>
                 <form action="" method="post" role="form">
                   <div class="form-group">
                     <label for="comment_author">Author</label>
                     <input class="form-control" type="text" name="comment_author" value="">
                   </div>
                   <div class="form-group">
                     <label for="comment_email">Email</label>
                     <input class="form-control" type="text" name="comment_email" value="">
                   </div>
                     <div class="form-group">
                       <label for="comment_content">Your Comment</label>
                         <textarea class="form-control" rows="3" name="comment_content"></textarea>
                     </div>
                     <button type="submit" class="btn btn-primary" name="create_comment">Submit</button>
                 </form>
             </div>

             <hr>

             <!-- Posted Comments -->

                <?php

                  $query = "SELECT * FROM comment WHERE comment_post_id=$post_id AND comment_status='approved'";
                  $result = mysqli_query($connection,$query);
                  while ($row = mysqli_fetch_assoc($result)) {
                    $comment_author = $row['comment_author'];
                    $comment_date = $row['comment_date'];
                    $comment_content = $row['comment_content'];

                      ?>

                      <!-- Comment -->
                      <div class="media">
                          <a class="pull-left" href="#">
                              <img class="media-object" src="http://placehold.it/64x64" alt="">
                          </a>
                          <div class="media-body">
                              <h4 class="media-heading"><?php  echo $comment_author;  ?>
                                  <small><?php echo $comment_date;   ?></small>
                              </h4>
                          <?php echo $comment_content; ?>
                          </div>
                      </div>

                      <!-- Comment -->

                              <!-- End Nested Comment -->


                <?php  }


                 ?>











                <!-- Pager -->
            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include('includes/sidebar.php'); ?>
        </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->
        <?php  include('includes/footer.php');  ?>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
