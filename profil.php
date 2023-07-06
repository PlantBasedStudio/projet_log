<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./CSS/profil.css">
    <title>Votre profil</title>
</head>
<body>
    <?php include './PHP/INCLUDES/menu.php'; ?>
    <main class="profil">
        <h1>Salut <?php echo $_SESSION['login']; ?></h1>

        <p>Bienvenue sur votre profil, ici vous pouvez modifier votre image de profil et faire pleins de trucs qui ne sont pas encore dans le site</p>
    </main>
    
    <?php include './PHP/INCLUDES/footer.php'; ?>
</body>
</html>