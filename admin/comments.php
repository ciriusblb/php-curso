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
                            Comentarios
                            <small> CMS</small>
                        </h1>
                        <?php 

                            if(isset($_GET['source'])) {
                                $source = $_GET['source'];

                                switch($source) {
                                    case 'add_post':
                                        echo "agregando";
                                        break;
                                    case 'edit_post':
                                        echo "editadnod";
                                        
                                        break;
                                    case 'detele_post':
                                        echo "eliminafo";
                                        break;
                                    default: 
                                        include "includes/all_posts.php";
                                        break;

                                }
                            } else {
                                include "includes/all_comments.php";
                            }

                         ?> 
                       
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
