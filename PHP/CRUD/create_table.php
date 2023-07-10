<?php 
require_once './config.php';

$table = "users";
$sql = "CREATE TABLE IF NOT EXISTS $table(
id int(10) unsigned auto_increment primary key,
login varchar(50) unique not null,
mdp varchar(150) not null,
roles varchar(15) not null,
isVerified bool null)";

if(mysqli_query($conn, $sql)){
    echo "Table : " . $table . "est créée";
} else {
    echo "Erreur de création" . mysqli_error($conn);
}

$table2 = "products";
$sql = "CREATE TABLE IF NOT EXISTS $table2(
id int(8) unsigned auto_increment primary key,
ref varchar(20) unique not null,
category varchar(255) not null,
pu_ht decimal(10,2) not null,
tva float(6) not null,
designation varchar(255) not null,
description text not null,
thumbnail varchar(255) not null,
stock int(10) not null)";

if(mysqli_query($conn, $sql)){
    echo "Table : " . $table2 . "est créée";
} else {
    echo "Erreur de création" . mysqli_error($conn);
}

$conn -> close();

?>