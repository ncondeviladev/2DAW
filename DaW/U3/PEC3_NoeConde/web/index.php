<?php
//Los parámetros que aparecen dentro de getenv son las variables de entorno
$servername = getenv('MYSQL_HOST');
$username = getenv('MYSQL_USER');
$password = getenv('MYSQL_PASSWORD');
$dbname = getenv('MYSQL_DATABASE');
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("<h2 style='color:red;'>Conexión fallida: " . $conn->connect_error .
        "</h2>");
}
echo "<h2 style='color:green;'>Conexión exitosa a la base de datos '$dbname'
en el host '$servername'</h2>";
$conn->close();
?>