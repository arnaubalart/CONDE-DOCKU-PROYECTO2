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
    <title>PROYECTO</title>
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
<h1>Benvingut
    <?php 
     echo $_SESSION['username'];?>
</h1>
<br>
<h2 id='count2'></h2>
<div class="boton-afegir-incidencia">
  <?php
    if($_SESSION['tipus_usuari']=="administrador"){
      ?>
      <button type='button' class='boton uno' id='boto-usuaris' onclick='window.location.href=`admin_usuaris.php`'><span>Administrar usuaris</span></button>
      <button type='button' class='boton uno' id='boto-recursos' onclick='window.location.href=`admin_recursos.php`'><span>Administrar recursos</span></button>
    <?php
    }
  ?>
<button type='button' class='boton uno' id='boto-incidencia' onclick='window.location.href=`afegirincidencia.php`'><span>Afegir incidència</span></button>

</div>
<div class="cuerpo-home">
  <div class="container-filtros">
    <form action="home.php" method="post" class="form-filtros">
        <div>
          <h3>Filtrar taules</h3>
        </div>
        <br>
          <div>
            <label for="num_taula" class="fuente">Num. de taula</label>
            <select name="num_taula">
            <option value="*">Totes les taules</option>
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
            </select>
          </div>
          <br>
          <div>
            <label for="sala" class="fuente">Sala</label>
            <select name="sala">
                <option value="*">Totes les sales</option>
                <?php
                  $stmt = $pdo->prepare("SELECT nom_sala FROM tbl_sala");
                  $stmt->execute();
                  $sales = $stmt->fetchAll(PDO::FETCH_ASSOC);
                  foreach($sales as $sala){
                ?>
                <option value="<?php echo $sala['nom_sala']; ?>"><?php echo $sala['nom_sala']; ?></option>
            
                <?php
                  }
                ?>
            </select>
          </div>
          <br>
          <div>
            <label for="datetime" class="fuente">Dia i hora de la reserva</label>
            <input type="datetime-local" name="datetime">
          </div>
          <br>
          <div>
            <input type="submit" name="enviarfiltro" value="BUSCAR">
          </div>
      </form>
    </div>
    <?php
