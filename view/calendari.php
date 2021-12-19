<?php
include '../services/conexion.php';
session_start();
if (isset($_SESSION['username']) and !empty($_GET['num_taula'])){

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
    <h1>Reservar la taula <?php echo $_GET['num_taula']; ?></h1>
</div>
<div class="cuerpo_reserva">
    <div class="titol_sala">
        <h2>
            SALA:
        </h2>
    </div>
    <div class="foto_sala">
        <img src="<?php 
            $stmt=$pdo->prepare("SELECT s.foto_sala, t.num_taula from tbl_sala s inner join tbl_taula t on t.id_sala=s.id_sala where t.num_taula=".$_GET['num_taula'].";");
            $stmt->execute();
            $sala=$stmt->fetchAll(PDO::FETCH_ASSOC);
            $foto_sala=$sala[0]['foto_sala'];
            echo "../img/".$foto_sala;
        ?>" alt="foto sala" width="100%">
    </div>
    <div class="container-incidencia">
        <form class="form-incidencia" action="formreserva.php" method="POST">
        <h2>Per a quin dia vols reservar?</h2>
            
            <label for="data">Introdueix la data:</label>
            <input type="date" name="data" value="" autocomplete="off" required>
            <input type="hidden" name="num_taula" value="<?php echo $_GET['num_taula'] ?>">
            <input type="submit" value="Continuar" name="enviar">
        </form>
    </div>
</div>
<?php
}else{
    header('location:home.php');
}
?>