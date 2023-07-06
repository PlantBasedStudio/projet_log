<?php
session_start();

$_SESSION['erreur'] ='';
$_SESSION['login'] ='';
$_SESSION['roles']='';


require_once './PHP/CRUD/security.php';

$erreur = '';


if (isset($_POST['login']) && ($_POST['login'] != null)){
    $login = $_POST['login'];

} else {
    $_SESSION['erreur'] .= 'Veuillez entrez votre adresse mail <br>';
    header('Location: ./login.php');
    exit();
}

if (isset($_POST['mdp']) && ($_POST['mdp'] != null)){
    $mdp = $_POST['mdp'];
} else {
    $_SESSION['erreur'] .= 'Veuillez entrez votre mot de passe';
    header('Location: ./login.php');
    exit();
}

require_once './PHP/CRUD/config.php';

$login_ok = protect_montexte($login);
$mdp_ok = protect_montexte($mdp);
$sql = "SELECT * FROM users";

if($result = mysqli_query($conn, $sql)){
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_array($result)){
            if(($login_ok == $row['login']) && ($mdp_ok == password_verify($mdp_ok, $row['mdp']))){
                $_SESSION['login'] = $login;
                $_SESSION['roles'] = $row['roles'];
                $valide = "ok";
                header('Location: ./index.php');
                exit();
            } else {
                $valide = '';
            }
        }
        if($valide !="ok"){
            $_SESSION['erreur'] = "L'adresse mail ou le mot de passe est erroné";
            header('Location: ./login.php');
            exit();
        }
    }
} else {
    echo "ouah ça marche pas la";
}

?>