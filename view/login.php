<!DOCTYPE html>
<html lang="en" xmlns:th="http://www.thymeleaf.org">
<head>
    <title>Mi primer Login</title>

    <!--JQUERY-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    
    <!-- FRAMEWORK BOOTSTRAP para el estilo de la pagina-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    
    <!-- Los iconos tipo Solid de Fontawesome-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/solid.css">
    <script src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script>

    <!-- Nuestro css-->
    <link rel="stylesheet" type="text/css" href="../css/style.css" th:href="@{/css/index.css}">
    <script type="text/javascript" src="../js/login.js"></script>

</head>
<body class="bodylogin">
    
    <div class="modal-dialog text-center">
        <div class="col-sm-8 main-section">
            <div class="modal-content">
                <div class="col-12 user-img">
                    <img src="../img/user.png" th:src="@{../img/user.png}"/>
                </div>
            
                <form action="../processes/login.proc.php" class="col-12" th:action="@{/login}" method="POST" onsubmit="return validar()">
                    <div class="form-group" id="user-group">
                        <input type="text" class="form-control" id="username" placeholder="Nombre de usuario" name="username"/>
                        
                    </div>
                    <div class="form-group" id="contrasena-group">
                        <input type="password" class="form-control" id="password" placeholder="Contraseña" name="password"/>
                    </div>
                    <br>
                    <div class="alert" id="alerta"></div>
                    <button type="submit" class="buttonlogin btn btn-primary"><i class="fas fa-sign-in-alt"></i>  Ingresar </button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
