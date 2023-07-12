<?php
session_start();
require './PHP/CRUD/config.php';



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./CSS/profile.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>Votre profil</title>
</head>
<body>
    <?php include './PHP/INCLUDES/menu.php'; ?>
    <main class="profil">
        
        <p>Bienvenue sur votre profil, ici vous pouvez modifier votre image de profil et faire pleins de trucs qui ne sont pas encore dans le site</p>
        <?php
        $sql = "SELECT * FROM users";

        if($result = mysqli_query($conn, $sql)){
            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_array($result)){
                    if(($_SESSION['login'] == $row['login'])){
                        $rowid = $row['id'];
                        $sql2 = "SELECT * FROM clients WHERE user_id = $rowid";
                        if($result = mysqli_query($conn, $sql2)){
                            if(mysqli_num_rows($result)>0){
                                

                                while ($row = mysqli_fetch_array($result)){
                                    echo "<div class='profilUser'>
                                    <p>Nom: ". $row['nom'] . "</p>
                                    </div>";

                                    echo "<div class='profilUser'>
                                    <p>Prenom: ". $row['prenom'] . "</p>                                   
                                    </div>";

                                    echo "<div class='profilUser'>
                                    <p>Telephone: ". $row['telephone'] . "</p>                                  
                                    </div>";

                                    echo "<div class='profilUser'>
                                    <p>adresse: ". $row['adresse'] . "</p>                                   
                                    </div>";
                                    
                                    echo "<div class='profilUser'>
                                    <p>Complément d'adresse: ". $row['complement'] . "</p>                                   
                                    </div>";
                                    
                                    echo "<div class='profilUser'>
                                    <p>cp: ". $row['cp'] . "</p>                                   
                                    </div>";
                                    
                                    echo "<div class='profilUser'>
                                    <p>Ville: ". $row['ville'] . "</p>                                   
                                    </div>";

                                    echo "<a href='./modify.php?id=".$rowid."'><button class='btn btn-primary'>Modifier</button></a>";
                                }
                                

            } else {
                echo '<div class="alert alert-info"><em>Vous n avez pas encore de compte client : Veuillez cliquer ici : </em><button type="button" class="btn btn-primary">Creer un profil</button></div>';
            }
        } else {
            echo '<div class="alert alert-danger"><em>Aucune information trouvée</em></div>';
        }
                    } 
                }
            }
        }
        
        mysqli_close($conn);
        
        
        
        
        
        
        
        ?>
    </main>
    
    <?php include './PHP/INCLUDES/footer.php'; ?>
</body>
</html>