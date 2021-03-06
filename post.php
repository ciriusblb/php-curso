<?php include "includes/db.php" ?>
<?php include "includes/header.php" ?>

<?php 
    if(isset($_GET['post_id'])) {
        $post_id = $_GET['post_id'];
        $query = "SELECT * FROM posts WHERE post_id = {$post_id}";
        $post = mysqli_query($connection, $query);
        while($row = mysqli_fetch_assoc($post)) {
            $post_title = $row['post_title'];
            $post_author = $row['post_author'];
            $post_date = $row['post_date'];
            $post_image = $row['post_image'];
            $post_content = $row['post_content'];
        }
    }
?>



<body>
    <!-- Navigation -->
    <?php include "includes/navigation.php" ?>
    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Post Content Column -->
            <div class="col-lg-8">

                <!-- Blog Post -->

                <!-- Title -->
                <h1> <?php echo $post_title ?> </h1>

                <!-- Author -->
                <p class="lead">
                    by <a href="#"><?php echo $post_author ?></a>
                </p>

                <hr>

                <!-- Date/Time -->
                <p><span class="glyphicon glyphicon-time"></span> Publicado el día de <?php echo $post_date ?></p>

                <hr>

                <!-- Preview Image -->
                <img class="img-responsive" src="images/<?php echo $post_image ?>" alt="">

                <hr>

                <!-- Post Content -->
                <p class="lead"> <?php echo $post_content ?></p>

                <hr>

                <!-- Blog Comments -->

                <!-- Comments Form -->

                <?php 

                if(isset($_POST['crete_comment'])) {
                    $comment_post_id = $_GET['post_id'];
                    $comment_author = $_POST['comment_author'];
                    $comment_email = $_POST['comment_email'];
                    $comment_content = $_POST['comment_content'];

                    $query = "INSERT INTO comments(comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date) ";
                    $query .= "VALUES ({$comment_post_id}, '{$comment_author}', '{$comment_email}', '{$comment_content}', 'unaprove', now()) ";
                    $create_comment = mysqli_query($connection, $query);
                    if(!$create_comment) {
                        die("QUERY FAILED ". mysqli_error($connection));
                    }
                    $query = "UPDATE posts SET post_comment_count = post_comment_count + 1 WHERE post_id = {$comment_post_id}";
                    $update_comment_count = mysqli_query($connection, $query);
                    if(!$update_comment_count) {
                        die("QUERY FAILED ". mysqli_error($connection));
                    }


                }

                 ?>

                <div class="well">
                    <h4>Escribe un comentario:</h4>
                    <form role="form" method="post" action=""> 
                        <div class="form-group">
                            <label>De parte de</label>
                            <input type="text" class="form-control" name="comment_author">
                        </div>
                        <div class="form-group">
                            <label>Correo electrónico</label>
                            <input type="email" class="form-control" name="comment_email">                    
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="comment_content" rows="3"></textarea>
                        </div>
                        <button type="submit" name="crete_comment" class="btn btn-primary">Comentar</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->

                <!-- Comment -->
                <?php 

                $query = "SELECT * FROM comments where comment_post_id = {$post_id} AND comment_status = 'aprove' ORDER BY comment_id DESC";
                $comments = mysqli_query($connection, $query);
                while($row = mysqli_fetch_assoc($comments)) {
                    $comment_author = $row['comment_author'];
                    $comment_date = $row['comment_date'];
                    $comment_content = $row['comment_content'];
                    ?>
                    <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"> <?php echo $comment_author; ?>
                            <small><?php echo $comment_date; ?></small>
                        </h4>
                        <?php echo $comment_content; ?>
                    </div>
                </div>
                <?php 
                }

                ?>
                



            </div>

           <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php" ?>

        </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->
        <?php include "includes/footer.php" ?>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
