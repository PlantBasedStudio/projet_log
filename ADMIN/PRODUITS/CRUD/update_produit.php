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

if(isset($_POST['id']) && !empty($_POST['id'])){
    
    $id = $_POST['id'];
    $ref = $_POST['ref'];
    $cat = $_POST['category'];
    $prixHT = $_POST['pu_ht'];
    $TVA = $_POST['tva'];
    $designation = $_POST['designation'];
    $description = $_POST['description'];
    if (isset($_POST['thumbnail']) && $_POST['thumbnail'] != null){
        $thumbnail = $_POST['thumbnail'];
    }else {
        $thumbnail = "./Thumbnails/img.png";
    }
    if (isset($_POST['stock'])){
        $stock = $_POST['stock'];
    }else {
        $stock = 0;
    }
//! pas encore a jour
//     if(empty($login_err) && empty($roles_err)){
//         $sql = "UPDATE users SET login=?, roles=? WHERE id=$id";
        
//         if($stmt = mysqli_prepare($conn, $sql)){
//             mysqli_stmt_bind_param($stmt, "ss", $param_login, $param_roles);

//             $param_login = $login;
//             $param_roles = $roles;
            
//             $message = "modification validée.";
            
//             if (mysqli_stmt_execute($stmt)){
//                 header("Location: ./index_admin.php");
//                 exit();
//             } else {
//                 echo "erreur";
//             }
//         }else{
//             var_dump($conn);
//         }
//     }
//     mysqli_close($conn);
    
// }else {
//     if(isset($_GET['id']) && !empty($_GET['id'])){
//         $id = trim($_GET['id']);

//         $sql = "SELECT * FROM users WHERE id =?";

//         if($stmt = mysqli_prepare($conn, $sql)){
//             if(mysqli_stmt_bind_param($stmt, "i", $param_id)){
                
//                 $param_id = $id;

//                 if(mysqli_stmt_execute($stmt)){
//                     $result = mysqli_stmt_get_result($stmt);
                    
//                     if(mysqli_num_rows($result) == 1){
//                         $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                        
//                         $_SESSION['mail'] = $row['login'];
//                         $roles = $row['roles'];
//                         $id = $row['id'];

//                     } else {
//                         header('Location : ./index_admin.php');
//                         exit();
//                     }
//                 }
//             }
//         }else {
//             echo "erreur innatendue";
//         }
//     }else{
//         header('location: ./index_admin.php');
//         exit();
//     }
// }
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
    <title>Création d'un produit</title>
</head>

<body>

    <h1>modification du produit</h1>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="form-group">
                <form action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>" method="post" class="cnx formulaireLogin">
                    <label for="ref"> Référence
                        <input class="form-control" type="text" name="ref" id="ref" placeholder="reference du produit" maxlength="20" required>
                    </label>

                    <label for="category"> Catégorie
                        <input class="form-control" type="text" name="category" id="category" placeholder="Catégorie" maxlength="255" required>
                    </label>

                    <label for="pu_ht"> prix HT
                        <input class="form-control" type="float" name="pu_ht" id="pu_ht" placeholder="prix HT" maxlength="255" required>
                    </label>

                    <label for="tva">TVA
                        <input class="form-control" type="float" name="tva" id="tva" placeholder="tva" maxlength="255" required>
                    </label>

                    <label for="designation"> Designation
                        <input class="form-control" type="text" name="designation" id="designation" placeholder="designation" maxlength="255" required>
                    </label>

                    <label for="description">Description
                        <input class="form-control" type="text" name="description" id="description" placeholder="description" required>
                    </label>

                    <label for="thumbnail"> Image miniature
                        <input class="form-control" class="form-control" type="text" name="thumbnail" id="thumbnail" placeholder="thumbnail" maxlength="255" required>
                    </label>

                    <label for="stock"> Stock
                        <input class="form-control" type="int" name="stock" id="tva" placeholder="stock" required>
                    </label>



                    <input class="btnSubmit btn btn-primary" type="submit" value="créer le produit">

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