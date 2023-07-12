<?php 
session_start();

$_SESSION['erreur'] ='';
$_SESSION['login'] ='';
$_SESSION['id'] ='';
$_SESSION['roles']='';
require './PHP/CRUD/security.php';

if (isset($_POST['login']) && ($_POST['login'] != null) && !empty($_POST['login']) && (filter_var($_POST['login'], FILTER_VALIDATE_EMAIL))){
    $login = $_POST['login'];
} else {
    $_SESSION['erreur'] .= 'Veuillez entrez une adresse mail valide';
    header('Location: ./inscription.php');
    exit();
}

if (isset($_POST['mdp']) && ($_POST['mdp'] != null) && $_POST['mdp'] == $_POST['mdpverif']){
    $mdp = $_POST['mdp'];
} else {
    $_SESSION['erreur'] .= 'Veuillez entrez votre mot de passe et vérifier la validation';
    header('Location: ./inscription.php');
    exit();
}


require_once './PHP/CRUD/config.php';

$login = protect_montexte($login);
$mdp = protect_montexte($mdp);

$sql = "SELECT * FROM users";

//! bloc de protection pour ne pas pouvoir créer un compte sur une adresse déjà existante
if($result = mysqli_query($conn, $sql)){
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_array($result)){
            if(($login == $row['login'])){
                $_SESSION['erreur'] .= 'Vous     avez déjà un compte avec cette adresse mail';
                header('Location: ./inscription.php');
                exit();
            } 
        }
    }
}

$pass = password_hash($mdp, PASSWORD_DEFAULT);

$sql = 'INSERT INTO users (login, mdp, roles, isVerified) VALUES (?,?,?,?)';
$sql2 = 'INSERT INTO clients (nom, prenom, telephone, adresse, complement, cp, ville, user_id) VALUES (?,?,?,?,?,?,?,?) ';
if($stmt = mysqli_prepare($conn, $sql)){
    mysqli_stmt_bind_param($stmt, "sssi", $param_login, $param_mdp, $param_role, $param_verif);
    $_SESSION['login'] = $login;
    $param_login = $login;
    $param_mdp = $pass;
    $param_role = "user";
    $param_verif = false;
    
    

    
        
    
    
    if(mysqli_stmt_execute($stmt)){
        $stmt2 = mysqli_prepare($conn, $sql2);
    
        mysqli_stmt_bind_param($stmt2 ,"sssssssi", $param_nom, $param_prenom, $param_telephone, $param_adresse, $param_complement, $param_cp, $param_ville, $param_userid);
        $param_nom = protect_montexte($_POST['nom']);
        $param_prenom = protect_montexte($_POST['prenom']);
        $param_telephone = protect_montexte($_POST['telephone']);
        $param_adresse = protect_montexte($_POST['adresse']);
        $param_complement = protect_montexte($_POST['complement']);
        $param_cp = protect_montexte($_POST['cp']);
        $param_ville = protect_montexte($_POST['ville']);
        if($result = mysqli_query($conn, "SELECT id FROM users")){
            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_array($result)){
                    $param_userid = $row['id'];
                }
            }else{
                $param_userid = 1;
            }
        }
        if(mysqli_stmt_execute($stmt2)){
            header('Location: ./profil.php');
        }
        else {
            echo "erreur de création client";
        }
        
    }
}


?> 