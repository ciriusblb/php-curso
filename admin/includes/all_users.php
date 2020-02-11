<?php 
  if(isset($_GET['delete'])) {
    $delete_user_id = $_GET['delete'];
    $query = "DELETE FROM users WHERE user_id = {$delete_user_id}";
    $delete_query = mysqli_query($connection, $query);
    header("Location: users.php");

  }
 ?>
<?php 
  if(isset($_GET['admin'])) {
    $user_id = $_GET['admin'];
    $query = "UPDATE users SET user_role = 'Admin' WHERE user_id = {$user_id}";
    $update_query = mysqli_query($connection, $query);
    header("Location: users.php");
  }
 ?>
 <?php 
  if(isset($_GET['suscriber'])) {
    $user_id = $_GET['suscriber'];
    $query = "UPDATE users SET user_role = 'Suscriber' WHERE user_id = {$user_id}";
    $update_query = mysqli_query($connection, $query);
    header("Location: users.php");
  }
 ?>
<table class="table table-bordered table-hover">
     <thead>
         <tr>
             <th>ID</th>
             <th>Username</th>
             <th>Nombre(s)</th>
             <th>Apellidos</th>
             <th>Correo Electrónico</th>
             <th>Rol</th>
             <th colspan="4">Acciones</th>
         </tr>
     </thead>
     <tbody>
         
         <?php 
              $query = "SELECT * FROM users";
              $users = mysqli_query($connection, $query);
              while($row = mysqli_fetch_assoc($users)){
                $user_id = $row['user_id'];
                $username = $row['username'];
                $user_password = $row['user_password'];
                $user_firstname = $row['user_firstname'];
                $user_lastname = $row['user_lastname'];
                $user_email = $row['user_email'];
                $user_role = $row['user_role'];


                  echo "<tr>";
                  echo   "<td>{$user_id}</td>";
                  echo   "<td>{$username}</td>";
                  echo   "<td>{$user_firstname}</td>";
                  echo   "<td>{$user_lastname}</td>";
                  echo   "<td>{$user_email}</td>";
                  // $query = "SELECT * FROM posts where post_id = {$comment_post_id}";
                  //  $post_query = mysqli_query($connection, $query);
                  //  while($row = mysqli_fetch_assoc($post_query)) {
                  //   $post_id = $row['post_id'];                                      
                  //   $post_title = $row['post_title'];
                  //   echo   "<td> <a href='../post.php?post_id={$post_id}'>{$post_title}</a></td>";
                  //  }
                  echo   "<td>{$user_role}</td>";
                  echo   "<td><a href='users.php?admin={$user_id}'>Administrador</a></td>";
                  echo   "<td><a href='users.php?suscriber={$user_id}'>Suscriptor</a></td>";
                  echo   "<td><a href='users.php?source=edit_user&user_id={$user_id}'>Editar</a></td>";
                  echo   "<td><a href='users.php?delete={$user_id}'>Eliminar</a></td>";

                  echo "</tr>";
              }


          ?> 
     </tbody>
 </table>