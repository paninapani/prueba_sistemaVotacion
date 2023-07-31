<?php

function conectar()
{	
	$servername = "localhost"; // Dirección del servidor MySQL
    $username = "root"; // Nombre de usuario de MySQL
    $password = ""; // Contraseña de MySQL
    $dbname = "prueba"; // Nombre de la base de datos
	
	// Variable que guarda la conexión a la BD
	$conexion = mysqli_connect($servername, $username, $password, $dbname);
	
	// Utilizamos esta función para transformar la salida a LATINO
	$conexion->set_charset('utf8');	

	// Comprobamos si la conexión fue exitosa
	if (!$conexion) {
		echo 'Ha ocurrido un error inesperado en la conexión a la BD';
	}

	return $conexion;
}

function obtenerCandidato() {
	$conexion = conectar();
    $sql = "SELECT id_candidato, nombre FROM candidatos";
    $result = mysqli_query($conexion, $sql);
	return $result;
}


function obtenerRegion() {
	$conexion = conectar();
  	$sql = "SELECT id_region, nombre_region FROM regiones;"; 
  	$result = mysqli_query($conexion, $sql);
	return $result;
}

function obtenerCiudad($region_id) {
    $conexion = conectar();
    $sql = "SELECT id_comuna, nombre_comuna FROM comunas WHERE id_region = $region_id";  
    $result = mysqli_query($conexion, $sql);
    $ciudades = array();

    while ($rowCiudad = mysqli_fetch_assoc($result)) {
        $ciudades[] = $rowCiudad;
    }

    // Convertir el array de ciudades a formato JSON
    $ciudadesJSON = json_encode($ciudades);
    
    return $ciudadesJSON;
}


if (isset($_POST['tipo']) && isset($_POST['dato'])) {
    $tipo = $_POST['tipo'];
    $dato = $_POST['dato'];

    // Asegurarnos de que la función obtenerCiudad existe antes de usarla
    if (function_exists('obtenerCiudad')) {
        $ciudadesJSON = obtenerCiudad($dato);
        echo $ciudadesJSON;
    } 
} 



?>
