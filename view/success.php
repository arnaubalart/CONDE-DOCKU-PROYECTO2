<?php
include '../services/conexion.php';
session_start();
if (isset($_SESSION['username']) and !empty($_GET['id_reserva'])){

    include '../services/conexion.php';
    $id_reserva=$_GET['id_reserva'];
    $stmt = $pdo->prepare("SELECT * FROM tbl_reserva WHERE id_reserva=$id_reserva;");
    $stmt->execute();
    $reserva = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $nom_reserva=$reserva[0]['nom_reserva'];
    $data_ini_reserva=$reserva[0]['data_ini_reserva'];
    $data_fi_reserva=$reserva[0]['data_fi_reserva'];
    $num_taula=$reserva[0]['num_taula'];


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
    <h1>Reserva correcta!</h1>
</div>
<div class="cuerpo_reserva">
    <div class="container-incidencia">
        <form class="form-incidencia" action="../view/home.php" method="POST">
            <p class="verde" style="text-align:center; font-size:20px">
                <?php echo "Reserva creada correctament a nom de $nom_reserva, el dia ".strftime('%d/%m/%Y', strtotime($data_ini_reserva)).", de ".date("H:i", strtotime($data_ini_reserva))." a ".date("H:i", strtotime($data_fi_reserva)); ?>
            </p>
            <input type="submit" value="Tornar al menú" name="enviar">
        </form>
    </div>
</div>
<?php
}else{
    header('location:home.php');
}
?>