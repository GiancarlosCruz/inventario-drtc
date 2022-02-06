<?php
   $peticionAjax=true;
   require_once "../config/APP.php";
   if(isset($_POST['buscar_equipo']) || isset($_POST['id_agregar_equipo']) || isset($_POST['id_eliminar_equipo']) ||
    isset($_POST['mante_tipo_reg']) || isset($_POST['mante_id_del']) || isset($_POST['mante_id_up'])){

       /**------------instancia al controlador--- */
        /**------------FALTA ANALIZAR PARA MODIFICAR ESTE AJAX--- */
       require_once "../controladores/mantenimientoControlador.php";
       $ins_mantenimiento =new mantenimientoControlador();

         /**------------buscar equipo--- */
       if(isset($_POST['buscar_equipo'])){
           echo $ins_mantenimiento->buscar_equipo_mantenimiento_controlador();
       }

        /**------------agregar equipo--- */
        if(isset($_POST['id_agregar_equipo'])){
            echo $ins_mantenimiento->agregar_equipo_mantenimiento_controlador();
        }

        /**------------eliminar equipo--- */
        if(isset($_POST['id_eliminar_equipo'])){
            echo $ins_mantenimiento->eliminar_equipo_mantenimiento_controlador();
        }

        //------------------------------------------------
        /*---------------- agregar mante ----------------*/
        //------------------------------------------------
        if(isset($_POST['mante_tipo_reg'])){
            echo $ins_mantenimiento->agregar_mantenimiento_controlador();
        }

        /*---------------- eliminar mante ----------------*/
        if(isset($_POST['mante_id_del'])){
            echo $ins_mantenimiento->eliminar_mantenimiento_controlador();
        }

        /*---------------- actualizar mante ----------------*/
        if(isset($_POST['mante_id_up'])){
            echo $ins_mantenimiento->actualizar_mantenimiento_controlador();
        }

    }else{
        session_start(['name'=>'SDRTC']);
        session_unset();
        session_destroy();
        header("Location: ".SERVERURL."login/");
        exit();
    }