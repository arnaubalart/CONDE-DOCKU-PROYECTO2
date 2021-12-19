<?php
session_start();
if (!isset($_SESSION['username'])){
    header('location:../view/home.php');
}else{
    include '../services/conexion.php';

    $username=$_SESSION['username'];
    $nom_reserva=$_POST['nom_reserva'];
    $data_reserva=$_POST['data'];
    $hora_reserva=$_POST['hora'];
    $duracio_reserva=$_POST['duracio_reserva'];
    $num_taula=$_POST['num_taula'];

    $hora_fi_reserva=$hora_reserva+$duracio_reserva;
    if ($hora_fi_reserva>=24) {
        header('location:../view/formreserva.php?num_taula='.$num_taula.'&data='.$data_reserva.'&error=1');//LA RESERVA SE PASA DE LA HORA DE APERTURA DEL RESTAURANTE
    }
    else{
        //ID USUARI
        $stmt = $pdo->prepare("SELECT id_usuari FROM tbl_usuari WHERE nom_usuari='$username';");
        $stmt->execute();
        $usuaris = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $id_usuari=$usuaris[0]['id_usuari'];
        
        //DATA INICI I FI
        $data_ini_reserva="$data_reserva+$hora_reserva:00:00";
        $data_fi_reserva="$data_reserva+$hora_fi_reserva:00:00";

        //CREAR REGISTRES
        $stmt = $pdo->prepare("INSERT INTO `tbl_reserva` (`id_reserva`, `data_ini_reserva`, `data_fi_reserva`, `nom_reserva`, `cancelacio_reserva`, `num_taula`, `id_usuari`) VALUES (NULL, '$data_ini_reserva', '$data_fi_reserva', '$nom_reserva', 0, '$num_taula', '$id_usuari');");
        $stmt->execute();

        $stmt = $pdo->prepare("SELECT * from tbl_reserva order by id_reserva desc limit 1;");
        $stmt->execute();
        $reservas = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $id_reserva=$reservas[0]['id_reserva'];
        header('location:../view/success.php?id_reserva='.$id_reserva);
    }
}