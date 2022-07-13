const boton = document.getElementById('botonsubmit');
const correo = document.getElementById('correo');
const nomusu = document.getElementById('nameusu');
const password = document.getElementById('contra'); 
const confcontra = document.getElementById('confircontra');
const alerta = document.getElementById('aviso');

function validar(){
    if(correo.value !== "" && nomusu.value !== "" && password.value !== "" && confcontra.value !== ""){
        if(password.value === confcontra.value){
            alerta.style.display = 'none';
            boton.disabled = false;
        }else{
            alerta.style.display = 'block';
            alerta.innerHTML = "Las contraseñas no coinciden";
            boton.disabled = true;
        }
    }else{
        alerta.style.display = 'block';
        alerta.innerHTML = "Para enviar el formulario debes llenar todos los campos";
        boton.disabled = true; 
    }
}

correo.addEventListener('keyup', validar); 
nomusu.addEventListener('keyup', validar); 
password.addEventListener('keyup', validar); 
confcontra.addEventListener('keyup', validar); 
