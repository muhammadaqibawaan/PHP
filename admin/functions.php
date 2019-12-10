<?php
function insert_category(){
  global $connection;
    if (isset($_POST['cat_btn'])) {
      $cat_title = $_POST['cat_title'];
      if(!empty($cat_title)){
        $cat_query = "INSERT INTO category (cat_title) VALUES ('$cat_title')";
          $cat_query_run = mysqli_query($connection,$cat_query);
          if ($cat_query_run) {
            header('location:categories.php');
          } else {
            die('Query Failed'.mysqli_error($connection));
          }
      }else {
        echo "This field shoud not be empty";
      }
    }
}

function delete_category(){
    global $connection;
     if (isset($_GET['cat_delete_id']) && $_GET['cat_delete_id'] !='') {
       $cat_delete_id = $_GET['cat_delete_id'];
       $delete_query = "DELETE FROM category WHERE cat_id='".$cat_delete_id."'";
       if (mysqli_query($connection,$delete_query)) {
         header('location:categories.php');
       }
     }
}

function  find_all_categories(){
    global $connection;
    $query = "SELECT * FROM category";
    $count = 1;
    $run = mysqli_query($connection,$query);
    while ($row = mysqli_fetch_assoc($run)) {
        echo "<tr>";
        echo "<td>".$count++."</td>";
        echo "<td>{$row['cat_title']}</td>";
        echo "<td><a href='categories.php?cat_delete_id=".$row['cat_id']."'>Delete</td>";
        echo "<td><a href='categories.php?cat_edit_id=".$row['cat_id']."'>Edit</td>";
        echo "</tr>";
    }
}

function  find_all_posts(){
    global $connection;
    $query = "SELECT * FROM posts";
    $count = 1;
    $run = mysqli_query($connection,$query);
    while ($row = mysqli_fetch_assoc($run)) {
        $post_id = $row['post_id'];
        echo "<tr>";
        echo "<td>"; ?> <input type="checkbox" name="checkBoxArray[]" class="checkBoxArray" value="<?php  echo $post_id;  ?>">

        <?php echo "</td>";
        echo "<td>".$count++."</td>";

        $post_cat_id = $row['post_cat_id'];

        $query1 = "SELECT * FROM category WHERE cat_id='".$post_cat_id."'";
        $run1 = mysqli_query($connection,$query1);
        $row1 = mysqli_fetch_assoc($run1);
        echo "<td>{$row1['cat_title']}</td>";

        echo "<td>{$row['post_title']}</td>";
        echo "<td>{$row['post_author']}</td>";
        echo "<td><img src='../images/{$row['post_image']}' width='100'></td>";
        echo "<td>{$row['post_date']}</td>";
        echo "<td>{$row['post_tags']}</td>";

        $comment_query = "SELECT * FROM comment WHERE comment_post_id = $post_id";
        $comment_result = mysqli_query($connection, $comment_query);
        $comment_row = mysqli_fetch_assoc($comment_result);
        $comment_post_id = $comment_row['comment_post_id'];
        $comment_count =  mysqli_num_rows($comment_result);

        echo "<td><a href='comments.php?source=all_posts&all_comment=$comment_post_id'> {$comment_count} </a></td>";
        echo "<td>{$row['post_status']}</td>";

        echo "<td><a href='posts.php?reset_views=".$row['post_id']."'>{$row['post_views_count']}</a></td>";
        echo "<td colspan='2'><a href='../post.php?post_id=".$row['post_id']."'>View</a> | ";
        echo "<a href='posts.php?source=edit_post&post_id=".$row['post_id']."'>Edit</a></td>";
        // echo "<td><a href='posts.php?delete=".$row['post_id']."'>Delete</a></td>";?>

          <form class="" action="" method="post">
            <input type="hidden" name="post_id" value="<?php echo $row['post_id']; ?>">
            <?php echo "<td><input class='btn btn-danger' type='submit' name='delete' value='Delete'></td>"; ?>
          </form>


      <?php
      // echo "<td><a rel='$post_id' href='javascript:void(0)' class='delete-link'>Delete</a></td>";
        echo "</tr>";
    }
}


