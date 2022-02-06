<?php
if($_SESSION['tipo_sdrtc']<1 || $_SESSION['tipo_sdrtc']>2 ){
    echo $lc->forzar_cierre_sesion_controlador();
    exit();
}
?>

<!-- Page header -->
<div class="full-box page-header">
    <h3 class="text-left">
        <i class="fas fa-sync-alt fa-fw"></i> &nbsp; ACTUALIZAR COMPUTADORA
    </h3>
    <p class="text-justify">
        <h5>En esta vista podrá modificar las computadoras registradas.</h5>
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
            <a href="<?php echo SERVERURL;?>compu-search"><i class="fas fa-search"></i> &nbsp;BUSQUEDA</a>
        </li>
    </ul>   
</div>

<!-- Content here-->
<div class="container-fluid">
    <?php
    require_once "./controladores/equipoControlador.php";

    $ins_equipo= new equipoControlador();
    $datos_equipo=$ins_equipo->datos_equipo_controlador("Unico",$pagina[1]);

    if($datos_equipo->rowCount()==1){
        $campos=$datos_equipo->fetch();

        ?>
        <form class="form-neon FormularioAjax" action="<?php echo SERVERURL;?>ajax/equipoAjax.php" method="POST" data-form="update" autocomplete="off">
            <input type="hidden" name="equipo_id_up" value="<?php  echo $pagina[1]; ?>">
            <fieldset>
                <legend><i class="fas fa-user"></i> &nbsp; Información básica</legend>
                <div class="container-fluid">
                    <div class="row">                       
                        
                     <div class="col-12 col-md-3">
                        <div class="form-group">
                            <label for="compu_tipo" class="bmd-label-floating">Tipo computadora</label>
                            <select class="form-control" name="compu_tipo_up" >


                                <option value="UNIDAD CENTRAL DE PROCESO - CPU" <?php if($campos['tipo_compu']=="escritorio"){echo 'selected=""';}?>>PC de escritorio<?php if($campos['tipo_compu']=="escritorio"){echo '(actual)';}?></option>


                                <option value="COMPUTADORA PERSONAL PORTATIL" <?php if($campos['tipo_compu']=="portatil"){echo 'selected=""';}?>>PC portatil<?php if($campos['tipo_compu']=="portatil"){echo '(actual)';}?></option>


                                <option value="MONITOR CON PROCESADOR INTEGRADO" <?php if($campos['tipo_compu']=="allinone"){echo 'selected=""';}?>>All in one<?php if($campos['tipo_compu']=="allinone"){echo '(actual)';}?></option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-12 col-md-3">
                        <div class="form-group">
                            <label for="equipo_estado" class="bmd-label-floating">Estado</label>
                            <select class="form-control" name="equipo_estado_up" >

                                <option value="Bueno" <?php if($campos['estado']=="Bueno"){echo 'selected=""';}?>>Bueno<?php if($campos['estado']=="Bueno"){echo '(actual)';}?></option>


                                <option value="Regular" <?php if($campos['estado']=="Regular"){echo 'selected=""';}?>>Regular<?php if($campos['estado']=="Regular"){echo '(actual)';}?></option>


                                <option value="Malo" <?php if($campos['estado']=="Malo"){echo 'selected=""';}?>>Malo<?php if($campos['estado']=="Malo"){echo '(actual)';}?></option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-md-5">
                        <div class="form-group">
                            <label for="equipo_procesador" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,150}" class="bmd-label-floating">Ingrese el procesador</label>
                            <input type="text"  class="form-control" name="equipo_procesador_up" value="<?php echo $campos['procesador']; ?>" id="equipo_procesador" maxlength="50" >
                        </div>
                    </div>
                    <div class="col-12 col-md-2">
                        <div class="form-group">
                            <label for="equipo_ram" class="bmd-label-floating">Memoria Ram</label>
                            <input type="text" pattern="[0-9]{1,8}" class="form-control" name="equipo_ram_up" value="<?php echo $campos['ram']; ?>" id="equipo_ram" maxlength="8">
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="form-group">
                            <label for="equipo_so" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,150}" class="bmd-label-floating">Ingrese el sistema operativo</label>
                            <input type="text"  class="form-control" name="equipo_so_up" value="<?php echo $campos['sistema_operativo']; ?>" id="equipo_so" maxlength="50" >
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="form-group">
                            <label for="equipo_disco" class="bmd-label-floating">Capacidad de disco duro</label>
                            <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,150}" class="form-control" name="equipo_disco_up" value="<?php echo $campos['capacidad_disco_duro']; ?>" id="equipo_disco" maxlength="10">
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="form-group">
                            <label for="equipo_tarjeta" class="bmd-label-floating">Describa la tarjeta de video</label>
                            <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,150}" class="form-control" name="equipo_tarjeta_up" value="<?php echo $campos['tarjeta_video']; ?>" id="equipo_tarjeta" maxlength="50">  
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="form-group">
                            <label for="equipo_pantalla" class="bmd-label-floating">Ingrese pulgadas de pantalla</label>
                            <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,150}" class="form-control" name="equipo_pantalla_up" value="<?php echo $campos['pantalla']; ?>" id="equipo_pantalla" maxlength="4"> 
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="form-group">
                            <label for="equipo_modelo" class="bmd-label-floating">Ingrese Modelo</label>
                            <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,150}" class="form-control" name="equipo_modelo_up" value="<?php echo $campos['modelo']; ?>" id="equipo_modelo" maxlength="50">    
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="form-group">
                            <label for="equipo_fecha">Fecha de adquisicion</label>
                            <input type="text" class="form-control" name="equipo_fecha_up" value="<?php echo $campos['anio_adquisicion']; ?>" id="equipo_fecha">
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="form-group">
                            <label for="equipo_ip" class="bmd-label-floating">Direccion IP</label>
                            <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,150}" class="form-control" name="equipo_ip_up" value="<?php echo $campos['direccion_ip']; ?>" id="equipo_ip" maxlength="50">    
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="form-group">
                            <label for="equipo_area" class="bmd-label-floating">Area</label>
                            <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,150}" class="form-control" name="equipo_area_up" value="<?php echo $campos['area_designada']; ?>" id="equipo_area" maxlength="50">    
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