<?php
session_start();
$_SESSION['login'] ='';
if (isset($_SESSION['erreur'])){
    $erreur = $_SESSION['erreur'];
} else {
    $erreur ="";
}
$nav = 'login';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <link rel="stylesheet" href="/CSS/style.css">
    <title>Connexion</title>
</head>
<body>
    <?php include './PHP/INCLUDES/menu.php'; ?>

    <h1>Connectez-vous</h1>

    <br><br>

    <form class="formulaireLogin" action="traitement.php" method="post">

        <label for="login"> Login
            <input type="text" name="login" id="login" placeholder="votre adresse mail">
        </label>

        <label for="password"> Password
            <input type="password" name="mdp" id="mdp" placeholder="mot de passe">
        </label>
        <div class="align">
            <input class="btnSubmit" type="submit" value="Connexion">
            <a href="./inscription.php"><input type="button" value="Inscription"></a>
        </div>
    </form>
        <?php
        if (!empty($erreur) && $erreur != ""){
            echo '<div class="erreur"> <p>' . $erreur . '</p> </div>';
        }
        ?>


    <?php include './PHP/INCLUDES/footer.php'; ?>
</body>
</html>