<?php
    class Usuario {

        private $id;
        private $usuarios_nombre;
        private $usuarios_apellidos;
        private $usuarios_correo;
        private $usuarios_alias;
        private $usuarios_direccion;
        private $usuarios_pais;
        private $usuarios_codigo_postal;

        public function __construct($id, $usuarios_nombre
            , $usuarios_apellidos, $usuarios_correo, $usuarios_alias 
            , $usuarios_direccion, $usuarios_pais, $usuarios_codigo_postal) {

            $this->id = $id;
            $this->usuarios_nombre = $usuarios_nombre;
            $this->usuarios_apellidos = $usuarios_apellidos;
            $this->usuarios_correo = $usuarios_correo;
            $this->usuarios_alias = $usuarios_alias;
            $this->usuarios_direccion = $usuarios_direccion;
            $this->usuarios_pais = $usuarios_pais;
            $this->usuarios_codigo_postal = $usuarios_codigo_postal;
        }

        public function getId() {
            return $this->id;
        }

        public function getNombre() {
            return $this->usuarios_nombre;
        }

        public function getApellidos() {
            return $this->usuarios_apellidos;
        }

        public function getCorreo() {
            return $this->usuarios_correo;
        }

        public function getAlias() {
            return $this->usuarios_alias;
        }

        public function getDireccion() {
            return $this->usuarios_direccion;
        }

        public function getPais() {
            return $this->usuarios_pais;
        }

        public function getCP() {
            return $this->usuarios_codigo_postal;
        }

        public function setNombre($id) {
            $this->usuario_nombre = $id;
        }

        public function setApellidos($id) {
            $this->usuario_apellidos = $id;
        }

        public function setCorreo($id) {
            $this->usuario_correo = $id;
        }

        public function setAlias($id) {
            $this->usuario_alias = $id;
        }

        public function setDireccion($id) {
            $this->usuario_direccion = $id;
        }

        public function setPais($id) {
            $this->usuario_pais = $id;
        }

        public function setCP($id) {
            $this->usuario_codigo_postal = $id;
        }
    }