

<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'phpmailer/Exception.php';
require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';


class ambientes extends Controller{

    function __construct()
    {
        parent::__construct();
    }

    function render(){
        session_start();

        if ( $_SESSION['usuario'] ==""  and  $_SESSION['contrasena'] =="" or $_SESSION['Roles_idRoles'] == 1 ) {
            header('Location:'.constant('URL').'login');
            die();        
        }
        $this->view->query = $this->model->consultarAmbientes();
        $this->view->render('ambientes/index');
    }

    function inhabilitarambiente($param = null){
      session_start();
      if ( $_SESSION['usuario'] ==""  and  $_SESSION['contrasena'] =="" or $_SESSION['Roles_idRoles'] != 4 ) {
         header('Location:'.constant('URL').'login');
         die();
      }
      $idAmbientes= $param[0];
      $this->model->inhabilitarambiente($idAmbientes);
      header("Location:".constant('URL').'ambientes');
    }

    function habilitarambiente($param = null){
      session_start();
      if ( $_SESSION['usuario'] ==""  and  $_SESSION['contrasena'] =="" or $_SESSION['Roles_idRoles'] != 4 ) {
         header('Location:'.constant('URL').'login');
         die();
      }
      $idAmbientes= $param[0];
      $this->model->habilitarambiente($idAmbientes);
      header("Location:".constant('URL').'ambientes');
    }

    function  registrarAmbientes(){
      session_start();
      if ( $_SESSION['usuario'] ==""  and  $_SESSION['contrasena'] =="" or $_SESSION['Roles_idRoles'] != 4 ) {
        header('Location:'.constant('URL').'login');
        die();        
    }
    $this->view->query = $this->model->consultarUbicacion();
    $this->view->render('ambientes/registrarAmbientes');
    }

    function  registrarAmbiente(){
      session_start();
      if ( $_SESSION['usuario'] ==""  and  $_SESSION['contrasena'] =="" or $_SESSION['Roles_idRoles'] != 4 ) {
        header('Location:'.constant('URL').'login');
        die();        
    }
      if (isset($_POST["envioRegistroAmbiente"])){
        $NumeroAmbiente = $_POST['NumeroAmbiente'];
        $ubicacion = $_POST['ubicacion'];
        $Cuentadante = $_POST['Cuentadante'];
        $this->e =$this->model->validardocumentoexiste($Cuentadante);
        $this->p =$this->model->ambienteExiste($NumeroAmbiente,$ubicacion);
        if(empty($ubicacion) ) {
        
          echo '<div class="alert alert-danger">
          <strong>ERROR!</strong>  Seleccione ubicación.
           </div>' ;
      } 
        
        else if(empty($NumeroAmbiente) ) {
            echo '<div class="alert alert-danger">
            <strong>ERROR!</strong>  El  Número Ambiente  no puede ir vacío.
             </div>' ;
        } 
            else if(!preg_match("/^[0-9a-zA-Z]+$/",$NumeroAmbiente)){  
            echo '<div class="alert alert-danger">
            <strong>ERROR!</strong>  El campo Número Ambiente debe contener solo (números,letras,o ambas) pero no deben haber espacios.
            </div>';
          } 
           else if ( $this->p > 0 ) {
            echo '<div class="alert alert-danger">
            <strong>ERROR!</strong> El Ambiente ya existe en esta ubicación.
             </div>' ;
        }
         else if(empty($Cuentadante) ) {
            
          echo '<div class="alert alert-danger">
          <strong>ERROR!</strong> El documento del cuentadante  no puede ir vacío.
           </div>' ;
      } 
        // solo caracteres numericos  
          else if(!preg_match("/^[0-9]+$/",$Cuentadante)){  
          echo '<div class="alert alert-danger">
          <strong>ERROR!</strong> El documento del cuentadante debe contener solo números.
          </div>';
        } 
      else if ($this->e == 0) {
          echo '<div class="alert alert-danger">
          <strong>ERROR!</strong>  El Cuentadante no existe.
           </div>' ;
      }
        else {
            $this->model->registrarAmbiente($NumeroAmbiente,$ubicacion);
            $idambientee = $this->model->consultarIdNuevoAmbiente($NumeroAmbiente,$ubicacion);
            $idambientes = $idambientee['idAmbientes'];
            $cuentadante = $this->model->consultarIdPersona($Cuentadante);
            $idcuentadante =  $cuentadante['idPersona'];
            $this->model->registrarCuentadante($idcuentadante,$idambientes);
            echo 1;
        }
        }
    }

