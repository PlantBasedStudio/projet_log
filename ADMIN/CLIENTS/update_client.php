<?php
session_start();

if(isset($_SESSION['roles'])){
    $roles = $_SESSION['roles']; 
} else {
    $roles = '';
    
}

if($roles != 'admin' || $_SESSION['login'] == null){
    header('Location: ../index_produits.php');   
}

require '../../PHP/CRUD/config.php';

if(isset($_POST['nom'])){
    $id = $_SESSION['id'];
    $sql = "UPDATE clients SET nom=?, prenom=?, telephone=?, adresse=?, complement=?, cp=?, ville=? WHERE id=$id";
    if($stmt = mysqli_prepare($conn, $sql)){
        mysqli_stmt_bind_param($stmt, "sssssss", $param_nom, $param_prenom, $param_telephone, $param_adresse, $param_complement, $param_cp, $param_ville);

        $param_nom = $_POST['nom'];
        $param_prenom = $_POST['prenom'];
        $param_telephone = $_POST['telephone'];
        $param_adresse = $_POST['adresse'];
        $param_complement = $_POST['complement'];
        $param_cp =$_POST['cp'];
        $param_ville = $_POST['ville'];
            
        $message = "modification validée.";
            
        if (mysqli_stmt_execute($stmt)){
            header("Location: ./index_clients.php");
            exit();
        } else {
            echo "erreur";
        }
    }else{
        var_dump($conn);die;
    }
    
    mysqli_close($conn);
}else{
    if(isset($_GET['id']) && !empty($_GET['id'])){
        $id = trim($_GET['id']);
        $_SESSION['id'] = $id;
        $id = $_SESSION['id'];
        $sql = "SELECT * FROM clients WHERE id =?";
        
        if($stmt = mysqli_prepare($conn, $sql)){
            if(mysqli_stmt_bind_param($stmt, "i", $param_id)){
                
                $param_id = $id;
                
                if(mysqli_stmt_execute($stmt)){
                    $result = mysqli_stmt_get_result($stmt);
                    
                    if(mysqli_num_rows($result) == 1){
                        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                        
                        $_SESSION['nom'] = $row['nom'];
                        $_SESSION['prenom'] = $row['prenom'];
                        $_SESSION['telephone'] = $row['telephone'];
                        $_SESSION['adresse']= $row['adresse'];
                        $_SESSION['complement'] = $row['complement'];
                        $_SESSION['cp'] = $row['cp'];
                        $_SESSION['ville'] = $row['ville'];
                        

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
    <link rel="stylesheet" href="./CSS/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .wrapper {
            width: 600px;
            margin: 0 auto;
        }
    </style>
    <title>Mise à jour d'un client</title>
</head>

<body>

    <h1>modification du client</h1>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="form-group">
                <form action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>" method="post" class="cnx formulaireLogin">
                    
                    <label for="nom"> Nom
                        <input class="form-control" type="text" name="nom" id="nom" placeholder="Nom du client" maxlength="255" required
                        value="<?php echo $_SESSION['nom']; ?>">
                    </label>

                    <label for="prenom"> Prenom
                        <input class="form-control" type="text" name="prenom" id="prenom" placeholder="prenom du client" maxlength="255" required
                        value="<?php echo $_SESSION['prenom']; ?>">
                    </label>

                    <label for="telephone"> Telephone
                        <input class="form-control" type="text" name="telephone" id="telephone" placeholder="telephone du client" maxlength="20" required
                        value="<?php echo $_SESSION['telephone']; ?>">
                    </label>

                    <label for="adresse"> adresse
                        <input class="form-control" type="text" name="adresse" id="adresse" placeholder="adresse du client" maxlength="255" required
                        value="<?php echo $_SESSION['adresse']; ?>">
                    </label>

                    <label for="complement"> complement
                        <input class="form-control" type="text" name="complement" id="complement" placeholder="complement du client" maxlength="255"
                        value="<?php echo $_SESSION['complement']; ?>">
                    </label>

                    <label for="cp"> cp
                        <input class="form-control" type="text" name="cp" id="cp" placeholder="cp du client" maxlength="50" required
                        value="<?php echo $_SESSION['cp']; ?>">
                    </label>

                    <label for="ville"> ville
                        <input class="form-control" type="text" name="ville" id="ville" placeholder="ville du client" maxlength="255" required
                        value="<?php echo $_SESSION['ville']; ?>">
                    </label>
                    



                    <input class="btnSubmit btn btn-primary" type="submit" value="Modifier le client">

                </form>
            </div>
        </div>
    </div>

    <?php
    if (!empty($erreur) && $erreur != "") {
        echo '<div class="erreur"> <p>' . $erreur . '</p> </div>';
    }
    ?>

</body>

</html>