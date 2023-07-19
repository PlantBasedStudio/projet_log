<?php
session_start();
require_once './PHP/CRUD/config.php';
$nav = 'profil';

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $token = $_GET['token'];
}


if(isset($_POST['email']) && !empty(trim($_POST['email']))){
    function str_random($var){
        $string = "";
        $chaine = "a0b1c2d3e4f5g6h7i8j9klmnopqrstuvwxyz";
        srand((double)microtime()*1000000);
        for($i=0; $i<$var; $i++){
            $string .= $chaine[rand()%strlen($chaine)];
        }
        return $string;
    }
    $token = str_random(50);
    $email = trim($_POST['email']);
    $errors = array();
    $message= "";
    
    if(empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errors[] = "Email address is required";
    }else {
        $sql = "SELECT id FROM users WHERE login = '$email'";
        
        $resetstmt = mysqli_query($conn, $sql);
        $number = mysqli_affected_rows($conn);
        var_dump($_POST['email']);
        var_dump($conn);
        var_dump($resetstmt);
        
        if($number > 0) {
            $user = mysqli_fetch_array($resetstmt);
            $user_id = $user['id'];
            $sql = "UPDATE users SET token_reset = '$token' WHERE login = '$email'";
            if(mysqli_query($conn, $sql)){
                $message = "Demande envoyé, vérifiez votre boite mail.";
                $link = 'https://localhost/Projets/projet_log/confirm_reset.php?id='.$user_id.'&token='.$token.'';
                var_dump($link);die;
                if (mail($email, "Changer le mot de passe", "Veuillez cliquer ici pour changer le mot de passe : \n\n" . $link)){
                    
                    
                    header('Location: ./index.php');
                    exit();
                }else{
                    echo "Il y a eu un problème, veuillez réessayer.";
                }
            }
        } else {
            $message = "Cette adresse mail est introuvable.";
        }
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php require "./PHP/INCLUDES/menu.php"; ?>
<div class="container">

<div class="row mylogin">
    <div class="offset-3 col-md-6 myform">
        <form class="form-horizontal" action="reset_password.php" method="post">
            <fieldset>

                <!-- Form Name -->
                <legend class="mt-3">Reset Mot de Passe</legend>

                <!-- Text input-->


                <div class="form-group">
                    <label class="col-md-12 control-label" for="email">E-mail</label>
                    <div class="col-md-12">
                        <input id="email" name="email" type="text" placeholder="entrez votre email" class="form-control input-md" required="">

                    </div>
                </div>


                <!-- Button -->
                <div class="row">
                    <div class="form-group col-md-2">
                        <div class="col-md-10">
                            <button id="submit" name="submit" class="btn btn-primary mt-3" value="envoyer">Envoyer</button>
                        </div>
                    </div>
                    <div class="form-group col-md-10">
                        <div class="col-md-12">
                            <?php
                            if (isset($message)) : echo $message;
                            else : echo "";
                            endif;
                            ?>
                        </div>
                    </div>
                </div>

            </fieldset>
            <hr>
            <div class="row">
                <p class="col-md-12 text-center">

                    retourner à l'<a href="index.php">accueil</a>
                </p>
            </div>
        </form>

    </div>
</div>

</div>
</body>
</html>