    function actualizarAmbientes($param = null){
      session_start();
      if ( $_SESSION['usuario'] ==""  and  $_SESSION['contrasena'] =="" or $_SESSION['Roles_idRoles'] != 4 ) {
        header('Location:'.constant('URL').'login');
        die();        
    }
      $this->view->idAmbientes= $param[0];
      $this->view->query = $this->model->consultarUbicacion();
      $this->view->valores = $this->model->consultarAmbiente($this->view->idAmbientes);
      $this->view->render('ambientes/actualizarambientes');
    }

    function  actualizarAmbiente(){
      session_start();
      if ( $_SESSION['usuario'] ==""  and  $_SESSION['contrasena'] =="" or $_SESSION['Roles_idRoles'] != 4 ) {
        header('Location:'.constant('URL').'login');
        die();        
    }
      if (isset($_POST["envioActualizoAmbiente"])){
        $idAmbientes = $_POST['idAmbientes'];
        $NumeroAmbiente = $_POST['NumeroAmbiente'];
        $ubicacion = $_POST['ubicacion'];
        $this->comparador=$this->model->consultarAmbiente($idAmbientes);
        $this->p =$this->model->ambienteExiste($NumeroAmbiente,$ubicacion);
        if(empty($NumeroAmbiente) ) {
            echo '<div class="alert alert-danger">
            <strong>ERROR!</strong>  El  Número Ambiente  no puede ir vacío.
             </div>' ;
        } 
        else if(!preg_match("/^[0-9a-zA-Z]+$/",$NumeroAmbiente)){  
          echo '<div class="alert alert-danger">
          <strong>ERROR!</strong>  El campo Número Ambiente debe contener solo (números,letras,o ambas) pero no deben haber espacios.
          </div>';
        } 
      
           else if ( $this->comparador['Ubicacion_idUbicacion'] != $ubicacion && $this->p > 0 ) {
            echo '<div class="alert alert-danger">
            <strong>ERROR!</strong> El Ambiente ya existe en esta ubicación.
             </div>' ;
        }
        else if ( $this->comparador['Numero_Ambiente'] != $NumeroAmbiente && $this->p > 0 ) {
          echo '<div class="alert alert-danger">
          <strong>ERROR!</strong> El Ambiente ya existe en esta ubicación.
           </div>' ;
      }
        else {
            $this->model->actualizarAmbiente($NumeroAmbiente,$ubicacion,$idAmbientes);
            echo 1;
        }
        }
    }

    function elementosAmbiente($param = null){
    session_start();
    if ( $_SESSION['usuario'] ==""  and  $_SESSION['contrasena'] =="" or $_SESSION['Roles_idRoles'] == 1 ) {
      header('Location:'.constant('URL').'login');
      die();
    }
    $this->view->idAmbientes = $param[0];
    $this->view->query2 = $this->model->consultarNumeroAmbiente($this->view->idAmbientes);
    $this->view->query = $this->model->consultarElementos($this->view->idAmbientes);
    $this->view->render('ambientes/elementosAmbiente');
  }

