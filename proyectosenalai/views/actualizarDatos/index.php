<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?php echo constant('URL')?>public/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo constant('URL')?>public/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="<?php echo constant('URL')?>public/css/login.css">
    <link rel="stylesheet" type="text/css" href="<?php echo constant('URL')?>public/css/footer.css">
    <link rel="stylesheet" type="text/css" href="<?php echo constant('URL')?>public/css/header.css">
    <link rel="icon" href="<?php echo constant('URL');?>public/img/sena.png">
    <title>Sena L.A.I</title>
</head>
<body>
    <?php require('views/plantilla/header.php')  ?>
    <div class="container">
        <form class="form" id="formularioActualizarDatos">
            <h2 style="text-align: center; font-family: fantasy;">Actualizar Datos </h2>
            <hr style=" height: 1px;
            background-color: black;s" />
            <input type="hidden" value="<?php echo $this->valores['idPersona'] ?>" name="idPersona">
            <div class="form-group">
                <label for="">Nombres</label>
                <input type="text" name="Anombres" id="Anombres" disabled="disabled"  value="<?php echo $this->valores['Nombre']; ?>"
                    class="form-control " placeholder="" tabindex="3">
            </div>
            <div class="row">
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <label for="">Primer Apellido</label>
                        <input type="text" name="Aapellido_primero" id="Aapellido_primero" 
                            value="<?php echo $this->valores['Apellido_Primero']; ?>" disabled="disabled" class="form-control " placeholder=""
                            tabindex="1">
                    </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6">

                    <div class="form-group">
                        <label for="">Segundo Apellido</label>
                        <input type="text" name="Aapellido_segundo" id="Aapellido_segundo"
                            value="<?php echo $this->valores['Apellido_Segundo']; ?>" disabled="disabled" class="form-control " placeholder=""
                            tabindex="2">
                    </div>

                </div>
            </div>
            <div class="row">
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <label for="">Usuario</label>
                        <input type="text" disabled="disabled" name="Ausuario" id="Ausuario" value="<?php echo $this->valores['Usuario']; ?>"
                            class="form-control " placeholder="" tabindex="3">
                    </div>
                </div>

                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <label>Rol</label>

                        <input type="text" disabled="disabled" name="" id="" value="<?php echo $this->valores['NombreRoles']; ?>"
                            class="form-control " placeholder="" tabindex="3">

                    </div>
                </div>

                

            </div>
            <div class="row">
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <label>Tipo Documento</label>
                        <input type="text" disabled="disabled" name="" id="" value="<?php echo $this->valores['Tipo_Documento']; ?>"
                            class="form-control " placeholder="" tabindex="3">
                    </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <label for="">Núm. Documento</label>
                        <input type="text" name="" id=""   disabled="disabled"
                            value="<?php echo $this->valores['Numero_Documento']; ?>" class="form-control " placeholder=" "
                            tabindex="3">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label>Sexo actual  (<?php echo $this->valores['NombreSexo']; ?>)</label>
                <select class='form-control' id='Asexo' name='Asexo'>
                    <option value="<?php echo $this->valores['Sexo_idSexo']; ?>">selecciona:</option>
                    <?php foreach ( $this->consultarsexo as $resultado) { ?>
                    <option value="<?php echo $resultado['idSexo']; ?>"> <?php echo $resultado['NombreSexo']; ?>
                    </option>
                    <?php } ?>
                </select>
            </div>
            <div class="row">
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <label>Departamento</label>
                        <select class='form-control' id='departamento' name='departamento'>
                            <option value="">selecciona:</option>
                            <?php foreach ($this->consultardepartamento as $resultado ) { ?>
                            <option value="<?php echo $resultado['idDepartamento']; ?>">
                                <?php echo $resultado['NombreDepartamento']; ?> </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group" id="ciudades">
                        <label>Municipio actual  (<?php echo $this->valores['NombreCiudad']; ?>)</label>
                        <select class='form-control' id='ciudad' name='ciudad'>
                            <option value="<?php echo $this->valores['Ciudad_idCiudad']; ?>">Primero selecciona un
                                departamento</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="">Dirección</label>
                <input type="text" name="Adireccion" id="Adireccion" value="<?php echo $this->valores['Direccion']; ?>"
                    class="form-control " placeholder=" " tabindex="3">
            </div>
            <div class="form-group">
                <label for="">Email</label>
                <input type="email" name="Aemail" id="Aemail" value="<?php echo $this->valores['Email']; ?>"
                    class="form-control " placeholder=" " tabindex="3">
            </div>
            <div class="row">
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <label for="">Celular </label>
                        <input type="text" name="Anumero_celular" id="Anumero_celular"
                            value="<?php echo $this->valores['Numero_Celular']; ?>" class="form-control " placeholder=" "
                            tabindex="3">
                    </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <label for="">Tel Fijo</label>
                        <input type="text" name="Atelefono" id="Atelefono" value="<?php echo $this->valores['Telefono']; ?>"
                            class="form-control " placeholder=" " tabindex="3">
                    </div>
                </div>
            </div>
            <p style="text-align: center;">Nota: Los Siguientes Campos son Requeridos para el Aprendiz</p>
            <div class="row">
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <label>Programa</label>
                    <input type="text" name="Adocumento" id="Adocumento"   
                            value="<?php echo $this->valores['NombrePrograma']; ?>" disabled="disabled" class="form-control " placeholder=" "
                            tabindex="3">
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <label for="">Número Ficha</label>
                        <input type="text" disabled="disabled" name="Anumero_ficha" id="Anumero_ficha"
                            value="<?php echo $this->valores['Numero_Ficha']; ?>" class="form-control " placeholder=" "
                            tabindex="3">
                    </div>
                </div>
            </div>
            <hr />
            <div class="row">
                <div class="col-xs-6 col-md-6">
                    <input type="hidden" name="envioActualizarUsuario">
                    <input id="Asubmit" name="Asubmit" type="button" value="Actualizar"
                        class="btn btn-primary btn-block btn-lg" tabindex="7">
                </div>
                <div class="col-xs-6 col-md-6">
                    <a href="<?php echo constant('URL')?>administrarUsuarios" class="btn btn-primary btn-block btn-lg">Cancelar</a>
                </div>
            </div>
            <div id="alert"><img class="loading" id="loading" src="<?php echo constant('URL')?>public/img/loading.gif" alt=""> <span
                    id="mensajes"> </span></div>
        </form>
    </div>
    <!-- MODAL exito ACTUALIZAR USUARIO ---->
    <div data-backdrop="static" data-keyboard="false" class="modal fade" id="modalExitoActualizoUsuario" tabindex="-1"
        role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title" id="exampleModalLongTitle">Éxito</h2>
                </div>
                <div class="modal-body">
                    <p for="">Usuario actualizado correctamente.</p>
                </div>
                <div class="modal-footer">
                    <a href="<?php echo constant('URL')?>bienvenido"
                        class="btn btn-primary">Aceptar</a>
                </div>
            </div>
        </div>
    </div>
    <br>
    <?php include('views/plantilla/footer.php') ?>
    <script src="<?php echo constant('URL')?>public/js/jquery-3.3.1.min.js"></script>
    <script src="<?php echo constant('URL')?>public/js/bootstrap.min.js"></script>
</body>
</html>
<script>
$(function () {
        console.log('jquery funciona')  ;
        $('#Asubmit').click(function () {

           $.ajax({
               url:'<?php echo constant('URL')?>actualizarDatos/actualizarUsuario',
               type:'POST',
               data:$("#formularioActualizarDatos").serialize(),
               beforeSend: function() {
                $('#loading').show();
                $('#mensajes').html('procesando datos');
            },
               success:function (respuesta) {
                $('#loading').hide();
                  if (respuesta == 1) {
                    $('#modalExitoActualizoUsuario').modal("show");
                      
                  }else{
                    $('#mensajes').html(respuesta);
                  }
               }
           })
        }) 
       }   
       )
       function buscar_datos(consulta){
    $.ajax({
		url:'<?php echo constant('URL')?>administrarUsuarios/ciudadesPorDepartamento',
		type: 'POST' ,
		dataType: 'html',
		data: {consulta: consulta},
	})
	.done(function(respuesta){
		$("#ciudades").html(respuesta);
	})
	.fail(function(){
		console.log("error");
	});
}
$('select#departamento').on('change',function(){
    var valor = $(this).val();
   if (valor != "") {
       buscar_datos(valor);
   }
});
</script>