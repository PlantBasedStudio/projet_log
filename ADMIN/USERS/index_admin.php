<?php 
session_start();

if(isset($_SESSION['roles'])){
    $roles = $_SESSION['roles']; 
} else {
    $roles = '';
    
}

if($roles != 'admin' || $_SESSION['login'] == null){
    header('Location: ../../index.php');   
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Accueil admin</title>
</head>
<body>
<?php include '../INCLUDES/menu_admin.php' ?>
    <h1>Partie Administrateur</h1>
    <a href="./PRODUITS/index_produits.php" class="btn btn-secondary">Produits</a>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <?php
                        require '../../PHP/CRUD/config.php';
                        $sql = "SELECT * FROM users";

                        if($result = mysqli_query($conn, $sql)){
                            if(mysqli_num_rows($result)>0){
                                echo '<table class="table table-bordered table-striped">';
                                    echo '<thead>';
                                        echo '<tr>';
                                            echo '<th>ID</th>';
                                            echo '<th>Login</th>';
                                            echo '<th>role</th>';
                                            echo '<th>Compte Verifié</th>';
                                            echo '<th>Outils</th>';
                                        echo '</tr>';
                                    echo '</thead>';
                                    echo '<tbody>';

                                    while ($row = mysqli_fetch_array($result)){
                                        echo '<tr>';
                                            echo '<td>'. $row['id'] . '</td>';
                                            echo '<td>'. $row['login'] . '</td>';
                                            echo '<td>'. $row['roles'] . '</td>';
                                            echo '<td>'. $row['isVerified'] . '</td>';
                                            echo '<td>';
                                                echo '<a href="./update.php?id='.$row['id'].'" class="mr-3" title="update" data-toggle="tooltip"><span class="fas fa-pencil-alt"></span> </a>';
                                                echo '<a href="./delete.php?id='.$row['id'].'" class="mr-3" title="update" data-toggle="tooltip"><span class="fas fa-trash-alt"></span> </a>';
                                            echo '</td>';
                                        echo '</tr>';
                                    }
                                    echo '</tbody>';
                                echo '</table>';

                            } else {
                                echo '<div class="alert alert-danger"><em>Aucun utilisateur trouvé</em></div>';
                            }
                        } else {
                            echo '<div class="alert alert-danger"><em>Aucun utilisateur trouvé</em></div>';
                        }
                        mysqli_close($conn);
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>