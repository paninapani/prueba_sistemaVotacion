<?php

require_once('conexion.php');

$listaRegion = obtenerRegion();
$listaCandidato = obtenerCandidato();


    
    if ($listaCandidato != '') //si la variable tiene al menos 1 fila entonces seguimos con el codigo
{
    $candidatos="";
    while ($rowCandidato = mysqli_fetch_assoc($listaCandidato)) 
    {
        $candidatos .=" <option value='".$rowCandidato['id_candidato']."'>".$rowCandidato['nombre']."</option>"; //concatenamos el los options para luego ser insertado en el HTML
    }
}

   
    if ($listaRegion != '') //si la variable tiene al menos 1 fila entonces seguimos con el codigo
{
    $regiones="";
    while ($rowRegiones = mysqli_fetch_assoc($listaRegion)) 
    {
        $regiones .=" <option value='".$rowRegiones['id_region']."'>".$rowRegiones['nombre_region']."</option>"; //concatenamos el los options para luego ser insertado en el HTML
    }
}








?>