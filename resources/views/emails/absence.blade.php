<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nueva Ausencia Registrada</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 20px; }
        .container { max-width: 600px; background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); }
        h2 { color: #333; }
        .details { margin-top: 15px; padding: 10px; background: #eef; border-radius: 5px; }
        p { margin: 5px 0; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Notificación de Nueva Ausencia</h2>
        <p>Se ha registrado una nueva ausencia con los siguientes detalles:</p>

        <div class="details">
            <p><strong>Usuario:</strong> {{ $absenceData['user'] }}</p>
            <p><strong>Departamento:</strong> {{ $absenceData['department'] }}</p>
            <p><strong>Fecha:</strong> {{ $absenceData['date'] }}</p>
            <p><strong>Horario:</strong> {{ $absenceData['timeSlot'] }}</p>
            <p><strong>Comentarios:</strong> {{ $absenceData['comments'] }}</p>
        </div>

        <p>Por favor, revisa el sistema para más detalles.</p>
    </div>
</body>
</html>
