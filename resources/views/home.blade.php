@extends('adminlte::page')

@section('content_header')
<div class="container">
    <div class="jumbotron text-center">
        <h1>Gestión de Residentes</h1>
        <p>Bienvenido al sistema de gestión de residentes. Encuentra la información que necesitas de manera rápida y sencilla.</p>
    </div>

    <div class="row">
        <div class="col-md-6 mx-auto">
            <!-- Formulario de búsqueda -->
            <form action="{{ route('home') }}" method="get" class="search-form">
                @csrf
                <div class="form-group">
                    <label for="texto">Buscar por Id Resident o Apellidos</label>
                    <input type="texto" class="form-control" name="texto" value="{{ $texto }}">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Buscar</button>
                    <a href="{{ route('residentes.create') }}" class="btn btn-success">Nuevo Residente</a>
                    <a href="{{ route('residentes.pdf') }}" class="btn btn-success" target="_blank">Generar PDF</a>
    <a href="{{ route('login') }}" class="btn btn-primary">Iniciar Sesión</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Mostrar información del residente si está seteada -->
    @if(isset($residentes) && count($residentes) > 0)
        <div class="row mt-4">
            <div class="col-md-8 mx-auto">
               
                <div class="table-container">
                    <h2>Información del Residente</h2>
                    <!-- Presentación organizada con una tabla -->
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID_Resident</th>
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
                                <td>{{ $residentes[0]->id_resident }}</td>
                                <td>{{ $residentes[0]->apellidos }}</td>
                                <td>{{ $residentes[0]->nombre }}</td>
                                <td>{{ $residentes[0]->domicilio }}</td>
                                <td>{{ date('d/m/Y', strtotime($residentes[0]->fecha_de_pago)) }}</td>
                                <td>{{ $residentes[0]->concepto }}</td>
                                <td>{{ $residentes[0]->tipo_pago }}</td>
                                <td>{{ $residentes[0]->cantidad_pagar }}</td>
                                <td>
                                    <!-- Botón de editar -->
                                    <a href="{{ route('residentes.edit', $residentes[0]->id_resident) }}" class="btn btn-primary">Editar</a>

                                    <!-- Botón de eliminar (puedes utilizar un formulario para mayor seguridad) -->
                                    <!-- Botón de eliminar con mensaje de confirmación -->
                                    <form id="deleteForm" action="{{ route('residentes.destroy', $residentes[0]->id_resident) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger" onclick="confirmarEliminar()">Eliminar</button>
                                    </form>

                                    @if(isset($residentes[0]->historialPagos) && count($residentes[0]->historialPagos) > 0)
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
                                                @foreach ($residentes[0]->historialPagos as $pago)
                                                    <tr>
                                                        <td>{{ $pago->fecha_pago }}</td>
                                                        <td>{{ $pago->concepto }}</td>
                                                        <td>{{ $pago->tipo_pago }}</td>
                                                        <td>{{ $pago->cantidad_pagar }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @else
        <p>No se encontraron residentes.</p>
    @endif
</div>
@stop

@section('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
@stop

@section('js')
<script src="https://code.jquery.com/jquery-3.6.4.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
<script>
    function confirmarEliminar() {
        // Mostrar un cuadro de diálogo de confirmación
        if (confirm('¿Estás seguro de que deseas eliminar este residente?')) {
            // Si el usuario hace clic en "Aceptar", enviar el formulario
            document.getElementById('deleteForm').submit();
        }
    }
</script>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <p class="mb-0">You are logged in!</p>
                </div>
            </div>
        </div>
    </div>
@stop
