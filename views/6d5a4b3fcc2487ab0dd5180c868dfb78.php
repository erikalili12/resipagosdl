<!DOCTYPE html>
<html lang="en">

<head>
    <title>Residentes</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

    <style>
        body {
            background-color: #f8f9fa;
        }

        .header {
            background-color: #343a40;
            color: #ffffff;
            padding: 20px 0;
            text-align: center;
        }

        h1 {
            color: brown;
        }

        .table-container {
            margin-top: 30px;
            text-align: center;
        }

        table {
            width: 90%;
            border-collapse: collapse;
            margin: auto;
            margin-top: 10px;
        }

        th, td {
            border: 1px solid #dee2e6;
            padding: 2px;
            text-align: center;
        }

        th {
            background-color: #343a40;
            color: #ffffff;
            font-weight: bold;
        }
    </style>
</head>

<body>

    <div class="header">
        <img src="assets/67.jpg" alt="" width="50px" height="50px">
        <h1>RESIDENTES</h1>
    </div>

    <div class="container table-container">
        <table class="table table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Apellidos</th>
                    <th>Nombre</th>
                    <th>Domicilio</th>
                    <th>Fecha de Pago</th>
                    <th>Concepto</th>
                    <th>Tipo de Pago</th>
                    <th>Cantidad a Pagar</th>
                </tr>
            </thead>
            <tbody>
                <?php if(count($residentes) <= 0): ?>
                <tr>
                    <td colspan="8" class="text-center">No hay resultados</td>
                </tr>
                <?php else: ?>
                <?php $__currentLoopData = $residentes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $resident): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td class="text-center"><?php echo e($resident->id_resident); ?></td>
                    <td class="text-center"><?php echo e($resident->apellidos); ?></td>
                    <td class="text-center"><?php echo e($resident->nombre); ?></td>
                    <td class="text-center"><?php echo e($resident->domicilio); ?></td>
                    <td class="text-center"><?php echo e($resident->fecha_de_pago); ?></td>
                    <td class="text-center"><?php echo e($resident->concepto); ?></td>
                    <td class="text-center"><?php echo e($resident->tipo_pago); ?></td>
                    <td class="text-center"><?php echo e($resident->cantidad_pagar); ?></td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3"
        crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
        integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz"
        crossorigin="anonymous"></script>
</body>

</html>

<?php /**PATH C:\xampp\htdocs\loginmoderno14\resources\views/residentes/pdf.blade.php ENDPATH**/ ?>