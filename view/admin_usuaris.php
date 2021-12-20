<?php
include '../services/conexion.php';
session_start();
if (isset($_SESSION['username'])){

    include '../services/conexion.php';

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
<div class="boton-afegir-incidencia">
    <button type='button' class='boton uno' id='boto-incidencia' onclick='window.location.href=`crear_usuari.php`'><span>Crear usuari</span></button>
</div>
<div class="titulo-incidencia">
    <h1>Administració d'usuaris</h1>
</div>
<div class="mensaje">
    <?php 
        if (isset($_GET['error'])) {
            echo "<p class='rojo' style='text-align:center;margin-top:2.5%;'>No pots eliminar-te a tú mateix!</p>";
        }
    ?>
</div>
<div class="cuerpo_reserva">
  <div class="mostrar-mesashistorial">
      <table class="historial_reservas">
        <tr>
          <th>ID</th>
          <th>Nom</th>
          <th>Cognom</th>
          <th>Tipus</th>
          <th></th>
          <th></th>
        </tr>
      
    <?php
    //TRANSACCION
    try{
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->beginTransaction();
        $stmt=$pdo->prepare('SELECT id_usuari, nom_usuari, cognom_usuari, tipus_usuari from tbl_usuari;');
        $stmt->execute();
        $usuaris=$stmt->fetchAll(PDO::FETCH_ASSOC);
        $pdo->commit();
    }catch(Exception $e){
        $pdo->rollBack();
        echo "Fallo: " . $e->getMessage();
    }

    foreach ($usuaris as $usuari) {

      ?>
      <tr class="registro-historial">
        <td>
          <h4 class="h4historial"><?php echo $usuari['id_usuari']; ?></h4>
        </td>
        <td>
          <h6 class="h6historial"><?php echo $usuari['nom_usuari']; ?></h6>
        </td>  
        <td>
          <h6 class="h6historial"><?php echo $usuari['cognom_usuari']; ?></h6>
        </td>
        <td>
        <h6 class="h6historial"><?php echo $usuari['tipus_usuari']; ?></h6>
        </td>
        <td>
          <h6 class="h6historial"><button onclick='window.location.href=`./modificar_usuari.php?id_usuari=<?php echo $usuari["id_usuari"]; ?>`'>Modificar</button></h6>
        </td>
        <td>
          <h6 class="h6historial"><button onclick='window.location.href=`../processes/eliminar_usuari.php?id_usuari=<?php echo $usuari["id_usuari"]; ?>`'>Eliminar</button></h6>
        </td>
      </tr>
      <?php
    }
    ?>
    </table>
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