function  find_all_comments(){
    global $connection;
    $query = "SELECT * FROM comment";
    $count = 1;
    $run = mysqli_query($connection,$query);
    while ($row = mysqli_fetch_assoc($run)) {
      $comment_id = $row['comment_id'];
        echo "<tr>";
        echo "<td>".$count++."</td>";

        $comment_post_id = $row['comment_post_id'];
        // $query1 = "SELECT * FROM category WHERE cat_id='".$post_cat_id."'";
        // $run1 = mysqli_query($connection,$query1);
        // $row1 = mysqli_fetch_assoc($run1);
        // echo "<td>{$row1['cat_title']}</td>";

        echo "<td>{$row['comment_author']}</td>";
        echo "<td>{$row['comment_post_id']}</td>";
        echo "<td>{$row['comment_content']}</td>";
        echo "<td>{$row['comment_email']}</td>";
        echo "<td>{$row['comment_status']}</td>";

        $post_query = "SELECT post_id, post_title FROM posts WHERE post_id = $comment_post_id";
        $post_result = mysqli_query($connection,$post_query);
        while ($post_row = mysqli_fetch_assoc($post_result)) {
                $post_id = $post_row['post_id'];
                $post_title = $post_row['post_title'];
        }

        echo "<td><a href='../post.php?post_id=$post_id'>$post_title </a></td>";
        echo "<td>{$row['comment_date']}</td>";
        echo "<td><a href='comments.php?approve=$comment_id'>Approve</a></td>";
        echo "<td><a href='comments.php?unapprove=$comment_id'>Unapprove</a></td>";
        echo "<td><a href='comments.php?comment_delete_id=$comment_id'>Delete</a></td>";
        // echo "<td><a href='posts.php?source=edit_post&post_id=".$row['post_id']."'>Edit</a></td>";
        echo "</tr>";
    }
}



function  find_all_users(){
    global $connection;
    $query = "SELECT * FROM users";
    $count = 1;
    $run = mysqli_query($connection,$query);
    while ($row = mysqli_fetch_assoc($run)) {
        echo "<tr>";
        $user_id = $row['user_id'];
        $user_image = $row['user_image'];
        echo "<td>".$count++."</td>";
        echo "<td>{$row['username']}</td>";
        echo "<td>{$row['user_firstname']}</td>";
        echo "<td>{$row['user_lastname']}</td>";
        echo "<td>{$row['user_email']}</td>";

        echo "<td><img src='../images/users/$user_image' width='40'></td>";
        echo "<td>{$row['user_role']}</td>";
        echo "<td><a href='users.php?subscriber=$user_id'>Subscriber</a></td>";
        echo "<td><a href='users.php?admin=$user_id'>Admin</a></td>";
        echo "<td><a href='users.php?delete_user=$user_id'>Delete</a></td>";
        echo "<td><a href='users.php?source=edit_user&edit_user_id=$user_id'>Edit</a></td>";
        echo "</tr>";
    }
}


function post_view_all_comments(){

  global $connection;

  if (isset($_GET['all_comment'])) {

    $all_comment_id = $_GET['all_comment'];

  }

      $query = "SELECT * FROM comment WHERE comment_post_id = $all_comment_id";
      $count = 1;
      $run = mysqli_query($connection,$query);
      while ($row = mysqli_fetch_assoc($run)) {
        $comment_id = $row['comment_id'];
          echo "<tr>";
          echo "<td>".$count++."</td>";

          $comment_post_id = $row['comment_post_id'];
          // $query1 = "SELECT * FROM category WHERE cat_id='".$post_cat_id."'";
          // $run1 = mysqli_query($connection,$query1);
          // $row1 = mysqli_fetch_assoc($run1);
          // echo "<td>{$row1['cat_title']}</td>";

          echo "<td>{$row['comment_author']}</td>";
          echo "<td>{$row['comment_post_id']}</td>";
          echo "<td>{$row['comment_content']}</td>";
          echo "<td>{$row['comment_email']}</td>";
          echo "<td>{$row['comment_status']}</td>";

          $post_query = "SELECT post_id, post_title FROM posts WHERE post_id = $comment_post_id";
          $post_result = mysqli_query($connection,$post_query);
          while ($post_row = mysqli_fetch_assoc($post_result)) {
                  $post_id = $post_row['post_id'];
                  $post_title = $post_row['post_title'];
          }

          echo "<td><a href='../post.php?post_id=$post_id'>$post_title </a></td>";
          echo "<td>{$row['comment_date']}</td>";
          echo "<td><a href='comments.php?approve=$comment_id'>Approve</a></td>";
          echo "<td><a href='comments.php?unapprove=$comment_id'>Unapprove</a></td>";
          echo "<td><a href='comments.php?comment_delete_id=$comment_id'>Delete</a></td>";
          // echo "<td><a href='posts.php?source=edit_post&post_id=".$row['post_id']."'>Edit</a></td>";
          echo "</tr>";
      }
}


function users_online(){

  global $connection;

  $session = session_id();
  $time = time();
  $time_out_in_seconds = 60;
  $time_out = $time - $time_out_in_seconds;

  $query = "SELECT * FROM users_online WHERE session = '$session'";
  $result = mysqli_query($connection, $query);
  $row_count = mysqli_num_rows($result);

  if ($row_count == 0) {
    $insert_query = "INSERT INTO users_online(session, session_time) VALUES('$session', '$time')";
    mysqli_query($connection, $insert_query);
  } else {
    $update_qquery = "UPDATE users_online SET session_time = $time WHERE session_time = '$session'";
    mysqli_query($connection, $update_qquery);
  }

  $users_online_query = "SELECT * FROM users_online WHERE session_time > $time_out";
  $user_online_res = mysqli_query($connection, $users_online_query);
  $count_user = mysqli_num_rows($user_online_res);

  return $count_user;
}

 ?>
