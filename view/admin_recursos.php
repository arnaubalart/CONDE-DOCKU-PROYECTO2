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
    <title>Administrar recursos</title>
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
    <button type='button' class='boton uno' id='boto-incidencia' onclick='window.location.href=`afegir_taula.php`'><span>Afegir taula</span></button>
</div>
<div class="titulo-administracion">
    <h1>Administració de recursos (taules)</h1>
</div>
<div class="mensaje">
    <?php 
        if (isset($_GET['error'])) {
            echo "<p class='rojo' style='text-align:center;margin-top:2.5%;'>ERROR</p>";
        }
    ?>
</div>
<div class="cuerpo_reserva">
  <div class="mostrar-mesashistorial">
      <table class="historial_reservas">
        <tr>
          <th>Nombre taula</th>
          <th>Nombre de llocs</th>
          <th>Sala</th>
          <th></th>
          <th></th>
        </tr>
      
    <?php
    //TRANSACCION
    try{
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->beginTransaction();
        $stmt=$pdo->prepare('SELECT t.num_taula, t.num_llocs_taula, s.foto_sala, s.id_sala from tbl_taula t inner join tbl_sala s on t.id_sala=s.id_sala order by t.num_taula;');
        $stmt->execute();
        $taules=$stmt->fetchAll(PDO::FETCH_ASSOC);
        $pdo->commit();
    }catch(Exception $e){
        $pdo->rollBack();
        echo "Fallo: " . $e->getMessage();
    }

    foreach ($taules as $taula) {

      ?>
      <tr class="registro-historial">
        <td>
          <h4 class="h4historial"><?php echo $taula['num_taula']; ?></h4>
        </td>
        <td>
          <h6 class="h6historial"><?php echo $taula['num_llocs_taula']; ?></h6>
        </td>  
        <td>
          <h6 class="h6historial"><?php echo "<img width='50%' src='../img/".$taula['foto_sala']."'>"; ?></h6>
        </td>
        <td>
          <h6 class="h6historial"><button onclick='window.location.href=`./modificar_recurs.php?num_taula=<?php echo $taula["num_taula"]; ?>`'>Modificar</button></h6>
        </td>
        <td>
          <h6 class="h6historial"><button onclick='window.location.href=`../processes/eliminar_recurs.php?num_taula=<?php echo $taula["num_taula"]; ?>`'>Eliminar</button></h6>
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