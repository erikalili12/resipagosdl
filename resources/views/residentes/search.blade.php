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
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <div class="row">
            <div class="col-xl-12">
                <form action="{{ route('residentes.search') }}" method="get" class="search-form">

                    @csrf

                    <div class="form-group">
                        <label for="texto">Buscar por Id Resident o Apellidos </label>
                        <input type="text" class="form-control" name="texto" value="{{ $texto }}">
                    </div>

                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Buscar">
                        <a href="{{ route('residentes.create') }}" class="btn btn-success">Nuevo</a>
                        <a href="{{ route('residentes.pdf') }}" class="btn btn-success" target="_blank">PDF</a>
                        <a href="javascript:history.back()" class="btn btn-secondary">Volver</a>
                    </div>
                </form>
            </div>
        </div>

        @if(isset($residentes) && count($residentes) > 0)
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
                        @foreach ($residentes as $residente)
                            <tr>
                                <td>{{ $residente->id_resident }}</td>
                                <td>{{ $residente->apellidos }}</td>
                                <td>{{ $residente->nombre }}</td>
                                <td>{{ $residente->domicilio }}</td>
                                <!-- Agrega más columnas según los campos que desees mostrar -->
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p>No se encontraron resultados.</p>
        @endif
    </div>

    <!-- Add the script for printing at the end -->
    <script>
        function imprimirFormato() {
            window.print();
        }
    </script>
</body>
</html>
