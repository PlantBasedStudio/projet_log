<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d'accueil</title>
</head>
<body>
    <?php include './PHP/INCLUDES/menu.php'; ?>
    <?php
    if (!empty($login)){
        echo $login;
        var_dump($login);die;
    } 
    ?>
    <?php include './PHP/INCLUDES/footer.php'; ?>
</body>
</html>