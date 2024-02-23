<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Delivery Chongoyape - Búsqueda de Residentes</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <h4>Búsqueda de Residentes</h4>

        <!-- Display validation error messages -->
        <?php if(session('error')): ?>
            <div class="alert alert-danger">
                <?php echo e(session('error')); ?>

            </div>
        <?php endif; ?>

        <div class="row">
            <div class="col-xl-12">
                <form action="<?php echo e(route('residentes.search')); ?>" method="get" class="search-form">

                    <?php echo csrf_field(); ?>

                    <div class="form-group">
                        <label for="texto">Buscar por Id Resident o Apellidos </label>
                        <input type="text" class="form-control" name="texto" value="<?php echo e($texto); ?>">
                    </div>

                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Buscar">
                        <a href="<?php echo e(route('residentes.create')); ?>" class="btn btn-success">Nuevo</a>
                        <a href="<?php echo e(route('residentes.pdf')); ?>" class="btn btn-success" target="_blank">PDF</a>
                        <a href="javascript:history.back()" class="btn btn-secondary">Volver</a>
                    </div>
                </form>
            </div>
        </div>

        <?php if(isset($residentes) && count($residentes) > 0): ?>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>id_resident</th>
                            <th>Apellidos</th>
                            <th>Nombre</th>
                            <th>Domicilio</th>
                            <!-- Agrega más encabezados según los campos que desees mostrar -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $residentes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $residente): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($residente->id_resident); ?></td>
                                <td><?php echo e($residente->apellidos); ?></td>
                                <td><?php echo e($residente->nombre); ?></td>
                                <td><?php echo e($residente->domicilio); ?></td>
                                <!-- Agrega más columnas según los campos que desees mostrar -->
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <p>No se encontraron resultados.</p>
        <?php endif; ?>
    </div>

    <!-- Add the script for printing at the end -->
    <script>
        function imprimirFormato() {
            window.print();
        }
    </script>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\loginmoderno14\resources\views/residentes/search.blade.php ENDPATH**/ ?>