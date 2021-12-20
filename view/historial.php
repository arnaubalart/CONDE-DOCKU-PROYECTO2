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

<body class="historial">
<div id="mySidepanel" class="sidepanel">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <a href="home.php">Home</a>
  <a href="../processes/logout.proc.php">Logout</a>
</div>

<button class="openbtn" onclick="openNav()">&#9776;</button>

<div class="cuerpo-home">
  <div class="container-filtros">
    <form action="historial.php" method="post" class="form-filtros">
      <div>
        <h3>Filtrar registres</h3>
      </div>
        <div>
          <label for="num_taula">Num. de taula</label>
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
        <div>
          <label for="sala">Sala</label>
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
        <div>
          <input type="submit" name="enviarfiltro" value="Buscar">
        </div>
    </form>
  </div>
  <div class="mostrar-mesashistorial">
    <?php
    if(!isset($_POST['enviarfiltro'])){
      $stmt=$pdo->prepare("SELECT r.id_reserva, t.num_taula, t.num_llocs_taula, t.id_sala, r.data_ini_reserva, r.data_fi_reserva, s.nom_sala from tbl_taula t inner join tbl_reserva r on t.num_taula=r.num_taula inner join tbl_sala s on t.id_sala=s.id_sala order by r.id_reserva;");
      $stmt->execute();
      $listamesas=$stmt->fetchAll(PDO::FETCH_ASSOC);    
    }else{
          //000
        if(($_POST['num_taula']=="*") && $_POST['sala']=='*'){
            $stmt=$pdo->prepare("SELECT r.id_reserva, t.num_taula, t.num_llocs_taula, t.id_sala, r.data_ini_reserva, r.data_fi_reserva, s.nom_sala from tbl_taula t inner join tbl_reserva r on t.num_taula=r.num_taula inner join tbl_sala s on t.id_sala=s.id_sala order by r.id_reserva;");
            $stmt->execute();
            $listamesas=$stmt->fetchAll(PDO::FETCH_ASSOC);  
        }//010
        elseif(($_POST['num_taula']!="*") && ($_POST['sala']=='*')){
          $stmt=$pdo->prepare("SELECT r.id_reserva, t.num_taula, t.num_llocs_taula, t.id_sala, r.data_ini_reserva, r.data_fi_reserva, s.nom_sala from tbl_taula t inner join tbl_reserva r on t.num_taula=r.num_taula inner join tbl_sala s on t.id_sala=s.id_sala where t.num_taula='".$_POST['num_taula']."' order by r.id_reserva;");
          $stmt->execute();
          $listamesas=$stmt->fetchAll(PDO::FETCH_ASSOC);     
        }//011
        elseif(($_POST['num_taula']!="*") && ($_POST['sala']!='*')){
          $stmt=$pdo->prepare("SELECT r.id_reserva, t.num_taula, t.num_llocs_taula, t.id_sala, r.data_ini_reserva, r.data_fi_reserva, s.nom_sala from tbl_taula t inner join tbl_reserva r on t.num_taula=r.num_taula inner join tbl_sala s on t.id_sala=s.id_sala where t.num_taula='".$_POST['num_taula']."' and s.nom_sala='".$_POST['sala']."' order by r.id_reserva;");
          $stmt->execute();
          $listamesas=$stmt->fetchAll(PDO::FETCH_ASSOC);     
        }//001
        elseif(($_POST['num_taula']=="*") && ($_POST['sala']!='*')){
          $stmt=$pdo->prepare("SELECT r.id_reserva, t.num_taula, t.num_llocs_taula, t.id_sala, r.data_ini_reserva, r.data_fi_reserva, s.nom_sala from tbl_taula t inner join tbl_reserva r on t.num_taula=r.num_taula inner join tbl_sala s on t.id_sala=s.id_sala where s.nom_sala='".$_POST['sala']."' order by r.id_reserva;");
          $stmt->execute();
          $listamesas=$stmt->fetchAll(PDO::FETCH_ASSOC);  
        }
    }
    ?>
      <table class="historial_reservas">
        <tr>
          <th>Núm. taula</th>
          <th>Sala</th>
          <th>Núm. llocs taula</th>
          <th>Data inici reserva</th>
          <th>Data fi reserva</th>
        </tr>
      
    <?php
    setlocale(LC_TIME, 'spanish');
    foreach ($listamesas as $mesa) {

      ?>
      <tr class="registro-historial">
        <td>
          <h4 class="h4historial"><?php echo $mesa['num_taula']; ?></h4>
        </td>
        <td>
          <h6 class="h6historial"><?php echo $mesa['nom_sala']; ?></h6>
        </td>  
        <td>
          <h6 class="h6historial"><?php echo $mesa['num_llocs_taula']; ?></h6>
        </td>
        <td>
          <h6 class="h6historial"><?php echo strftime("%A, %d de %B del %Y", strtotime($mesa['data_ini_reserva']))." a las ".date("H:i:s", strtotime($mesa['data_ini_reserva']));?>
        </td>
        <td>
        <h6 class="h6historial"><?php echo strftime("%A, %d de %B del %Y", strtotime($mesa['data_fi_reserva']))." a las ".date("H:i:s", strtotime($mesa['data_fi_reserva']));?>
        </td>
      </tr>
      <?php
    }
    ?>
    </table>
  </div>
</div>
<?php } else {header('location:login.php');}?>