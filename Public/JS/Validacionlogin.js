var boton = document.getElementById('botonsubmit'); 
const usuario = document.getElementById('floatingInput'); 
const contraseña = document.getElementById('floatingPassword');
const alerta = document.getElementById('aviso');

function validar(){
    if(usuario.value !== "" && contraseña.value !== ""){
        alerta.style.display = 'none';
        boton.disabled = false; 
    }else{
        alerta.style.display = 'block';
        boton.disabled = true; 
    }
}

usuario.addEventListener('keyup', validar); 
contraseña.addEventListener('keyup', validar); 
