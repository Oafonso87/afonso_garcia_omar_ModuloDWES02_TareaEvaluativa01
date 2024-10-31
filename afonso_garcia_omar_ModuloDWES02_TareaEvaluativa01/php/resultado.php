<?php
require('procesar_datos.php');
require_once('datos.php');

// Verificar si existen errores en `$resultados`
if (!empty($resultados['errores'])) {
    // Mostrar HTML con errores
    ?>
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="refresh" content="10;url=../index.php">
        <title>Errores en la Reserva</title>
        <link rel="stylesheet" href="../css/estilos.css">
    </head>
    <body>
        <div class="contenedor-result">
            <h1>Errores en la Reserva</h1>
            <ul>
                <?php foreach ($resultados['validos'] as $valido): ?>
                    <li class="valido"><?= htmlspecialchars(ucfirst(strtolower($valido))) ?></li>
                <?php endforeach; ?>
                <?php foreach ($resultados['errores'] as $error): ?>
                    <li class="error"><?= htmlspecialchars($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </body>
    </html>
    <?php
    exit;
}

// Si no hay errores se ejecuta esta parte donde se confirma la reserva
$nombre = ucfirst(strtolower($resultados['validos']['nombre']));
$apellido = ucfirst(strtolower($resultados['validos']['apellido']));
$modelo = $resultados['validos']['modelo'];
$imagenCoche = $resultados['imagen']['modelo'] ?? 'imagen_default.jpg';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Confirmación Reserva</title>
    <link rel="stylesheet" href="../css/estilos.css">
</head>
<body>
    <div class="contenedor-result">
        <h1>Reserva Confirmada</h1>
        <p><strong>Nombre: </strong><?= htmlspecialchars($nombre) ?></p>
        <p><strong>Apellido: </strong><?= htmlspecialchars($apellido) ?></p>
        <p><strong>Modelo del Vehículo: </strong><?= htmlspecialchars($modelo) ?></p>
        <div class="imagen-coche">
            <img src="<?= htmlspecialchars($imagenCoche) ?>" alt="Imagen de <?= htmlspecialchars($modelo) ?>">
        </div>
    </div>
</body>
</html>