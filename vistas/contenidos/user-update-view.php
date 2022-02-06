
<?php
    if($lc->encryption($_SESSION['id_sdrtc'])!=$pagina[1]){
        if($_SESSION['tipo_sdrtc']!=1){
            echo $lc->forzar_cierre_sesion_controlador();
            exit();
        }
    }
?>
<!-- Page header -->
<div class="full-box page-header">
    <h3 class="text-left">
        <i class="fas fa-sync-alt fa-fw"></i> &nbsp; ACTUALIZAR USUARIO
    </h3>
    <p class="text-justify">
        <h5>En esta vista podrá modifcar usuarios registrados.</h5>
    </p>
</div>

<?php if($_SESSION['tipo_sdrtc']==1){ ?>
<div class="container-fluid">
    <ul class="full-box list-unstyled page-nav-tabs">
        <li>
            <a href="<?php echo SERVERURL;?>user-new/"><i class="fas fa-plus fa-fw"></i> &nbsp; NUEVO USUARIO</a>
        </li>
        <li>
            <a href="<?php echo SERVERURL;?>user-list/"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTA DE USUARIOS</a>
        </li>
        <li>
            <a href="<?php echo SERVERURL;?>user-search/"><i class="fas fa-search fa-fw"></i> &nbsp; BUSCAR USUARIO</a>
        </li>
    </ul>	
</div>
<?php }?>

<!-- Content -->
<div class="container-fluid">
    <?php 
        require_once "./controladores/usuarioControlador.php";
        $ins_usuario = new usuarioControlador();

        $datos_usuario=$ins_usuario->datos_usuario_controlador("Unico",$pagina[1]);

        if($datos_usuario->rowCount()==1){
            $campos=$datos_usuario->fetch();
        
    ?>
    <form class="form-neon FormularioAjax" action="<?php echo SERVERURL;?>ajax/usuarioAjax.php" method="POST" data-form="update" autocomplete="off">
        <input type="hidden" name="usuario_id_up" value="<?php echo $pagina[1] ?>">
        <fieldset>
            <legend><i class="far fa-address-card"></i> &nbsp; Información General</legend>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="usuario_nombre" class="bmd-label-floating">Nombres y Apellidos</label>
                            <input type="text"  class="form-control" name="usuario_nombre_up" id="usuario_nombre" maxlength="35" value="<?php echo $campos['NombreCompleto']?>">
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="usuario_usuario" class="bmd-label-floating">Nombre de usuario</label>
                            <input type="text" pattern="[a-zA-Z0-9]{5,35}" class="form-control" name="usuario_usuario_up" id="usuario_usuario" maxlength="35" required="" value="<?php echo $campos['nombre_usuario']?>">
                        </div>
                    </div>
                    
                    <?php if($_SESSION['tipo_sdrtc']==1 && $campos['id_usuario']!=1){?>
                        <div class="col-12">
                            <div class="form-group">
                                <span>Estado de la cuenta &nbsp; <?php if($campos['estado_usuario']=="Activo"){
                                    echo '<span class="badge badge-info">Activo</span></span>';
                                    }else{
                                    echo '<span class="badge badge-danger">Inactivo</span></span>';
                                    }?>
                                <select class="form-control" name="usuario_estado_up" >
                                    <option value="Activo" <?php if($campos['estado_usuario']=="Activo"){echo 'selected=""';} ?>>Activo</option>
                                    <option value="Inactivo" <?php if($campos['estado_usuario']=="Inactivo"){echo 'selected=""';} ?>>Inactivo</option>
                                </select>
                            </div>
                        </div>
                    <?php } ?>
                    

                </div>
            </div>
        </fieldset>
        <br><br><br>
        <fieldset>
        <legend><i class="fas fa-lock"></i> &nbsp; Nueva Contraseña</legend>
        <p>Para actualizar la contraseña de esta cuenta ingrese una nueva y confirme. En caso de no desee actualizar la contraseña debe dejar los campos vacios.</p>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                                <label for="usuario_clave_nueva_1" class="bmd-label-floating">Contraseña Nueva</label>
                                <input type="password" class="form-control" name="usuario_clave_nueva_1" id="usuario_clave_nueva_1" pattern="[a-zA-Z0-9$@.-]{4,100}" maxlength="100"  >
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                                <label for="usuario_clave_nueva_2" class="bmd-label-floating">Repetir contraseña Nueva</label>
                                <input type="password" class="form-control" name="usuario_clave_nueva_2" id="usuario_clave_nueva_2" pattern="[a-zA-Z0-9$@.-]{4,100}" maxlength="100"  >
                        </div>
                    </div>
                </div>
            </div>
        </fieldset>

        <?php if($_SESSION['tipo_sdrtc']==1 && $campos['id_usuario']!=1){?>
        <br><br><br>
        <fieldset>
            <legend><i class="fas fa-medal"></i> &nbsp; Tipo de Usuario</legend>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <p><span class="badge badge-info">Administrador</span> Permisos para registrar, actualizar y eliminar</p>
                        <p><span class="badge badge-success">Asistente</span> Permisos para registrar y actualizar</p>
                        <p><span class="badge badge-dark">Invitado</span> Solo permisos para registrar</p>
                        <div class="form-group">
                            <select class="form-control" name="usuario_tipo_up" >
                                <option value="1" <?php if($campos['tipo_usuario']==1){echo 'selected=""';}?>>
                                Administrador <?php if($campos['tipo_usuario']==1){echo '(actual)';}?></option>

                                <option value="2" <?php if($campos['tipo_usuario']==2){echo 'selected=""';}?>>
                                Asistente <?php if($campos['tipo_usuario']==2){echo '(actual)';}?></option>

                                <option value="3" <?php if($campos['tipo_usuario']==3){echo 'selected=""';}?>>
                                Invitado <?php if($campos['tipo_usuario']==3){echo '(actual)';}?></option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </fieldset>
        <?php } ?>
        <p class="text-center" style="margin-top: 40px;">
            <button type="submit" class="btn btn-raised btn-success btn-sm"><i class="fas fa-sync-alt"></i> &nbsp; ACTUALIZAR</button>
        </p>
    </form>

    <?php }else{ ?>

    <div class="alert alert-danger text-center" role="alert">
        <p><i class="fas fa-exclamation-triangle fa-5x"></i></p>
        <h4 class="alert-heading">¡Ocurrió un error inesperado!</h4>
        <p class="mb-0">Lo sentimos, no podemos mostrar la información solicitada debido a un error.</p>
    </div>
    <?php } ?>
</div>