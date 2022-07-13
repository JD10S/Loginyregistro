<?php
namespace App\Controllers;
use \Core\View;
use \App\Models\login;

class Home extends \Core\Controller{
    public function index(){
        View::renderTemplate('login.twig');
    }
    public function login() {
        $data = Login::getUsuario($_POST['Usuario']);
        if(isset($data[0])){
        if($_POST['Password'] == $data[0]['password']){
            session_start();
            $_SESSION['nombre']=$data[0]['nomusu'];
            $_SESSION['tipo']=$data[0]['tipo'];
            switch ($data[0]['tipo']) {
                case 'admin':
                    View::renderTemplate('Admin/inicio.twig',$_SESSION);
                    break;
                case 'cliente':
                    View::renderTemplate('Cliente/inicio.twig',$_SESSION);
                     break;
                default:
                    throw new Exception("No está autorizado", 401);
                    
                    break;
            }
        }else{
            $data['error'] = 'La contraseña es incorrecta';
            $data['usuario'] = $_POST['Usuario'];
            View::renderTemplate('login.twig',$data); 
        }
    }else{
        $data['error'] = 'El nombre de usuario no existe';
        $data['usuario'] = $_POST['Usuario'];
        View::renderTemplate('login.twig',$data); 
    }
    }
    public function registerForm(){
        View::renderTemplate('registro.twig'); 
    }
    public function registro(){
        $resul = Login::getUsuario($_POST['Usuario']);
        if(!isset($resul[0])){
        $data = [
            'correo' => $_POST['Correo'],
            'nomusu' => $_POST['Usuario'],
            'password' => $_POST['Contraseña'],
            'tipo' => 'Cliente'
        ];
        $db = Login::registro($data);
        if (!isset($db)){
            session_start();
            $_SESSION['nombre']= $_POST['Usuario'];
            $_SESSION['tipo']= $data['tipo'];
            View::renderTemplate('Cliente/inicio.twig', $_SESSION);
        }
         }else{
            $var['error'] = 'Ese nombre de usuario ya existe';
            $var['correo'] = $_POST['Correo'];
            View::renderTemplate('registro.twig', $var);
         }
    }
    public function cerrarsesion(){
        session_start();
        session_destroy();
        View::renderTemplate('login.twig');
    }
}