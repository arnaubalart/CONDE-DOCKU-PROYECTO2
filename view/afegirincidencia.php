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
    <title>Afegir Incidencia</title>
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
    <h1>Crear incidència</h1>
</div>
<div class="container-incidencia">
    <form class="form-incidencia" action="../processes/afegirincidencia.proc.php" method="POST">
        <label  for="num_taula" class="fuente">Num. de taula</label><br><br>
        <select name="num_taula">
        <?php
                $stmt = $pdo->prepare("SELECT num_taula FROM tbl_taula order by num_taula");
                $stmt->execute();
                $taules = $stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach($taules as $taula){
            ?>
            <option value="<?php echo $taula['num_taula']; ?>"><?php echo $taula['num_taula']; ?></option>
        
            <?php
                }
            ?>
        </select><br><br>
        <label for="desc_incidencia">Descripció de la incidència</label><br><br>
        <textarea rows="3" cols="20" name="desc_incidencia">Escriu aquí la descripció...</textarea><br><br>
        <input type="submit" value="Crear incidencia" name="enviar">
    </form>
</div>





<?php
}else{
    header('location:home.php');
}
?>