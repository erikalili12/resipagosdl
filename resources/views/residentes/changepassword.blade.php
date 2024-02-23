<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cambiar Contraseña</title>
</head>
<body>
    <form action="{{ route('change-password') }}" method="POST">
        @csrf
        <label for="current_password">Contraseña actual:</label>
        <input type="password" id="current_password" name="current_password" required>
        <label for="new_password">Nueva contraseña:</label>
        <input type="password" id="new_password" name="new_password" required>
        <label for="new_password_confirmation">Confirmar nueva contraseña:</label>
        <input type="password" id="new_password_confirmation" name="new_password_confirmation" required>
        <button type="submit">Cambiar contraseña</button>
    </form>
</body>
</html>
