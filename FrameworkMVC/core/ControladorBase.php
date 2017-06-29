<?php
class ControladorBase{

    public function __construct() {
        require_once 'EntidadBase.php';
        require_once 'ModeloBase.php';
        
        //Incluir todos los modelos
        foreach(glob("model/*.php") as $file){
            require_once $file;
        }
    }
    
    
    ///////// EMPIEZA FUNCION PARA REDIRECCIONAR A VISTAS INICIALES/////////
    public function view($vista,$datos){
        foreach ($datos as $id_assoc => $valor) {
            ${$id_assoc}=$valor; 
        }
        
        require_once 'core/AyudaVistas.php';
        $helper=new AyudaVistas();
    
        require_once 'view/'.$vista.'View.php';
    }
    ///////// TERMINA FUNCION PARA REDIRECCIONAR A VISTAS INICIALES/////////
      
    
    
    
    
    ////////EMPIEZA FUNCION PARA DIRECCIONAR VISTAS AL CHAT//////////
    public function chat($vista,$datos){
    	foreach ($datos as $id_assoc => $valor) {
    		${$id_assoc}=$valor;
    	}
    	require_once 'core/AyudaVistas.php';
    	$helper=new AyudaVistas();
    
    	require_once 'view/Chat/'.$vista.'View.php';
    }
    ////////TERMINA FUNCION PARA DIRECCIONAR VISTAS AL CHAT//////////
      
    
    
    ////////EMPIEZA FUNCION PARA DIRECCIONAR VISTAS ALA FACTURACION Y COMPRAS//////////
    public function facturacion_compras($vista,$datos){
    	foreach ($datos as $id_assoc => $valor) {
    		${$id_assoc}=$valor;
    	}
    	require_once 'core/AyudaVistas.php';
    	$helper=new AyudaVistas();
    
    	require_once 'view/FACTURACION_COMPRAS/'.$vista.'View.php';
    }
    ////////TERMINA FUNCION PARA DIRECCIONAR VISTAS ALA FACTURACION Y COMPRAS//////////
    
    ///////////////EMPIEZA FUNCION PARA DIRECCIONAR A CARTERA//////////////////////
    public function cartera($vista,$datos){
    	foreach ($datos as $id_assoc => $valor) {
    		${$id_assoc}=$valor;
    	}
    	require_once 'core/AyudaVistas.php';
    	$helper=new AyudaVistas();
    
    	require_once 'webservices/'.$vista.'Service.php';
    }
    ///////////////TERMINA FUNCION PARA DIRECCIONAR A CARTERA///////////////////////
    
    public function afuera($vista,$datos){
    	foreach ($datos as $id_assoc => $valor) {
    		${$id_assoc}=$valor;
    	}
    	
    
    	require_once 'core/AyudaVistas.php';
    	$helper=new AyudaVistas();
    
    	require_once 'http://localhost:3000/'.$vista;
    }
    
    
    public function redirect($controlador=CONTROLADOR_DEFECTO,$accion=ACCION_DEFECTO){
        header("Location:index.php?controller=".$controlador."&action=".$accion);
    }
    
    //Métodos para los controladores
    
    
    public function report($vista,$datos){
    	foreach ($datos as $id_assoc => $valor) {
    		${$id_assoc}=$valor;
    	}
    
    	require_once 'core/AyudaVistas.php';
    	$helper=new AyudaVistas();
    
    	require_once 'view/reportes/'.$vista.'Report.php';
    }
    
   

}
?>
