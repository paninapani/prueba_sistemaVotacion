function validarFormulario() {
  const nombreApellido = document.getElementById('nombreApellido');
    
    
    const region = document.getElementById('region');
    const comuna = document.getElementById('comuna');
    const candidatos = document.getElementById('candidatos');
    
  if (nombreApellido.value === '' || region.value === '0' || comuna.value === '0' || candidatos.value === '0') {
    alert('Debe completar todos los campos obligatorios.');
    return false;
}

  var checkboxes = document.querySelectorAll('input[type="checkbox"]:checked');
  if (checkboxes.length < 2) {
      alert("Debe seleccionar al menos dos opciones en 'Como se enteró de nosotros'.");
      return false;
  }
  const emailInput = document.getElementById('email');
  const emailValue = emailInput.value.trim();

  if (!validarEmail(emailValue)) {
    alert('Por favor, ingresa un correo electrónico válido.');
    // Otra opción podría ser agregar un mensaje de error debajo del campo de correo electrónico en el formulario.
    // Por ejemplo: emailInput.setCustomValidity('Por favor, ingresa un correo electrónico válido.');
    // Y luego llamar a emailInput.reportValidity();
    return false;
  }

  const rut = document.getElementById('rutid').value;
  // Verificar si el RUT está bien formateado y existe en la base de datos
  if (!checkRut(rut)) {
      return false;
  }
  const formulario = document.getElementById('formulario');
  formulario.addEventListener('submit', function(event) {
    if (!validarFormulario()) {
      event.preventDefault(); // Evitar el envío del formulario si la validación falla.
    }
  });
  return true; // Permite el envío del formulario si el campo no está vacío y el RUT es válido.
  
}
  function checkRut(rut) {
    const valorRut = rut.value.replace(/\./g, '').replace('-', '').toUpperCase();
    const cuerpo = valorRut.slice(0, -1);
    const dv = valorRut.slice(-1);

    rut.value = cuerpo + '-' + dv;

    if (cuerpo.length < 7) {
        rut.setCustomValidity("RUT Incompleto");
        return false;
    }

    let suma = 0;
    let multiplo = 2;

    for (let i = 1; i <= cuerpo.length; i++) {
        const index = multiplo * parseInt(valorRut.charAt(cuerpo.length - i));
        suma += index;
        multiplo = (multiplo < 7) ? multiplo + 1 : 2;
    }

    const dvEsperado = 11 - (suma % 11);
    const dvVerificador = (dv === 'K') ? 10 : parseInt(dv);

    if (dvEsperado !== dvVerificador) {
        rut.setCustomValidity("RUT Inválido");
        return false;
    }

    rut.setCustomValidity('');
    return true;
}

function validarEmail(email) {
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  return emailRegex.test(email);
}


function obtenerValorRegion() {
  var select = document.getElementById("region");
  var valorSeleccionado = select.value;
 // console.log("Región seleccionada: " + valorSeleccionado);
  return valorSeleccionado;
}

function obtenerComunas() {
  var regionSeleccionada = obtenerValorRegion();
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "conexion.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = function () {
      if (xhr.readyState === XMLHttpRequest.DONE) {
          if (xhr.status === 200) {
              var selectComuna = document.getElementById("comuna");
              var comunas = JSON.parse(xhr.responseText);

              // Limpiar el select de comuna
              selectComuna.innerHTML = "<option value='0'>Seleccione una comuna</option>";

              // Agregar las opciones de comuna al select
              comunas.forEach(function (comuna) {
                  var option = document.createElement("option");
                  option.value = comuna.id_comuna;
                  option.textContent = comuna.nombre_comuna;
                  selectComuna.appendChild(option);
              });
          } else {
              console.error("Error al obtener las comunas. Estado de la solicitud: " + xhr.status);
          }
      }
  };

  xhr.onerror = function () {
      console.error("Error de red al obtener las comunas.");
  };

  var params = "tipo=1&dato=" + encodeURIComponent(regionSeleccionada);
  xhr.send(params);
}

