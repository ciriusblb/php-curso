

<div class="col-md-4">
                <!-- Blog Search Well -->
                <div class="well">
                    <h4>Buscar Noticia</h4>
                    <form method="post" action="search.php">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="submit" name="submit">
                                    <span class="glyphicon glyphicon-search"></span>
                            </button>
                            </span>
                        </div>
                    </form>
                    <!-- /.input-group -->
                </div>
                <!-- Blog Search Well -->
                <div class="well">
                    <h4>Login</h4>
                    <form method="post" action="includes/login.php">
                        <div class="form-group">
                            <input type="text" placeholder="Escriba su usuario" name="username" class="form-control">
                        </div>
                        <div class="input-group">
                            <input type="password" name="user_password" class="form-control" placeholder="Escriba su contraseña">
                            <span class="input-group-btn">
                                <button class="btn btn-primary" type="submit" name="login">
                                    Iniciar Sesión
                            </button>
                            </span>
                        </div>
                    </form>
                    <!-- /.input-group -->
                </div>

                <!-- Blog Categories Well -->
                <div class="well">


                    <?php 
                        $query = "SELECT * FROM categories";
                        $categories_sidebar = mysqli_query($connection, $query);

                     ?>

                    <h4>Categorías de noticia</h4>
                    <div class="row">
                        <div class="col-lg-12">
                            <ul class="list-unstyled">
                                <?php 
                                    while($row = mysqli_fetch_assoc($categories_sidebar)) {
                                        $cat_title = $row['cat_title'];
                                        $cat_id = $row['cat_id'];

                                        echo "<li><a href = 'category.php?category_id={$cat_id}'>{$cat_title}</a></li>";
                                    }

                                 ?>
                            </ul>
                        </div>
                        <!-- /.col-lg-6 -->
                    </div>
                    <!-- /.row -->
                </div>

                <!-- Side Widget Well -->
                <!-- <div class="well">
                    <h4>Side Widget Well</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, perspiciatis adipisci accusamus laudantium odit aliquam repellat tempore quos aspernatur vero.</p>
                </div> -->

            </div>