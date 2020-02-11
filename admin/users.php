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
                            Usuarios
                            <small> CMS</small>
                        </h1>
                        <?php 

                            if(isset($_GET['source'])) {
                                $source = $_GET['source'];

                                switch($source) {
                                    case 'add_user':
                                        include "includes/add_user.php";
                                        break;
                                    case 'edit_user':
                                        include "includes/edit_user.php";                                    
                                        break;
                                    case 'detele_post':
                                        echo "eliminafo";
                                        break;
                                    default: 
                                        include "includes/all_users.php";
                                        break;

                                }
                            } else {
                                include "includes/all_users.php";
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
