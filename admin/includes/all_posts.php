
<?php 
  if(isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];

    $query = "DELETE FROM posts WHERE post_id = {$delete_id}";
    $delete_query = mysqli_query($connection, $query);
    header("Location: view_posts.php");
  }
 ?>

<?php 
  if (isset($_POST['checkboxArray'])) {
    foreach ($_POST['checkboxArray'] as $postValueId) {
      $bulk_options = $_POST['bulk_options'];
      switch ($bulk_options) {
        case 'published':
          $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$postValueId}";
          $update_published_status = mysqli_query($connection, $query);
          confirm($update_published_status);
          break;
        case 'draft':
          $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$postValueId}";
          $update_draft_status = mysqli_query($connection, $query);
          confirm($update_draft_status);
          break;
        case 'delete':
          $query = "DELETE FROM posts where post_id = {$postValueId}";
          $delete_post = mysqli_query($connection, $query);
          confirm($delete_post);
          break;
        
      }
    }
  }

 ?>
<form action="" method="post">

<table class="table table-bordered table-hover">

  <div id="bulkOptionContainer" class="col-xs-4">
    <select class="form-control" name="bulk_options" id="">
      <option value="">Seleccionar opción</option>
      <option value="published">Público</option>
      <option value="draft">Privado</option>
      <option value="delete">Eliminar</option>
    </select>
  </div>
  <div class="col-xs-4">
    <input type="submit" name="submit" class="btn btn-success" value="Aplicar">
<!--     <a href="add_post.php" class="btn btn-primary">Nuevo Post</a> -->
  </div>

   <thead>
       <tr>
        <th><input type="checkbox" id="selectAllBoxes"></th>
           <th>ID</th>
           <th>Autor</th>
           <th>Titulo</th>
           <th>Categoría</th>
           <th>Estado</th>
           <th>Imagen</th>
           <th>Etiquetas</th>
           <th>Comentarios</th>
           <th>Fecha</th>
           <th colspan="2">Acciones</th>
       </tr>
   </thead>
   <tbody>
       
       <?php 
            $query = "SELECT * FROM posts";
            $posts = mysqli_query($connection, $query);
            while($row = mysqli_fetch_assoc($posts)){
              $post_id = $row['post_id'];
              $post_author = $row['post_author'];
              $post_title = $row['post_title'];
              $post_category_id = $row['post_category_id'];
              $post_status = $row['post_status'];
              $post_image = $row['post_image'];
              $post_tags = $row['post_tags'];
              $post_comment_count = $row['post_comment_count'];
              $post_date = $row['post_date'];


                echo "<tr>";
                ?>
                <td><input type="checkbox" class="checkBoxes" name="checkboxArray[]" value=" <?php echo $post_id ?> "></td>
                <?php 
                echo   "<td>{$post_id}</td>";
                echo   "<td>{$post_author}</td>";
                echo   "<td>{$post_title}</td>";

                $query = "SELECT * FROM categories where cat_id = {$post_category_id}";
                 $category_query = mysqli_query($connection, $query);
                 while($row = mysqli_fetch_assoc($category_query)) {
                  $cat_id = $row['cat_id'];
                  $cat_title = $row['cat_title'];

                  echo "<td>{$cat_title}</td>";
                 }

                // echo   "<td>{$row['post_category_id']}</td>";




                echo   "<td>{$post_status}</td>";
                echo   "<td><img width='100' src='../images/{$post_image}'></td>";
                echo   "<td>{$post_tags}</td>";
                echo   "<td>{$post_comment_count}</td>";
                echo   "<td>{$post_date}</td>";
                echo   "<td><a href='view_posts.php?source=edit_post&edit_id={$post_id}'>Editar</a></td>";

                echo   "<td><a href='view_posts.php?delete={$post_id}'>Eliminar</a></td>";

                echo "</tr>";
            }


        ?> 
   </tbody>
</table>

</form>

