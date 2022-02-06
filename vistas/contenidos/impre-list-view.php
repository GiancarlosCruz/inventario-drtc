<!-- Page header -->
<?php 
    if($_SESSION['tipo_sdrtc']!=1){
        echo $lc->forzar_cierre_sesion_controlador();
        exit();
    }
?>
<div class="full-box page-header">
    <h3 class="text-left">
        <i class="far fa-calendar-alt fa-fw"></i> &nbsp; LISTA DE IMPRESORAS
    </h3>
    <p class="text-justify">
         <h5>En esta vista podrá visualizar las impresoras registradas.</h5>
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
<!-- Content -->
<div class="container-fluid">
<?php
        require_once "./controladores/equipoControlador.php";
        $ins_equipo = new equipoControlador();
        echo $ins_equipo->paginador_impresora_controlador($pagina[1],15,$_SESSION['tipo_sdrtc'],$pagina[0],"Impresora","","");
   ?>
</div>