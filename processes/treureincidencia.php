<?php
include '../services/conexion.php';
if(isset($_GET['num_taula'])){
    $num_taula=$_GET['num_taula'];
    $stmt=$pdo->prepare('UPDATE tbl_incidencia set estat_incidencia=0 where num_taula='.$num_taula.';');
    $stmt->execute();
    header('location:../view/home.php');
}else{
    header('location:../view/home.php');
}