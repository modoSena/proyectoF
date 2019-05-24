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
         $nombres = $_POST['Anombres'];
         $apellido_primero = $_POST['Aapellido_primero'];
         $apellido_segundo = $_POST['Aapellido_segundo'];
         $usuario = $_POST['Ausuario'];
         $rol = $_POST['Arol'];
         $tipodocumento = $_POST['Atipodocumento'];
         $documento = $_POST['Adocumento'];
         $ciudad = $_POST['ciudad'];
         $direccion = $_POST['Adireccion'];
         $email = $_POST['Aemail'];
         $sexo = $_POST['Asexo'];
         $numero_celular = $_POST['Anumero_celular'];
         $telefono = $_POST['Atelefono'];
         $idprograma = $_POST['Aidprograma'];
         $numero_ficha = $_POST['Anumero_ficha'];;

         //CONSULTAMOS EL EMAIL Y USUARIO Y DOCUMENTO PARA HACER VALIDACIONES
         $this->comparador = $this->model->consultarDatosParaComparar($idPersona);
         //Consulta para validar que el email no exista en nuestra base de datos//
         $this->f =$this->model->validaremailexiste($email);
         //----------fin consulta----------//
         //Consulta para validar que el email no exista en nuestra base de datos//
         $this->y=$this->model->validarusuarioexiste($usuario);
         //----------fin consulta----------//
         //Consulta para validar que el Documento no exista en nuestra base de datos//
         $this->j=$this->model->validardocumentoexiste($documento);
         //---- VALIDACIONES DEL NOMBRE----- ///
            
               //Si esta vacio  
                 if($nombres == "" ){ 
                  echo '<div class="alert alert-danger">
                  <strong>ERROR!</strong>  El campo Nombres no puede ir vacío.
                  </div>';
                 }
              //NO cumple longitud  
                 else if(strlen($nombres) > 40 ){  
                  echo '<div class="alert alert-danger">
                  <strong>ERROR!</strong> El campo Nombres no puede ser mayor de 40 caracteres.
                  </div>'; 
                 }
                 //SI longitud pero NO solo caracteres A-z  
                 else if(!preg_match("/^[a-zA-Z]+(\s*[a-zA-Z]*)*[a-zA-Z]+$/", $nombres)){  
                  echo '<div class="alert alert-danger">
                  <strong>ERROR!</strong> El campo Nombres solo debe tener letras. 
                  </div>';
                 }
         
         //---- VALIDACIONES DE LOS  APELLIDOS----- /// 
             
                 else if($apellido_primero == "" ) { 
                  echo '<div class="alert alert-danger">
                  <strong>ERROR!</strong>  El campo Primer Apellido no puede ir vacío.
                  </div>';
                 }
         
                 //NO cumple longitud minima  
                 else if(strlen($apellido_primero) > 20 ){  
                  echo '<div class="alert alert-danger">
                  <strong>ERROR!</strong> El campo Primer Apellido no puede ser mayor de 20 caracteres.
                  </div>'; 
                 } 
                 //SI longitud pero NO solo caracteres A-z  
                 else if(!preg_match("/^[a-zA-Z]+$/",$apellido_primero)){  
                  echo '<div class="alert alert-danger">
                  <strong>ERROR!</strong> El campo Primer Apellido solo debe tener letras y no pueden haber espacios.
                  </div>'; 
                 }
                
                        //NO cumple longitud minima  
                        else if(strlen($apellido_segundo) > 20 ){  
                         echo '<div class="alert alert-danger">
                         <strong>ERROR!</strong> El campo Segundo Apellido no puede ser mayor de 20 caracteres.
                         </div>';  
                        } 
                        //SI longitud pero NO solo caracteres A-z  
                        else if(!preg_match("/[A-Za-z]/",$apellido_segundo) && $apellido_segundo !="" ){  
                         echo '<div class="alert alert-danger">
                         <strong>ERROR!</strong> El campo Segundo apellido solo debe tener letras o debe estar vacío.
                         </div>'; 
                        }       
                        //---- VALIDACIONES DEL USUARIO----- ///
                 else if($usuario == "" )  {
                         echo '<div class="alert alert-danger">
                         <strong>ERROR!</strong>  El campo Usuario no puede ir vacío.
                         </div>'; 
                        }
                        
                        //NO cumple longitud   
                        else if(strlen($usuario) < 5 || strlen($usuario) >20 ){ 
                         echo '<div class="alert alert-danger">
                         <strong>ERROR!</strong> El usuario no puede tener menos de 5 caracteres o mas de 20 caracteres.
                         </div>';
                        } 
                        //SI longitud pero NO solo caracteres A-z  
                        else if(!preg_match("/^[0-9a-zA-Z]+$/",$usuario)) {
                         echo '<div class="alert alert-danger">
                         <strong>ERROR!</strong> El campo usuario solo debe tener letras y números.
                         </div>'; 
                        } 
                        // SI longitud, SI caracteres A-z
                
                        else if($this->comparador['Usuario'] != $usuario && $this->y > 0 ){
         
                         echo '<div class="alert alert-danger">
                         <strong>ERROR!</strong>  El usuario ya ha sido registrado, intenta con otro.
                         </div>';

                        }
                        
                  //---- VALIDACIONES DEL rol----- ///      
                        else if($rol==""){
         
                         echo '<div class="alert alert-danger">
                         <strong>ERROR!</strong>  Seleccione un rol.
                         </div>';
                        }
         
                           //---- VALIDACIONES DEL tipo documento----- ///      
                           else if($tipodocumento == ""){
         
                                 echo '<div class="alert alert-danger">
                                 <strong>ERROR!</strong>  Seleccione un tipo de documento.
                                 </div>';
                                }      
                        //---- VALIDACIONES DEL DOCUMENTO----- /// 
                 else if($documento == "" ){   
                         echo '<div class="alert alert-danger">
                         <strong>ERROR!</strong>  El campo Número Documento no puede ir vacío.
                         </div>'; 
                        }
                        //NO cumple longitud minima  
                        else if(strlen($documento) > 30 ){  
                         echo '<div class="alert alert-danger">
                         <strong>ERROR!</strong>  El campo Número Documento no puede ser mayor de 30 caracteres.
                         </div>';
                        }
                        //SI longitud pero NO solo caracteres A-z  
                        else if(!preg_match("/^[0-9]+$/",$documento)){  
                         echo '<div class="alert alert-danger">
                         <strong>ERROR!</strong>  El campo Número Documento solo debe contener  números.
                         </div>';
                        }
         
         
                        else if($this->comparador['Numero_Documento'] != $documento && $this->j > 0){
         
                         
                         echo '<div class="alert alert-danger">
                         <strong>ERROR!</strong>  El Número Documento ya ha sido registrado.
                         </div>';
                        
         
                        }
                                 //---- VALIDACIONES DEL tipo documento----- ///      
                                 else if($sexo == ""){
                                         echo '<div class="alert alert-danger">
                                         <strong>ERROR!</strong>  Seleccione un sexo.
                                         </div>';
                                         } 
                                                         //---- VALIDACIONES DEL tipo documento----- ///      
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
         //---- VALIDACIONES DEL NUMERO FICHA----- ///   
                   else if(!preg_match("/^[0-9]+$/",$numero_ficha) && $numero_ficha !=""){  
                       echo '<div class="alert alert-danger">
                       <strong>ERROR!</strong>  El Campo Numero Ficha debe contener solo números o debe estar vacío.
                       </div>';
                        }
          //---- REGISTRAR USUARIO CORRECTAMENTE----- /// 
                else {
                  if ($_SESSION['Roles_idRoles'] != 4 && $rol == 4 or $rol == 3 ) {
                     echo "ERROR ";
                     die(); 
                  } 
                  $this->model->actualizarUsuario($idPersona,$nombres,$apellido_primero,$apellido_segundo,$usuario,$rol,$tipodocumento,$documento,$ciudad,$direccion,$email,$sexo,$numero_celular,$telefono,$idprograma,$numero_ficha);
                 echo 1; 
               } 
         }
    }

}
?>