<?php include_once('includes/connection.php');

session_start();

?>
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

              if (isset($_GET['category_id'])) {
                $category_id = $_GET['category_id'];
              }


              if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin' ) {
                  $query = "SELECT * FROM posts WHERE post_cat_id=$category_id";
              } else {
                $query = "SELECT * FROM posts WHERE post_cat_id=$category_id AND post_status='published'";
              }

              $fecth_all_posts = mysqli_query($connection,$query);
              $category_count = mysqli_num_rows($fecth_all_posts);
              if ($category_count < 1) {
                echo "<h1 class='text-center'>No Category Available</h1>";
              } else {

              while ($row = mysqli_fetch_assoc($fecth_all_posts)) {
                $post_id  = $row['post_id'];
                $title  = $row['post_title'];
                $author = $row['post_author'];
                $date   = $row['post_date'];
                $image  = $row['post_image'];
                $content = substr($row['post_content'],0,100)."...";
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
                  <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

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
