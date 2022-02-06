<?php
    $peticionAjax=true;
    require_once "../config/APP.php";
    
    if(isset($_POST['equipo_tipo_reg']) || isset($_POST['equipo_id_del']) || isset($_POST['equipo_id_up']) ||
     isset($_POST['impresora_id_up']) || isset($_POST['switch_id_up'])){ 

        /*---------------- Instancia al controlador ----------------*/
        require_once "../controladores/equipoControlador.php";
        $ins_equipo = new equipoControlador();

        /*---------Agregar un equipo---------- */
        if(isset($_POST['equipo_tipo_reg'])){
            echo $ins_equipo->agregar_equipo_controlador();
        }

        /*---------Eliminar un equipo---------- */
        if(isset($_POST['equipo_id_del'])){
            echo $ins_equipo->eliminar_equipo_controlador();
        }

        /*---------Actualizar un equipo---------- */
        if(isset($_POST['equipo_id_up'])){
            echo $ins_equipo->actualizar_equipo_controlador();
        }

        /*---------Actualizar un equipo---------- */
        if(isset($_POST['impresora_id_up'])){
            echo $ins_equipo->actualizar_impresora_controlador();
        }

        /*---------Actualizar un equipo---------- */
        if(isset($_POST['switch_id_up'])){
            echo $ins_equipo->actualizar_switch_controlador();
        }

    }else{
        session_start(['name'=>'SDRTC']);
        session_unset();
        session_destroy();
        header("Location: ".SERVERURL."login/");
        exit();
    }