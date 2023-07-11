<?php

if(isset($_SESSION['login']) && $_SESSION['login'] != null){
  $username = '<a class="nav-link" href="./deconnexion.php">bonjour ' . $_SESSION['login'] . ' Cliquez ici pour vous déco</a>';
  $profil = '<a class="nav-link" href="./profil.php">Profil</a>';
} else {
  $username = '<a class="nav-link" href="./login.php">Connexion</a>';
  $profil = '<a class="nav-link" href="./login.php">Profil</a>';
}   

if(isset($_SESSION['roles'])){
  $role = $_SESSION['roles'];
} else {
  $role = "";
}

if (isset($_SESSION['erreur'])){
  $erreur = $_SESSION['erreur'];
} else {
  $erreur ="";
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" defer></script>
    <link rel="stylesheet" href="./CSS/style.css">
    <link rel="stylesheet" href="./CSS/bootstrap.css">
    <title>Document</title>
</head>
<body>
<nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="./index.php">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarColor01">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link active" href="./index.php">Accueil
          </a>
        </li>
        <li class="nav-item">
        <?php echo $profil ?>
        </li>
        <?php if (!isset($_SESSION['login']) || $_SESSION['login'] == null ) : ?>
          <?php $_SESSION = ""; ?>
          <li class="nav-item">
          <a class="nav-link" href="./inscription.php">Inscription</a>
        </li>
        <?php endif ; ?>
        <?php if (isset($role) && $role == 'admin' && $_SESSION['login'] != null) : ?>
          <li class="nav-item">
          <a class="nav-link" href="./ADMIN/USERS/index_admin.php">admin</a>
        </li>
        <?php endif ; ?>
        <li class="nav-item">
          <?php echo $username  ?>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./produits.php">Produits
          </a>
        </li>
        
        
      </ul>
      <form class="d-flex">
        <input class="form-control me-sm-2" type="search" placeholder="Search">
        <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>

</body>
</html>