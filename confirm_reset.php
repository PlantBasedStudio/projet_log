<?php
session_start();

require_once './PHP/CRUD/config.php';
$user_id = $_GET['id'];
$token = $_GET['token'];
$_SESSION['id'] = $user_id;

if ($user_id == $_GET['id']){
    $sql = "SELECT * FROM users WHERE token_reset = '$token'";
    if($result = mysqli_query($conn, $sql)){
        $user = mysqli_fetch_array($result);
        if (($user['id'] == $user_id) && ($user['token_reset'] == $token)){
            $_SESSION['login'] = $user['login'];
            header('Location: ./form_reset.php');
        } else {
            die('Ce lien n\'est pas ou plus valable');
        }
    }
}
?>

