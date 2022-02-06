<!-- Page header -->
<?php 
if($_SESSION['tipo_sdrtc']!=1){
	echo $lc->forzar_cierre_sesion_controlador();
	exit();
}
?>

<div class="full-box page-header">
	<h3 class="text-left">
		<i class="fas fa-plus fa-fw"></i> &nbsp; NUEVO EQUIPO DE COMPUTO
	</h3>
	<p class="text-justify">
		<h5>En esta vista podrá hacer un nuevo registro del equipo de computo que seleccione.</h5> 
	</p>
    <p class="text-justify">
        Segun el tipo de equipo que seleccione guardara los datos pertinentes. 
        <br>Datos que no correspondan no se registraran   
    </p>
</div>

<div class="container-fluid">
    <ul class="full-box list-unstyled page-nav-tabs">
        <li>
            <a class="active" href="<?php echo SERVERURL;?>equipo-new/"><i class="fas fa-plus fa-fw"></i> &nbsp; NUEVO EQUIPO DE COMPUTO</a>
        </li>
       <li>
            <a href="<?php echo SERVERURL;?>compu-search"><i class="fas fa-search"></i> &nbsp; BUSCAR COMPUTADORA</a>
        </li>
        <li>
            <a href="<?php echo SERVERURL;?>impre-search"><i class="fas fa-search"></i> &nbsp; BUSCAR IMPRESORA</a>
        </li>
        <li>
            <a href="<?php echo SERVERURL;?>switch-search"><i class="fas fa-search"></i> &nbsp; BUSCAR SWITCH</a>
        </li>        
    </ul>	
</div>

