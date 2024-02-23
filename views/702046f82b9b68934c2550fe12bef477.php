<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Residentes</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        body {
            background-image: url("https://dulcelili.my.canva.site/resipagos");
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
            color: white;
            position: relative;
            margin: 0;
            padding: 0;
        }

        .marca-agua {
            position: absolute;
            top: 86%;
            left: 63%;
            transform: translate(-65%, -65%);
            font-size: 6rem;
            font-weight: bold;
            opacity: 0.3;
            pointer-events: none;
        }

        .jumbotron {
            background-color: rgba(0, 113, 255, 0.7);
            padding: 65px;
            margin-top: 70px;
            border-radius: 70px;
            position: relative;
            overflow: hidden; /* Añadir un overflow hidden para que la imagen no se salga del jumbotron */
        }

        .jumbotron h1 {
            font-size: 3rem;
        }

        .jumbotron img {
            position: absolute;
            bottom: -40px; /* Ajustar la posición de la imagen según sea necesario */
            right: -10px; /* Ajustar la posición de la imagen según sea necesario */
            max-width: 10%; /* Ajustar el tamaño máximo de la imagen */
            z-index: -5; /* Colocar la imagen detrás del contenido */
            opacity: 0.5; /* Ajustar la opacidad de la imagen si es necesario */
        }

        .search-form {
            background-color: rgba(255, 255, 255, 0.7);
            padding: 0px;
            border-radius: 2px;
            margin-top: 20px;
        }

        .search-form label {
            font-size: .6rem;
        }

        .search-form button {
            margin-top: 1px;
        }
    </style>
</head>
<body>
    <!-- Marca de agua -->
    <div class="marca-agua">RESIPAGOSDL</div>

    <div class="container">
        <div class="jumbotron text-center">
            <h1>Gestión de Residentes</h1>
            <p>Bienvenido al sistema de gestión de residentes. Encuentra la información que necesitas de manera rápida y sencilla.</p>
            <img src="fotos/dulce.gif" style="position: absolute; bottom: 0; right: 0; max-width: 150%; z-index: -1; opacity: 0.5;">
        </div>

        <div class="row">
            <div class="col-md-6 mx-auto">
                <!-- Formulario de búsqueda -->
                <form action="<?php echo e(route('residentes.index')); ?>" method="get" class="search-form">
                    <?php echo csrf_field(); ?>
                    <div class="form-group">
                        <label for="texto">Buscar por Id Resident o Apellidos</label>
                        <input type="text" class="form-control" name="texto" value="<?php echo e($texto); ?>">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Buscar</button>
                        <a href="<?php echo e(route('residentes.create')); ?>" class="btn btn-success">Nuevo Residente</a>
                        <a href="<?php echo e(route('residentes.pdf')); ?>" class="btn btn-success" target="_blank">Generar PDF</a>
                        <a href="<?php echo e(route('login')); ?>" class="btn btn-success">Cerrar Sesión</a>
                        
                    </div>
                </form>
            </div>
        </div>

        <!-- Mostrar información del residente si está seteada -->
        <?php if(isset($residentes) && count($residentes) > 0): ?>
            <!-- Resto del código para mostrar información del residente -->
            <div class="row mt-4">
                <div class="col-md-8 mx-auto">
                    <div class="table-container">
                        <h2>Información del Residente</h2>
                        <!-- Presentación organizada con una tabla -->
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID_Residente</th>
                                    <th>Apellidos</th>
                                    <th>Nombre</th>
                                    <th>Domicilio</th>
                                    <th>Fecha de Pago</th>
                                    <th>Concepto</th>
                                    <th>Tipo de Pago</th>
                                    <th>Cantidad a Pagar</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><?php echo e($residentes[0]->id_resident); ?></td>
                                    <td><?php echo e($residentes[0]->apellidos); ?></td>
                                    <td><?php echo e($residentes[0]->nombre); ?></td>
                                    <td><?php echo e($residentes[0]->domicilio); ?></td>
                                    <td><?php echo e(date('d/m/Y', strtotime($residentes[0]->fecha_de_pago))); ?></td>
                                    <td><?php echo e($residentes[0]->concepto); ?></td>
                                    <td><?php echo e($residentes[0]->tipo_pago); ?></td>
                                    <td><?php echo e($residentes[0]->cantidad_pagar); ?></td>
                                    <td>
                                        <!-- Botón de editar -->
                                        <a href="<?php echo e(route('residentes.edit', $residentes[0]->id_resident)); ?>" class="btn btn-primary">Editar</a>

                                        <!-- Botón de eliminar con mensaje de confirmación -->
                                        <form id="deleteForm" action="<?php echo e(route('residentes.destroy', $residentes[0]->id_resident)); ?>" method="POST" style="display: inline;">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="button" class="btn btn-danger" onclick="confirmarEliminar()">Eliminar</button>
                                        </form>

                                        <!-- Botón de imprimir residente -->
                                        <a href="<?php echo e(route('residentes.imprimir', $residentes[0]->id_resident)); ?>" class="btn btn-info">Imprimir Residente</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <?php if(isset($residentes[0]->historialPagos) && count($residentes[0]->historialPagos) > 0): ?>
                <div class="row mt-4">
                    <div class="col-md-8 mx-auto">
                        <h2>Historial de Pagos</h2>
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Fecha de Pago</th>
                                    <th>Concepto</th>
                                    <th>Tipo de Pago</th>
                                    <th>Cantidad a Pagar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $residentes[0]->historialPagos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pago): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($pago->fecha_pago); ?></td>
                                        <td><?php echo e($pago->concepto); ?></td>
                                        <td><?php echo e($pago->tipo_pago); ?></td>
                                        <td><?php echo e($pago->cantidad_pagar); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php endif; ?>

        <?php else: ?>
            <p>No se encontraron residentes.</p>
        <?php endif; ?>
    </div>
    <a href="<?php echo e(route('aviso.privacidad')); ?>">Aviso de Privacidad</a>
    <a href="<?php echo e(route('aviso.legal')); ?>">Aviso de legal</a>

    <script src="https://code.jquery.com/jquery-3.6.4.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\loginmoderno19\resources\views/residentes/index.blade.php ENDPATH**/ ?>