<?php
session_start();
if(isset($_SESSION['roles'])){
    $roles = $_SESSION['roles']; 
} else {
    $roles = '';
    
}

if($roles != 'admin' || $_SESSION['login'] == null){
    header('Location: ../../index.php');   
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>index produits</title>
</head>
<body>
    <?php include '../INCLUDES/menu_admin.php' ?>
    <h1>Partie Administrateur : Produits</h1>
    <a href="./CRUD/create_produit.php" class="btn btn-primary">Ajouter un produit</a>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <?php
                        require '../../PHP/CRUD/config.php';
                        $sql = "SELECT * FROM products";

                        if($result = mysqli_query($conn, $sql)){
                            if(mysqli_num_rows($result)>0){
                                echo '<table class="table table-bordered table-striped">';
                                    echo '<thead>';
                                        echo '<tr>';
                                            echo '<th>ID</th>';
                                            echo '<th>Reférence</th>';
                                            echo '<th>Catégorie</th>';
                                            echo '<th>prix unitaire</th>';
                                            echo '<th>TVA</th>';
                                            echo '<th>Designation</th>';
                                            echo '<th>Description</th>';
                                            echo '<th>Thumbnail</th>';
                                            echo '<th>Stock</th>';
                                        echo '</tr>';
                                    echo '</thead>';
                                    echo '<tbody>';

                                    while ($row = mysqli_fetch_array($result)){
                                        echo '<tr>';
                                            echo '<td>'. $row['id'] . '</td>';
                                            echo '<td>'. $row['ref'] . '</td>';
                                            echo '<td>'. $row['category'] . '</td>';
                                            echo '<td>'. $row['pu_ht'] . '</td>';
                                            echo '<td>'. $row['tva'] . '</td>';
                                            echo '<td>'. $row['designation'] . '</td>';
                                            echo '<td>'. $row['description'] . '</td>';
                                            echo '<td><img src="'.$row['thumbnail'].'" alt="image">';
                                            echo '<td>'. $row['stock'] . '</td>';
                                            echo '<td>';
                                                echo '<a href="./CRUD/update_produit.php?id='.$row['id'].'" class="mr-3" title="update" data-toggle="tooltip"><span class="fas fa-pencil-alt"></span> </a>';
                                                echo '<a href="./CRUD/delete_produit.php?id='.$row['id'].'" class="mr-3" title="update" data-toggle="tooltip"><span class="fas fa-trash-alt"></span> </a>';
                                            echo '</td>';
                                        echo '</tr>';
                                    }
                                    echo '</tbody>';
                                echo '</table>';

                            } else {
                                echo '<div class="alert alert-danger"><em>Aucun produit trouvé</em></div>';
                            }
                        } else {
                            echo '<div class="alert alert-danger"><em>Aucun produit trouvé</em></div>';
                        }
                        mysqli_close($conn);
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>