<div class="col-md-4">
    <!-- Blog Search Well -->
    <div class="well">
        <h4>Blog Search</h4>
        <form class="" action="search.php" method="post">
          <div class="input-group">
              <input type="text" class="form-control" name="search">
              <span class="input-group-btn">
                  <button class="btn btn-default" type="submit" name="search_btn">
                      <span class="glyphicon glyphicon-search"></span>
              </button>
              </span>
          </div>
        </form>
    </div>
        <!-- /.input-group -->

          <!-- Login Form -->
        <div class="well">
          <?php if(isset($_SESSION['user_role'])):
            echo "<h4>Loged In</h4> ";
            echo "Welcome <strong>".$_SESSION['username']."</strong><br>";
           ?>
           <a class="btn btn-primary" href="admin/includes/logout.php">Logout</a>

         <?php else:  ?>
            <h4>Login</h4>
            <form class="" action="includes/login.php" method="post">
              <div class="form-group">
                  <input type="text" class="form-control" name="login_username" placeholder="username">
              </div>
              <div class="input-group">
                  <input type="password" class="form-control" name="login_password" placeholder="password">
                  <span class="input-group-btn">
                      <button class="btn btn-primary" type="submit" name="login_btn">Login
                  </button>
                  </span>
              </div>
            </form>
          <?php endif; ?>
</div>

    <!-- Blog Categories Well -->
    <div class="well">
        <h4>Blog Categories</h4>
        <div class="row">
            <div class="col-lg-12">
                <ul class="list-unstyled">
              <?php
                $query = "SELECT * FROM category";
                $run = mysqli_query($connection,$query);
                while ($row = mysqli_fetch_assoc($run)) {
                    $cat_id = $row['cat_id'];
                    echo "<li><a href='category.php?category_id=$cat_id'>{$row['cat_title']}</a>";
                }
               ?>
                 </ul>
            </div>
            <!-- /.col-lg-6 -->
        </div>
        <!-- /.row -->
    </div>

    <?php include('includes/widget.php'); ?>
</div>
