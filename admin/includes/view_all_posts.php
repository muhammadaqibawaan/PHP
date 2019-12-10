<?php

  if (isset($_POST['checkBoxArray'])) {
  foreach ($_POST['checkBoxArray'] as $checkBoxValue) {
    $bulk_options = $_POST['bulk_options'];

    switch ($bulk_options) {
      case 'published':
        $query = "UPDATE posts SET post_status='{$bulk_options}' WHERE post_id=$checkBoxValue";
        $run = mysqli_query($connection, $query);
        if (!$run) {
          die('Failed'.mysqli_error($connection));
        }
        break;

        case 'draft':
          $query = "UPDATE posts SET post_status='{$bulk_options}' WHERE post_id=$checkBoxValue";
          $run = mysqli_query($connection, $query);
          if (!$run) {
            die('Failed'.mysqli_error($connection));
          }
          break;

          case 'delete':
            $query = "DELETE FROM posts WHERE post_id=$checkBoxValue";
            $run = mysqli_query($connection, $query);
            if (!$run) {
              die('Failed'.mysqli_error($connection));
            }
            break;


            case 'clone':
              $query = "SELECT * FROM posts WHERE post_id=$checkBoxValue";
              $run = mysqli_query($connection, $query);
              if (!$run) {
                die('Failed'.mysqli_error($connection));
              } else {

              $row = mysqli_fetch_assoc($run);
                $post_cat_id =  $row['post_cat_id'];
                $post_title =  $row['post_title'];
                $post_author =  $row['post_author'];
                $post_image =  $row['post_image'];
                $post_date = $row['post_date'];
                $post_tags =  $row['post_tags'];
                $post_content =  $row['post_content'];
                $post_status =  $row['post_status'];


                $query = "INSERT INTO posts(post_cat_id, post_title, post_author, post_date,post_image,post_content,post_tags,post_status) ";

                $query .= "VALUES({$post_cat_id},'{$post_title}','{$post_author}',now(),'{$post_image}','{$post_content}','{$post_tags}', '{$post_status}') ";
                $post_id = mysqli_insert_id($connection);

                $create_post_query = mysqli_query($connection, $query);
                if (!$create_post_query) {
                  die("Failed".mysqli_error($connection));
                }

              break;

            }
    }
  }
}

?>
<?php  include('bootstrap_model.php'); ?>
<form class="" action="" method="post">
<table class="table table-bordered table-hover">
  <div class="row">
    <div class="bulkOptionContainer col-xs-4">
        <select class="form-control" name="bulk_options">
            <option value="">Select Options</option>
            <option value="published">Published</option>
            <option value="draft">Draft</option>
            <option value="clone">Clone</option>
            <option value="delete">Delete</option>
        </select>
    </div>
      <div class="col-xs-4">
        <input type="submit" name="submit" value="Apply" class="btn btn-success">
        <a href="posts.php?source=add_posts" class="btn btn-primary">Add New</a>
    </div>
  </div> <br>

  <thead>
    <tr>
      <th><input type="checkbox" onclick='selectAll()' value="Select All"</th>
      <th>Id</th>
      <th>Category</th>
      <th>Title</th>
      <th>Author</th>
      <th>Image</th>
      <th>Date</th>
      <th>Tags</th>
      <th>Comment Count</th>
      <th>Status</th>
      <th>Views Count</th>
      <th colspan="2">View | Edit</th>
      <th>Delete</th>
    </tr>
  </thead>
  <tbody>
    <?php
        echo find_all_posts();
     ?>
  </tbody>
</table>
</form>

<!-- <script>
    $(document).ready(function(){
      $('.delete-link').on('click', function(){
        var id = $(this).attr('rel');
        var deleteLink = "posts.php?delete="+ id +"";
        $('.delete-link-model').attr('href',deleteLink);
        $('#myModal').modal('show');
      })
    })
</script> -->
