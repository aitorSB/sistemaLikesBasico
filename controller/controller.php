<?php
    require_once '../model/model.php';
    require_once '../classes/usuario.php';

    session_start();
    
    $conexion = new Conexion();

    /***************************** ACCIONES ***************************/
    
    $accion = $_REQUEST['accion'];
    $salt = '$2a$07$usesomadasdsadsadsadasdasdasdsadesillystringfors';

//publicaciones *********************************************************************
    if($accion == "cargaDiscusiones") {
        
        $datosDiscusiones = $conexion->cargaDiscusiones();
        echo "<script src='js/likes.js'></script>";
        foreach($datosDiscusiones as $filaDatos) {
            echo '
                <ul id="comments-list" class="comments-list">
                    <li>
                        <div class="comment-main-level">
                            <!-- Avatar -->
                            <div class="comment-avatar"><img src="img/avatar/rose.jpg" alt=""></div>
                            <!-- Contenedor del Comentario -->
                            <div class="comment-box">
                                <div class="comment-head" id="'.$filaDatos['publicaciones_id'].'">
                                    <h6 class="comment-name"><a href="">'. $filaDatos['publicaciones_titulo'] .'</a></h6>
                                    <span>
                                    '.
                                        $filaDatos['publicaciones_fecha_creacion'] . " " .$filaDatos['publicaciones_tema']
                                    .'
                                    </span>';

                                    if (isset($_SESSION["login"])) {
                                        echo '<button type="button" class="comment-ico btn btn-light"><img src="img/iconos/corazon.png">
                                                <span class="badge badge-light">0</span>
                                            </button>
                                            <button type="button" class="comment-ico btn btn-light like">
                                                <img src="img/iconos/like.png">
                                                <span class="badge badge-light">'.$filaDatos['publicaciones_likes'] .'</span>
                                            </button>';
                                    } else {
                                        echo '<button type="button" class="comment-ico btn btn-light noLogin"><img src="img/iconos/corazon.png">
                                                <span class="badge badge-light">0</span>
                                            </button>
                                            <button type="button" class="comment-ico btn btn-light noLogin">
                                                <img src="img/iconos/like.png">
                                                <span class="badge badge-light">'.$filaDatos['publicaciones_likes'] .'</span>
                                            </button>';
                                    }
                                    echo '
                                </div>
                                <div class="comment-content">' 
                                . 
                                    $filaDatos['publicaciones_contenido'] 
                                . '
                                </div>
                            </div>
                            <div class="comment-cantidad">
                                <img src="img/iconos/comments.png" alt="">
                            </div>
                            <div class="contadorComentarios">0</div>
            
                        </div>


                        <!-- Respuestas de los comentarios -->

                        <!--
                        <ul class="comments-list reply-list">
                            <li> 
                                <div class="comment-avatar"><img src="img/avatar/skull.png" alt=""></div>
                                <div class="comment-box">
                                    <div class="comment-head">
                                        <h6 class="comment-name"><a href="">Pepe López</a></h6>
                                        <span>HORA DE LA RESPUESTA XXX</span>
                                        <button type="button" class="comment-ico btn btn-light"><img src="img/iconos/corazon.png"></button>
                                        <button type="button" class="comment-ico btn btn-light"><img src="img/iconos/like.png"></button>
                                    </div>
                                    <div class="comment-content">
                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Velit omnis animi et iure laudantium vitae, praesentium optio, sapiente distinctio illo?

                                    </div>
                                </div>
                            </li> -->
                            <!-- CREAR OTRO LI PARA MAS RESPUESTAS  DE USUARIOS FUTURO LLAMAR A BD Y CARGAR RESPUESTAS -->
                        </ul>
                    </li>
                </ul>
            </div>';
            echo '
            
            <button type="button" id="accionNoLogin" data-toggle="modal" data-target="#myModal"></button>

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
                            <p>Inicie sesión.</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>';
        }
//registro *********************************************************************
    }elseif($accion == 'registrarUsuario') {
        $usuarios_nombre = $_REQUEST['usuarios_nombre'];
        $usuarios_apellidos = $_REQUEST['usuarios_apellidos'];
        $usuarios_correo = $_REQUEST['usuarios_correo'];

        $usuarios_contrasenna = crypt($_REQUEST['usuarios_contrasenna'], $salt);

        $usuarios_contrasenna_verficada = $_REQUEST['usuarios_contrasenna_verficada'];
        $usuarios_alias = $_REQUEST['usuarios_alias'];
        $usuarios_direccion = $_REQUEST['usuarios_direccion'];
        $usuarios_pais = $_REQUEST['usuarios_pais'];
        $usuarios_codigo_postal = $_REQUEST['usuarios_codigo_postal'];
      
        $verificarCorreo = $conexion->verificarCorreo($usuarios_correo);
        $verificarAlias = $conexion->verificarAlias($usuarios_alias);

        if($verificarCorreo < 1) {
            if($verificarAlias < 1) {
                $conexion->registrarUsuario($usuarios_nombre, $usuarios_apellidos, $usuarios_contrasenna, $usuarios_correo, $usuarios_alias, $usuarios_direccion, $usuarios_pais, $usuarios_codigo_postal);
            } else {
                echo 'aliasUso';
            } 
        } else {
            echo 'correoUso';
        }  
//login *********************************************************************
    } else if ($accion == "comprobarDatosLogin") {
        $aliasCorreo = $_REQUEST['aliasCorreo'];
        $pwd = $_REQUEST['pwd'];

        $verificacionAliasCorreo = $conexion->verificarAliasCorreo($aliasCorreo);
        $verificacionContrasenna = $conexion->verificarContrasenna($aliasCorreo);
        
        if(crypt($pwd, $salt) == $verificacionContrasenna) {
            
            $resultado = $conexion->datosUsuario($aliasCorreo);
            $cadena = '';
            foreach($resultado as $fila) {
                $cadena .= '&idUsuario=' . $fila['usuarios_id_usuario'] 
                . '&nombre=' . $fila['usuarios_nombre'] 
                . '&apellidos=' . $fila['usuarios_apellidos'] 
                . '&correo=' . $fila['usuarios_correo'] 
                . '&alias=' . $fila['usuarios_alias'] 
                . '&direccion=' . $fila['usuarios_direccion'] 
                . '&pais=' . $fila['usuarios_pais'] 
                . '&cp=' . $fila['usuarios_codigo_postal'];
            }
            unset($_SESSION['login']);
            echo $cadena;
        } else {
            echo "no";
        }
//sesion *********************************************************************
    } else if ($accion == "cerrarSesion") {
        unset($_SESSION['login']);
        session_destroy();
        header('Location: ../index.php');
        die();
//likes *********************************************************************
    } else if ($accion == "like") {
        $usuarioLogin = $_REQUEST['usuarioLogin'];
        
        $idUsuario = $conexion->idUsuario(unserialize($_SESSION['usuario'])->getAlias());

        $idPublicacion = $_REQUEST['idPublicacion'];
        $conexion->sumarLike($idPublicacion);
        $conexion->insertarLike($idUsuario, $idPublicacion);
    } else if ($accion == "quitarLike") {
        $idPublicacion = $_REQUEST['idPublicacion'];
        $usuarioLogin = $_REQUEST['usuarioLogin'];
        $idUsuario = $conexion->idUsuario(unserialize($_SESSION['usuario'])->getAlias());
        $conexion->quitarLike($idPublicacion);
        $conexion->eliminarLike($idUsuario, $idPublicacion);
    } else if ($accion == "comprobarUsuarioLike") {
        $usuarioLogin = $_REQUEST['usuarioLogin'];
        $idPublicacion = $_REQUEST['idPublicacion'];
        $idUsuario = $conexion->idUsuario(unserialize($_SESSION['usuario'])->getAlias());
        $comprobacion = $conexion->comprobarLike($idUsuario, $idPublicacion);
        if($comprobacion > 0) {
            echo "si";
        } else {
            echo "no";
        }
    } else if ($accion == "cargarLikes") {
        $idPublicacion = $_REQUEST['idPublicacion'];
        $resultado = $conexion->cargarLikes($idPublicacion);
        echo $resultado;
    } 
$conexion->cerrarConexion();
    