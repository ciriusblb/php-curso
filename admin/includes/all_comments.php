<?php 
  if(isset($_GET['delete'])) {
    $delete_comment_id = $_GET['delete'];
    $query = "DELETE FROM comments WHERE comment_id = {$delete_comment_id}";
    $delete_query = mysqli_query($connection, $query);
  }
 ?>
<?php 
  if(isset($_GET['aprove'])) {
    $comment_id = $_GET['aprove'];
    $query = "UPDATE comments SET comment_status = 'aprove' WHERE comment_id = {$comment_id}";

    $update_query = mysqli_query($connection, $query);
    header("Location: comments.php");
  }
 ?>
 <?php 
  if(isset($_GET['unaprove'])) {
    $comment_id = $_GET['unaprove'];
    $query = "UPDATE comments SET comment_status = 'unaprove' WHERE comment_id = {$comment_id}";

    $update_query = mysqli_query($connection, $query);
    header("Location: comments.php");

  }
 ?>
<table class="table table-bordered table-hover">
                           <thead>
                               <tr>
                                   <th>ID</th>
                                   <th>Autor</th>
                                   <th>Comentario</th>
                                   <th>Correo electrónico</th>
                                   <th>Estado</th>
                                   <th>En respuesta a</th>
                                   <th>Fecha</th>
                                   <th>Aprobar</th>
                                   <th>Desaprobar</th>
                                   <th>Acciones</th>
                               </tr>
                           </thead>
                           <tbody>
                               
                               <?php 
                                    $query = "SELECT * FROM comments";
                                    $comments = mysqli_query($connection, $query);
                                    while($row = mysqli_fetch_assoc($comments)){
                                      $comment_id = $row['comment_id'];
                                      $comment_author = $row['comment_author'];
                                      $comment_content = $row['comment_content'];
                                      $comment_email = $row['comment_email'];
                                      $comment_status = $row['comment_status'];
                                      $comment_post_id = $row['comment_post_id'];
                                      $comment_date = $row['comment_date'];


                                        echo "<tr>";
                                        echo   "<td>{$comment_id}</td>";
                                        echo   "<td>{$comment_author}</td>";
                                        echo   "<td>{$comment_content}</td>";
                                        echo   "<td>{$comment_email}</td>";
                                        echo   "<td>{$comment_status}</td>";
                                        $query = "SELECT * FROM posts where post_id = {$comment_post_id}";
                                         $post_query = mysqli_query($connection, $query);
                                         while($row = mysqli_fetch_assoc($post_query)) {
                                          $post_id = $row['post_id'];                                      
                                          $post_title = $row['post_title'];
                                          echo   "<td> <a href='../post.php?post_id={$post_id}'>{$post_title}</a></td>";
                                         }
                                        echo   "<td>{$comment_date}</td>";
                                        echo   "<td><a href='comments.php?aprove={$comment_id}'>Aprobar</a></td>";
                                        echo   "<td><a href='comments.php?unaprove={$comment_id}'>Desaprobar</a></td>";
                                        echo   "<td><a href='comments.php?delete={$comment_id}'>Eliminar</a></td>";

                                        echo "</tr>";
                                    }


                                ?> 
                           </tbody>
                       </table>