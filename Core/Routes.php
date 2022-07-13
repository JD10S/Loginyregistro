<?php
namespace Core;

//definiendo rutas
$router->add('',['controller'=>'Home', 'action' => 'index']);
$router->add('{controller}/{action}');