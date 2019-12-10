<form class="" action="" method="post">
  <div class="form-group">
    <label for="cat_title">Edit Category</label>
    <?php
      if (isset($_GET['cat_edit_id']) && !empty($_GET['cat_edit_id'])) {
          $cat_edit_id = $_GET['cat_edit_id'];
          $query = "SELECT * FROM category WHERE cat_id='".$cat_edit_id."'";
          $result = mysqli_query($connection,$query);
          $row = mysqli_fetch_assoc($result);
          $cat_edit_title = $row['cat_title']; ?>
        <input type="text" name="cat_title" value="<?php if(isset($cat_edit_title)){ echo $cat_edit_title; }  ?>" class="form-control" id="cat_title">;
      <?php } ?>
  </div>
  <?php
      if (isset($_POST['cat_edit_btn'])) {
        $cat_edit_id = $_GET['cat_edit_id'];
        $cat_edit = $_POST['cat_title'];
        $cat_edit_query = "UPDATE category SET cat_title='".$cat_edit."' WHERE cat_id='".$cat_edit_id."'";
        if (mysqli_query($connection,$cat_edit_query)) {
          header('location:categories.php');
        }
      }
   ?>
  <input class="btn btn-primary" type="submit" name="cat_edit_btn" value="Edit Category">
</form>
