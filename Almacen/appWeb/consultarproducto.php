<?php
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["producto_id"])) {
    // Obtener el ID del producto desde la consulta GET
    $producto_id = $_GET["producto_id"];

    // URL de la solicitud GET para consultar el producto por ID
    $url = 'http://192.168.100.2:3000/productos/' . $producto_id;

    // Inicializar cURL
    $ch = curl_init();

    // Configurar opciones de cURL
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Ejecutar la solicitud GET
    $response = curl_exec($ch);

    // Verificar el código de respuesta HTTP
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    
   // Manejar la respuesta
   if ($response === false) {
    header("Location: index.html");
   } else {
        // Decodificar la respuesta JSON
        $producto = json_decode($response, true);

        // Verificar si el producto se encontró
        if (isset($producto['id'])) {
            // Mostrar los detalles del producto
            echo "<h2>Detalles del Producto:</h2>";
            echo "<b>ID:</b> " . $producto['id'] . "<br>";
            echo "<b>Nombre:</b> " . $producto['nombre'] . "<br>";
            echo "<b>Descripción:</b> " . $producto['descripcion'] . "<br>";
            echo "<b>Precio:</b> " . $producto['precio'] . "<br>";
        } else {
            // Producto no encontrado
            echo "Producto no encontrado";
        }
    }


    
    // Cerrar la conexión cURL
    curl_close($ch);

}
?>