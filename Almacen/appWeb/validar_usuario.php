<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener el correo electrónico y la contraseña del formulario POST
    $email = $_POST["email"];
    $password = $_POST["password"];

    // URL de la solicitud GET para obtener la lista de usuarios desde la API
    $url = 'http://192.168.100.2:3000/usuarios/';

    // Inicializar cURL
    $ch = curl_init();

    // Configurar opciones de cURL
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Ejecutar la solicitud GET
    $response = curl_exec($ch);

    // Verificar el código de respuesta HTTP
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    // Cerrar la conexión cURL
    curl_close($ch);

    // Manejar la respuesta de la API
    if ($http_code === 200) {
        // Decodificar la respuesta JSON
        $usuarios = json_decode($response, true);

        // Realizar la validación del usuario
        $usuarioValido = false;
        foreach ($usuarios as $usuario) {
            if ($usuario['email'] === $email && $usuario['password'] === $password) {
                $usuarioValido = true;
                break;
            }
        }

        if ($usuarioValido) {
            // Usuario válido, redirigir a index.html
            header("Location: index.html");
            exit; // Asegura que el script se detenga después de redirigir
        } else {
            // Usuario inválido, muestra un mensaje
            echo "Usuario inválido";
        }
    } else {
        echo "Error al obtener la lista de usuarios. Código de respuesta HTTP: " . $http_code;
    }
}
?>