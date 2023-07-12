<?php
session_start();


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./CSS/style.css">
    <title>Inscription</title>
</head>
<body>
<?php include './PHP/INCLUDES/menu.php' ?>

<h1>Inscription</h1>

<form action="inscrit.php" method="post" class="cnx formulaireLogin">
        <label for="login"> Login
            <input type="text" name="login" id="login" placeholder="votre adresse mail" require maxlength="50">
        </label>

        <label for="password"> Password
            <input type="password" name="mdp" id="mdp" placeholder="mot de passe" require maxlength="128">
        </label>

        <label for="passwordverif"> Password verify
            <input type="password" name="mdpverif" id="mdpverif" placeholder="Verification du mot de passe" require maxlength="128">
        </label>

        <label for="nom"> Nom
            <input type="nom" name="nom" id="nom" placeholder="Votre nom" require maxlength="255">
        </label>
        <label for="prenom"> prenom
            <input type="prenom" name="prenom" id="prenom" placeholder="Votre prenom" require maxlength="255">
        </label>
        <label for="telephone"> telephone
            <input type="telephone" name="telephone" id="telephone" placeholder="Your phone" require maxlength="20">
        </label>
        <label for="adresse"> adresse
            <input type="adresse" name="adresse" id="adresse" placeholder="adresse" require maxlength="255">
        </label>
        <label for="complement"> complement d'adresse
            <input type="complement" name="complement" id="adresse" placeholder="complement d'adresse" require maxlength="255">
        </label>
        <label for="cp"> cp
            <input type="cp" name="cp" id="cp" placeholder="code postal" require maxlength="50">
        </label>
        <label for="ville"> ville
            <input type="ville" name="ville" id="ville" placeholder="ville" require maxlength="255">
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
