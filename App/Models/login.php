<?php
namespace App\Models;

use PDO; 

class login extends \Core\Model{
    public static function getUsuario($usuario) {
        try {
            $db = static::getDB();
            $sql = "SELECT * FROM usuarios WHERE nomusu='$usuario'";
            $consulta = $db->query($sql);
            $consulta = $consulta->fetchAll(PDO::FETCH_ASSOC);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          } catch(\PDOException $exception) {
           $consulta = ['error' => 'Se ha capturado el siguente error: '.$exception->getMessage()];
          }
          return $consulta;
    }
    public static function registro($data){
        $correo = $data['correo'];
        $nomusu = $data['nomusu'];
        $password = $data['password'];
        $tipo = 'cliente';
        try{
          $db = static::getDB();
            $sql = "INSERT INTO `usuarios` (`correo`, `nomusu`, `password`, `tipo`) VALUES ('$correo','$nomusu','$password','$tipo')";
            $db->exec($sql);
        } catch (\PDOException $e) {
            return $e->getMessage();
        }
        $db = null; 
    }
}