<?php
// Incluir el archivo de conexión a la base de datos
include 'conexion.php';
function rutExistsInDatabase($conexion, $rut)
{
    $sql_verificar_rut = "SELECT rut FROM formulario_datos WHERE rut = ?";
    $stmt_verificar_rut = mysqli_prepare($conexion, $sql_verificar_rut);
    mysqli_stmt_bind_param($stmt_verificar_rut, "s", $rut);
    mysqli_stmt_execute($stmt_verificar_rut);
    mysqli_stmt_store_result($stmt_verificar_rut);
    return mysqli_stmt_num_rows($stmt_verificar_rut) > 0;
}

// Definir la función insertarDatosCarga()
function insertarDatosCarga()
{
    // Obtener la conexión a la base de datos
    $conexion = conectar();

    // Obtener los datos del formulario
    $nombre = $_POST['nombreApellido'];
    $alias = $_POST['alias'];
    $rut = $_POST['rutid'];
    $email = $_POST['email'];
    $region = $_POST['region'];
    $comuna = $_POST['comuna'];
    $candidatos = $_POST['candidatos'];

    // Escapar los datos para evitar inyección SQL
    $nombre = mysqli_real_escape_string($conexion, $nombre);
    $alias = mysqli_real_escape_string($conexion, $alias);
    $rut = mysqli_real_escape_string($conexion, $rut);
    $email = mysqli_real_escape_string($conexion, $email);
    $region = mysqli_real_escape_string($conexion, $region);
    $comuna = mysqli_real_escape_string($conexion, $comuna);
    $candidatos = mysqli_real_escape_string($conexion, $candidatos);

   // Verificar si el RUT ya existe en la base de datos
   if (rutExistsInDatabase($conexion, $rut)) {
    return "El RUT ya está registrado en la base de datos.";
}

    // Procesar checkboxes
    $fuentes = isset($_POST['fuentes']) ? $_POST['fuentes'] : [];
    $fuentes = implode(", ", $fuentes);
    $fuentes = mysqli_real_escape_string($conexion, $fuentes);

    // Consulta SQL para insertar los datos en la tabla
    $sql = "INSERT INTO formulario_datos (nombre_apellido, alias, rut, email, region_id, comuna_id, candidato_id, Como) 
            VALUES ('$nombre', '$alias', '$rut', '$email', '$region', '$comuna', '$candidatos', '$fuentes')";

    // Ejecutar la consulta
    $result = mysqli_query($conexion, $sql);

    // Cerrar la conexión a la base de datos
    mysqli_close($conexion);

    // Retornar el resultado de la inserción (true o false)
    return $result;
}


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $result = insertarDatosCarga();
    if (is_string($result)) {
        // El resultado es una cadena, lo que significa que hay un mensaje de error
        echo '<script>alert("' . $result . '"); window.location.href = "index.php";</script>';
    } else {
        header("Location: index.php"); // Redirigir a otra página después de la inserción exitosa
        exit();
    }
}