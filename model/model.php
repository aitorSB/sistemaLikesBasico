<?php

class Conexion {
    private $conexion;

    function __construct() {
        $server = 'localhost';
        $user = 'root';
        $pwd = '';
        $bd = 'dblikes';

        $this->conexion = new mysqli($server,$user,$pwd,$bd);

        if ($this->conexion->connect_error) { 
            die('Error de Conexión('.$this->conexion->connect_errno.')'.$this->conexion->connect_error);
        }
    }

    /*
    *   función de carga de discusiones para el index
    */
    function cargaDiscusiones() {
        $stmt = $this->conexion->stmt_init();
        $stmt->prepare("SELECT publicaciones_id, publicaciones_tema, publicaciones_fecha_creacion
            , publicaciones_contenido, publicaciones_titulo, publicaciones_likes FROM publicaciones");
        $stmt->execute();

        $resultado = $stmt->get_result();
        $contenedorDatos = [];
        while($fila = mysqli_fetch_assoc($resultado)) {
            $datos = [
                "publicaciones_id" => $fila['publicaciones_id'],
                "publicaciones_tema" => $fila['publicaciones_tema'],
                "publicaciones_fecha_creacion" => $fila['publicaciones_fecha_creacion'],
                "publicaciones_contenido" => $fila['publicaciones_contenido'],
                "publicaciones_titulo" => $fila['publicaciones_titulo'],
                "publicaciones_likes" => $fila['publicaciones_likes'],
            ];
            array_push($contenedorDatos, $datos);
        }
        return $contenedorDatos;
    }

    /*
    * función cerrar conexión
    */
    function cerrarConexion() {
        $this->conexion->close();
    }

    function verificarCorreo($correo) {
            $stmt = $this->conexion->stmt_init();
            $stmt->prepare('SELECT usuarios_correo FROM usuarios WHERE usuarios_correo = ?');
            $stmt->bind_param('s', $correo);
            $stmt->execute();

            $resultado = $stmt->get_result();
            $arrayDatos = [];

            while($fila = $resultado->fetch_assoc()) {
                $temp = [
                    'usuarios_correo' => $fila['usuarios_correo']
                ];
                array_push($arrayDatos, $temp);
            }

            return count($arrayDatos);
    }

    function verificarAlias($alias) {
        $stmt = $this->conexion->stmt_init();
        $stmt->prepare('SELECT usuarios_alias FROM usuarios WHERE usuarios_alias = ?');
        $stmt->bind_param('s', $alias);
        $stmt->execute();

        $resultado = $stmt->get_result();
        $arrayDatos = [];

        while($fila = $resultado->fetch_assoc()) {
            $temp = [
                'usuarios_alias' => $fila['usuarios_alias']
            ];
            array_push($arrayDatos, $temp);
        }
        return count($arrayDatos);
    }


    function verificarAliasCorreo($aliasCorreo) {
        $stmt = $this->conexion->stmt_init();
        $stmt->prepare('SELECT usuarios_alias FROM usuarios WHERE usuarios_alias = ? OR usuarios_correo = ?');
        $stmt->bind_param('ss', $aliasCorreo, $aliasCorreo);
        $stmt->execute();

        $resultado = $stmt->get_result();
        $arrayDatos = [];

        while($fila = $resultado->fetch_assoc()) {
            $temp = [
                'usuarios_alias' => $fila['usuarios_alias']
            ];
            array_push($arrayDatos, $temp);
        }

        return count($arrayDatos);
    }

    function verificarContrasenna($aliasCorreo) {
        $stmt = $this->conexion->stmt_init();
        $stmt->prepare('SELECT usuarios_contrasenna FROM usuarios WHERE usuarios_alias = ? OR usuarios_correo = ?');
        $stmt->bind_param('ss', $aliasCorreo, $aliasCorreo);
        $stmt->execute();

        $resultado = $stmt->get_result();

        while($fila = $resultado->fetch_assoc()) {
            return $fila['usuarios_contrasenna'];
        }
    }

    function sumarLike($idPublicacion) {
        $stmt = $this->conexion->stmt_init();
        $stmt->prepare("UPDATE dblikes.publicaciones SET publicaciones_likes = publicaciones_likes + 1
            WHERE publicaciones_id = ?");
        $stmt->bind_param('i', $idPublicacion);
        $stmt->execute();
    }

    function quitarLike($idPublicacion) {
        $stmt = $this->conexion->stmt_init();
        $stmt->prepare("UPDATE dblikes.publicaciones SET publicaciones_likes = publicaciones_likes - 1
            WHERE publicaciones_id = ?");
        $stmt->bind_param('i', $idPublicacion);
        $stmt->execute();
    }

    function cargarLikes($idPublicacion) {
        $stmt = $this->conexion->stmt_init();
        $stmt->prepare('SELECT publicaciones_likes FROM dblikes.publicaciones WHERE publicaciones_id = ?');
        $stmt->bind_param('i', $idPublicacion);
        $stmt->execute();

        $resultado = $stmt->get_result();

        while($fila = $resultado->fetch_assoc()) {
            return $fila['publicaciones_likes'];
        }
    }
    
    function idUsuario($usuarioLogin) {
        $stmt = $this->conexion->stmt_init();
        $stmt->prepare('SELECT usuarios_id_usuario FROM dblikes.usuarios
            WHERE usuarios_correo = ? OR usuarios_alias = ?');
        $stmt->bind_param('ss', $usuarioLogin,  $usuarioLogin);
        $stmt->execute();
        $resultado = $stmt->get_result();

        while($fila = $resultado->fetch_assoc()) {
            return $fila['usuarios_id_usuario'];
        }
    }

    function comprobarLike($idUsuario, $idPublicacion) {
        $stmt = $this->conexion->stmt_init();
        $stmt->prepare('SELECT * FROM dblikes.likes WHERE like_usuario_id
            = ? AND like_publicacion_id = ?');
        $stmt->bind_param('ii', $idUsuario,  $idPublicacion);
        $stmt->execute();

        $resultado = $stmt->get_result();
        $arrayDatos = [];

        while($fila = $resultado->fetch_assoc()) {
            $temp = [
                'like_usuario_id' => $fila['like_usuario_id']
            ];
            array_push($arrayDatos, $temp);
        }
        return count($arrayDatos);
    }

    function insertarLike($idUsuario, $idPublicacion) {
        $stmt = $this->conexion->stmt_init();
        $stmt->prepare('INSERT INTO dblikes.likes (like_usuario_id, like_publicacion_id) 
        values(?, ?)');
        $stmt->bind_param('ii', $idUsuario,  $idPublicacion);
        $stmt->execute();
    }

    function eliminarLike($idUsuario, $idPublicacion) {
        $stmt = $this->conexion->stmt_init();
        $stmt->prepare('DELETE FROM dblikes.likes  
            WHERE like_usuario_id = ? AND like_publicacion_id = ?');
        $stmt->bind_param('ii', $idUsuario,  $idPublicacion);
        $stmt->execute();
    }

    function datosUsuario($usuarioLogin) {
        $stmt = $this->conexion->stmt_init();
        $stmt->prepare('SELECT * FROM dblikes.usuarios
            WHERE usuarios_correo = ? OR usuarios_alias = ?');
        $stmt->bind_param('ss', $usuarioLogin,  $usuarioLogin);
        $stmt->execute();
        $resultado = $stmt->get_result();

        $arrayDatos = [];

        while($fila = $resultado->fetch_assoc()) {
            $temp = [
                'usuarios_id_usuario' => $fila['usuarios_id_usuario'],
                'usuarios_nombre' => $fila['usuarios_nombre'],
                'usuarios_apellidos' => $fila['usuarios_apellidos'],
                'usuarios_correo' => $fila['usuarios_correo'],
                'usuarios_alias' => $fila['usuarios_alias'],
                'usuarios_direccion' => $fila['usuarios_direccion'],
                'usuarios_fecha_registro' => $fila['usuarios_fecha_registro'],
                'usuarios_pais' => $fila['usuarios_pais'],
                'usuarios_codigo_postal' => $fila['usuarios_codigo_postal'],
            ];
            array_push($arrayDatos, $temp);
        }
        return $arrayDatos;
    }

    function datosUsuarioPorId($id) {
        $stmt = $this->conexion->stmt_init();
        $stmt->prepare('SELECT * FROM dblikes.usuarios
            WHERE usuarios_id_usuario = ?');
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $resultado = $stmt->get_result();

        $arrayDatos = [];

        while($fila = $resultado->fetch_assoc()) {
            $temp = [
                'usuarios_id_usuario' => $fila['usuarios_id_usuario'],
                'usuarios_nombre' => $fila['usuarios_nombre'],
                'usuarios_apellidos' => $fila['usuarios_apellidos'],
                'usuarios_correo' => $fila['usuarios_correo'],
                'usuarios_alias' => $fila['usuarios_alias'],
                'usuarios_direccion' => $fila['usuarios_direccion'],
                'usuarios_fecha_registro' => $fila['usuarios_fecha_registro'],
                'usuarios_pais' => $fila['usuarios_pais'],
                'usuarios_codigo_postal' => $fila['usuarios_codigo_postal'],
                'usuarios_contrasenna' => $fila['usuarios_contrasenna'],
            ];
            array_push($arrayDatos, $temp);
        }
        return $arrayDatos;
    }

    function datosPublicacionPorId($id) {
        $stmt = $this->conexion->stmt_init();
        $stmt->prepare('SELECT * FROM dblikes.publicaciones
            WHERE publicaciones_id = ?');
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $resultado = $stmt->get_result();

        $arrayDatos = [];

        while($fila = $resultado->fetch_assoc()) {
            $temp = [
                "publicaciones_id" => $fila['publicaciones_id'],
                "publicaciones_tema" => $fila['publicaciones_tema'],
                "publicaciones_fecha_creacion" => $fila['publicaciones_fecha_creacion'],
                "publicaciones_contenido" => $fila['publicaciones_contenido'],
                "publicaciones_titulo" => $fila['publicaciones_titulo'],
                "publicaciones_likes" => $fila['publicaciones_likes'],
            ];
            array_push($arrayDatos, $temp);
        }
        return $arrayDatos;
    }

}