<?php
    // URL de la solicitud GET
    $url = 'http://192.168.100.2:3000/productos';

    // Inicializar cURL
    $ch = curl_init();

    // Configurar opciones de cURL
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Ejecutar la solicitud GET
    $response = curl_exec($ch);

    // Manejar la respuesta
    if ($response === false) {
        header("Location: index.html");
    } else {
        // Decodificar la respuesta JSON (si la API devuelve JSON)
        $data = json_decode($response, true);

        // Aquí puedes procesar y mostrar los datos de $data como desees
        echo "<h2> Lista de productos:</h2>";
        if (is_array($data)) {
            foreach ($data as $producto) {
                echo " <b> ID: </b>" . $producto['id'] . "<br>";
                echo " <b> Nombre: </b>" . $producto['nombre'] . "<br>";
                echo "<b> Descripción: </b>" . $producto['descripcion'] . "<br>";
                echo "<b> Precio: </b>" . $producto['precio'] . "<br>";
                echo "<br>";
            }
        }
        
    }

    // Cerrar la conexión cURL
    curl_close($ch);
?>