  function registrarnovedad(){
    session_start();
    if ( $_SESSION['usuario'] ==""  and  $_SESSION['contrasena'] =="" or $_SESSION['Roles_idRoles'] == 1 ) {
      header('Location:'.constant('URL').'login');
      die();
    }
      if (isset($_POST["envioReportarNovedad"])) {
        ini_set('date.timezone','America/Bogota'); 
        $idElemento = $_POST['idElemento'];
        $novedad = $_POST['novedad'];
        $idpersona = $_SESSION['idPersona'];
        $fecha = date("Y-m-d H:i:s");
         
        if (empty($novedad)) {
          echo '<div class="alert alert-danger">
          <strong>ERROR!</strong> Ingresa una Novedad.
           </div>' ;
      }else {
        $this->model->registrarNovedad($novedad,$idpersona,$idElemento,$fecha);
        $datosE = $this->model->consultarE($idElemento);



        $mail = new PHPMailer(true); 

        // Passing `true` enables exceptions
        try {
           //Server settings
           $mail->SMTPDebug = 0;                                 // Enable verbose debug output
           $mail->isSMTP();                                      // Set mailer to use SMTP
           $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
           $mail->SMTPAuth = true;                               // Enable SMTP authentication
           $mail->Username = 'senalai31@gmail.com';                 // SMTP username
           $mail->Password = 'colonbia123';                          // SMTP password
           $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
           $mail->Port = 587;                                    // TCP port to connect to
        
           //Recipients
           $mail->setFrom('mate2801@gmail.com', 'Sena L.A.I');
           $mail->addAddress('senalai31@gmail.com', '');     // Add a recipient
           $mail->addAddress($_SESSION['Email'], ''); 
           $message  = "<html><body>";
           
           $message .= "<table width='100%' bgcolor='#e0e0e0' cellpadding='0' cellspacing='0' border='0'>";
              
           $message .= "<tr><td>";
              
           $message .= "<table align='center' width='100%' border='0' cellpadding='0' cellspacing='0' style='max-width:650px; background-color:#fff; font-family:Verdana, Geneva, sans-serif;'>";
                 
           $message .= "<thead>
              <tr height='80'>
              <th colspan='4' style='background-color:rgb(235,111,13); border-bottom:solid 1px #bdbdbd; font-family:Verdana, Geneva, sans-serif; color:#333; font-size:34px;' >Sena L.A.I</th>
              </tr>
                          </thead>";
                 
           $message .= "<tbody>
                          <tr align='center' height='50' style='font-family:Verdana, Geneva, sans-serif;'>
                    <td style='background-color:fff; text-align:center;'><h1 style='color:black'; >Hola Señor(a): </td>
        
                    </tr>
                 
                    <tr>
                    <td colspan='4' style='padding:15px;'>
                    <p style='font-size:20px;'>Novedad Reportada</p>
                    <hr />
                    <p style='font-size:25px;'>Los datos de la novedad son:</p>
                    <p style='font-size:25px;'>Elemento: ".$datosE['Placa_Equipo']." - ".$datosE['Descripcion']."</p>
                    <p style='font-size:25px;'>Ubicacion de elemento: ".$datosE['NombreUbicacion']."</p>
                    <p style='font-size:25px;'>Numero de ambiente: ".$datosE['Numero_Ambiente']."</p>
                    <p style='font-size:25px;'>Descripción de novedad: ".$novedad."</p>
                    <p style='font-size:25px;'>Realizada por: ".$_SESSION['Nombre']." ".$_SESSION['Apellido_Primero']."</p>
                    <p style='font-size:25px;'>Fecha de novedad: ".$fecha."</p>
                 
                    </td>
                    </tr>
                 
                          </tbody>";
                 
           $message .= "</table>";
              
           $message .= "</td></tr>";
           $message .= "</table>";
              
           $message .= "</body></html>";
           //Content
           $mail->isHTML(true);                                  // Set email format to HTML
           $mail->Subject = 'asunto importante';
           $mail->Body   = $message ;
           
           $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        
           $mail->send();
           
           echo 1;
           
        } catch (Exception $e) {
           echo 'no se envio error: ', $mail->ErrorInfo;
        }  
      }
      }
  }

