<?php 

require './PHP/CRUD/security.php';

if (isset($_POST['login']) && ($_POST['login'] != null) && !empty($_POST['login'])){
    $login = $_POST['login'];
} else {
    $_SESSION['erreur'] .= 'Veuillez entrez votre adresse mail <br>';
    header('Location: ./inscription.php');
    exit();
}

if (isset($_POST['mdp']) && ($_POST['mdp'] != null)){
    $mdp = $_POST['mdp'];
} else {
    $_SESSION['erreur'] .= 'Veuillez entrez votre mot de passe';
    header('Location: ./inscription.php');
    exit();
}


require_once './PHP/CRUD/config.php';

$login = protect_montexte($login);
$mdp = protect_montexte($mdp);


$pass = password_hash($mdp, PASSWORD_DEFAULT);

$sql = 'INSERT INTO users (login, mdp, role, isVerified) VALUES ('.$login.','.$pass.',?,?)';

if($stmt = mysqli_prepare($link, $sql)){
    mysqli_stmt_bind_param($stmt, "sssi", $param_login, $param_mdp, $param_role, $param_verif);
}
?> 