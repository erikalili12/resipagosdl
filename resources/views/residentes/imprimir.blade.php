<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Imprimir Residente</title>
    <!-- Agrega cualquier estilo específico para la impresión -->
    <style>
        /* Estilos para la impresión */
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }

        h2 {
            text-align: center;
            color: #007bff;
        }

        /* Estilos para los botones */
        .btn-container {
            text-align: center;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            text-align: center;
            text-decoration: none;
            border-radius: 5px;
            font-size: 18px;
            margin-right: 10px;
            margin-bottom: 10px;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        /* ... Otros estilos de impresión ... */
    </style>
</head>
<body>
    <h2>Información del Residente</h2>

    <table>
        <tr>
            <th>ID_Resident</th>
            <td>{{ $residente->id_resident }}</td>
        </tr>
        <tr>
            <th>Apellidos</th>
            <td>{{ $residente->apellidos }}</td>
        </tr>
        <tr>
            <th>Nombre</th>
            <td>{{ $residente->nombre }}</td>
        </tr>
        <tr>
            <th>Domicilio</th>
            <td>{{ $residente->domicilio }}</td>
        </tr>
        <tr>
            <th>Fecha de Pago</th>
            <td>{{ $residente->fecha_de_pago }}</td>
        </tr>
        <tr>
            <th>Concepto</th>
            <td>{{ $residente->concepto }}</td>
        </tr>
        <tr>
            <th>Tipo Pago</th>
            <td>{{ $residente->tipo_pago }}</td>
        </tr>
        <tr>
            <th>Cantidad a Pagar</th>
            <td>{{ $residente->cantidad_pagar }}</td>
        </tr>
    </table>
    
    <div class="btn-container">
        <a href="javascript:history.back()" class="btn">Ir al listado</a>
        <a href="{{ route('generarPDF', ['id_resident' => $residente->id_resident]) }}" class="btn">Generar PDF</a>
    </div>

    <!-- Agrega cualquier otro contenido que desees imprimir -->

    <script>
        // Puedes agregar scripts específicos para la impresión si es necesario
    </script>
</body>
</html>
