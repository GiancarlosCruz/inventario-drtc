<?php
if($_SESSION['tipo_sdrtc']<1 || $_SESSION['tipo_sdrtc']>2 ){
    echo $lc->forzar_cierre_sesion_controlador();
    exit();
}
?>

<!-- Page header -->
<div class="full-box page-header">
    <h3 class="text-left">
        <i class="fas fa-sync-alt fa-fw"></i> &nbsp; ACTUALIZAR SWITCH
    </h3>
    <p class="text-justify">
        <h5>En esta vista podrá modificar los switchs registrados.</h5>
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
            <a  href="<?php echo SERVERURL;?>switch-search"><i class="fas fa-search"></i> &nbsp;BUSQUEDA</a>
        </li>
    </ul>
</div>

<!-- Content here-->
<div class="container-fluid">
    <?php
    require_once "./controladores/equipoControlador.php";

    $ins_switch= new equipoControlador();
    $datos_switch=$ins_switch->datos_equipo_controlador("Unico",$pagina[1]);

    if($datos_switch->rowCount()==1){
        $campos=$datos_switch->fetch();
        ?>
        <form class="form-neon FormularioAjax" action="<?php echo SERVERURL;?>ajax/equipoAjax.php" method="POST" data-form="update" autocomplete="off">
            <input type="hidden" name="switch_id_up" value="<?php  echo $pagina[1]; ?>">
            <fieldset>
                <legend><i class="fas fa-user"></i> &nbsp; Información básica</legend>
                <div class="container-fluid">
                    <div class="row">                                            
                    <div class="col-12 col-md-3">
                        <div class="form-group">
                            <label for="switch_estado" class="bmd-label-floating">Estado</label>
                            <select class="form-control" name="switch_estado_up" >

                                <option value="Bueno" <?php if($campos['estado']=="Bueno"){echo 'selected=""';}?>>Bueno<?php if($campos['estado']=="Bueno"){echo '(actual)';}?></option>


                                <option value="Regular" <?php if($campos['estado']=="Regular"){echo 'selected=""';}?>>Regular<?php if($campos['estado']=="Regular"){echo '(actual)';}?></option>


                                <option value="Malo" <?php if($campos['estado']=="Malo"){echo 'selected=""';}?>>Malo<?php if($campos['estado']=="Malo"){echo '(actual)';}?></option>
                            </select>
                        </div>
                    </div>                                                            
                    <div class="col-12 col-md-4">
                        <div class="form-group">
                            <label for="switch_marca" class="bmd-label-floating">Ingrese Marca</label>
                            <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,150}" class="form-control" name="switch_marca_up" value="<?php echo $campos['marca']; ?>" id="switch_marca" maxlength="50">  
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="form-group">
                            <label for="switch_modelo" class="bmd-label-floating">Ingrese Modelo</label>
                            <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,150}" class="form-control" name="switch_modelo_up" value="<?php echo $campos['modelo']; ?>" id="switch_modelo" maxlength="50">    
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="form-group">
                            <label for="switch_puertos" class="bmd-label-floating">Ingrese cantidad de puertos</label>
                            <input type="text" pattern="[0-9]{1,8}" class="form-control" name="switch_puertos_up" value="<?php echo $campos['cantidad_puertos']; ?>" id="switch_puertos" maxlength="50">  
                        </div>
                    </div>                                        
                    <div class="col-12 col-md-4">
                        <div class="form-group">
                            <label for="switch_area" class="bmd-label-floating">Area</label>
                            <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,150}" class="form-control" name="switch_area_up" value="<?php echo $campos['area_designada']; ?>" id="switch_area" maxlength="50">    
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