<?php
session_start();

if (isset($_SESSION['erreur'])){
    $erreur = $_SESSION['erreur'];
} else {
    $erreur ="";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./CSS/style.css">
    <title>Document</title>
</head>
<body>
<?php include './PHP/INCLUDES/menu.php' ?>

<h1>Inscription</h1>

<form action="inscrit.php" method="post" class="cnx formulaireLogin">
        <label for="login"> Login
            <input type="text" name="login" id="login" placeholder="votre adresse mail">
        </label>

        <label for="password"> Password
            <input type="password" name="mdp" id="mdp" placeholder="mot de passe">
        </label>

        <input class="btnSubmit" type="submit" value="S'inscrire">

</form>
<?php
        if (!empty($erreur) && $erreur != ""){
            echo '<div class="erreur"> <p>' . $erreur . '</p> </div>';
        }
        ?>

<?php include './PHP/INCLUDES/footer.php'; ?>
</body>
</html>
