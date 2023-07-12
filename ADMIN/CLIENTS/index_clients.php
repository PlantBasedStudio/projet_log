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
    <title>index clients</title>
</head>
<body>
<?php include '../INCLUDES/menu_admin.php' ?>
    <h1 class="m-2">Partie Administrateur : Clients</h1>
    <a href="./PRODUITS/index_produits.php" class="btn btn-secondary">Clients</a>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <?php
                        require '../../PHP/CRUD/config.php';
                        $sql = "SELECT * FROM clients";

                        if($result = mysqli_query($conn, $sql)){
                            if(mysqli_num_rows($result)>0){
                                echo '<table class="table table-bordered table-striped">';
                                    echo '<thead>';
                                        echo '<tr>';
                                            echo '<th>id</th>';
                                            echo '<th>nom</th>';
                                            echo '<th>prenom</th>';
                                            echo '<th>telephone</th>';
                                            echo '<th>adresse</th>';
                                            echo '<th>complément d adresse</th>';
                                            echo '<th>CP</th>';
                                            echo '<th>ville</th>';
                                            echo '<th>user_id</th>';
                                        echo '</tr>';
                                    echo '</thead>';
                                    echo '<tbody>';

                                    while ($row = mysqli_fetch_array($result)){
                                        echo '<tr>';
                                            echo '<td>'. $row['id'] . '</td>';
                                            echo '<td>'. $row['nom'] . '</td>';
                                            echo '<td>'. $row['prenom'] . '</td>';
                                            echo '<td>'. $row['telephone'] . '</td>';
                                            echo '<td>'. $row['adresse'] . '</td>';
                                            echo '<td>'. $row['complement'] . '</td>';
                                            echo '<td>'. $row['cp'] . '</td>';
                                            echo '<td>'. $row['ville'] . '</td>';
                                            echo '<td>'. $row['user_id'] . '</td>';
                                            echo '<td>';
                                                echo '<a href="./update_client.php?id='.$row['id'].'" class="mr-3" title="update" data-toggle="tooltip"><span class="fas fa-pencil-alt"></span> </a>';
                                                echo '<a href="./delete_client.php?id='.$row['id'].'" class="mr-3" title="update" data-toggle="tooltip"><span class="fas fa-trash-alt"></span> </a>';
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