  function consultarNovedades(){
    session_start();
    if ( $_SESSION['usuario'] ==""  and  $_SESSION['contrasena'] =="" or $_SESSION['Roles_idRoles'] == 1 ) {
      header('Location:'.constant('URL').'login');
      die();
    }
    $idElemento = $_POST['consulta'];
    $this->view->query = $this->model->consultarNovedades($idElemento);
$salida = "<table id='table_id2' class='display'>
          <thead>
        <tr>
                  <th>Realizado por</th>
                  <th>Documento</th>
                  <th>Novedad</th>
                  <th>fecha</th>
        </tr>
    </thead>
    <tbody>";
    foreach($this->view->query as  $fila) { 
      $salida .=  "<tr>";
             $salida .= "<td>" . $fila['Nombre'] .' '.$fila['Apellido_Primero']."</td>         
               <td>".  $fila['Numero_Documento']. "</td>
               <td>".$fila['Descripcion']. "</td>
               <td>".$fila['Fecha_Realizacion']. "</td>"; 
         $salida .="</tr>";
     } 
    $salida.="</tbody></table>";
   echo $salida;
   echo"<script>$(document).ready( function () { $('#table_id2').DataTable(); } );</script>";
  }

  function registrarCuentadantes(){
    session_start();
    if ( $_SESSION['usuario'] ==""  and  $_SESSION['contrasena'] =="" or $_SESSION['Roles_idRoles'] == 1 ) {
      header('Location:'.constant('URL').'login');
      die();
    }
    $Cuentadante = $_POST['cuentadante'];
    $idambientes = $_POST['idambiente'];
    $idDetalleCuentadante = $_POST['idDetalleCuentadante'];
    $this->e =$this->model->validardocumentoexiste($Cuentadante);
    if(empty($Cuentadante) ) { 
      echo '<div class="alert alert-danger">
      <strong>ERROR!</strong> El documento del cuentadante  no puede ir vacío.
       </div>' ;
  } 
    // solo caracteres numericos  
      else if(!preg_match("/^[0-9]+$/",$Cuentadante)){  
      echo '<div class="alert alert-danger">
      <strong>ERROR!</strong> El documento del cuentadante debe contener solo números.
      </div>';
    } 
  else if ($this->e == 0) {
      echo '<div class="alert alert-danger">
      <strong>ERROR!</strong>  El Cuentadante no existe.
       </div>' ;
  }
  else {
       $this->model->destivarCuentadante($idDetalleCuentadante);
       $cuentadante = $this->model->consultarIdPersona($Cuentadante);
       $idcuentadante =  $cuentadante['idPersona'];
       $this->model->registrarCuentadante($idcuentadante,$idambientes);
       echo 1;
  }
  }

  function consultarCuentadantes(){
    session_start();
    if ( $_SESSION['usuario'] ==""  and  $_SESSION['contrasena'] =="" or $_SESSION['Roles_idRoles'] == 1 ) {
      header('Location:'.constant('URL').'login');
      die();
    }
    $idambiente = $_POST['consulta'];
    $this->view->query = $this->model->consultarCuentadantes($idambiente);
$salida = "<table id='table_id2' class='display'>
          <thead>
        <tr>
                  <th>Estado</th>
                  <th>Núm. Documento</th>
                  <th>Nombres</th>
                  <th>Celular</th>
                  <th>Fecha Registro</th>
                  <th>Fecha Salida</th>  
        </tr>
    </thead>
    <tbody>";
    foreach($this->view->query as  $fila) { 
      $salida .=  "<tr>";
      if ($fila['Estado_C'] == 1 ) {
        $salida .= "<td>".'Activo'."</td>";
      }else {
        $salida .= "<td>".'Inactivo'."</td>";
      }
             $salida .= "<td>" . $fila['Numero_Documento'] ."</td>      
               <td>".  $fila['Nombre']. "</td>
               <td>".$fila['Numero_Celular']. "</td>
               <td>".$fila['Fecha']. "</td>
               <td>".$fila['Fecha_Final']. "</td>";
         $salida .="</tr>";
     } 
    $salida.="</tbody></table>";
   echo $salida;
   echo"<script>$(document).ready( function () { $('#table_id2').DataTable(); } );</script>";

  }
}

?>