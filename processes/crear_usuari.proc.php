<?php
session_start();
if(!isset($_SESSION['username']) or !isset($_POST['nom_usuari'])){
    header('location:../view/home.php');
}

include '../services/conexion.php';

$nom_usuari=$_POST['nom_usuari'];
$cognom_usuari=$_POST['cognom_usuari'];
$contra_usuari=$_POST['contra_usuari'];
$tipus_usuari=$_POST['tipus_usuari'];


//TRANSACCION
try{
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->beginTransaction();
    $stmt=$pdo->prepare("INSERT INTO tbl_usuari(id_usuari, nom_usuari, cognom_usuari, contra_usuari, tipus_usuari) values (NULL, ?, ?, MD5(?), ?);");
    $stmt->bindParam(1, $nom_usuari);
    $stmt->bindParam(2, $cognom_usuari);
    $stmt->bindParam(3, $contra_usuari);
    $stmt->bindParam(4, $tipus_usuari);
    $stmt->execute();
    $pdo->commit();
    header('location:../view/admin_usuaris.php');
}catch(Exception $e){
    $pdo->rollBack();
    echo "Fallo: " . $e->getMessage();
}