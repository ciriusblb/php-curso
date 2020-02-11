<form method="post" action="">
    
    <div class="form-group">
        <label for="cat-title">Editar categoria</label>
        <?php 

        // if(isset($_GET['edit'])) {
            $cat_id = $_GET['edit'];
            if($cat_id == "" || empty($cat_id)) {
                echo "<h2>El campo no puede ser vacío</h2>";
            } else {
                $query = "SELECT * FROM categories WHERE cat_id = '$cat_id'";
                $editing_query = mysqli_query($connection, $query);
                while($row = mysqli_fetch_assoc($editing_query)) {
                    echo "<input type='text' value='{$row['cat_title']}' name='cat_title' class='form-control'>";

                }
            }
            if(isset($_POST['submit_edit'])) {
                $cat_title = $_POST['cat_title'];
                if($cat_title == "" || empty($cat_title)) {
                    echo "<h2>El campo no puede ser vacío</h2>";
                } else {
                    $query = "UPDATE categories SET cat_title = '$cat_title' ";
                    $query .= "WHERE cat_id = '$cat_id'";
                    $update_query = mysqli_query($connection, $query);
                    if(!$update_query) {
                        die("query failed ". mysqli_error($connection));
                    }
                }
            }
        // }   
        ?>
        
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="submit_edit" value="Editar categoria">
    </div>
</form>