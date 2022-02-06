<!-- Page header -->
<?php 
    if($_SESSION['tipo_sdrtc']!=1){
        echo $lc->forzar_cierre_sesion_controlador();
        exit();
    }
?>
<div class="full-box page-header">
    <h3 class="text-left">
        <i class="fas fa-search fa-fw"></i> &nbsp; BUSCAR IMPRESORA
    </h3>
    <p class="text-justify">
       <h5> En esta vista podrá buscar las impresoras registradas.</h5>
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
            <a class="active" href="<?php echo SERVERURL;?>impre-search"><i class="fas fa-search"></i> &nbsp;BUSQUEDA</a>
        </li>
    </ul>
</div>

<?php
    if(!isset($_SESSION['busqueda_impre']) && empty($_SESSION['busqueda_impre'])){
?>
<!-- Content -->
<div class="container-fluid">
    <form class="form-neon FormularioAjax" action="<?php echo SERVERURL;?>ajax/buscadorAjax.php" method="POST" data-form="default" autocomplete="off">
        <input type="hidden" name="modulo" value="impre">
        <div class="container-fluid">
            <div class="row justify-content-md-center">
                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label for="inputSearch" class="bmd-label-floating">¿Qué impresora estas buscando?</label>
                        <input type="text" class="form-control" name="busqueda_inicial" id="inputSearch" maxlength="30">
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
    <form class="FormularioAjax" action="<?php echo SERVERURL;?>ajax/buscadorAjax.php" method="POST" data-form="search" autocomplete="off">
        <input type="hidden" name="modulo" value="impre">
        <input type="hidden" name="eliminar_busqueda" value="eliminar">
        <div class="container-fluid">
            <div class="row justify-content-md-center">
                <div class="col-12 col-md-6">
                    <p class="text-center" style="font-size: 20px;">
                        Resultados de la busqueda <strong>“<?php echo $_SESSION['busqueda_impre'];?>”</strong>
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
        require_once "./controladores/equipoControlador.php";
        $ins_compu = new equipoControlador();
        echo $ins_compu->paginador_impresora_busqueda_controlador($pagina[1],15,$_SESSION['tipo_sdrtc'],$pagina[0],$_SESSION['busqueda_impre']);
   ?>
</div>
<?php
    }
?>