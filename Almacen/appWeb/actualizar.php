<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Obtener los datos del formulario
    $producto_id = $_POST["producto_id"];
    $nuevo_nombre = $_POST["nuevo_nombre"];
    $nueva_descripcion = $_POST["nueva_descripcion"];
    $nuevo_precio = $_POST["nuevo_precio"];

    // Construir los datos a enviar en la solicitud PUT (en formato JSON)
    $datos_actualizados = json_encode([
        "nombre" => $nuevo_nombre,
        "descripcion" => $nueva_descripcion,
        "precio" => $nuevo_precio
    ]);

    // URL de la solicitud PUT
    $url = 'http://192.168.100.2:3000/productos/' . $producto_id;

    // Inicializar cURL
    $ch = curl_init();

    // Configurar opciones de cURL para una solicitud PUT
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
    curl_setopt($ch, CURLOPT_POSTFIELDS, $datos_actualizados);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Content-Length: ' . strlen($datos_actualizados)
    ));

    // Ejecutar la solicitud PUT
    $response = curl_exec($ch);

    // Verificar el código de respuesta HTTP
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);


   // Manejar la respuesta
    if ($response===false){
        header("Location:index.html");
    }
    
    // Cerrar la conexión cURL
    curl_close($ch);
    echo "El producto ha sido actualizado";
    //header("Location:index.php");
}
?>