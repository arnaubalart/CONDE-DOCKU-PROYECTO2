<?php
include '../services/conexion.php';
session_start();
if (isset($_SESSION['username'])){

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <script type="text/javascript" src="../js/menu.js"></script>
    <title>Afegir Reserva</title>
</head>
<body>
<div id="mySidepanel" class="sidepanel">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <a href="historial.php">Historial</a>
  <a href="../processes/logout.proc.php">Logout</a>
</div>
<div class="msgopen">

<button class="openbtn" onclick="openNav()">&#9776;</button>
</div>
<div class="titulo-incidencia">
    <h1>Crea un nou usuari</h1>
</div>
<div class="cuerpo_reserva">
    <div class="container-incidencia">
        <form class="form-incidencia" action="../processes/crear_usuari.proc.php" method="POST">
        <div id="mensaje">
            <?php 
                if (isset($_GET['error'])) {
                    $error=$_GET['error'];
                    if ($error==1) {
                        echo "<p class='rojo' style='text-align:center;'>ERROR</p>";
                    }
                }            
            ?>
        </div>
        <h2>Introdueix les dades del nou usuari</h2>
        <label for="nom_usuari">Nom</label>
            <input type="text" name="nom_usuari" placeholder="Nom" required>
            <label for="cognom_usuari">Cognom</label>
            <input type="text" name="cognom_usuari" placeholder="Cognom">
            <label for="contra_usuari">Contrasenya</label>
            <input type="password" name="contra_usuari" placeholder="Contrasenya">
            <label for="tipus_usuari">Tipus d'usuari</label>
            <select name="tipus_usuari">
                <option value="cambrer">Cambrer</option>
                <option value="manteniment">Manteniment</option>
            </select>
            <input type="submit" value="Crear" name="enviar">
        </form>
    </div>
</div>
<?php
}else{
    header('location:home.php');
}
?>