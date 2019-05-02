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
        $Cuentadante = $_POST['Cuentadante'];
        $ubicacion = $_POST['ubicacion'];
        

        
        
        $this->p =$this->model->ambienteExiste($NumeroAmbiente,$ubicacion);
        
        
        
        
        $this->e =$this->model->validardocumentoexiste($Cuentadante);

        if(empty($ubicacion) ) {
        
          echo '<div class="alert alert-danger">
          <strong>ERROR!</strong>  Seleccione ubicacion.
           </div>' ;
      } 
        
        else if(empty($NumeroAmbiente) ) {
        
            echo '<div class="alert alert-danger">
            <strong>ERROR!</strong>  El  Numero Ambiente  no puede ir vacio.
             </div>' ;
        } 
        
        
          // solo caracteres numericos  
            else if(!preg_match("/^[0-9]+$/",$NumeroAmbiente)){  
            echo '<div class="alert alert-danger">
            <strong>ERROR!</strong>  El campo Numero Ambiente debe contener solo numeros.
            </div>';
          } 
        
        
        
           else if ( $this->p > 0 ) {
            echo '<div class="alert alert-danger">
            <strong>ERROR!</strong> El Ambiente ya existe en esta ubicacion.
             </div>' ;
        }
        
        
        
        else if(empty($Cuentadante) ) {
        
            echo '<div class="alert alert-danger">
            <strong>ERROR!</strong> El documento del cuentadante  no puede ir vacio.
             </div>' ;
        } 
        
        
          // solo caracteres numericos  
            else if(!preg_match("/^[0-9]+$/",$NumeroAmbiente)){  
            echo '<div class="alert alert-danger">
            <strong>ERROR!</strong> El documento del cuentadante debe contener solo numeros.
            </div>';
          } 
                   
        
        else if ($this->e == 0) {
            echo '<div class="alert alert-danger">
            <strong>ERROR!</strong>  El Cuentadante no existe.
             </div>' ;
        }
        
        else {
            $this->view->valores = $this->model->consultarIdPersona($Cuentadante);
            $idCuentadante = $this->view->valores['idPersona'];
            $this->model->registrarAmbiente($NumeroAmbiente,$idCuentadante,$ubicacion);
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
        $Cuentadante = $_POST['Cuentadante'];
        $ubicacion = $_POST['ubicacion'];
        
        $this->comparador=$this->model->consultarAmbiente($idAmbientes);



        $this->p =$this->model->ambienteExiste($NumeroAmbiente,$ubicacion);
        
        
        
        
        $this->e =$this->model->validardocumentoexiste($Cuentadante);
        
        
        if(empty($NumeroAmbiente) ) {
        
            echo '<div class="alert alert-danger">
            <strong>ERROR!</strong>  El  Numero Ambiente  no puede ir vacio.
             </div>' ;
        } 
        
        
          // solo caracteres numericos  
            else if(!preg_match("/^[0-9]+$/",$NumeroAmbiente)){  
            echo '<div class="alert alert-danger">
            <strong>ERROR!</strong>  El campo Numero Ambiente debe contener solo numeros.
            </div>';
          } 
        
        
        
           else if ( $this->comparador['Ubicacion_idUbicacion'] != $ubicacion && $this->p > 0 ) {
            echo '<div class="alert alert-danger">
            <strong>ERROR!</strong> El Ambiente ya existe en esta ubicacion.
             </div>' ;
        }

        else if ( $this->comparador['Numero_Ambiente'] != $NumeroAmbiente && $this->p > 0 ) {
          echo '<div class="alert alert-danger">
          <strong>ERROR!</strong> El Ambiente ya existe en esta ubicacion.
           </div>' ;
      }
        
        
        
        else if(empty($Cuentadante) ) {
        
            echo '<div class="alert alert-danger">
            <strong>ERROR!</strong> El documento del cuentadante  no puede ir vacio.
             </div>' ;
        } 
        
        
          // solo caracteres numericos  
            else if(!preg_match("/^[0-9]+$/",$NumeroAmbiente)){  
            echo '<div class="alert alert-danger">
            <strong>ERROR!</strong> El documento del cuentadante debe contener solo numeros.
            </div>';
          } 
                   
        
        else if ($this->e == 0) {
            echo '<div class="alert alert-danger">
            <strong>ERROR!</strong>  El Cuentadante no existe.
             </div>' ;
        }
        
        else {
            $this->view->valores = $this->model->consultarIdPersona($Cuentadante);
            $NCuentadante = $this->view->valores['idPersona'];
            $this->model->actualizarAmbiente($NumeroAmbiente,$NCuentadante,$ubicacion,$idAmbientes);
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
                  <th>Realizador por</th>
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


    

    








}

?>