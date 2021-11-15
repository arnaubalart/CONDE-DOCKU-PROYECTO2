<?php
include 'conexion.php';
include 'taula.php';
$sentencia=$pdo->prepare("SELECT * FROM tbl_taula");
$sentencia->execute();
$llistaTaules=$sentencia->fetchAll(PDO::FETCH_ASSOC);
