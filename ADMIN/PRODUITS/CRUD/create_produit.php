<?php
session_start();

if (isset($_SESSION['erreur'])) {
    $erreur = $_SESSION['erreur'];
} else {
    $erreur = "";
}

if(isset($_SESSION['roles'])){
    $roles = $_SESSION['roles']; 
} else {
    $roles = '';
    
}

if($roles != 'admin' || $_SESSION['login'] == null){
    header('Location: ../index_admin.php');   
}

if(isset($_POST['ref'])){
    require '../../../PHP/CRUD/security.php';

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
    
    
    
    
    require_once '../../../PHP/CRUD/config.php';
    
    
    
    $sql = "SELECT * FROM products";
    
    //! bloc de protection pour ne pas pouvoir créer un compte sur une adresse déjà existante
    if($result = mysqli_query($conn, $sql)){
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_array($result)){
                if(($ref == $row['ref'])){
                    $_SESSION['erreur'] .= 'Vous avez déjà cette référence';
                    header('Location: ..=./index_produits.php');
                    exit();
                } 
            }
        }
    }
    
    
    $sql = 'INSERT INTO products (ref, category, pu_ht, tva, designation, description, thumbnail, stock) VALUES (?,?,?,?,?,?,?,?)';
    
    if($stmt = mysqli_prepare($conn, $sql)){
        mysqli_stmt_bind_param($stmt, "ssddsssi", $param_ref, $param_cat, $param_pu_ht, $param_tva, $param_designation, $param_description, $param_thumbnail, $param_stock);
        
        $param_ref = $ref;
        $param_cat = $cat;
        $param_pu_ht = $prixHT;
        $param_tva = $TVA;
        $param_designation = $designation;
        $param_description = $description;
        $param_thumbnail = $thumbnail;
        $param_stock = $stock;




        if(mysqli_stmt_execute($stmt)){
            
            header('Location: ../index_produits.php');
        }
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
    <title>Création d'un produit</title>
</head>

<body>

    <h1>nouveau produit</h1>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="form-group">
                <form action="create_produit.php" method="post" class="cnx formulaireLogin">
                    <label for="ref"> Référence
                        <input class="form-control" type="text" name="ref" id="ref" placeholder="reference du produit" maxlength="20" required>
                    </label>

                    <label for="category"> Catégorie
                        <input class="form-control" type="text" name="category" id="category" placeholder="Catégorie" maxlength="255" required>
                    </label>

                    <label for="pu_ht"> prix HT
                        <input class="form-control" type="number" step="0.01" name="pu_ht" id="pu_ht" placeholder="prix HT" maxlength="255" required>
                    </label>

                    <label for="tva">TVA
                        <input class="form-control" type="number" step="0.01" name="tva" id="tva" placeholder="tva" maxlength="255" required>
                    </label>

                    <label for="designation"> Designation
                        <input class="form-control" type="text" name="designation" id="designation" placeholder="designation" maxlength="255" required>
                    </label>

                    <label for="description">Description
                        <input class="form-control" type="text" name="description" id="description" placeholder="description" required>
                    </label>

                    <label for="thumbnail"> Image miniature
                        <input class="form-control" class="form-control" type="text" name="thumbnail" id="thumbnail" placeholder="thumbnail" maxlength="255">
                    </label>

                    <label for="stock"> Stock
                        <input class="form-control" type="number" name="stock" id="tva" placeholder="stock">
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