/*       if(!isset($_POST['enviarfiltro'])){
        $stmt=$pdo->prepare("SELECT t.num_taula, t.num_llocs_taula, t.id_sala, s.nom_sala from tbl_taula t inner join tbl_sala s on t.id_sala=s.id_sala order by t.num_taula;");
        $stmt->execute();
        $listamesas=$stmt->fetchAll(PDO::FETCH_ASSOC);
        $auto=1;    
      }else{
        $auto=0;
            //000
          if(($_POST['estado']=='ambas') && ($_POST['num_taula']=="*") && $_POST['sala']=='*'){
              $stmt=$pdo->prepare("SELECT t.num_taula, t.num_llocs_taula, t.id_sala, t.estat_taula, s.nom_sala from tbl_taula t inner join tbl_sala s on t.id_sala=s.id_sala order by t.estat_taula, t.num_taula;");
              $stmt->execute();
              $listamesas=$stmt->fetchAll(PDO::FETCH_ASSOC);  
          }//100
          elseif($_POST['estado']!='ambas' && ($_POST['num_taula']=="*") && ($_POST['sala']=='*')){
              $stmt=$pdo->prepare("SELECT t.num_taula, t.num_llocs_taula, t.id_sala, t.estat_taula, s.nom_sala from tbl_taula t inner join tbl_sala s on t.id_sala=s.id_sala where t.estat_taula='".$_POST['estado']."' order by t.estat_taula, t.num_taula;");
              $stmt->execute();
              $listamesas=$stmt->fetchAll(PDO::FETCH_ASSOC);  
          }//110
          elseif($_POST['estado']!='ambas' && ($_POST['num_taula']!="*") && ($_POST['sala']=='*')){
            $stmt=$pdo->prepare("SELECT t.num_taula, t.num_llocs_taula, t.id_sala, t.estat_taula, s.nom_sala from tbl_taula t inner join tbl_sala s on t.id_sala=s.id_sala where t.estat_taula='".$_POST['estado']."' and t.num_taula='".$_POST['num_taula']."' order by t.estat_taula, t.num_taula;");
            $stmt->execute();
            $listamesas=$stmt->fetchAll(PDO::FETCH_ASSOC);     
          }//101
          elseif($_POST['estado']!='ambas' && ($_POST['num_taula']=="*") && ($_POST['sala']!='*')){
            $stmt=$pdo->prepare("SELECT t.num_taula, t.num_llocs_taula, t.id_sala, t.estat_taula, s.nom_sala from tbl_taula t inner join tbl_sala s on t.id_sala=s.id_sala where t.estat_taula='".$_POST['estado']."' and s.nom_sala='".$_POST['sala']."' order by t.estat_taula, t.num_taula;");
            $stmt->execute();
            $listamesas=$stmt->fetchAll(PDO::FETCH_ASSOC);     
          }//010
          elseif($_POST['estado']=='ambas' && ($_POST['num_taula']!="*") && ($_POST['sala']=='*')){
            $stmt=$pdo->prepare("SELECT t.num_taula, t.num_llocs_taula, t.id_sala, t.estat_taula, s.nom_sala from tbl_taula t inner join tbl_sala s on t.id_sala=s.id_sala where t.num_taula='".$_POST['num_taula']."' order by t.estat_taula, t.num_taula;");
            $stmt->execute();
            $listamesas=$stmt->fetchAll(PDO::FETCH_ASSOC);     
          }//011
          elseif($_POST['estado']=='ambas' && ($_POST['num_taula']!="*") && ($_POST['sala']!='*')){
            $stmt=$pdo->prepare("SELECT t.num_taula, t.num_llocs_taula, t.id_sala, t.estat_taula, s.nom_sala from tbl_taula t inner join tbl_sala s on t.id_sala=s.id_sala where t.num_taula='".$_POST['num_taula']."' and s.nom_sala='".$_POST['sala']."' order by t.estat_taula, t.num_taula;");
            $stmt->execute();
            $listamesas=$stmt->fetchAll(PDO::FETCH_ASSOC);     
          }//001
          elseif($_POST['estado']=='ambas' && ($_POST['num_taula']=="*") && ($_POST['sala']!='*')){
            $stmt=$pdo->prepare("SELECT t.num_taula, t.num_llocs_taula, t.id_sala, t.estat_taula, s.nom_sala from tbl_taula t inner join tbl_sala s on t.id_sala=s.id_sala where s.nom_sala='".$_POST['sala']."' order by t.estat_taula, t.num_taula;");
            $stmt->execute();
            $listamesas=$stmt->fetchAll(PDO::FETCH_ASSOC);  
          }//111
          else{
            $stmt=$pdo->prepare("SELECT t.num_taula, t.num_llocs_taula, t.id_sala, t.estat_taula, s.nom_sala from tbl_taula t inner join tbl_sala s on t.id_sala=s.id_sala where t.estat_taula='".$_POST['estado']."' and t.num_taula='".$_POST['num_taula']."' and s.nom_sala='".$_POST['sala']."' order by t.estat_taula, t.num_taula;");
            $stmt->execute();
            $listamesas=$stmt->fetchAll(PDO::FETCH_ASSOC);                
          }
      } */
      $queryGeneral="SELECT t.num_taula, t.num_llocs_taula, t.id_sala, s.nom_sala from tbl_taula t inner join tbl_sala s on t.id_sala=s.id_sala where t.num_taula like '%%'";

      if(isset($_POST['num_taula']) and $_POST['num_taula']!="*"){
        $num_taula = $_POST['num_taula'];
        $query2 = "AND t.num_taula = $num_taula";
        $queryGeneral = $queryGeneral.$query2;
      }
      if(isset($_POST['sala']) and $_POST['sala']!="*"){
        $sala = $_POST['sala'];
        $query2 = "AND s.nom_sala = '$sala'";
        $queryGeneral = $queryGeneral.$query2;
      }
      $stmt=$pdo->prepare($queryGeneral." order by t.num_taula;");
      $stmt->execute();
      $listamesas=$stmt->fetchAll(PDO::FETCH_ASSOC); 
    ?>
    <div class="mostrar-mesas">
      <div class="titulo">
        <h2><?php 
              if (empty($_POST['datetime'])) {
                $hora=date("H");
                $dia=date("d");
                $horacomplet=date("H:m");
                $diacomplet=date("d-m-Y");
                $diacompletangles=date("Y-m-d");
              }else{
                $hora=date("H", strtotime($_POST['datetime']));
                $dia=strftime('%d', strtotime($_POST['datetime']));
                $diacomplet=strftime('%d/%m/%Y', strtotime($_POST['datetime']));
                $diacompletangles=strftime('%Y/%m/%d', strtotime($_POST['datetime']));
                $horacomplet=date("H:i:s", strtotime($_POST['datetime']));
              }
              echo "Taules el dia ".$diacomplet.", a les  ".$hora.":00";
            ?>
        </h2>
      </div>
            <?php
              foreach ($listamesas as $mesa) {
                $stmt=$pdo->prepare('SELECT r.data_ini_reserva, r.data_fi_reserva, r.cancelacio_reserva, t.num_taula from tbl_reserva r inner join tbl_taula t on t.num_taula=r.num_taula where t.num_taula='.$mesa['num_taula'].' and r.cancelacio_reserva=0 and r.data_ini_reserva<"'.$diacompletangles."+".$horacomplet.'" and r.data_fi_reserva>"'.$diacompletangles."+".$horacomplet.'"');
                $stmt->execute();
                $num_dates = $stmt->fetchColumn();
            ?>
        <div class="mesa">
          <div class="parte-mesa">
            <?php 
              /* if($dia!=strftime('%d', strtotime($mesa['data_ini_reserva']))){
                $estado=0;
                ?>
                  <img class="tamanoimagen" width="100%" src="../img/silla_verde.png" alt="logomesa_libre">
                <?php
              }else{
                if ($hora<date("H", strtotime($mesa['data_ini_reserva'])) or $hora>=date("H", strtotime($mesa['data_fi_reserva']))) {
                  $estado=0;
                  ?>
                    <img class="tamanoimagen" width="100%" src="../img/silla_verde.png" alt="logomesa_libre">
                  <?php
                }else{
                  $estado=1;
                  ?>
                    <img class="tamanoimagen2" width="100%" src="../img/silla_roja.png" alt="logomesa">
                  <?php
                }
              } */
              if ($num_dates>0) {
                ?>
                  <img class="tamanoimagen2" width="100%" src="../img/silla_roja.png" alt="logomesa">
                <?php
                $estado=1;
              }else{
                ?>
                  <img class="tamanoimagen" width="100%" src="../img/silla_verde.png" alt="logomesa_libre">
                <?php    
                $estado=0;            
              }
            ?>
          </div>
          <div class="parte-mesa">
            <h4><?php echo "<br>Taula num. ".$mesa['num_taula']; ?></h4>
            <h6><?php echo "<br>Sala: ".$mesa['nom_sala']; ?></h6>
            <h6><?php echo "<br>Num. de llocs: ".$mesa['num_llocs_taula']; ?></h6>
            <h6><?php 
            if($estado==1){
              echo "<br>Estat de la taula: <span class='estat-taula-reservada'>Reservada</span></h6>";
            }else{
              echo "<br>Estat de la taula: <span class='estat-taula-lliure'>Lliure</span></h6>";
            }
            ?>
          </div>
          <div class="parte-mesa contenedor botones-mesa">
              <?php 
                  $stmt2=$pdo->prepare("SELECT i.id_incidencia, i.desc_incidencia, i.estat_incidencia, t.num_taula from tbl_incidencia i inner join tbl_taula t on i.num_taula=t.num_taula where t.num_taula=".$mesa['num_taula']." and i.estat_incidencia=1;");
                  $stmt2->execute();
                  $listamantenimiento=$stmt2->fetchAll(PDO::FETCH_ASSOC);
                  $num_rows = count($listamantenimiento);
                if($num_rows!=0){
                  foreach ($listamantenimiento as $mantenimiento) {
                    echo "No es pot reservar. Taula en manteniment. Motiu: ".$mantenimiento['desc_incidencia']."<br><br>";
                  } 
                  if($_SESSION['tipus_usuari']=="manteniment"){
                    echo "<button type='button' class='boton uno' id='boto-incidencia' onclick='window.location.href=`../processes/treureincidencia.php?num_taula=".$mesa['num_taula']."`'><span>Treure incidència</span></button>";
                  }
                }else{
                  if($estado==1){
                    echo "<button type='button' class='boton uno' onclick='window.location.href=`../processes/home2.php?num_taula=".$mesa['num_taula']."`'><span>ALLIBERAR</span></button>";
                  }else{
                    echo "<button type='button' class='boton dos' onclick='window.location.href=`./calendari.php?num_taula=".$mesa['num_taula']."`'><span>RESERVAR</span></button>";
                  }
                }

              ?>
          </div>
        </div>
        <?php
      }
      $count= count($listamesas);
      ?>
              <input type=hidden value='<?php echo $count;?>' id='count'>
    </div>
  </div>
</body>
</html>
<?php } else {header('location:login.php');}?>