<?php
session_start();
require '../PHP/CRUD/config.php';

$login = $roles = '';
$login_err = $roles_err = '';
$message = "";

if(isset($_SESSION['roles'])){
    $roles = $_SESSION['roles']; 
} else {
    $roles = '';
    
}

if($roles != 'admin' || $_SESSION['login'] == null){
    header('Location: ../index.php');   
}

if(isset($_POST['id']) && !empty($_POST['id'])){
    
    $id = $_POST['id'];

    $input_login = trim($_POST['login']);
    
    if(empty($input_login)){
        $login_err = "Entrez un login";
    } else {
        $login = $input_login;
    }

    $input_roles = trim($_POST['roles']);
    
    if(empty($input_roles)){
        $lroles_err = "Entrez un role";
    } else {
        $roles = $input_roles;
    }

    if(empty($login_err) && empty($roles_err)){
        $sql = "UPDATE users SET login=?, roles=? WHERE id=$id";
        
        if($stmt = mysqli_prepare($conn, $sql)){
            mysqli_stmt_bind_param($stmt, "ss", $param_login, $param_roles);

            $param_login = $login;
            $param_roles = $roles;
            
            $message = "modification validée.";
            
            if (mysqli_stmt_execute($stmt)){
                header("Location: ./index_admin.php");
                exit();
            } else {
                echo "erreur";
            }
        }else{
            var_dump($conn);
        }
    }
    mysqli_close($conn);
    
}else {
    if(isset($_GET['id']) && !empty($_GET['id'])){
        $id = trim($_GET['id']);

        $sql = "SELECT * FROM users WHERE id =?";

        if($stmt = mysqli_prepare($conn, $sql)){
            if(mysqli_stmt_bind_param($stmt, "i", $param_id)){
                
                $param_id = $id;

                if(mysqli_stmt_execute($stmt)){
                    $result = mysqli_stmt_get_result($stmt);
                    
                    if(mysqli_num_rows($result) == 1){
                        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                        
                        $_SESSION['mail'] = $row['login'];
                        $roles = $row['roles'];
                        $id = $row['id'];

                    } else {
                        header('Location : ./index_admin.php');
                        exit();
                    }
                }
            }
        }else {
            echo "erreur innatendue";
        }
    }else{
        header('location: ./index_admin.php');
        exit();
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modification de l'utilisateur</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Mise à jour de l'utilisateur <?php echo $_SESSION['mail']; ?></h2>
                </div>
                <p>Modification en cours</p>
                <form action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>" method="post">
                    <div class="form-group">
                        <label for="login">@mail</label>
                        <input type="text" name="login" id="login" class="form-control <?php echo (!empty($login_err)) ? 'is-invalid' : ''; ?>" 
                        value="<?php echo $_SESSION['mail']; ?>">
                        <span class="invalid-feedback"><?php echo $login_err; ?></span>
                    </div>

                    <div class="form-group">
                        <label for="roles">role</label>
                        <input type="text" name="roles" id="roles" class="form-control <?php echo (!empty($role_err)) ? 'is-invalid' : ''; ?>" 
                        value="<?php echo $roles; ?>">
                        <span class="invalid-feedback"><?php echo $role_err; ?></span>
                    </div>

                    <input type="hidden" name="id" value="<?php echo $id; ?>" />
                    <input type="submit" value="Enregistrer" class="btn btn-primary">
                    <a href="./index_admin.php" class="btn btn-secondary ml-2">Annuler</a>

                    <?php
                        if (!empty($message) && $message != ""){
                        echo '<div class="valid"> <p>' . $message . '</p> </div>';
                    }
                    ?>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
