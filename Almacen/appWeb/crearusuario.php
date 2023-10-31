<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["nombre"]) && isset($_POST["email"]) && isset($_POST["password"])) {
    // Obtener los datos del formulario
    $nombre = $_POST["nombre"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Construir los datos a enviar en la solicitud POST (en formato JSON)
    $datos_usuario = json_encode([
        "name" => $nombre,
        "email" => $email,
        "password" => $password
    ]);

    // URL de la solicitud POST a tu API
    $url = 'http://192.168.100.2:3000/usuarios';

    // Inicializar cURL
    $ch = curl_init();

    // Configurar opciones de cURL para una solicitud POST
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $datos_usuario);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Content-Length: ' . strlen($datos_usuario)
    ));

    // Ejecutar la solicitud POST
    $response = curl_exec($ch);

    // Verificar el código de respuesta HTTP
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    // Cerrar la conexión cURL
    curl_close($ch);

    // Manejar la respuesta
    if ($http_code === 200) {
        echo "Usuario registrado exitosamente.";
    } else {
        echo "Error al registrar el usuario. Código de respuesta HTTP: " . $http_code;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Crear Usuario</title>
</head>
<body>
    <h2>Crear Usuario</h2>
    <form action="crearusuario.php" method="POST">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required>
        <br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <br>
        <button type="submit">Registrar Usuario</button>
    </form>
</body>
</html>