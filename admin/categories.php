<?php
  include('includes/admin_header.php');
 ?>
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
                    </div>
                </div>
                <!-- /.row -->
                <!-- Add category -->
                <div class="row">
                  <div class="col-md-6">
                    <!-- Query to fetch all categories -->
                      <?php  echo insert_category();  ?>
                     <!-- Query to delete requested category -->
                  <?php  echo delete_category(); ?>

                      <!-- Add Category Form -->
                    <form class="" action="" method="post">
                      <div class="form-group">
                        <label for="cat_title">Add Category</label>
                        <input type="text" name="cat_title" value="" class="form-control" id="cat_title">
                      </div>
                      <input class="btn btn-primary" type="submit" name="cat_btn" value="Add Category">
                    </form> <br>

                    <!-- Update Category Form -->
                    <?php if (isset($_GET['cat_edit_id'])) {
                      include('includes/update_category.php');
                    } ?>

                  </div>  <!-- end of first column -->
                <div class="col-md-6">
                  <table class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>Id</th>
                        <th>Category</th>
                        <th>Delete</th>
                        <th>Edit</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php find_all_categories(); ?>
                    </tbody>
                  </table>
                </div>
            </div>  <!-- end of row -->
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
