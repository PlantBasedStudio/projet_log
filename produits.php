<?php
session_start();
require './PHP/CRUD/config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./CSS/produit.css">
    <title>Produits</title>
</head>
<body>
    <?php include './PHP/INCLUDES/menu.php'; ?>
    <?php
                        $sql = "SELECT * FROM products";

                        if($result = mysqli_query($conn, $sql)){
                            if(mysqli_num_rows($result)>0){
                                echo '<div class="container mt-4 mb-5">';
                                    echo '<div class="row">';
                                        while ($row = mysqli_fetch_array($result)){
                                        
                                            echo '<div class="col-md-2">';
                                                echo '<div class="card mb-2 box-shadow border produit">';
                                                    echo '<div class="container  produit g-0">';
                                                        echo '<img class ="card-img-top centerImg" src="./ADMIN/PRODUITS/'.$row['thumbnail'].'" alt="image">';
                                                        echo '<div class="card-body">';
                                                            echo '<h5>'. $row['designation'] . '</h5>';
                                                            echo '<p>'. $row['ref'] . '</p>';
                                                            echo '<h6>'. $row['category'] . '</h6>';
                                                            echo '<p>'. $row['pu_ht'] * $row['tva'] . ' €</p>';
                                            
                                                            echo '<p class="description">'. $row['description'] . '</p>';
                                            
                                                            if($row['stock'] > 0){
                                                                echo '<p class="green"> En stock !</p>';
                                                            } else {
                                                                echo '<p class="red"> En rupture !</p>';
                                                            }
                                                            echo '<button class="btn btn-primary btnPanier">Ajouter au panier</button>';
                                                        echo '</div>';
                                                        
                                                    echo '</div>';
                                                echo '</div>';
                                            echo '</div>';
                                    }
                                    echo '</div>';
                                echo '</div>';
                                
                            } else {
                                echo '<div class="alert alert-danger"><em>Aucun produit trouvé</em></div>';
                            }
                        } else {
                            echo '<div class="alert alert-danger"><em>Aucun produit trouvé</em></div>';
                        }
                        mysqli_close($conn);
                    ?>
                    <hr>
                    <br>
                    <p>Voir votre panier</p>
    <?php include './PHP/INCLUDES/footer.php'; ?>
</body>
</html>