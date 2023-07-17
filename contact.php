<?php
session_start();
require './PHP/CRUD/config.php';
$nav = 'contact';
if(isset($_SESSION['erreurContact'])){
    $erreurcontact = $_SESSION['erreurContact'];
} else {
    $_SESSION['erreurContact'] = '';
    $erreurcontact = "";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./CSS/produit.css">
    <link rel="stylesheet" href="/CSS/style.css">
    <title>Contact</title>
</head>
<body>
    <?php include './PHP/INCLUDES/menu.php'; ?>
    <form class="mt-4 formulaireLogin" action="mail.php" method="post">

        <input type="text" name="name" id="name" placeholder="votre nom" required>
        <input type="text" name="prename" id="prename" placeholder="votre prénom" required> 
        <input type="email" name="mail" id="mail" placeholder="votre adresse mail" required>
        <textarea type="text" name="message" id="message" placeholder="votre message" rows="5" required></textarea>
        
        <div class="center">
            <input class="btnSubmit" type="submit" value="Envoyer">
            
        </div>
        <?= $erreurcontact ?>
    </form>
    
    <?php include './PHP/INCLUDES/footer.php'; ?>
</body>
</html>