<?php 

function confirm($result) {
	global $connection;
	if(!$result) {
		die("QUERY FAILED". mysqli_error($connection) );
	}
}
function add_category() {
	global $connection;
	if(isset($_POST['submit'])) {
        $cat_title = $_POST['cat_title'];
        if($cat_title == "" || empty($cat_title)) {
            echo "<h2>this field no should be empty</h2>";
        } else {
            $query = "INSERT INTO categories(cat_title) ";
            $query .= "VALUES ('$cat_title')";
            $add_query = mysqli_query($connection, $query);
            if(!$add_query) {
                die("query failed ". mysqli_error($connection));
            }
        }
    }
 }
 function view_all_categories() {
	global $connection;
 	$query = "SELECT * FROM categories";
    $categories_admin = mysqli_query($connection, $query);
    while($row = mysqli_fetch_assoc($categories_admin)) {
        $cat_id = $row['cat_id'];
        echo "<tr>";
        echo    "<td>{$cat_id}</td>";
        echo    "<td>{$row['cat_title']}</td>";
        echo    "<td><a href='categories.php?delete={$cat_id}'>Eliminar </a></td>";
        echo    "<td><a href='categories.php?edit={$cat_id}'>Editar </a></td>";
        echo "</tr>";
    }
}
function delete_category() {
	global $connection;
	if(isset($_GET['delete'])) {
        $the_cat_id = $_GET['delete'];
        $query = "DELETE FROM categories WHERE cat_id = '$the_cat_id'";
        $delete_query = mysqli_query($connection, $query);

        header("Location: categories.php");
    }
}

?>
