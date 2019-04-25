<?php
    $conexion = mysqli_connect('localhost', 'root', ''); 
    if ($conexion->connect_error) { 
        die('Error de Conexión('.$conexion->connect_errno.')'.$conexion->connect_error);
    }else{        
        $query = '';
        $sqlScript = file('bd/dataBase.sql');
        foreach ($sqlScript as $line){    
            $startWith = substr(trim($line), 0 ,2);
            $endWith = substr(trim($line), -1 ,1);
        
            if (empty($line) || $startWith == '--' || $startWith == '/*' || $startWith == '//') {
                continue;
            }
                
            $query = $query . $line;
            if ($endWith == ';') {
                $query = mysqli_query($conexion, $query) or die(mysqli_error($conexion));
                $query= '';             
            }
        }
        $conexion = null;
    }
    $conexion = null;
