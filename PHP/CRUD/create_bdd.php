<?php
require './config.php';
$sql = "CREATE DATABASE if not exists testbdd";

if(!mysqli_query($conn, $sql)){
    echo "Création KO";
}else{
    echo 'La BDD a été créee';
}
echo '<hr>';
mysqli_close($conn);
?>