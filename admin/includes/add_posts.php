
<?php

   if(isset($_POST['create_post'])) {

            $post_title        = $_POST['title'];

            // $post_id           = $_POST['post_id'];

            $post_user         = $_POST['post_user'];
            $post_category_id  = $_POST['post_cat_id'];
            $post_status       = $_POST['post_status'];

            $post_image        = $_FILES['image']['name'];
            $post_image_temp   = $_FILES['image']['tmp_name'];


            $post_tags         = $_POST['post_tags'];
            $post_content      = $_POST['post_content'];
            $post_date         = date('d-m-y');
            // $post_comment_count = 4;


        move_uploaded_file($post_image_temp, "../images/$post_image" );


      $query = "INSERT INTO posts(post_cat_id, post_title, post_author, post_date,post_image,post_content,post_tags,post_status) ";

      $query .= "VALUES({$post_category_id},'{$post_title}','{$post_user}',now(),'{$post_image}','{$post_content}','{$post_tags}', '{$post_status}') ";
      $post_id = mysqli_insert_id($connection);

      $create_post_query = mysqli_query($connection, $query);
      if (!$create_post_query) {
        die("Failed".mysqli_error($connection));
      } else {
        echo "Post Created.";
      }


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
          <input type="text" class="form-control" name="title">
      </div>

      <div class="form-group">
         <label for="post_cat_id">Post Category Id</label>
          <select class="form-control" name="post_cat_id">
            <?php
            $query = "SELECT * FROM category";
            $count = 1;
            $run = mysqli_query($connection,$query);
            while ($row = mysqli_fetch_assoc($run)) {
              echo "<option value='{$row['cat_id']}'>{$row['cat_title']}</option>";
            }
            ?>
          </select>
      </div>


      <div class="form-group">
         <label for="post_user">Post Author</label>
         <select class="form-control" name="post_user">
           <option value='aqib'>Select User</option>
           <?php
           $query = "SELECT * FROM users";
           $run = mysqli_query($connection,$query);
           while ($row = mysqli_fetch_assoc($run)) {
             echo "<option value='{$row['user_id']}'>{$row['username']}</option>";
           }
           ?>
         </select>
      </div>


      <div class="form-group">
         <label for="post_status">Post Status</label>
          <input type="text" class="form-control" name="post_status">
      </div>



    <div class="form-group">
         <label for="post_image">Post Image</label>
          <input type="file"  name="image">
      </div>

      <div class="form-group">
         <label for="post_tags">Post Tags</label>
          <input type="text" class="form-control" name="post_tags">
      </div>

      <div class="form-group">
         <label for="post_content">Post Content</label>
         <textarea class="form-control "name="post_content" id="" cols="30" rows="10">
         </textarea>
      </div>



       <div class="form-group">
          <input class="btn btn-primary" type="submit" name="create_post" value="Publish Post">
      </div>


</form>
