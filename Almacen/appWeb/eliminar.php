<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener el ID del producto desde el formulario
    $producto_id = $_POST["producto_id"];

    // URL de la solicitud DELETE
    $url = 'http://192.168.100.2:3000/productos/' . $producto_id;

    // Inicializar cURL
    $ch = curl_init();

    // Configurar opciones de cURL para una solicitud DELETE
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Ejecutar la solicitud DELETE
    $response = curl_exec($ch);

    // Verificar el código de respuesta HTTP
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    // Manejar la respuesta
    if ($response===false){
        header("Location:index.html");
    }
    // Cerrar la conexión cURL
    curl_close($ch);
    echo "El producto ha sido eliminado";
    //header("Location:index.php");
}
?>