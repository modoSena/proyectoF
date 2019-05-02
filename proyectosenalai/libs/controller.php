<?php

class Controller{

    function __construct()
    {
       
        $this->view = new View();

    }

    function loadModel($model){

        $url = 'models/'.$model.'model.php';

        if (file_exists($url)) {
           require $url;

           $modalName = $model.'Model';
           $this->model = new $modalName;
        }

    }

    function loadmodel2($model){

        $url = 'models/'.$model.'model.php';

        if (file_exists($url)) {
           require $url;

           $modalName = $model.'Model';
           $this->model2 = new $modalName;
        }

    }

}



?>
