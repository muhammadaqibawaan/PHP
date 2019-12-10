<?php

if (isset($_GET['post_id'])) {
  $post_edit_id = $_GET['post_id'];
  $query = "SELECT * FROM posts WHERE post_id={$post_edit_id}";
  $run = mysqli_query($connection,$query);
  $row = mysqli_fetch_assoc($run);
    $post_cat_id =  $row['post_cat_id'];
    $post_title =  $row['post_title'];
    $post_author =  $row['post_author'];
    $post_image =  $row['post_image'];
    $post_date = $row['post_date'];
    $post_tags =  $row['post_tags'];
    $post_content =  $row['post_content'];
    $post_status =  $row['post_status'];
}
   if(isset($_POST['edit_post'])) {

            $post_title        = $_POST['title'];
            $post_user         = $_POST['post_user'];
            $post_category  = $_POST['post_category'];
            // echo $post_category;
            $post_status       = $_POST['post_status'];

            $post_image        = $_FILES['image']['name'];
            $post_image_temp   = $_FILES['image']['tmp_name'];


            $post_tags         = $_POST['post_tags'];
            $post_content         = $_POST['post_content'];


        move_uploaded_file($post_image_temp, "../images/$post_image" );

        if (empty($_POST['post_image'])) {
          $query = "SELECT * FROM posts WHERE post_id={$post_edit_id}";
          $run = mysqli_query($connection,$query);
          $row = mysqli_fetch_assoc($run);
            $post_image =  $row['post_image'];
        }

        if (empty($_POST['post_status'])) {
          $query = "SELECT post_status FROM posts WHERE post_id={$post_edit_id}";
          $run = mysqli_query($connection,$query);
          $row = mysqli_fetch_assoc($run);
          $post_status =  $row['post_status'];
        }

        if (empty($_POST['post_user'])) {
          $query = "SELECT post_author FROM posts WHERE post_id={$post_edit_id}";
          $run = mysqli_query($connection,$query);
          $row = mysqli_fetch_assoc($run);
          $post_user =  $row['post_author'];
        }

      $query = "UPDATE posts SET post_cat_id='".$post_category."', post_title='".$post_title."', post_author='".$post_user."',
                  post_image='".$post_image."', post_content='".$post_content."', post_tags='".$post_tags."', post_status='".$post_status."'
                   WHERE post_id='".$post_edit_id."'";



      $update_post_query = mysqli_query($connection, $query);
      if (!$update_post_query) {
        die("Failed".mysqli_error($connection));
      } else {
        echo "<p class='bg-success'>Updated: <a href='../post.php?post_id=$post_edit_id'>View Post</a> or <a href='posts.php'>Edit More Posts</a></p>";
      }
      // else {
      //   header('location:posts.php');
      // }

      // confirmQuery($create_post_query);
      //
      // $the_post_id = mysqli_insert_id($connection);
      //
      //
      // echo "<p class='bg-success'>Post Created. <a href='../post.php?p_id={$the_post_id}'>View Post </a> or <a href='posts.php'>Edit More Posts</a></p>";



   }



?>

    <form action="" method="post" enctype="multipart/form-data">


      <div class="form-group">
         <label for="title">Post Title</label>
          <input type="text" class="form-control" name="title" value="<?php echo $post_title; ?>">
      </div>

      <div class="form-group">
         <label for="post_category">Post Category Id</label>
         <select class="form-control" name="post_category">
           <!-- selected option -->
           <?php
              //  $query3 = "SELECT * FROM category WHERE cat_id=$post_cat_id";
              //  $run3 = mysqli_query($connection,$query3);
              //  while ($row3 = mysqli_fetch_assoc($run3)) {
              //
              //      echo "<option value='".$row3['cat_id']."' selected>{$row3['cat_title']}</option>";
              //
              // }
            ?>

            <!-- Fetching all dropdown items -->
         <?php
             $query = "SELECT * FROM category";
             $run = mysqli_query($connection,$query);
             while ($row = mysqli_fetch_assoc($run)) {

               $selectedValue = "";

               if ($row['cat_id'] == $post_cat_id) {
                 $selectedValue = "selected";
               }

               echo "<option value='".$row['cat_id']."' $selectedValue>{$row['cat_title']}</option>";
            }
          ?>
      </select>

      </div>


      <div class="form-group">
         <label for="post_user">Post Author</label>

         <select class="form-control" name="post_user">

            <option value="<?php $post_author; ?>"><?php echo $post_author; ?></option>

            <!-- Fetching all users -->
         <?php
             $user_query = "SELECT * FROM users";
             $user_run = mysqli_query($connection,$user_query);
             while ($user_row = mysqli_fetch_assoc($user_run)) {
               echo "<option value='".$user_row['username']."'>{$user_row['username']}</option>";
            }
          ?>
      </select>

      </div>

      <div class="form-group">
         <label for="post_status">Post Status</label>
         <select class="form-control" name="post_status">
           <option value="<?php $post_status ?>" selected><?php echo $post_status; ?></option>
           <?php if ($post_status == 'published') {
             echo "<option value='draft'>Draft</option>";
           } else {
              echo "<option value='published'>Published</option>";
           }
           ?>
         </select>
      </div>



    <div class="form-group">
         <label for="post_image">Post Image</label>
          <img src="../images/<?php echo $post_image; ?>" alt="<?php echo $post_title; ?>" width="100">
          <input type="file" name="image">
      </div>

      <div class="form-group">
         <label for="post_tags">Post Tags</label>
          <input type="text" class="form-control" name="post_tags" value="<?php echo $post_tags; ?>">
      </div>

      <div class="form-group">
         <label for="post_content">Post Content</label>
         <textarea class="form-control" name="post_content" id="" cols="30" rows="10"> <?php echo $post_content; ?>
         </textarea>
      </div>



       <div class="form-group">
          <input class="btn btn-primary" type="submit" name="edit_post" value="Edit Post">
      </div>


</form>
