<?php
session_start();
if (isset($_SESSION['username'])) {
    require_once '../services/conexion.php';

    $stmt=$pdo->prepare("SELECT id_usuari, nom_usuari, cognom_usuari, tipus_usuari from tbl_usuari where id_usuari=".$_REQUEST['id_usuari'].";");
    $stmt->execute();
    $usuaris=$stmt->fetchAll(PDO::FETCH_ASSOC);

    $nom_usuari=$_POST['nom_usuari'];
    $cognom_usuari=$_POST['cognom_usuari'];
    if (empty($_POST['contra_usuari'])) {
        $stmt = $pdo->prepare("UPDATE tbl_usuari set nom_usuari='$nom_usuari', cognom_usuari='$cognom_usuari' WHERE id_usuari=".$_REQUEST['id_usuari'].";");
        $stmt->execute();
        header('location:../view/admin_usuaris.php');
    }else{
        $contra_usuari=$_POST['contra_usuari'];
        $stmt = $pdo->prepare("UPDATE tbl_usuari set nom_usuari='$nom_usuari', cognom_usuari='$cognom_usuari', contra_usuari=MD5($contra_usuari) WHERE id_usuari=".$_REQUEST['id_usuari'].";");
        $stmt->execute();
        header('location:../view/admin_usuaris.php');
    }


}else{
    header("location: ../view/home.php");
}
?>