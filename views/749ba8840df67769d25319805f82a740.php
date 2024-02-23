<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Delivery Chongoyape - Gestion Residentes</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<!-- Agregar esta sección al inicio del formulario -->
<?php if(session('error')): ?>
    <div class="alert alert-danger">
        <?php echo e(session('error')); ?>

    </div>
<?php endif; ?>






<body>
  <div class="container">
    <h4>Nuevo Registro </h4>
    <div class="row">
      <div class="col-xl-12">
        <form action="<?php echo e(route('residentes.store')); ?>" method="post">
          <?php echo csrf_field(); ?>


          <div class="form-group">
            <label for="apellidos">Apellidos</label>
            <input type="text" class="form-control" name="apellidos" required maxlength="60">

          </div>
           <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control" name="nombre" required maxlength="50">
          </div>
          <div class="form-group">
            <label for="domicilio">Domicilio</label>
            <input type="text" class="form-control" name="domicilio" required maxlength="150">
          </div>
          <div class="form-group">
            <label for="fecha_de_pago">Fecha_de_pago</label>
            <input type="date" class="form-control" name="fecha_de_pago" required maxlength="30">
          </div>
          <div class="form-group">
            <label for="concepto">Concepto</label>
            <input type="text" class="form-control" name="concepto" required maxlength="50">
          </div>

          <div class="form-group">

            <label for="tipo_pago">Tipo de Pago</label>
            <select class="form-control" name="tipo_pago" required>
              <option value="mensual">Mensual</option>
              <option value="bimestral">Bimestral</option>
              <option value="anual">Anual</option>
              <!-- Agrega más opciones según tus necesidades -->
            </select>
          </div>

          <div class="form-group">
    <label for="cantidad_pagar">Cantidad a Pagar</label>
    <div class="input-group">
        <span class="input-group-text">$</span>
        <input type="number" class="form-control" name="cantidad_pagar" required maxlength="50" placeholder="0.00"> <!-- Agrega el valor predeterminado con el símbolo de pesos -->
    </div>
</div>

          <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Guardar">



            <input type="reset" class="btn btn-default" value="Cancelar">
            <a href="javascript:history.back()">Ir al listado</a>

          </div>
        </form>
    </div>
    </div>

<!-- Agrega este script al final del cuerpo antes de cerrar la etiqueta </body> -->
<script>
        function imprimirFormato() {
            window.print();
        }
    </script>

</body>
</html>
<?php /**PATH C:\xampp\htdocs\loginmoderno17\resources\views/residentes/create.blade.php ENDPATH**/ ?>