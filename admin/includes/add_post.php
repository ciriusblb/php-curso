
<?php 
  if(isset($_POST['create_post'])) {
    $post_title = $_POST['post_title'];
    $post_category_id =$_POST['post_category_id'];
    $post_author = $_POST['post_author'];
    $post_user = $_POST['post_user'];

    $post_status = $_POST['post_status'];
    $post_image = $_FILES['image']['name'];
    $post_image_temp = $_FILES['image']['tmp_name'];
    $post_tags = $_POST['post_tags'];
    $post_content = $_POST['post_content'];
    $post_date = date('d-m-y');
    $post_comment_count = 0;

    move_uploaded_file($post_image_temp, "../images/$post_image");

    $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_user, post_date, post_image, post_content, post_tags, post_comment_count, post_status) ";
    $query .= "VALUES( {$post_category_id}, '{$post_title}','{$post_author}','{$post_user}',now(),'{$post_image}','{$post_content}','{$post_tags}',{$post_comment_count},'{$post_status}' ) ";
    $add_query_post = mysqli_query($connection, $query);
    confirm($add_query_post);
  }
  
 ?>


<form action="" method="post" enctype="multipart/form-data">
  <div class="form-group">
    <label for="post_title">Titulo de noticia</label>
    <input type="text" class="form-control" name="post_title">
  </div>
    <div class="form-group">
    <label for="post_category_id">Categoría de noticia</label>
    <select name="post_category_id" class="form-control" id="post_category_id">
      <?php 
         $query = "SELECT * FROM categories";
         $categories_query = mysqli_query($connection, $query);
         while($row = mysqli_fetch_assoc($categories_query)) {
          $cat_id = $row['cat_id'];
          $cat_title = $row['cat_title'];
          echo "<option value='{$cat_id}'>{$cat_title}</option>";
         }
       ?>
    </select>
  </div>
    <div class="form-group">
    <label for="post_author">Autor de la noticia</label>
    <input type="text" class="form-control" name="post_author">
  </div>
  <div class="form-group">
    <label for="post_user">Administrador responsable</label>
    <select name="post_user" class="form-control">
      <option value = "<?php echo $_SESSION['username'] ?>"><?php echo $_SESSION['username'] ?></option>
    </select>
  </div>
  <div class="form-group">
    <label for="post_status">Estado de noticia</label>
    <select name="post_status" class="form-control">
      <option value="published">Público</option>
      <option value="draft">Privado</option>
    </select>
  </div>
  <div class="form-group">
    <label for="post_image">Imagen de noticia</label>
    <input type="file" name="image">
  </div>
  <div class="form-group">
    <label for="post_tags">Etiquetas de noticia</label>
    <input type="text" class="form-control" name="post_tags">
  </div>
  <div class="form-group">
    <label for="post_content">Contenido de noticia</label>
    <textarea class="form-control" name="post_content" id="textarea" cols="30" rows="10"></textarea>
  </div>
  <button type="submit" name="create_post"  class="btn btn-primary">Guardar</button>
</form>