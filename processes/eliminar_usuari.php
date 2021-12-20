<?php
session_start();
if(!isset($_SESSION['username']) or !isset($_GET['id_usuari'])){
    header('location:../view/home.php');
}

include '../services/conexion.php';
$id_usuari=$_GET['id_usuari'];
$stmt=$pdo->prepare("SELECT * from tbl_usuari where id_usuari=$id_usuari;");
$stmt->execute();
$usuari=$stmt->fetchAll(PDO::FETCH_ASSOC);
if ($usuari[0]['nom_usuari']==$_SESSION['username']) {
    header('location:../view/admin_usuaris.php?error');
}else{

}


//TRANSACCION
try{
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->beginTransaction();
    $stmt=$pdo->prepare("DELETE FROM tbl_usuari WHERE id_usuari=$id_usuari");
    $stmt->execute();
    $pdo->commit();
    header('location:../view/admin_usuaris.php');
}catch(Exception $e){
    $pdo->rollBack();
    echo "Fallo: " . $e->getMessage();
}