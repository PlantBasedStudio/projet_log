<?php 
session_start();

require_once './config.php';
require_once './security.php';


$login_ok = protect_montexte($_GET['login']);
$mdp_ok = protect_montexte($_GET['mdp']);
//? Ici on va créer un lien qu'il faudra copier coller dans la barre de navigation pour créer un admin. Attention à bien changer les valeurs du login et du mdp pour correspondre à un utilisateur existant
//! http://localhost/Projets/projet_log/PHP/CRUD/roles.php?login=damien@gmail.com&mdp=azerty02
if($mdp_ok == "azerty02"){
    $sql ="UPDATE users SET roles=? WHERE login=?";

    if($stmt = mysqli_prepare($conn, $sql)){
        mysqli_stmt_bind_param($stmt, 'ss', $param_role, $param_login);

        $param_role = "admin";
        $param_login = $login_ok;

        if(mysqli_stmt_execute($stmt)){
            mysqli_close($conn);
            header('Location: ../../index.php');
            exit();
        }
    }
} else {
    header('Location: ../../index.php');
    exit();
}


?>