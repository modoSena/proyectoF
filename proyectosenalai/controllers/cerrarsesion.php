<?php

class cerrarsesion extends Controller{

    function __construct()
    {
        
        session_start();
        session_destroy();
        header('Location:'.constant('URL').'login');
        
    }




}


?>