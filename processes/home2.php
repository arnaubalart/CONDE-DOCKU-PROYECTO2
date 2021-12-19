<?php
include '../services/conexion.php';
?>

<?php

//if(!empty($_SESSION['email'])){}

$num_mesa= $_GET['num_taula'];
$date = date('Y-m-d');
date_default_timezone_set("Europe/Madrid");
$time = date('H:i:s');
session_start();
$username= $_SESSION['username'];
?>



<?php
$stmt = $pdo->prepare("SELECT id_usuari FROM tbl_usuari WHERE nom_usuari='$username';");
$stmt->execute();
$usuaris = $stmt->fetchAll(PDO::FETCH_ASSOC);
$sqlu2=$usuaris[0][0];




$stmt = $pdo->prepare("UPDATE `tbl_reserva` SET `cancelacio_reserva` = 1 WHERE `tbl_reserva`.`num_taula` =$num_mesa ORDER BY `id_reserva` DESC LIMIT 1;");
$stmt->execute();

header('Location:../view/home.php');