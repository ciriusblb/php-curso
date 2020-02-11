<?php include "includes/header.php" ?>

<?php 
  if(isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $query = "SELECT * FROM users WHERE username = '{$username}' ";
    $get_query = mysqli_query($connection, $query);
    while($row = mysqli_fetch_assoc($get_query)) {
      $user_id =$row['user_id'];
      $username = $row['username'];
      $user_password = $row['user_password'];
      $user_firstname =$row['user_firstname'];
      $user_lastname = $row['user_lastname'];
      $user_email = $row['user_email'];
      $user_image = $row['user_image'];
      $user_role = $row['user_role'];
    }
  }

  if (isset($_POST['update_profile'])) {
      $username = $_POST['username'];
      $user_password =$_POST['user_password'];
      $user_firstname = $_POST['user_firstname'];
      $user_lastname = $_POST['user_lastname'];
      // $post_image = $_FILES['image']['name'];
      // $post_image_temp = $_FILES['image']['tmp_name'];
      $user_email = $_POST['user_email'];
      $user_role = $_POST['user_role'];
      // move_uploaded_file($post_image_temp, "../images/$post_image");
      
      // if(empty($post_image)) {
      //   $query = "SELECT * FROM posts WHERE post_id = $edit_id ";
      //   $select_image = mysqli_query($connection,$query);
      //   while($row = mysqli_fetch_array($select_image)) {
      //      $post_image = $row['post_image'];
      //   } 
      // }


      $query = "SELECT randSalt FROM users";
        $select_randsalt_query = mysqli_query($connection, $query);

        if(!$select_randsalt_query) {
            die("QUERY failed ". mysqli_error($connection));
        }
        $row = mysqli_fetch_array($select_randsalt_query);
        $salt = $row['randSalt'];
        $hashed_password = crypt($user_password, $salt);

      $query = "UPDATE users SET ";
      $query .= "username = '{$username}', ";
      $query .= "user_password = '{$hashed_password}', ";
      $query .= "user_firstname = '{$user_firstname}', ";
      $query .= "user_lastname = '{$user_lastname}', ";
      $query .= "user_email = '{$user_email}', ";
      $query .= "user_role = '{$user_role}' ";
      $query .= "WHERE user_id = '{$user_id}' ";

     $update_query = mysqli_query($connection, $query);
     confirm($update_query);

  }
  
 ?>
<body>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include "includes/navigation.php" ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Administrador: 
                            <small> <?php 
                                echo $_SESSION['username'];
                             ?> </small>
                        </h1>
                        
                        <form action="" method="post">
                          <div class="form-group">
                            <label for="user_firstname">Nombre(s)</label>
                            <input type="text" value="<?php echo $user_firstname ?>" class="form-control" name="user_firstname">
                          </div>
                          <div class="form-group">
                            <label for="user_lastname">Apellidos</label>
                            <input type="text" value="<?php echo $user_lastname ?>" class="form-control" name="user_lastname">
                          </div>
                            <div class="form-group">
                            <label for="user_role">Rol de Usuario</label>
                            <select name="user_role" class="form-control" id="user_role">
                              <option value="<?php echo $user_role ?>"> <?php echo $user_role ?> </option>
                                <?php 
                                 if($user_role = "Admin") {
                                  echo "<option value='Suscriber'>Suscriptor</option>";
                                 } else {
                                  echo "<option value='Admin'>Administrador</option>";
                                 }
                                ?>
                            </select>
                          </div>
                          <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" value="<?php echo $username ?>" class="form-control" name="username">
                          </div>
                          <div class="form-group">
                            <label for="user_email">Correo electrónico</label>
                            <input type="email" value="<?php echo $user_email ?>" class="form-control" name="user_email">
                          </div>
                          <div class="form-group">
                            <label for="user_password">Contraseña</label>
                            <input type="password" value="<?php echo $user_password ?>" class="form-control" name="user_password">
                          </div>
                          <!-- <div class="form-group">
                            <label for="post_image">POST Image</label>
                            <input type="file" name="image">
                          </div> -->

                          <button type="submit" name="update_profile"  class="btn btn-primary">Actualizar Usuario</button>
                        </form>
                        
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

<?php include "includes/footer.php" ?>

</body>

</html>
