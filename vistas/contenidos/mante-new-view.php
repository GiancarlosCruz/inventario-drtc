<!-- Page header -->
<?php 
if($_SESSION['tipo_sdrtc']!=1){
	echo $lc->forzar_cierre_sesion_controlador();
	exit();
}
?>

<div class="full-box page-header">
	<h3 class="text-left">
		<i class="fas fa-plus fa-fw"></i> &nbsp; NUEVO MANTENIMIENTO
	</h3>
	<p class="text-justify">
		<h5> En esta vista se podra registrar nuevos mantenimientos.</h5>
	</p>
</div>

<div class="container-fluid">
    <ul class="full-box list-unstyled page-nav-tabs">
        <li>
            <a class="active" href="<?php echo SERVERURL;?>mante-new/"><i class="fas fa-plus fa-fw"></i> &nbsp; NUEVO MANTENIMIENTO</a>
        </li>
        <li>
            <a  href="<?php echo SERVERURL;?>mante-list/"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTA DE MANTENIMIENTOS</a>
        </li>
        <li>
            <a href="<?php echo SERVERURL;?>mante-search/"><i class="fas fa-search fa-fw"></i> &nbsp; BUSCAR MANTENIMIENTO</a>
        </li>
    </ul>   
</div>

<!-- Content -->
<div class="container-fluid">
            <p class="text-center roboto-medium">AGREGAR EQUIPO DE COMPUTO</p>
            <p class="text-center">

                <?php if(empty($_SESSION['datos_equipo'])){?>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ModalEquipo"><i class="fas fa-city"></i> &nbsp; Agregar Equipo</button>
                <?php }?>
            </p>
            <div>
                <span class="roboto-medium">EQUIPO:</span> 
                <?php if(empty($_SESSION['datos_equipo'])){?>
                <span class="text-danger">&nbsp; <i class="fas fa-exclamation-triangle"></i> Seleccione una equipo</span>
                <?php }else{?>   
                <form class="FormularioAjax" action="<?php echo SERVERURL;?>ajax/manteAjax.php" method="POST" data-form="loans" style="display: inline-block !important;">
                    <input type="hidden" name="id_eliminar_equipo" values="<?php $_SESSION['datos_equipo']['ID'];?>">
                    <?php echo "(".$_SESSION['datos_equipo']['Area'].") - ".$_SESSION['datos_equipo']['Tipo']." ".$_SESSION['datos_equipo']['Ip']; ?>

                    <button type="submit" class="btn btn-danger"><i class="fas fa-user-times"></i></button>
                </form>
                <?php }?>

            </div>

         
	<form class="form-neon FormularioAjax" action="<?php echo SERVERURL;?>ajax/manteAjax.php" method="POST" data-form="save" autocomplete="off">
		<fieldset>
			<legend><i class="far fa-address-card"></i> &nbsp; Información General</legend>
			<div class="container-fluid">
				<div class="row">
					<div class="col-12 col-md-3">
                        <div class="form-group">
                        <label for="mante_tipo" class="bmd-label-floating">Tipo de mantenimiento</label>
                            <select class="form-control" name="mante_tipo_reg" >
                                <option value="" selected="" disabled="">Seleccione una opción</option>
                                <option value="Mantenimiento Predictivo">Mantenimiento Predictivo</option>
                                <option value="Mantenimiento Preventivo">Mantenimiento Preventivo</option>
                                <option value="Mantenimiento Correctivo">Mantenimiento Correctivo</option>
                            </select>
                        </div>
                   </div>
                   <div class="col-12 col-md-3">
                        <div class="form-group">
                        <label for="mante_estado" class="bmd-label-floating">Estado</label>
                            <select class="form-control" name="mante_estado_reg" >
                                <option value="" selected="" disabled="">Seleccione una opción</option>
                                <option value="En proceso">En proceso</option>
                                <option value="Pendiente">Pendiente</option>
                                <option value="Finalizado">Finalizado</option>
                            </select>
                        </div>
                    </div>                                                                                                      					
                    <div class="col-12 col-md-10">
                        <div class="form-group">
                            <label for="mante_observacion" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,150}" class="bmd-label-floating">Descripción del mantenimiento</label>
                            <input type="text"  class="form-control" name="mante_observacion_reg" id="mante_observacion" maxlength="150" >
                        </div>
                    </div>					
                    <div class="col-12 col-md-3">
                            <div class="form-group">
                                <label for="mante_fecha_entrada">Fecha de entrada</label>
                                <input type="date" class="form-control" name="mante_fecha_entrada_reg" id="mante_fecha_entrada">
                            </div>
                    </div>
                    <div class="col-12 col-md-3">
                            <div class="form-group">
                                <label for="mante_hora_entrada">Hora entrada</label>
                                <input type="time" class="form-control" name="mante_hora_entrada_reg" id="mante_hora_entrada">
                            </div>
                    </div>
                    <div class="col-12 col-md-3">
                            <div class="form-group">
                                <label for="mante_fecha_salida">Fecha de salida</label>
                                <input type="date" class="form-control" name="mante_fecha_salida_reg" id="mante_fecha_salida">
                            </div>
                    </div>  
                    <div class="col-12 col-md-3">
                            <div class="form-group">
                                <label for="mante_hora_salida">Hora salida</label>
                                <input type="time" class="form-control" name="mante_hora_salida_reg" id="mante_hora_salida">
                            </div>
                    </div>                                                        
				</div>
			</div>
		</fieldset>
		<br><br><br>
		<p class="text-center" style="margin-top: 40px;">
			<button type="reset" class="btn btn-raised btn-secondary btn-sm"><i class="fas fa-paint-roller"></i> &nbsp; LIMPIAR</button>
			&nbsp; &nbsp;
			<button type="submit" class="btn btn-raised btn-info btn-sm"><i class="far fa-save"></i> &nbsp; GUARDAR</button>
		</p>
	</form>
</div>

<!-- MODAL EQUIPO -->
<div class="modal fade" id="ModalEquipo" tabindex="-1" role="dialog" aria-labelledby="ModalEquipo" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalEquipo">Agregar Equipo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="form-group">
                        <label for="input_equipo" class="bmd-label-floating">area, marca, tipo</label>
                        <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{1,30}" class="form-control" name="input_equipo" id="input_equipo" maxlength="30">
                    </div>
                </div>
                <br>
                <div class="container-fluid" id="tabla_equipos"></div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="buscar_equipo()"><i class="fas fa-search fa-fw"></i> &nbsp; Buscar</button>
                &nbsp; &nbsp;
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<?php include_once "./vistas/inc/mantenimiento.php";?>