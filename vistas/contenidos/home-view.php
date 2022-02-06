<!-- Page header -->
<div class="full-box page-header">
    <h3 class="text-left">
        <i class="fas fa-list-alt fa-fw"></i> &nbsp; MENU PRINCIPAL
    </h3>
    <p class="text-justify">
        <h5>Acceso a las utilidades del sistema</h5>
    </p>
</div>

<!-- Content -->
<div class="full-box tile-container">    

    <?php 
    if($_SESSION['tipo_sdrtc']==1){ 
        require_once "./controladores/usuarioControlador.php";
        $ins_usuario = new usuarioControlador();
        $total_usuarios=$ins_usuario->datos_usuario_controlador("Conteo",0);
        ?>
        <a href="<?php echo SERVERURL;?>user-list/" class="tile">
            <div class="tile-tittle">Usuarios</div>
            <div class="tile-icon">
                <i class="fas fa-user-secret fa-fw"></i>
                <p><?php echo $total_usuarios->rowCount();?> Registrados</p>
            </div>
        </a>
    <?php } ?>
    <a href="<?php echo SERVERURL;?>compu-list/" class="tile">
        <div class="tile-tittle">Computadoras</div>
        <div class="tile-icon">
            <i class="fas fa-desktop"></i>
            <p> Registrados</p>
        </div>
    </a>
    <a href="<?php echo SERVERURL;?>impre-list/" class="tile">
        <div class="tile-tittle">Impresoras</div>
        <div class="tile-icon">
            <i class="fas fa-print"></i>
            <p> Registrados</p>
        </div>
    </a>
    <a href="<?php echo SERVERURL;?>switch-list/" class="tile">
        <div class="tile-tittle">Switchs</div>
        <div class="tile-icon">
            <i class="fas fa-hdd"></i>
            <p> Registrados</p>
        </div>
    </a>
</div>