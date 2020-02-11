<?php include "includes/db.php" ?>
<?php include "includes/header.php" ?>

<body>

    <!-- Navigation -->
    <?php include "includes/navigation.php" ?>
    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <h1 class="page-header">
                    Resultados
                    <small>de la busqueda...</small>
                </h1>
                
                <?php 
                    $search = $_POST['search'];
                    $query = "SELECT * FROM posts WHERE post_tags LIKE '%$search%' ";
                    $search_query = mysqli_query($connection, $query);
                    if(!$search_query) {
                        die("QUERY FAILED ". mysqli_error($connection));
                    }
                    $count = mysqli_num_rows($search_query);
                    if($count == 0) {
                        echo "<h1> no hay resultados </h1>";
                    } else {
                       



                    while($row = mysqli_fetch_assoc($search_query)) {
                        ?>
                            <!-- Blog Post -->
                            <h2>
                                <a href="#"> <?php echo $row['post_title'] ?> </a>
                            </h2>
                            <p class="lead">
                                by <a href="index.php"><?php echo $row['post_author'] ?></a>
                            </p>
                            <p><span class="glyphicon glyphicon-time"></span> Publicado el día <?php echo $row['post_date'] ?></p>
                            <hr>
                            <img class="img-responsive" src="images/<?php echo $row['post_image'] ?> " alt="">
                            <hr>
                            <p><?php echo $row['post_content'] ?></p>
                            <a class="btn btn-primary" href="post.php?post_id=<?php echo $post_id ?>">Leer más <span class="glyphicon glyphicon-chevron-right"></span></a>

                            <hr>
                        <?php 
                    }

                    }
                 ?>


                

                <!-- Pager -->
                <!-- <ul class="pager">
                    <li class="previous">
                        <a href="#">&larr; Older</a>
                    </li>
                    <li class="next">
                        <a href="#">Newer &rarr;</a>
                    </li>
                </ul> -->

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php" ?>

        </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->
        <?php include "includes/footer.php" ?>

</body>

</html>
