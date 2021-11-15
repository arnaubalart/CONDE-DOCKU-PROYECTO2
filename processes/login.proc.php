
<?php
if (isset($_POST['username']) && isset($_POST['password'])) {
    require_once '../services/conexion.php';
    $username=$_POST['username'];
    $password=$_POST['password'];
    $stmt = $pdo->prepare("SELECT * FROM tbl_usuari WHERE nom_usuari=? and contra_usuari=MD5(?)");

    $stmt->bindParam(1, $username);
    $stmt->bindParam(2, $password);

    $stmt->execute();
    $comprobar=$stmt->fetchAll(PDO::FETCH_ASSOC);
    try {
        if (!$comprobar=="") {
            session_start();
            $_SESSION['username']=$username;
            $_SESSION['tipus_usuari']=$comprobar[0]['tipus_usuari'];
            echo $comprobar[0]['tipus_usuari'];
            header("location: ../view/home.php");
        }else {
            header("location: ../view/login.php");
            
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}else{
    header("location: ../view/login.php");
}
?>
