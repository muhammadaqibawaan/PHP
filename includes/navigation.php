<?php include_once('connection.php');
  // session_start();
 ?>
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="./index.php">CMS Front</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
              <?php
                $query = "SELECT * FROM category";
                $fetch_all_categories = mysqli_query($connection,$query);
                while ($row = mysqli_fetch_assoc($fetch_all_categories)) {
                  $cat_id = $row['cat_id'];

                  $category_class = '';
                  $register_class = '';
                  $page_name = basename($_SERVER['PHP_SELF']);

                  if (isset($_GET['category_id']) &&  $_GET['category_id'] == $cat_id) {

                    $category_class = 'active';

                  } else if($page_name == 'registration.php') {

                    $register_class = 'active';

                  }

                  echo "<li class='".$category_class."'>
                      <a href='category.php?category_id=$cat_id'>{$row['cat_title']}</a>
                  </li>";
                }
               ?>
               <li class="<?php echo $register_class; ?>">
                   <a href='registration.php' target="_blank">Register</a>
               </li>
               <li>
                   <a href='admin' target="_blank">Admin</a>
               </li>
               <?php if (isset($_SESSION['user_role'])) {
                   if (isset($_GET['post_id'])) {

                     $the_post_id = $_GET['post_id'];
                     echo "<li>
                         <a href='admin/posts.php?source=edit_post&post_id=$the_post_id' target='_blank'>Edit Post</a>
                     </li>";
                   }
                 }
              ?>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>
