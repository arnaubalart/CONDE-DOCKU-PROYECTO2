<?php
include '../services/conexion.php';
session_start();
if (isset($_SESSION['username']) and isset($_REQUEST['num_taula'])){

    $stmt=$pdo->prepare("SELECT t.num_taula, t.num_llocs_taula, t.id_sala, s.nom_sala  from tbl_taula t inner join tbl_sala s where num_taula=".$_REQUEST['num_taula'].";");
    $stmt->execute();
    $taules=$stmt->fetchAll(PDO::FETCH_ASSOC);

    $stmt=$pdo->prepare("SELECT nom_sala from tbl_sala;");
    $stmt->execute();
    $sales=$stmt->fetchAll(PDO::FETCH_ASSOC);
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
    <h1>Modificar la taula <?php echo $taules[0]['num_taula']; ?></h1>
</div>
<div class="cuerpo_reserva">
    <div class="container-incidencia">
        <form class="form-incidencia" action="../processes/modificar_recurs.proc.php" method="POST">
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
            <h2>Aquí pots modificar les dades de la taula.</h2>
            <label for="num_llocs_taula">Nombre de llocs</label>
            <select name="num_llocs_taula">
                <option value="<?php echo $taules[0]['num_llocs_taula']; ?>" selected><?php echo $taules[0]['num_llocs_taula']; ?></option>
                <?php
                    for ($i=1; $i < 12; $i++) { 
                        echo "<option value='$i'>$i</option>";
                    }
                ?>
            </select>
            <label for="nom_sala">Sala</label>
            <select name="nom_sala">
                <option value="<?php echo $taules[0]['nom_sala']; ?>" selected><?php echo $taules[0]['nom_sala']; ?></option>
                <?php 
                    foreach ($sales as $sala) {
                        ?>
                            <option value="<?php echo $sala['nom_sala']; ?>"><?php echo $sala['nom_sala']; ?></option>

                        <?php
                    }
                ?>
            </select>
            <input type="hidden" name="num_taula" value="<?php echo $taules[0]['num_taula']; ?>">
            <input type="submit" value="Modificar" name="enviar">
        </form>
    </div>
</div>
<?php
}else{
    header('location:home.php');
}
?>