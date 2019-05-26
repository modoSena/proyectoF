<div class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container"> 
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span> 
            </button>
            <a href="<?php echo constant('URL')?>bienvenido"><img style="width:170px; height:50px;"src="<?php echo constant('URL');?>public/img/senalai.png" alt=""> </a>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
            <?php if($_SESSION['Roles_idRoles'] == 1) { ?>               
            <?php } ?>
            <?php if($_SESSION['Roles_idRoles'] == 2) { ?>   
                <li><a  href="<?php echo constant('URL');?>ambientes"><span  class="glyphicon glyphicon-home"></span> Ambientes</a></li>
            <?php } ?>
                        <?php if($_SESSION['Roles_idRoles'] == 3) { ?>
                            <li><a  href="<?php echo constant('URL');?>ambientes"><span  class="glyphicon glyphicon-home"></span> Ambientes</a></li>
                            <li> <a  href="<?php echo constant('URL');?>administrarUsuarios" ><span  class="glyphicon glyphicon-user"></span> Usuarios </a></li>
            <?php } ?>
            <?php   if ($_SESSION['Roles_idRoles'] == 4) { ?>
                <li><a  href="<?php echo constant('URL');?>ambientes"><span  class="glyphicon glyphicon-home"></span> Ambientes</a></li>                
                <li> <a  href="<?php echo constant('URL');?>administrarUsuarios" ><span  class="glyphicon glyphicon-user"></span> Usuarios </a></li>
                
                <li class="dropdown">
                 <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-shopping-cart"></i> Administrar Elementos<span class="caret"></span></a>
                 <ul class="dropdown-menu">
                 <li><a  href="<?php echo constant('URL');?>elementos" >Elementos</a></li>
                 <li> <a href="<?php echo constant('URL');?>tipoElemento" >Tipo Elementos</a></li>
                <li><a  href="<?php echo constant('URL');?>marca">Marca</a></li>
             </ul>
             </li>
             <li class="dropdown">
                 <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-cog"></i> Mantenimiento<span class="caret"></span></a>
                 <ul class="dropdown-menu">
                 <li><a  href="<?php echo constant('URL');?>tipoDocumento" >Tipo Documentos</a></li>
                <li><a  href="<?php echo constant('URL');?>programa">Programa</a></li>
             </ul>
             </li>
              <?php } ?>
              <li><a  href="<?php echo constant('URL');?>Prestamos"> <i class="glyphicon glyphicon-calendar"></i> Prestamos  </a></li>
             </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <strong> <?php echo $_SESSION['Nombre'] ?> </strong>
                        <span class="glyphicon glyphicon-chevron-down"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <div class="navbar-login">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <p class="text-center">
                                            <img src="<?php echo constant('URL');?>public/img/logousuario.png" style="width:90px; heigth:90px;" alt="">
                                        </p>
                                    </div>
                                    <div class="col-lg-8">
                                        <p class="text-left"><strong><?php  echo $_SESSION['Nombre']." ".$_SESSION['Apellido_Primero']; ?></strong></p>
                                        <p class="text-left small"><?php echo $_SESSION['Email'] ?> </p>
                                        <p class="text-left">
                                            <a href="<?php echo constant('URL');?>actualizarDatos" class="btn btn-primary btn-block btn-sm">Actúalizar Datos</a>
                                        </p>
                                        <p class="text-left">
                                            <a href="<?php echo constant('URL');?>actualizarContrasena" class="btn btn-primary btn-block btn-sm">Cambiar contraseña </a>
                                        </p>

                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <div class="navbar-login navbar-login-session">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <p>
                                            <a href="<?php echo constant('URL')?>cerrarsesion" class="btn btn-danger btn-block">Cerrar Sesion</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>