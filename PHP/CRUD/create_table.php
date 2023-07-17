<?php 
require_once './config.php';

$table = "users";
$sql = "CREATE TABLE IF NOT EXISTS $table(
id int(10) unsigned auto_increment primary key,
login varchar(50) unique not null,
mdp varchar(150) not null,
roles varchar(15) not null,
isVerified bool null,
FOREIGN KEY (id) REFERENCES clients(id))";

if(mysqli_query($conn, $sql)){
    echo "Table : " . $table . " est créée";
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
    echo "Table : " . $table2 . " est créée";
} else {
    echo "Erreur de création" . mysqli_error($conn);
}

$table3 = "clients";
$sql = "CREATE TABLE IF NOT EXISTS $table3(
id int(10) unsigned primary key auto_increment not null,
nom varchar(255) not null,
prenom varchar(255) not null,
telephone varchar(20) not null,
adresse varchar(255) not null,
complement varchar(255) not null,
cp varchar(50) not null,
ville varchar(255) not null,
user_id int(10) unsigned not null)";

if(mysqli_query($conn, $sql)){
    echo "Table : " . $table3 . " est créée";
} else {
    echo "Erreur de création  dddd" . mysqli_error($conn);
}


$relation = "relation clients à user";
$sql = "ALTER TABLE clients ADD CONSTRAINT users FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE RESTRICT ON UPDATE RESTRICT";
if(mysqli_query($conn, $sql)){
    echo "Table : " . $relation . " est créée";
} else {
    echo "Erreur de création" . mysqli_error($conn);
}

$table4 = "mails";
$sql = "CREATE TABLE IF NOT EXISTS $table4(
    id int(10) unsigned NOT NULL auto_increment PRIMARY KEY,
    nom varchar(255) NOT NULL,
    prenom varchar(255) NOT NULL,
    mail varchar(255) NOT NULL,
    messages varchar(255) NOT NULL)";

if (mysqli_query($conn, $sql)){
    echo "Table : " . $table4 . " est créée";
}else {
    echo "Erreur de création" . mysqli_error($conn);
}

$conn -> close();

?>