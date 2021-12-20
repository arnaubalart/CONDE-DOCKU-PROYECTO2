<?php
session_start();
if (isset($_SESSION['username']) and isset($_POST['enviar'])) {
    require_once '../services/conexion.php';

    $num_taula=$_POST['num_taula'];
    $num_llocs_taula=$_POST['num_llocs_taula'];
    $nom_sala=$_POST['nom_sala'];

        $stmt = $pdo->prepare("SELECT id_sala from tbl_sala WHERE nom_sala='$nom_sala';");
        $stmt->execute();
        $idsala=$stmt->fetchAll(PDO::FETCH_ASSOC);
        $id_sala=$idsala[0]['id_sala'];

        $stmt = $pdo->prepare("UPDATE tbl_taula set num_llocs_taula=$num_llocs_taula, id_sala=$id_sala WHERE num_taula=$num_taula;");
        $stmt->execute();

        print_r($stmt);
        header('location:../view/admin_recursos.php');



}else{
    header("location: ../view/home.php");
}
?>