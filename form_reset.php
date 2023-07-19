<?php
session_start();
$nav = '';
require_once './PHP/CRUD/config.php';
$login = $_SESSION['login'];
if(isset($_POST['btn_modif'])){
    $id = $_SESSION['id'];
    if ($_POST['mdp'] === $_POST['mdpverif']){
        $password = password_hash($_POST['mdp'], PASSWORD_DEFAULT);

        $sql = "UPDATE users SET mdp = '$password', token_reset = NULL WHERE id = '$id'";
        var_dump(mysqli_query($conn, $sql));
        if(mysqli_query($conn, $sql)){
            header('Location: ./index.php');
            exit();
        } else  {
            echo "error";
        }
    } 
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/CSS/style.css">
    <title>reset password</title>
</head>
<body>
<?php include './PHP/INCLUDES/menu.php'; ?>

<form class="formulaireLogin mt-3" action="" method="post">

        <label for="login"> Login
            <input type="text" name="login" id="login" placeholder="<?php echo $login; ?>" disabled >
        </label>

        <label for="password"> Password
            <input type="password" name="mdp" id="mdp" placeholder="mot de passe">
        </label>
        <label for="password"> Password verif
            <input type="password" name="mdpverif" id="mdpverif" placeholder="verification mot de passe">
        </label>
       
            <input class="btnSubmit" type="submit" name="btn_modif" value="Modifier">
       
    </form>
<?php include './PHP/INCLUDES/footer.php'; ?>
</body>
</html>