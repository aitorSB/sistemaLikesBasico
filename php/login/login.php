<?php
session_start();
?>
<!DOCTYPE html>

<html>

<head>
    <?php include "../../inc/header.inc"?>
    <title>Iniciar sesión</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
        integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../../css/login.css">
</head>

<body>
    <div class="container">
        <div class="d-flex justify-content-center h-100">
            <div class="card">
                <div class="card-header">
                    <h4>Iniciar sesión</h4>
                    <div class="d-flex justify-content-end social_icon">
                        <span><i class="fab fa-facebook-square"></i></span>
                        <span><i class="fab fa-google-plus-square"></i></span>
                        <span><i class="fab fa-twitter-square"></i></span>
                    </div>
                </div>
                <div class="card-body">
                    <form id="formulario">
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><img src="../../img/iconos/userLogin.png"></span>
                            </div>
                            <input type="text" name="aliasCorreo" id="aliasCorreo" class="form-control"
                                placeholder="usuario">
                        </div>
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><img src="../../img/iconos/key.png"></i></span>
                            </div>
                            <input type="password" name="pwd" id="pwd" class="form-control" placeholder="contraseña">
                        </div>
                        <div class="row align-items-center remember">
                            <input type="checkbox">Recuerdame
                        </div>
                        <div class="form-group">
                        <a href="../../index.php"><button type="button" value="Volver"
                                class="btn float-left login_btn">Volver</button></a>
                            <input type="button" name="iniciarSesion" id="iniciarSesion" value="Iniciar"
                                class="btn float-right login_btn">
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-center links">
                        ¿No tienes cuenta?<a href="../register/register.php">Registrarse</a>
                    </div>
                    <div class="d-flex justify-content-center">
                        <a href="olvidadoContrasena.php">¿Has olvidado la contraseña?</a>
                    </div>
                </div>
            </div>
        </div>

        <button type="button" id="accionModal" data-toggle="modal" data-target="#myModal"></button>

        <!-- Modal -->
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"></h4>
                    </div>
                    <div class="modal-body">
                        <p>Datos incorrectos.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
        <script src="../../js/login.js"></script>
</body>

</html>