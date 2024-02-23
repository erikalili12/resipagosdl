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
                <form action="<?php echo e(route('vigilante.search1')); ?>" method="get" class="search-form">

                    <?php echo csrf_field(); ?>

                    <div class="form-group">
                        <label for="texto">Buscar por Id Resident:</label>
                        <input type="text" class="form-control" name="id_resident" required>
                        
                    </div>

                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Buscar">
                        <a href="javascript:history.back()" class="btn btn-secondary">Volver</a>
                    </div>
                </form>
            </div>
        </div>

        <?php if(isset($residente)): ?>
        <h2>Detalles del Residente</h2>
        <p>ID Residente: <?php echo e($residente->id_resident); ?></p>
        <p>Apellidos: <?php echo e($residente->apellidos); ?></p>
        <p>Nombre: <?php echo e($residente->nombre); ?></p>
        <p>Domicilio: <?php echo e($residente->domicilio); ?></p>
        <p>Fecha de pago: <?php echo e($residente->fecha_de_pago); ?></p>
        <p>Concepto: <?php echo e($residente->concepto); ?></p>
        <p>Tipo de Pago: <?php echo e($residente->tipo_pago); ?></p>
        <p>Cantidad a Pagar: <?php echo e($residente->cantidad_pagar); ?></p>
        <!-- Agrega más detalles según tus necesidades -->
    <?php else: ?>
        <p>No se encontró ningún residente con ese ID.</p>
    <?php endif; ?>
    

    </div>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\loginmoderno17\resources\views/vigilante/search1.blade.php ENDPATH**/ ?>