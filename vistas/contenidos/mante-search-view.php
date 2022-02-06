<!-- Page header -->
<div class="full-box page-header">
    <h3 class="text-left">
        <i class="fas fa-search fa-fw"></i> &nbsp; BUSCAR MATENIMIENTO
    </h3>
    <p class="text-justify">
    <h5>En esta vista podrá buscar los mantenimientos resgistrados.</h5>
    </p>
</div>

<div class="container-fluid">
    <ul class="full-box list-unstyled page-nav-tabs">
        <li>
            <a href="<?php echo SERVERURL;?>mante-new/"><i class="fas fa-plus fa-fw"></i> &nbsp; NUEVO MANTENIMIENTO</a>
        </li>
        <li>
            <a  href="<?php echo SERVERURL;?>mante-list/"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTA DE MANTENIMIENTOS</a>
        </li>
        <li>
            <a  class="active" href="<?php echo SERVERURL;?>mante-search/"><i class="fas fa-search fa-fw"></i> &nbsp; BUSCAR MANTENIMIENTO</a>
        </li>
    </ul>   
</div>

<?php
    if(!isset($_SESSION['fecha_inicio_mantenimiento']) && empty($_SESSION['fecha_inicio_mantenimiento']) && 
	!isset($_SESSION['fecha_final_mantenimiento']) && empty($_SESSION['fecha_final_mantenimiento'])){
?>

<div class="container-fluid">
	<form class="form-neon FormularioAjax" action="<?php echo SERVERURL;?>ajax/buscadorAjax.php" method="POST" data-form="default" autocomplete="off">
	<input type="hidden" name="modulo" value="mantenimiento">
		<div class="container-fluid">
			<div class="row justify-content-md-center">
				<div class="col-12 col-md-4">
					<div class="form-group">
						<label for="busqueda_inicio_mantenimiento" >Fecha inicial (día/mes/año)</label>
						<input type="date" class="form-control" name="fecha_inicio" id="busqueda_inicio_mantenimiento" maxlength="30">
					</div>
				</div>
				<div class="col-12 col-md-4">
					<div class="form-group">
						<label for="busqueda_final_mantenimiento" >Fecha final (día/mes/año)</label>
						<input type="date" class="form-control" name="fecha_final" id="busqueda_final_mantenimiento" maxlength="30">
					</div>
				</div>
				<div class="col-12">
					<p class="text-center" style="margin-top: 40px;">
						<button type="submit" class="btn btn-raised btn-info"><i class="fas fa-search"></i> &nbsp; BUSCAR</button>
					</p>
				</div>
			</div>
		</div>
	</form>
</div>

<?php
    }else{
?>

<div class="container-fluid">
	<form class="form-neon FormularioAjax" action="<?php echo SERVERURL;?>ajax/buscadorAjax.php" method="POST" data-form="default" autocomplete="off">
	<input type="hidden" name="modulo" value="mantenimiento">
	<input type="hidden" name="eliminar_busqueda" value="eliminar">
		<div class="container-fluid">
			<div class="row justify-content-md-center">
				<div class="col-12 col-md-6">
					<p class="text-center" style="font-size: 20px;">
						Fecha de busqueda: <strong> <?php echo date("d-m-Y",strtotime($_SESSION['fecha_inicio_mantenimiento']));?> &nbsp; a &nbsp; <?php echo date("d-m-Y",strtotime($_SESSION['fecha_final_mantenimiento']));?></strong>
					</p>
				</div>
				<div class="col-12">
					<p class="text-center" style="margin-top: 20px;">
						<button type="submit" class="btn btn-raised btn-danger"><i class="far fa-trash-alt"></i> &nbsp; ELIMINAR BÚSQUEDA</button>
					</p>
				</div>
			</div>
		</div>
	</form>
</div>


<div class="container-fluid">
	
<?php
        require_once "./controladores/mantenimientoControlador.php";
        $ins_mantenimiento = new mantenimientoControlador();
        echo $ins_mantenimiento->paginador_mantenimiento_controlador($pagina[1],15,$_SESSION['tipo_sdrtc'],$pagina[0],"busqueda",$_SESSION['fecha_inicio_mantenimiento'],$_SESSION['fecha_final_mantenimiento']);
   ?>

</div>

<?php
    }
?>