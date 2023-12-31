<?php
session_start(); // Indispensable à chaque nouvelle page qui va avoir besoin du chargement de la session actuelle (notamment pour garder la connexion de l'utilisateur).
$nav = 'index';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d'accueil</title>
</head>
<body>
    <?php require './PHP/INCLUDES/menu.php'; ?>
    <!-- section hero qui présente le projet -->
    <main class="px-4 py-5 my-5 text-center"> 
        <h5>Bienvenue sur mon site incroyable</h5>
        <img class="d-block mx-auto mb-4" src="./ADMIN/PRODUITS/Thumbnails/img.png" alt="presentation" >
        <h1 class="display-5 fw-bold text-body-emphasis">Projet Log</h1>
        <div class="col-lg-6 mx-auto">
            <p class="lead mb-4">Un template générique d'une plateforme d'e-commerce.</p>
            <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                <a href="./produits.php"><button type="button" class="btn btn-primary btn-lg px-4 gap-3">Voir les produits</button></a>
                <a href="./inscription.php"><button type="button" class="btn btn-outline-secondary btn-lg px-4">S'inscrire</button></a>
            </div>
        </div>
    </main>
    
    <?php include './PHP/INCLUDES/footer.php'; ?>
</body>
</html>