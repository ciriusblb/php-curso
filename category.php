<?php include "includes/db.php" ?>
<?php include "includes/header.php" ?>

<?php 
   if(isset($_GET['category_id'])) {
        $cat_id = $_GET['category_id'];
        $query = "SELECT * FROM posts WHERE post_category_id = {$cat_id}";
        $posts = mysqli_query($connection, $query);


        $query = "SELECT * FROM categories WHERE cat_id = {$cat_id}";
        $categorie = mysqli_query($connection, $query);
        $row = mysqli_fetch_assoc($categorie);
        $cat_title = $row['cat_title'];
   }

 ?>



<body>

    <!-- Navigation -->
    <?php include "includes/navigation.php" ?>
    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <h1 class="page-header">
                    Categoría: 
                    <small> <?php echo $cat_title; ?> </small>
                </h1>
                
                <?php 

                    while($row = mysqli_fetch_assoc($posts)) {
                        $post_id = $row['post_id'];
                        $post_title = $row['post_title'];
                        $post_author = $row['post_author'];
                        $post_date = $row['post_date'];
                        $post_image = $row['post_image'];
                        $post_content = $row['post_content'];
                        ?>
                            <!-- Blog Post -->
                            <h2>
                                <a href="#"> <?php echo $post_title ?> </a>
                            </h2>
                            <p class="lead">
                                by <a href="index.php"><?php echo $post_author ?></a>
                            </p>
                            <p><span class="glyphicon glyphicon-time"></span> Publicado el día de <?php echo $post_date ?></p>
                            <hr>
                            <img class="img-responsive" src="images/<?php echo $post_image ?> " alt="">
                            <hr>
                            <p><?php echo $post_content ?></p>
                            <a class="btn btn-primary" href="post.php?post_id=<?php echo $post_id ?> ">Leer más <span class="glyphicon glyphicon-chevron-right"></span></a>

                            <hr>
                        <?php 
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
