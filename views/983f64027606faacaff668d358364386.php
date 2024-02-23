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

        /* ... Otros estilos de impresión ... */
    </style>
</head>
<body>
    <h2>Información del Residente</h2>

    <table>
        <tr>
            <th>ID_Resident</th>
            <td><?php echo e($residente->id_resident); ?></td>
        </tr>
        <tr>
            <th>Apellidos</th>
            <td><?php echo e($residente->apellidos); ?></td>
        </tr>
        <tr>
            <th>Nombre</th>
            <td><?php echo e($residente->nombre); ?></td>
        </tr>
        <tr>
            <th>Domicilio</th>
            <td><?php echo e($residente->domicilio); ?></td>
        </tr>
        <tr>
            <th>Fecha de Pago</th>
            <td><?php echo e($residente->fecha_de_pago); ?></td>
        </tr>
        <tr>
            <th>Concepto</th>
            <td><?php echo e($residente->concepto); ?></td>
        </tr>
        <tr>
            <th>Tipo Pago</th>
            <td><?php echo e($residente->tipo_pago); ?></td>
        </tr>
        <tr>
            <th>Cantidad a Pagar</th>
            <td><?php echo e($residente->cantidad_pagar); ?></td>
        </tr>
    </table>
    <a href="javascript:history.back()">Ir al listado</a>
    <a href="<?php echo e(route('pdf.generar')); ?>" target="_blank">Imprimir PDF en la PC</a>


    <!-- Agrega cualquier otro contenido que desees imprimir -->

    <script>
        // Puedes agregar scripts específicos para la impresión si es necesario
    </script>
</body>
</html>

<?php /**PATH C:\xampp\htdocs\loginmoderno14\resources\views/residentes/imprimir.blade.php ENDPATH**/ ?>