<?php
if($_SESSION['tipo_sdrtc']<1 || $_SESSION['tipo_sdrtc']>2 ){
    echo $lc->forzar_cierre_sesion_controlador();
    exit();
}
?>

<!-- Page header -->
<div class="full-box page-header">
    <h3 class="text-left">
        <i class="fas fa-sync-alt fa-fw"></i> &nbsp; ACTUALIZAR IMPRESORA
    </h3>
    <p class="text-justify">
       <h5> En esta vista podrá modifcar las impresoras registradas.</h5>
    </p>
</div>

<div class="container-fluid">
    <ul class="full-box list-unstyled page-nav-tabs">
        <li>
            <a href="<?php echo SERVERURL;?>home/"><i class="fab fa-dashcube fa-fw"></i> &nbsp; MENU PRINCIPAL</a>
        </li>
        <li>
            <a  href="<?php echo SERVERURL;?>equipo-new/"><i class="fas fa-plus fa-fw"></i> &nbsp; NUEVO EQUIPO DE COMPUTO</a>
        </li>            
        <li>
            <a href="<?php echo SERVERURL;?>impre-search"><i class="fas fa-search"></i> &nbsp;BUSQUEDA</a>
        </li>
    </ul>
</div>

<!-- Content here-->
<div class="container-fluid">
    <?php
    require_once "./controladores/equipoControlador.php";

    $ins_impre= new equipoControlador();
    $datos_impre=$ins_impre->datos_equipo_controlador("Unico",$pagina[1]);

    if($datos_impre->rowCount()==1){
        $campos=$datos_impre->fetch();

        ?>
        <form class="form-neon FormularioAjax" action="<?php echo SERVERURL;?>ajax/equipoAjax.php" method="POST" data-form="update" autocomplete="off">
            <input type="hidden" name="impresora_id_up" value="<?php  echo $pagina[1]; ?>">
            <fieldset>
                <legend><i class="fas fa-user"></i> &nbsp; Información básica</legend>
                <div class="container-fluid">
                    <div class="row">                       
                    <div class="col-12 col-md-3">
                        <div class="form-group">
                            <label for="impre_tipo" class="bmd-label-floating">Tipo impresora</label>
                            <select class="form-control" name="impre_tipo_up" >

                                <option value="impre_laser" <?php if($campos['tipo_impre']=="impre_laser"){echo 'selected=""';}?>>Impresora láser<?php if($campos['tipo_impre']=="impre_laser"){echo '(actual)';}?></option>

                                <option value="impre_mono" <?php if($campos['tipo_impre']=="impre_mono"){echo 'selected=""';}?>>Impresora láser monocromo<?php if($campos['tipo_impre']=="impre_mono"){echo '(actual)';}?></option>

                                <option value="impre_laser_color" <?php if($campos['tipo_impre']=="impre_laser_color"){echo 'selected=""';}?>>Impresora láser a color<?php if($campos['tipo_impre']=="impre_laser_color"){echo '(actual)';}?></option>

                                <option value="impre_laser_multi" <?php if($campos['tipo_impre']=="impre_laser_multi"){echo 'selected=""';}?>>Impresora láser multifunción<?php if($campos['tipo_impre']=="impre_laser_multi"){echo '(actual)';}?></option>

                                <option value="impre_inye_tinta" <?php if($campos['tipo_impre']=="impre_inye_tinta"){echo 'selected=""';}?>>Impresora de inyección de tinta<?php if($campos['tipo_impre']=="impre_inye_tinta"){echo '(actual)';}?></option>

                                <option value="impre_inye_mono" <?php if($campos['tipo_impre']=="impre_inye_mono"){echo 'selected=""';}?>>Impresora de inyección monocromas<?php if($campos['tipo_impre']=="impre_inye_mono"){echo '(actual)';}?></option>

                                <option value="impre_inye_color" <?php if($campos['tipo_impre']=="impre_inye_color"){echo 'selected=""';}?>>Impresora de inyección a color<?php if($campos['tipo_impre']=="impre_inye_color"){echo '(actual)';}?></option>


                                <option value="impre_inye_multi" <?php if($campos['tipo_impre']=="impre_inye_multi"){echo 'selected=""';}?>>Impresora de inyección multifunción<?php if($campos['tipo_impre']=="impre_inye_multi"){echo '(actual)';}?></option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="form-group">
                            <label for="impre_estado" class="bmd-label-floating">Estado</label>
                            <select class="form-control" name="impre_estado_up" >

                                <option value="Bueno" <?php if($campos['estado']=="Bueno"){echo 'selected=""';}?>>Bueno<?php if($campos['estado']=="Bueno"){echo '(actual)';}?></option>


                                <option value="Regular" <?php if($campos['estado']=="Regular"){echo 'selected=""';}?>>Regular<?php if($campos['estado']=="Regular"){echo '(actual)';}?></option>


                                <option value="Malo" <?php if($campos['estado']=="Malo"){echo 'selected=""';}?>>Malo<?php if($campos['estado']=="Malo"){echo '(actual)';}?></option>
                            </select>
                        </div>
                    </div>                                                                                
                    <div class="col-12 col-md-4">
                        <div class="form-group">
                            <label for="impre_marca" class="bmd-label-floating">Ingrese Marca</label>
                            <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,150}" class="form-control" name="impre_marca_up" value="<?php echo $campos['marca']; ?>" id="impre_marca" maxlength="50">  
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="form-group">
                            <label for="impre_modelo" class="bmd-label-floating">Ingrese Modelo</label>
                            <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,150}" class="form-control" name="impre_modelo_up" value="<?php echo $campos['modelo']; ?>" id="impre_modelo" maxlength="50">    
                        </div>
                    </div>                
                    <div class="col-12 col-md-4">
                        <div class="form-group">
                            <label for="impre_color" class="bmd-label-floating">Ingrese color</label>
                            <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,150}" class="form-control" name="impre_color_up" value="<?php echo $campos['color']; ?>" id="impre_color" maxlength="50">  
                        </div>
                    </div>
                    
                    <div class="col-12 col-md-3">
                        <div class="form-group">
                            <label for="impre_fecha">Fecha de adquisicion</label>
                            <input type="text" class="form-control" name="impre_fecha_up" value="<?php echo $campos['anio_adquisicion']; ?>" id="impre_fecha">
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="form-group">
                            <label for="impre_ip" class="bmd-label-floating">Direccion IP</label>
                            <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,150}" class="form-control" name="impre_ip_up" value="<?php echo $campos['direccion_ip']; ?>" id="impre_ip" maxlength="50">    
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="form-group">
                            <label for="impre_area" class="bmd-label-floating">Area</label>
                            <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,150}" class="form-control" name="impre_area_up" value="<?php echo $campos['area_designada']; ?>" id="impre_area" maxlength="50">    
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