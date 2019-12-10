<?php
session_start();
include_once('includes/connection.php'); ?>
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
    <link href="css/style.css" rel="stylesheet">

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

            $per_page = 5;

            if (isset($_GET['page'])) {

              $page = $_GET['page'];

            } else {
              $page = '';
            }

            if ($page == '' || $page == 1) {
              $page1 = 0;
            } else {
              $page1 = ($page * 5) - 5;
            }

            if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin' ) {
                $count_query = "SELECT * FROM posts";
            } else {
                $count_query = "SELECT * FROM posts WHERE post_status = 'published'";
            }

            $count_result = mysqli_query($connection, $count_query);
            $count_rows = mysqli_num_rows($count_result);
            $count_rows = ceil($count_rows/5);

            if ($count_rows < 1) {
              echo "<h1 class='text-center'>No Post Available</h1>";
            } else {

              $query = "SELECT * FROM posts LIMIT $page1, $per_page";
              $fecth_all_posts = mysqli_query($connection,$query);
              while ($row = mysqli_fetch_assoc($fecth_all_posts)) {
                $post_id  = $row['post_id'];
                $title  = $row['post_title'];
                $author = $row['post_author'];
                $date   = $row['post_date'];
                $image  = $row['post_image'];
                $content = substr($row['post_content'],0,100)."...";
                $post_status   = $row['post_status'];


                // if ($post_status == 'published') {
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
                      by <a href="author_post.php?post_author=<?php echo $author; ?>"><?php echo $author; ?></a>
                  </p>
                  <p><span class="glyphicon glyphicon-time"></span> <?php echo $date; ?></p>
                  <hr>
                  <a href="post.php?post_id=<?php echo $post_id; ?>">
                    <img class="img-responsive" src="images/<?php  echo $image; ?>" alt="">
                  </a>
                  <hr>
                  <p><?php echo $content; ?></p>
                  <a class="btn btn-primary" href="post.php?post_id=<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                  <hr>

              <?php } }

             ?>
                <!-- Pager -->
            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include('includes/sidebar.php'); ?>
        </div>
        <!-- /.row -->

        <hr>

        <nav aria-label="Page navigation example">
  <ul class="pagination">
    <li class="page-item">
      <a class="page-link" href="#" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
        <span class="sr-only">Previous</span>
      </a>
    </li>
    <?php
        for ($i=1; $i <= $count_rows ; $i++) {
          if ($i == $page) {
            echo "<li class='page-item active'><a class='page-link' href='index.php?page=$i'>$i</a></li>";
          } else {
              echo "<li class='page-item'><a class='page-link' href='index.php?page=$i'>$i</a></li>";
          }
        }
    ?>
    <li class="page-item">
      <a class="page-link" href="#" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
        <span class="sr-only">Next</span>
      </a>
    </li>
  </ul>
</nav>

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
