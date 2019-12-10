<table class="table table-bordered table-hover">
  <thead>
    <tr>
      <th>Id</th>
      <th>Username</th>
      <th>First Name</th>
      <th>Last Name</th>
      <th>Email</th>
      <th>Image</th>
      <th>Role</th>
      <th colspan="2">Change Role</th>
      <th>Delete</th>
      <th>Edit</th>
    </tr>
  </thead>
  <tbody>
    <?php
        echo find_all_users();
     ?>
  </tbody>
</table>
