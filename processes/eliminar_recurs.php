<?php
session_start();
if(!isset($_SESSION['username']) or !isset($_GET['num_taula'])){
    header('location:../view/home.php');
}

include '../services/conexion.php';

//TRANSACCION
try{
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->beginTransaction();
    $stmt=$pdo->prepare("DELETE FROM tbl_taula WHERE num_taula=".$_GET['num_taula'].";");
    $stmt->execute();
    $pdo->commit();
    header('location:../view/admin_recursos.php');
}catch(Exception $e){
    $pdo->rollBack();
    echo "Fallo: " . $e->getMessage();
}