<?php 
require_once './config.php';

$table = "users";
$sql = "CREATE TABLE IF NOT EXISTS $table(
id int(6) unsigned auto_increment primary key,
login varchar(50) unique not null,
mdp varchar(150) not null,
roles varchar(15) not null,
isVerified bool null)";

if(mysqli_query($conn, $sql)){
    echo "Table : " . $table . "est créée";
} else {
    echo "Erreur de création" . mysqli_error($conn);
}

$conn -> close();

?>