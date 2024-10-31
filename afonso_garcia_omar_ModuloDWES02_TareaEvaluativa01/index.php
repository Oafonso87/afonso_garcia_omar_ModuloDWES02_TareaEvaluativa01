<!DOCTYPE html>
<html lang="es">
<head>
    <meta  charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Reserva de Vehículo</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>

<body>
    <div class="contenedor">
        <h1>Formulario de Reserva de Vehículo</h1>
        <form id="formulario" action="php/resultado.php" method="POST">
            <div>
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre">
            </div>

            <div>
                <label for="apellido">Apellido:</label>
                <input type="text" id="apellido" name="apellido">
            </div>

            <div>
                <label for="dni">DNI:</label>
                <input type="text" id="dni" name="dni">
            </div>

            <div>
                <label for="modelo">Modelo del Vehículo:</label>
                <select id="modelo" name="modelo">
                    <option value="Lancia Stratos">Lancia Stratos</option>
                    <option value="Audi Quattro">Audi Quattro</option>
                    <option value="Ford Escort RS1800">Ford Escort RS1800</option>
                    <option value="Subaru Impreza 555">Subaru Impreza 555</option>
                </select>
            </div>

            <div>
                <label for="fechaInicio">Fecha de Inicio de la Reserva:</label>
                <input type="date" id="fechaInicio" name="fechaInicio">
            </div>

            <div>
                <label for="duracion">Duración de la Reserva (en días):</label>
                <input type="number" id="duracion" name="duracion">
            </div>

            <button type="submit">Reservar</button>
        </form>
    </div>
</body>
</html>