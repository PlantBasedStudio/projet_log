<?php
session_start();
require_once './PHP/CRUD/config.php';
require_once './PHP/CRUD/security.php';

$erreurcontact = '';
$_SESSION['erreurContact'] = "";

if (isset($_POST['name']) && ($_POST['name'] != null)){
    $nom = protect_montexte($_POST['name']);

} else {
    $_SESSION['erreurContact'] = 'Problème de nom';
    header('Location: ./contact.php');
    exit();
}

if (isset($_POST['prename']) && ($_POST['prename'] != null)){
    $prenom = protect_montexte($_POST['prename']);
} else {
    $_SESSION['erreurContact'] = 'Problème de prénom';
    header('Location: ./contact.php');
    exit();
}

if (isset($_POST['mail']) && ($_POST['mail'] != null) && (filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL))){
    $mail = protect_montexte($_POST['mail']);
} else {
    $_SESSION['erreurContact'] = 'Problème de mail';
    header('Location: ./contact.php');
    exit();
}

if (isset($_POST['message']) && ($_POST['message'] != null)){
    $message = protect_montexte($_POST['message']);
} else {
    $_SESSION['erreurContact'] = 'Problème de message';
    header('Location: ./contact.php');
    exit();
}


$sql = "INSERT INTO mails (nom, prenom, mail, messages) VALUES (?,?,?,?);";
var_dump($conn);
if($stmt = mysqli_prepare($conn, $sql)){
    mysqli_stmt_bind_param($stmt, "ssss", $param_nom, $param_prenom, $param_mail, $param_message);
    $param_nom = $nom;
    $param_prenom = $prenom;
    $param_mail = $mail;
    $param_message = $message;

    mail( "adressemail@email.com",
    "nouveau message sur le site",
    $nom . " " . $prenom . " " . $mail . " : vous à écrit : " . $message,
    "From:" . $email,
    "To: adressemail@email.com");

    mail($mail,
    "Votre message sur le site : projet_log",
    "Vous avez écrit : " . $message,
    "From: adressemail@email.com",
    "To:" . $mail);
    
    if(mysqli_stmt_execute($stmt)){
        $_SESSION['erreurContact'] = 'Parfait chef';
        header('Location: ./contact.php');
        exit();
    } else {
        $_SESSION['erreurContact'] = 'Problème de connexion veuillez réessayer';
        header('Location: ./contact.php');
        exit();
    }
}







