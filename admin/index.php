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
                            <small>
                              <?php
                                  if (isset($_SESSION['username'])) {
                                  echo $_SESSION['username'];

                                  }
                               ?>
                          </small>
                        </h1>
                    </div>
                </div>
                <!-- /.row -->

                <?php  include('includes/widgets.php');  ?>

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
