<?php
include '../services/conexion.php';
if(isset($_POST['enviar']) and isset($_POST['num_taula'])){
    $num_mesa=$_POST['num_taula'];
    $desc_incidencia=$_POST['desc_incidencia'];
    $stmt=$pdo->prepare('INSERT INTO tbl_incidencia (`id_incidencia`, `desc_incidencia`, `estat_incidencia`, `num_taula`) VALUES (NULL,"'.$desc_incidencia.'",1,'.$num_mesa.');');
    $stmt->execute();
    header('location:../view/home.php');
}else{
    header('location:../view/home.php');
}