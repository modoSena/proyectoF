<?php


class login extends Controller{


    function __construct()
    {
        parent::__construct();
        
       
    }

    function render(){
        $this->view->render('login/index');
    }






    function validarUsuario(){


        session_start();
        
        $usuario = $_POST['usuario'] ;
        $contrasenaa = $_POST['contrasena'];

        
        
        $contrasena = md5($contrasenaa);
        $this->view->datos = $this->model->validarUsuario($usuario,$contrasena);

                /*------VARIABLES PARA REUTILIZAR ---------*/

        $_SESSION['usuario'] = $this->view->datos['Usuario'];

        $_SESSION['contrasena'] =  $this->view->datos['Contrasena'];

        $_SESSION['idPersona'] =  $this->view->datos['idPersona'];

        $_SESSION['Nombre'] =  $this->view->datos['Nombre'];

        $_SESSION['Apellido_Primero'] =  $this->view->datos['Apellido_Primero'];

        $_SESSION['Email'] =  $this->view->datos['Email'];

        $_SESSION['Telefono'] =  $this->view->datos['Telefono'];

        $_SESSION['Roles_idRoles'] =  $this->view->datos['Roles_idRoles'];

        if ($usuario == "") {
            echo '<div class="alert alert-danger">
            <strong>ERROR!</strong> El campo usuario no puede ir vacío.
            </div>';
        }
        
        else if($contrasenaa ==""){
            echo '<div class="alert alert-danger">
            <strong>ERROR!</strong> El campo contraseña no puede ir vacío. 
            </div>';
        }

        else if($this->view->datos > 0){

            if ($this->view->datos['Estado_idEstado'] != 1) {
                echo  '<div class="alert alert-danger">
            <strong>ERROR!</strong> Usuario "Inhabilitado" Contacte Administrador.
            </div>';
            }else {
               echo 1;
            }
        
             
        }
         else{
            echo  '<div class="alert alert-danger">
            <strong>ERROR!</strong> Datos incorretos "Inténtelo de nuevo"  
            </div>';
        }

    


    }


   
}



?>

