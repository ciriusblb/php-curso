
<?php 
  if(isset($_GET['edit_id'])) {
    $edit_id = $_GET['edit_id'];
    $query = "SELECT * FROM posts WHERE post_id = {$edit_id}";
    $editing_query = mysqli_query($connection, $query);
    while($row = mysqli_fetch_assoc($editing_query)) {
      $post_id =$row['post_id'];
      $post_author = $row['post_author'];
      $post_title = $row['post_title'];
      $post_category_id =$row['post_category_id'];
      $post_status = $row['post_status'];
      $post_image = $row['post_image'];
      $post_content = $row['post_content'];
      $post_tags = $row['post_tags'];
      $post_comment_count = $row['post_comment_count'];
    }
  }

  if (isset($_POST['update_post'])) {
      $post_title = $_POST['post_title'];
      $post_category_id =$_POST['post_category_id'];
      $post_author = $_POST['post_author'];
      $post_status = $_POST['post_status'];
      $post_image = $_FILES['image']['name'];
      $post_image_temp = $_FILES['image']['tmp_name'];
      $post_tags = $_POST['post_tags'];
      $post_content = $_POST['post_content'];
      $post_date = date('d-m-y');
      move_uploaded_file($post_image_temp, "../images/$post_image");
      
      if(empty($post_image)) {
        
        $query = "SELECT * FROM posts WHERE post_id = $edit_id ";
        $select_image = mysqli_query($connection,$query);
            
        while($row = mysqli_fetch_array($select_image)) {
            
           $post_image = $row['post_image'];
        
        }
        
      }


      
      $query = "UPDATE posts SET ";
      $query .= "post_title = '{$post_title}', ";
      $query .= "post_category_id = '{$post_category_id}', ";
      $query .= "post_date = now(),  ";
      $query .= "post_author = '{$post_author}',  ";
      $query .= "post_status = '{$post_status}',  ";
      $query .= "post_tags = '{$post_tags}',  ";
      $query .= "post_content = '{$post_content}', ";
      $query .= "post_image = '{$post_image}' ";
      $query .= "WHERE post_id = '{$edit_id}' ";

     $update_query = mysqli_query($connection, $query);
     confirm($update_query);

    echo "<div class='alert alert-success' role='alert'>";
      echo "Post actualizado <a href='../post.php?post_id={$edit_id}'>ver noticia</a> o <a href='view_posts.php'>editar otra noticia</a>";
    echo "</div>";

  }
  
 ?>

<form action="" method="post" enctype="multipart/form-data">
  <div class="form-group">
    <label for="post_title">Título de noticia</label>
    <input type="text" value="<?php echo $post_title; ?>" class="form-control" name="post_title">
  </div>
  <div class="form-group">
    <label for="post_category_id">Categoría de noticia </label>

    <select name="post_category_id" class="form-control" id="post_category_id">
  
      <?php 

      $query = "SELECT * FROM categories WHERE cat_id = '{$post_category_id}'";
      $category = mysqli_query($connection, $query);
      while($row = mysqli_fetch_assoc($category)) {
        $the_cat_id = $row['cat_id'];
        $the_cat_title = $row['cat_title'];

          echo "<option value='{$the_cat_id}'>{$the_cat_title}</option>";

      }
       ?>
      <?php 
         $query = "SELECT * FROM categories";
         $categories_query = mysqli_query($connection, $query);
         while($row = mysqli_fetch_assoc($categories_query)) {
            if($post_category_id != $row['cat_id']) {
              echo "<option value='{$row['cat_id']}'>{$row['cat_title']}</option>";
            }
         }
       ?>
    </select>
  </div>
  <div class="form-group">
    <label for="post_author">Autor de noticia</label>
    <input type="text" value="<?php echo $post_author; ?>" class="form-control" name="post_author">
  </div>
  <div class="form-group">
    <label for="post_status">Estado de noticia</label>
    <select name="post_status" class="form-control">
      <option value="<?php echo $post_status; ?>"><?php echo $post_status; ?></option>
      <?php 
      if($post_status == 'draft') {
        echo "<option value='published'>Publico</option>";
      } else {
        echo "<option value='draft'>Privado</option>";      
      }
       ?>
    </select>
  </div>
  <div class="form-group">
    <label for="post_image">Imagen de noticía</label>
    <img width="100" src="../images/<?php echo $post_image ?>">
    <input type="file" value="" name="image">
  </div>
  <div class="form-group">
    <label for="post_tags">Etiquetas de noticia</label>
    <input type="text" value="<?php echo $post_tags; ?>" class="form-control" name="post_tags">
  </div>
  <div class="form-group">
    <label for="post_content">Contenido de noticia</label>
    <textarea class="form-control" name="post_content" cols="30" rows="10"><?php echo $post_content; ?></textarea>
  </div>
  <button type="submit" name="update_post"  class="btn btn-primary">Actualizar</button>
</form>