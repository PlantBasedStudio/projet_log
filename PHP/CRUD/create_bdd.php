<?php
require './config.php';
$sql = "CREATE DATABASE if not exists users";

if(!mysqli_query($conn, $sql)){
    echo "Création KO";
}else{
    echo 'La BDD a été créee';
}
echo '<hr>';
mysqli_close($conn);
?>