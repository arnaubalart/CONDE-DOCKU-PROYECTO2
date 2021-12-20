<?php
include '../services/conexion.php';
session_start();
if (isset($_SESSION['username']) and isset($_REQUEST['id_usuari'])){

    $stmt=$pdo->prepare("SELECT id_usuari, nom_usuari, cognom_usuari, tipus_usuari from tbl_usuari where id_usuari=".$_REQUEST['id_usuari'].";");
    $stmt->execute();
    $usuaris=$stmt->fetchAll(PDO::FETCH_ASSOC);
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
    <h1>Modificar l'usuari <?php echo $usuaris[0]['nom_usuari']; ?></h1>
</div>
<div class="cuerpo_reserva">
    <div class="container-incidencia">
        <form class="form-incidencia" action="../processes/modificar_usuari.proc.php" method="POST">
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
            <h2>Aquí pots modificar les dades de l'usuari.</h2>
            <label for="nom_usuari">Nom</label>
            <input type="text" name="nom_usuari" value="<?php echo $usuaris[0]['nom_usuari']; ?>" required>
            <label for="cognom_usuari">Cognom</label>
            <input type="text" name="cognom_usuari" value="<?php echo $usuaris[0]['cognom_usuari']; ?>" required>
            <label for="contra_usuari">Contrasenya</label>
            <input type="password" name="contra_usuari" placeholder="Contrasenya">
            <input type="hidden" name="id_usuari" value="<?php echo $usuaris[0]['id_usuari']; ?>">
            <input type="submit" value="Modificar" name="enviar">
        </form>
    </div>
</div>
<?php
}else{
    header('location:home.php');
}
?>