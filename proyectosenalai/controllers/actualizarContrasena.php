<?php

class actualizarContrasena extends Controller{


    function __construct()
    {
        parent::__construct();
    
        
    }

    function render(){
        session_start();

        if ( $_SESSION['usuario'] ==""  and  $_SESSION['contrasena'] =="" ) {
            header('Location:'.constant('URL').'login');
            die();        
        }
        $this->view->render('actualizarContrasena/index');
    }

    function validarDatos(){
        session_start();

        if ( $_SESSION['usuario'] ==""  and  $_SESSION['contrasena'] ==""  ) {
            header('Location:'.constant('URL').'login');
            die();        
        }

        if (isset($_POST["envioActualizarContrasena"])){
            
            $idPersona = $_SESSION['idPersona'];
            $pasarContrasena = $_POST['contrasenaActual'];

            if($pasarContrasena == "" ) { 
                echo '<div class="alert alert-danger">
                <strong>ERROR!</strong>  Ingrese su contraseña actual.
                </div>';
               }else {
                  
               
            
            $contrasenaActual = md5($pasarContrasena);
            $nuevaContrasena = $_POST['nuevaContrasena'];
            $nuevaContrasena2 = $_POST['nuevaContrasena2'];

             //---- ENCRIMOS LA CONTRASEÑA NUEVA PARA VALIDAR QUE NOS SE IGUAL A LA ANTERIOR----- ///
            $n = md5($nuevaContrasena);
         
        
        
         //---- VALIDACIONES DE CONTRASEÑA ACTUAL----- ///
         
        
           
        
            if ($_SESSION['contrasena'] != $contrasenaActual ){
            echo '<div class="alert alert-danger">
            <strong>ERROR!</strong> Su Contraseña actual es incorrecta
            </div>';
           
           }
         //---- VALIDACIONES DE CONTRASEÑA NUEVAL----- ///



           else if($nuevaContrasena == "" ) { 
            echo '<div class="alert alert-danger">
            <strong>ERROR!</strong>  Ingrese su nueva constraseña.
            </div>';
           }
           //NO tiene minimo de 5 caracteres o mas de 12 caracteres  
           else if(strlen($nuevaContrasena) < 8 || strlen($nuevaContrasena) > 30){  
            echo '<div class="alert alert-danger">
            <strong>ERROR!</strong>  La Contrasena  no puede tener menos de 8 caracteres o mas de 30 caracteres
            </div>' ;
           } 
           // SI longitud, NO VALIDO numeros y letras  
           else if(!preg_match("/^[0-9a-zA-Z]+$/", $nuevaContrasena)){  
            echo '<div class="alert alert-danger">
            <strong>ERROR!</strong>  El campo contraseña solo debe tener letras y números y no pueden haber espacios
            </div>'; 
           }
           // validar que la nueva contraseña no sea igual a la anterior
           else if ($n == $contrasenaActual) {
            echo '<div class="alert alert-danger">
            <strong>ERROR!</strong>  La nueva contraseña no puede ser igual a la anterior.
            </div>';
           } 
        
        
        //---- VALIDACIONES DEL CONTRASEÑA2 (COINCIDAN)----- /// 
        
          else if($nuevaContrasena != $nuevaContrasena2){  
            echo '<div class="alert alert-danger">
            <strong>ERROR!</strong>  Las contraseñas no coinciden
            </div>';
           }
          else {



           
            $this->model->actualizarContrasena($n,$idPersona);

            $_SESSION['usuario'] = $n;
            
            echo 1 ;
        
          }
        
        
        }


    }
        
    }





}

?>