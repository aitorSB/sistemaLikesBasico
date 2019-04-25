<?php
    session_start();
    require_once 'bd/cargaBd.php';
    require_once 'model/model.php';
    require_once 'classes/usuario.php';

    if (!isset($_SESSION['login'])) {
        if (isset($_REQUEST['login'])) {
            if ($_REQUEST['login'] != '' && $_REQUEST['login'] != null) {
                $_SESSION['login'] = $_REQUEST['login'];

                $idUsuario = $_REQUEST['idUsuario'];
                $nombre =  $_REQUEST['nombre'];
                $apellidos =  $_REQUEST['apellidos'];
                $correo =  $_REQUEST['correo'];
                $alias =  $_REQUEST['alias'];
                $direccion =  $_REQUEST['direccion'];
                $pais =  $_REQUEST['pais'];
                $cp =  $_REQUEST['cp'];

                $_SESSION['usuario'] = serialize(new Usuario($idUsuario, $nombre, $apellidos
                , $correo, $alias, $direccion, $pais, $cp));

                if (unserialize($_SESSION['usuario'])->getNombre() == "administradorA3PF") {
                    header('Location: backPanel');
                    die();
                }
            }
        }
    } 
?>

<!DOCTYPE html>
<html>

<head>
    <?php include "inc/header.inc" ?>
    <link rel="stylesheet" type="text/css" href="css/diseñoIndex.css">
    <link rel="stylesheet" type="text/css" href="css/comentariosIndex.css">
</head>

<body>
    <header class="formatoHeader">
        <div class="row">
            <div class=" col-12 col-xs-12 col-sm-12 col-md-12">
                <nav class="navbar navbar-expand-lg navbar-light bg-lightgray">
                    <ul class="row">
                        <!--CONTROL SESIONES -->
                        <?php 
                            if (isset($_SESSION['usuario'])) {
                                echo '<li><a href="php/perfil/perfilUsuario.php"><button id="usuarioLogin" class="btn btn-warning tamannoBotonLogin">'. unserialize($_SESSION['usuario'])->getNombre() .'</button></a></li>';
                                echo '<li><button id="cerrarSesion"  class="btn btn-warning tamannoBotonLogin"> Cerrar sesión</button></li>';
                            } else {
                                echo '<li  class="formatoBotonRegistro "><a href="php/login/login.php"><button  class="btn btn-warning tamannoBotonLogin">Iniciar sesión</button></a></li>';
                            }
                        ?>
                    </ul>
                    </li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>

    <script src="js/sesionIndex.js"></script>
    <script src="js/discusionesIndex.js"></script>
    <script src="js/likes.js"></script>

    <div id="campo-discusiones"></div>
    <hr>
</body>

</html>