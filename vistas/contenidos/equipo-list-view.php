<!-- Page header -->
<?php 
if($_SESSION['tipo_sdrtc']!=1){
    echo $lc->forzar_cierre_sesion_controlador();
    exit();
}
?>
<div class="full-box page-header">
    <h3 class="text-left">
        <i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTA DE EQUIPOS DE COMPUTO
    </h3>
    <p class="text-justify">
        Lista de equipos de computo registrados
    </p>
</div>

<div class="container-fluid">
    <ul class="full-box list-unstyled page-nav-tabs">
        <li>
            <a href="<?php echo SERVERURL;?>equipo-new/"><i class="fas fa-plus fa-fw"></i> &nbsp; NUEVO EQUIPO DE COMPUTO</a>
        </li>
        <li>
            <a class="active" href="<?php echo SERVERURL;?>equipo-list/"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTA DE EQUIPOS DE COMPUTO</a>
        </li>
        <li>
            <a href="<?php echo SERVERURL;?>equipo-search/"><i class="fas fa-search fa-fw"></i> &nbsp; BUSCAR EQUIPO DE COMPUTO</a>
        </li>
    </ul>	
</div>
<!-- Content -->
<div class="container-fluid">
    <?php
        require_once "./controladores/equipoControlador.php";
        $ins_equipo = new equipoControlador();
        echo $ins_equipo->paginador_equipo_controlador($pagina[1],15,$_SESSION['tipo_sdrtc'],$pagina[0],"Computadora","","");
   ?>
</div>
