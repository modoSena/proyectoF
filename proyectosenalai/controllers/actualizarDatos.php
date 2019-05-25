<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'phpmailer/Exception.php';
require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';
class actualizarDatos extends Controller {
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
       $idpersona = $_SESSION['idPersona'];
       $this->view->consultarsexo = $this->model->consultarsexo();
       $this->view->consultardepartamento = $this->model->consultardepartamento();
       $this->view->consultarrol = $this->model->consultarrol();
       $this->view->consultarprograma = $this->model->consultarprograma();
       $this->view->consultartipodocumento = $this->model->consultartipodocumento();
       $this->view->valores = $this->model->consultarUsuario($idpersona);
       $this->view->render('actualizarDatos/index');
    }




    function actualizarUsuario(){

      session_start();
      if ( $_SESSION['usuario'] ==""  and  $_SESSION['contrasena'] =="" ) {
         header('Location:'.constant('URL').'login');
         die();        
     }

      if (isset($_POST["envioActualizarUsuario"])){

         sleep(2);
         
         $idPersona = $_SESSION['idPersona'];
         $ciudad = $_POST['ciudad'];
         $direccion = $_POST['Adireccion'];
         $email = $_POST['Aemail'];
         $sexo = $_POST['Asexo'];
         $numero_celular = $_POST['Anumero_celular'];
         $telefono = $_POST['Atelefono'];


         //CONSULTAMOS EL EMAIL Y USUARIO Y DOCUMENTO PARA HACER VALIDACIONES
         $this->comparador = $this->model->consultarDatosParaComparar($idPersona);
         //Consulta para validar que el email no exista en nuestra base de datos//
         $this->f =$this->model->validaremailexiste($email);
         //----------fin consulta----------//
             

                        

                                 //---- VALIDACIONES De sexo----- ///      
                                 if($sexo == ""){
                                         echo '<div class="alert alert-danger">
                                         <strong>ERROR!</strong>  Seleccione un sexo.
                                         </div>';
                                         } 
                                                         //---- VALIDACIONES DE ciudad----- ///      
                                 else if($ciudad == ""){
         
                                 echo '<div class="alert alert-danger">
                                 <strong>ERROR!</strong>  Seleccione una ciudad.
                                 </div>';
                                 } 
                        //---- VALIDACIONES DE LA DIRECCION----- /// 
                 else if($direccion == "" ){   
                         echo '<div class="alert alert-danger">
                         <strong>ERROR!</strong>  El campo Direccion no puede ir vacío.
                         </div>'; 
                        }
                        //NO cumple longitud minima  
                        else if(strlen($direccion) > 30 ){  
                         echo '<div class="alert alert-danger">
                         <strong>ERROR!</strong>  El campo Direccion no puede  ser mayor de 30 caracteres.
                         </div>';
                        }
          //---- VALIDACIONES DEL  EMAIL----- ///  
                 else if(strlen($email) == 0){ 
                  echo '<div class="alert alert-danger">
                  <strong>ERROR!</strong>  El campo Email no puede ir vacío.
                  </div>';
                 }   
                 // SI escrito, NO VALIDO email  
                 else if(!preg_match("/^[^\s()<>@,;:\/]+@\w[\w\.-]+\.[a-z]{2,}$/i",$email)){ 
                 echo '<div class="alert alert-danger">
                 <strong>ERROR!</strong>  Debe ingresar un Email valido.
                 </div>';   
                 }  
          
          //---- VALIDACIONES DEL  EMAIL(VALIDAR QUE EL EMAIL NO EXISTA EN LA BASE DE DATOS)----- ///      
           
                else if($this->comparador['Email'] != $email && $this->f > 0  ){
         
                
                  echo '<div class="alert alert-danger">
                  <strong>ERROR!</strong>  El Email ya ha sido registrado, intenta con otro.
                  </div>';
                 
                   
                 }
                
         
                 //---- VALIDACIONES DEl CELULAR----- /// 
                 else if($numero_celular == "" ){   
                         echo '<div class="alert alert-danger">
                         <strong>ERROR!</strong>  El campo Celular no puede ir vacío.
                         </div>'; 
                        }
         
         
                       // solo caracteres numericos  
                         else if(!preg_match("/^[0-9]+$/",$numero_celular)){  
                         echo '<div class="alert alert-danger">
                         <strong>ERROR!</strong>  El campo Celular debe contener solo números y no pueden haber espacios.
                         </div>';
                       } 
         
                        //NO cumple longitud  
                        else if(strlen($numero_celular) != 10 ){  
                         echo '<div class="alert alert-danger">
                         <strong>ERROR!</strong>  El campo Celular debe tener 10 numeros.
                         </div>';
                        }
         //---- VALIDACIONES DEL TELEFONO----- /// 
                   // solo caracteres numericos  
                      else if(!preg_match("/^[0-9]+$/",$telefono) && $telefono !=""){  
                       echo '<div class="alert alert-danger">
                       <strong>ERROR!</strong>  El campo Tel fijo  debe contener solo números o debe estar vacío.
                       </div>';
                        }
                 //NO cumple longitud  
                 else if(strlen($telefono) != 7 && $telefono !="" ){  
                  echo '<div class="alert alert-danger">
                  <strong>ERROR!</strong>  El campo Tel  FIjo debe tener los 7 dígitos o puede ir vacío.
                  </div>';
                 }
         
          //---- REGISTRAR USUARIO CORRECTAMENTE----- /// 
                else { 
                  $this->model->actualizarUsuario($idPersona,$ciudad,$direccion,$email,$sexo,$numero_celular,$telefono);
                 echo 1; 
               } 
         }
    }

}
?>