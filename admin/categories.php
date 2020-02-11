<?php include "includes/header.php" ?>
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
                            Categorías
                            <small> CMS</small>
                        </h1>

                        <div class="col-xs-6">
                            <?php 
                                add_category();
                             ?>
                            <form method="post" action="">
                                
                                <div class="form-group">
                                    <label for="cat-title">Agregar Categoría</label>
                                    <input type="text" name="cat_title" class="form-control">
                                </div>
                                <div class="form-group">
                                    <input type="submit" class="btn btn-primary" name="submit" value="Agregar Categoría">
                                </div>
                            </form>
                            <?php 
                                if(isset($_GET['edit'])) {
                                    include "includes/update_category.php";
                                }
                             ?>


                            
                        </div>
                        <div class="col-xs-6">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>Categoría</th>
                                        <th colspan="2">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        view_all_categories();
                                        
                                     ?>
                                     <?php 
                                        delete_category();
                                    ?>
                                </tbody>
                            </table>
                        </div>

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