<!-- Content -->
<div class="container-fluid">
	<form class="form-neon FormularioAjax" action="<?php echo SERVERURL;?>ajax/equipoAjax.php" method="POST" data-form="save" autocomplete="off">
		<fieldset>
			<legend><i class="far fa-address-card"></i> &nbsp; Información General</legend>
			<div class="container-fluid">
				<div class="row">
					<div class="col-12 col-md-3">
                        <div class="form-group">
                        <label for="equipo_tipo" class="bmd-label-floating">Tipo de equipo de computo</label>
                            <select class="form-control" name="equipo_tipo_reg" >
                                <option value="" selected="" disabled="">Seleccione una opción</option>
                                <option value="Computadora">Computadora</option>
                                <option value="Impresora">Impresora</option>
                                <option value="Switch">Switch</option>
                            </select>
                        </div>
                   </div>                           
                	<div class="col-12 col-md-3">
                        <div class="form-group">
                        <label for="compu_tipo" class="bmd-label-floating">Tipo computadora</label>
                            <select class="form-control" name="compu_tipo_reg" >
                                <option value="" selected="" disabled="">Seleccione una opción</option>
                                <option value="UNIDAD CENTRAL DE PROCESO - CPU">PC de escritorio</option>
                                <option value="COMPUTADORA PERSONAL PORTATIL">PC portatil</option>
                                <option value="MONITOR CON PROCESADOR INTEGRADO">All in one</option>
                            </select>   
                        </div>
                    </div>
                
                 	<div class="col-12 col-md-3">
                        <div class="form-group">
                        <label for="impre_tipo" class="bmd-label-floating">Tipo impresora</label>
                            <select class="form-control" name="impre_tipo_reg" >
                                <option value="" selected="" disabled="">Seleccione una opción</option>
                                <option value="Impresora láser">Impresora láser</option>
                                <option value="Impresora láser monocromo">Impresora láser monocromo</option>
                                <option value="Impresora láser a color">Impresora láser a color</option>
                                <option value="Impresora láser multifunción">Impresora láser multifunción</option>
                                <option value="Impresora de inyección de tinta">Impresora de inyección de tinta</option>
                                <option value="Impresora de inyección monocromas">Impresora de inyección monocromas</option>
                                <option value="Impresora de inyección a color">Impresora de inyección a color</option>
                                <option value="Impresora de inyección multifunción">Impresora de inyección multifunción</option>
                            </select>
                        </div>
                    </div>
                                    
					<div class="col-12 col-md-5">
						<div class="form-group">
							<label for="equipo_procesador" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,150}" class="bmd-label-floating">Ingrese el procesador</label>
							<input type="text"  class="form-control" name="equipo_procesador_reg" id="equipo_procesador" maxlength="50" >
						</div>
					</div>
					<div class="col-12 col-md-2">
                        <div class="form-group">
                            <label for="equipo_ram" class="bmd-label-floating">Memoria Ram</label>
                            <input type="text" pattern="[0-9]{1,8}" class="form-control" name="equipo_ram_reg" id="equipo_ram" maxlength="8">
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
						<div class="form-group">
							<label for="equipo_so" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,150}" class="bmd-label-floating">Ingrese el sistema operativo</label>
							<input type="text"  class="form-control" name="equipo_so_reg" id="equipo_so" maxlength="50" >
						</div>
					</div>
					<div class="col-12 col-md-3">
                        <div class="form-group">
                            <label for="equipo_disco" class="bmd-label-floating">Capacidad de disco duro</label>
                            <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,150}" class="form-control" name="equipo_disco_reg" id="equipo_disco" maxlength="10">
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="form-group">
                            <label for="equipo_tarjeta" class="bmd-label-floating">Describa la tarjeta de video</label>
                            <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,150}" class="form-control" name="equipo_tarjeta_reg" id="equipo_tarjeta" maxlength="50">	
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="form-group">
                            <label for="equipo_pantalla" class="bmd-label-floating">Ingrese pulgadas de la pantalla</label>
                            <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,4}" class="form-control" name="equipo_pantalla_reg" id="equipo_pantalla" maxlength="4">	
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="form-group">
                            <label for="equipo_marca" class="bmd-label-floating">Ingrese Marca</label>
                            <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,150}" class="form-control" name="equipo_marca_reg" id="equipo_marca" maxlength="50">	
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="form-group">
                            <label for="equipo_modelo" class="bmd-label-floating">Ingrese Modelo</label>
                            <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,150}" class="form-control" name="equipo_modelo_reg" id="equipo_modelo" maxlength="50">	
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="form-group">
                            <label for="equipo_puertos" class="bmd-label-floating">Ingrese cantidad de puertos</label>
                            <input type="text" pattern="[0-9]{1,8}" class="form-control" name="equipo_puertos_reg" id="equipo_puertos" maxlength="50">	
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="form-group">
                            <label for="equipo_color" class="bmd-label-floating">Ingrese color</label>
                            <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,150}" class="form-control" name="equipo_color_reg" id="equipo_color" maxlength="50">	
                        </div>
                    </div>
                   <div class="col-12 col-md-3">
                        <div class="form-group">
                        <label for="equipo_estado" class="bmd-label-floating">Estado</label>
                            <select class="form-control" name="equipo_estado_reg" >
                                <option value="" selected="" disabled="">Seleccione una opción</option>
                                <option value="Bueno">Bueno</option>
                                <option value="Regular">Regular</option>
                                <option value="Malo">Malo</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                            <div class="form-group">
                                <label for="equipo_fecha">Fecha de adquisicion</label>
                                <input type="date" class="form-control" name="equipo_fecha_reg" id="equipo_fecha">
                            </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="form-group">
                            <label for="equipo_ip" class="bmd-label-floating">Direccion IP</label>
                            <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,150}" class="form-control" name="equipo_ip_reg" id="equipo_ip" maxlength="50">	
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="form-group">
                            <label for="equipo_area" class="bmd-label-floating">Area</label>
                            <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,150}" class="form-control" name="equipo_area_reg" id="equipo_area" maxlength="50">	
                        </div>
                    </div>                    
				</div>
			</div>
		</fieldset>
		
		<p class="text-center" style="margin-top: 40px;">
			<button type="reset" class="btn btn-raised btn-secondary btn-sm"><i class="fas fa-paint-roller"></i> &nbsp; LIMPIAR</button>
			&nbsp; &nbsp;
			<button type="submit" class="btn btn-raised btn-info btn-sm"><i class="far fa-save"></i> &nbsp; GUARDAR</button>
		</p>
	</form>
</div>