<?php include_once 'header.php'; ?>
<?php //require_once 'conexion.php'; 
require_once 'funciones.php';
?>


<form name="formulario" action="ingresaDatosForm.php" method="post" onsubmit="return validarFormulario()">

<div class="col-6">

<div class=" form-group row">
    <div class="col ">
    <label for="nombreApellido">Nombre y Apellido</label>
    </div>
    <div class="col ">
    <input type="text" id="nombreApellido" name="nombreApellido" class="form-control" placeholder="Nombre y Apellido" required>

    </div>
  </div>
  
  <div class="form-group row">
  <div class="col">
    <label for="alias">Alias</label>
    </div>
    <div class="col">
    <input type="text" id="alias" name="alias" class="form-control" placeholder="alias" >

    </div>
  </div>
  <div class="form-group row">
  <div class="col">
  <label for="rutid">Rut</label>
    </div>
    <div class="col">
    <input type="text" id="rutid" name="rutid" oninput="checkRut(this); " class="form-control" mensaje="Debe completar ">   
    
  </div>
  </div>
  <div class="form-group row">
  <div class="col">
  <label for="email">Email</label>
    </div>
    <div class="col">
    <input type="email" class="form-control" name="email" id="email" placeholder="Email"  >
    </div>
  </div>

  <div class="form-group row">
    <div class="col">
        <label for="region">Región</label>
    </div>
    <div class="col">
        <select class="custom-select my-1 mr-sm-2" id="region"name="region" onchange="obtenerComunas()">
            <option value="0">Seleccione una región</option>
            <?php echo $regiones;  ?>
        </select>
    </div>
</div>

<div class="form-group row">
    <div class="col">
        <label for="comuna">Comuna</label>
    </div>
    <div class="col">
        <select class="custom-select my-1 mr-sm-2" id="comuna"name="comuna">
            <option value="0">Seleccione una comuna</option>
        </select>
    </div>
</div>
  <div class="form-group row">
  <div class="col">
  <label for="candidatos">Candidato</label>
    </div>
    <div class="col">
    <select class="custom-select my-1 mr-sm-2" id="candidatos"name="candidatos">
    <option value="0">Seleccione candidato</option>    
              <?php echo  $candidatos; ?> 
  </select>
    </div>
  </div>
  <div class="form-group row">
    <div class="col">
        <label>Como se enteró de nosotros:</label>
    </div>
    <div class="col">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="fuentes[]" value="web" id="chkWeb">
            <label class="form-check-label" for="chkWeb">Web</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="fuentes[]" value="tv" id="chkTv">
            <label class="form-check-label" for="chkTv">TV</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="fuentes[]" value="redes_sociales" id="chkRedesSociales">
            <label class="form-check-label" for="chkRedesSociales">Redes Sociales</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="fuentes[]" value="amigo" id="chkAmigo">
            <label class="form-check-label" for="chkAmigo">Amigo</label>
        </div>
    </div>
</div>
</div>


  <button type="submit" id="btnvalida" class="btn btn-default">Votar</button>
  
</form>

<script src="Validaciones.js"></script>
</body>

</html>

