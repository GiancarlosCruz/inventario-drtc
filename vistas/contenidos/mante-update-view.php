<?php
if($_SESSION['tipo_sdrtc']<1 || $_SESSION['tipo_sdrtc']>2 ){
    echo $lc->forzar_cierre_sesion_controlador();
    exit();
}
?>

<!-- Page header -->
<div class="full-box page-header">
    <h3 class="text-left">
        <i class="fas fa-sync-alt fa-fw"></i> &nbsp; ACTUALIZAR MANTENIMIENTO
    </h3>
    <p class="text-justify">
        <h5>En esta vista podrá modificar los mantenimientos resgistrados.</h5>
    </p>
</div>

<div class="container-fluid">
    <ul class="full-box list-unstyled page-nav-tabs">
        <li>
            <a href="<?php echo SERVERURL;?>mante-new/"><i class="fas fa-plus fa-fw"></i> &nbsp; NUEVO MANTENIMIENTO</a>
        </li>
        <li>
            <a href="<?php echo SERVERURL;?>mante-list/"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTA DE MANTENIMIENTOS</a>
        </li>
        <li>
            <a  href="<?php echo SERVERURL;?>mante-search/"><i class="fas fa-search fa-fw"></i> &nbsp; BUSCAR MANTENIMIENTO</a>
        </li>
    </ul>   
</div>

<!-- Content here-->
<div class="container-fluid">
    <?php
    require_once "./controladores/mantenimientoControlador.php";

    $ins_mante= new mantenimientoControlador();
    $datos_mante=$ins_mante->datos_mantenimiento_controlador("Unico",$pagina[1]);

    if($datos_mante->rowCount()==1){
        $campos=$datos_mante->fetch();

        ?>
        <form class="form-neon FormularioAjax" action="<?php echo SERVERURL;?>ajax/manteAjax.php" method="POST" data-form="update" autocomplete="off">
            <input type="hidden" name="mante_id_up" value="<?php  echo $pagina[1]; ?>">
            <fieldset>
                <legend><i class="fas fa-user"></i> &nbsp; Información básica</legend>
                <div class="container-fluid">
                    <div class="row">                       
                        
                     <div class="col-12 col-md-3">
                        <div class="form-group">
                            <label for="mante_tipo" class="bmd-label-floating">Tipo de mantenimiento</label>
                            <select class="form-control" name="mante_tipo_up" >
                                <option value="Mantenimiento Predictivo" <?php if($campos['tipo_mantenimiento']=="Mantenimiento Predictivo"){echo 'selected=""';}?>>Mantenimiento Predictivo<?php if($campos['tipo_mantenimiento']=="Mantenimiento Predictivo"){echo '(actual)';}?></option>

                                <option value="Mantenimiento Preventivo" <?php if($campos['tipo_mantenimiento']=="Mantenimiento Preventivo"){echo 'selected=""';}?>>Mantenimiento Preventivo<?php if($campos['tipo_mantenimiento']=="Mantenimiento Preventivo"){echo '(actual)';}?></option>

                                <option value="Mantenimiento Correctivo" <?php if($campos['tipo_mantenimiento']=="Mantenimiento Correctivo"){echo 'selected=""';}?>>Mantenimiento Correctivo<?php if($campos['tipo_mantenimiento']=="Mantenimiento Correctivo"){echo '(actual)';}?></option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="form-group">
                            <label for="equipo_estado" class="bmd-label-floating">Estado</label>
                            <select class="form-control" name="equipo_estado_up" >

                                <option value="En proceso" <?php if($campos['estado_matenimiento']=="En proceso"){echo 'selected=""';}?>>En proceso<?php if($campos['estado_matenimiento']=="En proceso"){echo '(actual)';}?></option>

                                <option value="Pendiente" <?php if($campos['estado_matenimiento']=="Pendiente"){echo 'selected=""';}?>>Pendiente<?php if($campos['estado_matenimiento']=="Pendiente"){echo '(actual)';}?></option>

                                <option value="Finalizado" <?php if($campos['estado_matenimiento']=="Finalizado"){echo 'selected=""';}?>>Finalizado<?php if($campos['estado_matenimiento']=="Finalizado"){echo '(actual)';}?></option>
                            </select>
                        </div>
                    </div>
                                                                                                                    
                    <div class="col-12 col-md-4">
                        <div class="form-group">
                            <label for="descripcion_equipo" class="bmd-label-floating">Descripcion del equipo de computo</label>
                            <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,150}" class="form-control" name="descripcion_equipo_up" value="<?php echo $campos['descripcion']; ?>" id="descripcion_equipo" maxlength="100">  
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="form-group">
                            <label for="mante_observacion" class="bmd-label-floating">Si desea modifique.....</label>
                            <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,150}" class="form-control" name="mante_observacion_up" value="<?php echo $campos['observacion']; ?>" id="mante_observacion" maxlength="150">  
                        </div>
                    </div>
                                        
                    <div class="col-12 col-md-3">
                        <div class="form-group">
                            <label for="mante_fecha_entrada">Fecha de entrada</label>
                            <input type="date" class="form-control" name="mante_fecha_entrada_up" value="<?php echo $campos['fecha_entrada']; ?>" id="mante_fecha_entrada">
                        </div>
                    </div>

                    <div class="col-12 col-md-3">
                        <div class="form-group">
                            <label for="mante_hora_entrada">Hora de ingreso </label>
                            <input type="time" class="form-control" name="mante_hora_entrada_up" value="<?php echo $campos['hora_entrada']; ?>" id="mante_hora_entrada">
                        </div>
                    </div>

                    <div class="col-12 col-md-3">
                        <div class="form-group">
                            <label for="mante_fecha_salida">Fecha de salida</label>
                            <input type="date" class="form-control" name="mante_fecha_salida_up" value="<?php echo $campos['fecha_salida']; ?>" id="mante_fecha_salida">
                        </div>
                    </div>

                    <div class="col-12 col-md-3">
                        <div class="form-group">
                            <label for="mante_hora_salida">Hora de salida </label>
                            <input type="time" class="form-control" name="mante_hora_salida_up" value="<?php echo $campos['hora_salida']; ?>" id="mante_hora_salida">
                        </div>
                    </div>

                </div>
            </div>
        </fieldset>

        <br><br><br>
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