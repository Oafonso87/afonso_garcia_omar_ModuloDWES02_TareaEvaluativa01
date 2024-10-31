<?php
// Cargar los datos de vehículos y usuarios
require('datos.php');  

// Inicializar array multidimensional para almacenar errores y valores válidos
$resultados = [
    'errores' => [],
    'validos' => [],
    'imagen' => []
];

// Función para validar nombre y apellido
function validarNombreApellido($nombre, $apellido, &$resultados) {
    if (empty($nombre)) {
        $resultados['errores']['nombre'] = "El nombre es obligatorio.";
    } else {
        $resultados['validos']['nombre'] = $nombre;
    }

    if (empty($apellido)) {
        $resultados['errores']['apellido'] = "El apellido es obligatorio.";
    } else {
        $resultados['validos']['apellido'] = $apellido;
    }
}

// Función para validar el DNI
function validarDNI($dni, &$resultados) {
    $letras = "TRWAGMYFPDXBNJZSQVHLCKE";
    $numero = substr($dni, 0, -1);
    $letra = strtoupper(substr($dni, -1));

    if (strlen($numero) == 8 && ctype_digit($numero)) {
        $indice = $numero % 23;
        $letra_correcta = $letras[$indice];
        if ($letra_correcta == $letra) {
            $resultados['validos']['dni'] = $dni;
        } else {
            $resultados['errores']['dni'] = "La letra del DNI no es correcta.";
        }
    } else {
        $resultados['errores']['dni'] = "El formato del DNI no es válido.";
    }
}

// Función para validar la existencia del usuario en datos.php
function validarUsuario($nombre, $apellido, $dni, &$resultados) {
    foreach (USUARIOS as $usuario) {
        if (
            strtolower($usuario['nombre']) === strtolower($nombre) &&
            strtolower($usuario['apellido']) === strtolower($apellido) &&
            strtoupper($usuario['dni']) === strtoupper($dni)
        ) {
            $resultados['validos']['usuario'] = "Usuario verificado.";
            return;
        }
    }
    $resultados['errores']['usuario'] = "El usuario no existe o los datos no coinciden.";
}

// Función para verificar la disponibilidad del modelo
function verificarDisponibilidad($modelo, $fecha, &$resultados) {
    global $coches;   

    foreach ($coches as $coche) {
        if ($coche['modelo'] === $modelo) {
            if ($coche['disponible']) {                
                $resultados['validos']['modelo'] = $modelo; 
                $resultados['imagen']['modelo'] = $coche['imagen'];               
            } else {                
                if ($fecha > $coche['fecha_fin']) {                    
                    $resultados['validos']['modelo'] = $modelo;
                    $resultados['imagen']['modelo'] = $coche['imagen'];
                } else {                    
                    $resultados['errores']['modelo'] = "El modelo seleccionado no existe.";
                }
            }
        }
    }    
}

// Función para validar la fecha de inicio de reserva
function validarFecha($fecha, &$resultados) {
    $fechaActual = date('Y-m-d');
    if ($fecha > $fechaActual) {
        $resultados['validos']['fechaInicio'] = $fecha;
    } else {
        $resultados['errores']['fechaInicio'] = "La fecha debe ser posterior a la fecha actual.";
    }
}

// Función para validar la duración de la reserva
function validarDuracion($duracion, &$resultados) {
    if ($duracion >= 1 && $duracion <= 30) {
        $resultados['validos']['duracion'] = $duracion;
    } else {
        $resultados['errores']['duracion'] = "La duración debe ser entre 1 y 30 días.";
    }
}

// Capturar los datos del formulario
$nombre = trim($_POST['nombre']);
$apellido = trim($_POST['apellido']);
$dni = strtoupper(trim($_POST['dni']));
$modelo = $_POST['modelo'];
$fecha = $_POST['fechaInicio'];
$duracion = (int)$_POST['duracion'];

// Ejecutar las validaciones
validarNombreApellido($nombre, $apellido, $resultados);
validarDNI($dni, $resultados);
validarUsuario($nombre, $apellido, $dni, $resultados);
verificarDisponibilidad($modelo, $fecha, $resultados);
validarFecha($fecha, $resultados);
validarDuracion($duracion, $resultados);

?>