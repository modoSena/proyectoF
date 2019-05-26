<?php
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
        echo 1;
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
             $salida .= "<td>" . $fila['Nombre'] ."</td>         
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