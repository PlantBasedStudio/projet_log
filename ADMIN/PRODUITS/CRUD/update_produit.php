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
}
require '../../../PHP/CRUD/config.php';

if(isset($_POST['ref'])){
    $id = $_SESSION['id'];
    $sql = "UPDATE products SET ref=?, category=?, pu_ht=?, tva=?, designation=?, description=?, thumbnail=?, stock=? WHERE id=$id";
        var_dump("ouiii");
    if($stmt = mysqli_prepare($conn, $sql)){
        mysqli_stmt_bind_param($stmt, "ssddsssi", $param_ref, $param_cat, $param_pu_ht, $param_tva, $param_designation, $param_description, $param_thumbnail, $param_stock);

        $param_ref = $_POST['ref'];
        $param_cat = $_POST['category'];
        $param_pu_ht = $_POST['pu_ht'];
        $param_tva = $_POST['tva'];
        $param_designation = $_POST['designation'];
        $param_description = $_POST['description'];
        $param_thumbnail = $_POST['thumbnail'];
        $param_stock = $_POST['stock'];
        
            
        $message = "modification validée.";
            
        if (mysqli_stmt_execute($stmt)){
            header("Location: ../index_produits.php");
            exit();
        } else {
            echo "erreur";
        }
    }else{
        var_dump($conn);
    }
    
    mysqli_close($conn);
}else{
    if(isset($_GET['id']) && !empty($_GET['id'])){
        $id = trim($_GET['id']);
        $_SESSION['id'] = $id;
        $id = $_SESSION['id'];
        $sql = "SELECT * FROM products WHERE id =?";
        
        if($stmt = mysqli_prepare($conn, $sql)){
            if(mysqli_stmt_bind_param($stmt, "i", $param_id)){
                
                $param_id = $id;
                
                if(mysqli_stmt_execute($stmt)){
                    $result = mysqli_stmt_get_result($stmt);
                    
                    if(mysqli_num_rows($result) == 1){
                        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                        $_SESSION['ref'] = $row['ref'];
                        $_SESSION['category'] = $row['category'];
                        $_SESSION['pu_ht'] = $row['pu_ht'];
                        $_SESSION['tva']= $row['tva'];
                        $_SESSION['designation'] = $row['designation'];
                        $_SESSION['description'] = $row['description'];
                        $_SESSION['thumbnail'] = $row['thumbnail'];
                        $_SESSION['stock'] = $row['stock'];
                        

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
    <title>Mise à jour d'un produit</title>
</head>

<body>

    <h1>modification du produit</h1>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="form-group">
                <form action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>" method="post" class="cnx formulaireLogin">
                    <label for="ref"> Référence
                        <input class="form-control" type="text" name="ref" id="ref" placeholder="reference du produit" maxlength="20" required
                        value="<?php echo $_SESSION['ref']; ?>">
                    </label>

                    <label for="category"> Catégorie
                        <input class="form-control" type="text" name="category" id="category" placeholder="Catégorie" maxlength="255" required
                        value="<?php echo $_SESSION['category']; ?>">
                    </label>

                    <label for="pu_ht"> prix HT
                        <input class="form-control" type="float" name="pu_ht" id="pu_ht" placeholder="prix HT" maxlength="255" required
                        value="<?php echo $_SESSION['pu_ht']; ?>">
                    </label>

                    <label for="tva">TVA
                        <input class="form-control" type="float" name="tva" id="tva" placeholder="tva" maxlength="255" required
                        value="<?php echo $_SESSION['tva']; ?>">
                    </label>

                    <label for="designation"> Designation
                        <input class="form-control" type="text" name="designation" id="designation" placeholder="designation" maxlength="255" required
                        value="<?php echo $_SESSION['designation']; ?>">
                    </label>

                    <label for="description">Description
                        <input class="form-control" type="text" name="description" id="description" placeholder="description" required
                        value="<?php echo $_SESSION['description']; ?>">
                    </label>

                    <label for="thumbnail"> Image miniature
                        <input class="form-control" class="form-control" type="text" name="thumbnail" id="thumbnail" placeholder="thumbnail" maxlength="255" required
                        value="<?php echo $_SESSION['thumbnail']; ?>">
                    </label>

                    <label for="stock"> Stock
                        <input class="form-control" type="int" name="stock" id="tva" placeholder="stock" required
                        value="<?php echo $_SESSION['stock']; ?>">
                    </label>



                    <input class="btnSubmit btn btn-primary" type="submit" value="Modifier le produit">

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