<?php
include '../services/conexion.php';
?>

<?php

//if(!empty($_SESSION['email'])){}

$reservar = $_GET['estat_taula'];
if ($reservar == '0') { $reservar = '1'; }
elseif ($reservar == '1') { $reservar = '0'; }
$num_mesa= $_GET['num_taula'];
$date = date('Y-m-d');
date_default_timezone_set("Europe/Madrid");
$time = date('H:i:s');
session_start();
$username= $_SESSION['username'];
?>



<?php
$sqlu="SELECT id_usuari FROM tbl_usuari WHERE nom_usuari='$username';";
$result_sqlu= mysqli_query($connection,$sqlu);
while ($result2=mysqli_fetch_all($result_sqlu)){
    $sqlu2=$result2[0][0];
}

  if ($reservar == "1")
  {
    $sql_submit="INSERT INTO `tbl_reserva` (`id_reserva`, `data_reserva`, `data_alliberament_reserva`, `num_taula`, `id_usuari`) VALUES (NULL, '$date+$time', NULL, '$num_mesa', '$sqlu2');";
    $result_submit = mysqli_query($connection,$sql_submit) or die(mysqli_error($connection));
    $sql_update="UPDATE `tbl_taula` SET `estat_taula` = '1' WHERE `tbl_taula`.`num_taula` =$num_mesa;";
    $result_update = mysqli_query($connection,$sql_update) or die(mysqli_error($connection));
  }
  elseif ($reservar == "0")
  {
    $sql_submit="UPDATE `tbl_reserva` SET `data_alliberament_reserva` = '$date+$time' WHERE `tbl_reserva`.`num_taula` =$num_mesa ORDER BY `id_reserva` DESC LIMIT 1;";
    $result_submit = mysqli_query($connection,$sql_submit) or die(mysqli_error($connection));
    $sql_update="UPDATE `tbl_taula` SET `estat_taula` = '0' WHERE `tbl_taula`.`num_taula` =$num_mesa;";
    $result_update = mysqli_query($connection,$sql_update) or die(mysqli_error($connection));
  }
  else {
    echo "error";
  }
header('Location:../view/home.php');