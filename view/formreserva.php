<?php
include '../services/conexion.php';
session_start();
if (isset($_SESSION['username']) and isset($_REQUEST['data']) and isset($_REQUEST['num_taula'])){

    $dia=strftime('%d', strtotime($_REQUEST['data']));
    $diacomplet=strftime('%d/%m/%Y', strtotime($_REQUEST['data']));
    $diacompletangles=strftime('%Y/%m/%d', strtotime($_REQUEST['data']));

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
    <h1>Reservar la taula <?php echo $_REQUEST['num_taula']." per al dia ".strftime("%d/%m/%Y", strtotime($_REQUEST['data'])); ?></h1>
</div>
<div class="cuerpo_reserva">
    <div class="titol_sala">
        <h2>
            SALA:
        </h2>
    </div>
    <div class="foto_sala">
        <img src="<?php 
            $stmt=$pdo->prepare("SELECT s.foto_sala, t.num_taula from tbl_sala s inner join tbl_taula t on t.id_sala=s.id_sala where t.num_taula=".$_REQUEST['num_taula'].";");
            $stmt->execute();
            $sala=$stmt->fetchAll(PDO::FETCH_ASSOC);
            $foto_sala=$sala[0]['foto_sala'];
            echo "../img/".$foto_sala;
        ?>" alt="foto sala" width="100%">
    </div>
    <div class="container-incidencia">
        <form class="form-incidencia" action="../processes/reserva.proc.php" method="POST">
        <div id="mensaje">
            <?php 
                if (isset($_GET['error'])) {
                    $error=$_GET['error'];
                    if ($error==1) {
                        echo "<p class='rojo' style='text-align:center;'>No pots reservar una taula després que el restaurant tanqui. Redueix la duració de la teva reserva o canvia l'hora.</p>";
                    }
                }            
            ?>
        </div>
        <h2>Fes la teva reserva! (Estem oberts de 13:00 a 23:00)</h2>
            <label for="nom_reserva">Nom</label>
            <input type="text" name="nom_reserva" placeholder="Nom" required>
            <label for="hora">Hora</label>
            <select name="hora" required>
                <?php
                    for ($i=13; $i <= 22; $i++) {
                        $horacomplet="$i:00:00";
                        $stmt=$pdo->prepare('SELECT r.data_ini_reserva, r.data_fi_reserva, r.cancelacio_reserva, t.num_taula from tbl_reserva r inner join tbl_taula t on t.num_taula=r.num_taula where t.num_taula='.$_REQUEST['num_taula'].' and r.cancelacio_reserva=0 and r.data_ini_reserva<="'.$diacompletangles."+".$horacomplet.'" and r.data_fi_reserva>"'.$diacompletangles."+".$horacomplet.'";');
                        $stmt->execute();
                        $num_dates = $stmt->fetchColumn();
                        if($num_dates>0){
                          ?>
                          <option value="<?php echo $i; ?>" disabled><?php echo $i.":00"; ?></option> 
                          <?php
                        }else{
                        ?>
                        <option value="<?php echo $i; ?>"><?php echo $i.":00"; ?></option>
                        <?php
                        }
                    }
                ?>
            </select>
            <label for="duracio_reserva">Duració de la reserva (màx. 4h)</label>
            <select name="duracio_reserva" id="duracio_reserva" required>
                <option value="1">1 hora</option>
                <option value="2">2 hores</option>
                <option value="3">3 hores</option>
                <option value="4">4 hores</option>
            </select>
            <input type="hidden" name="num_taula" value="<?php echo $_POST['num_taula'] ?>">
            <input type="hidden" name="data" value="<?php echo $_REQUEST['data'] ?>">
            <input type="submit" value="Reservar" name="enviar">
        </form>
    </div>
    <div class="btn_home">
        <button type='button' class='boton uno' id='' onclick='window.location.href=`home.php`'><span>Tornar a la home</span></button>
    </div>
</div>
<?php
}else{
    header('location:home.php');
}
?>