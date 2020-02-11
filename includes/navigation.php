<?php 
    $query = "SELECT * FROM categories";
    $categories = mysqli_query($connection, $query);

 ?>




<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="./index.php">Diario Maldonado</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">

                    <?php 
                        while($row = mysqli_fetch_assoc($categories)) {
                            $cat_title = $row['cat_title'];
                            $cat_id = $row['cat_id'];
                            echo "<li><a href = 'category.php?category_id={$cat_id}'>{$cat_title}</a></li>";
                        }

                     ?>

                    <li>
                        <a href="./admin/index.php">Admin</a>
                    </li>
                    <li>
                        <a href="registration.php">Registrar</a>
                    </li>
                    <?php 
                        if(isset($_SESSION['user_role'])) {
                            if(isset($_GET['post_id'])){
                                $post_id = $_GET['post_id'];
                                echo "<li>";
                                    echo "<a href='./admin/view_posts.php?source=edit_post&edit_id={$post_id}'>Editar POST</a>";
                                echo "</li>";
                            }

                        }
                     ?>
                     
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
