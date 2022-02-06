<!-- Page header -->
<?php 
if($_SESSION['tipo_sdrtc']!=1){
    echo $lc->forzar_cierre_sesion_controlador();
    exit();
}
?>
<div class="full-box page-header">
    <h3 class="text-left">
        <i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTA DE MANTENIMIENTO
    </h3>
    <p class="text-justify">
       <h5> En esta vista se podra vizualizar los mantenimientos registrados.</h5>
    </p>
</div>

<div class="container-fluid">
    <ul class="full-box list-unstyled page-nav-tabs">
        <li>
            <a href="<?php echo SERVERURL;?>mante-new/"><i class="fas fa-plus fa-fw"></i> &nbsp; NUEVO MANTENIMIENTO</a>
        </li>
        <li>
            <a class="active" href="<?php echo SERVERURL;?>mante-list/"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTA DE MANTENIMIENTOS</a>
        </li>
        <li>
            <a href="<?php echo SERVERURL;?>mante-search/"><i class="fas fa-search fa-fw"></i> &nbsp; BUSCAR MANTENIMIENTO</a>
        </li>
    </ul>	
</div>

<!-- Content -->
<div class="container-fluid">
<?php
        require_once "./controladores/mantenimientoControlador.php";
        $ins_mantenimiento = new mantenimientoControlador();
        echo $ins_mantenimiento->paginador_mantenimiento_controlador($pagina[1],15,$_SESSION['tipo_sdrtc'],$pagina[0],"","","");
   ?>
</div>