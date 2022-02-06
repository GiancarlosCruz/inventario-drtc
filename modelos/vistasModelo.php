<?php

    class vistasModelo{
        /*----------- Modelo Obtener vistas-----------*/
        protected static function obtener_vistas_modelo($vistas){
            $listablanca=["home","user-list","user-new","user-search","user-update","equipo-list","equipo-new","equipo-search","equipo-update","switch-list","switch-search","switch-update","compu-list","compu-search","compu-update","impre-list","impre-search","impre-update","mante-list","mante-new","mante-search","mante-update"];
            if(in_array($vistas, $listablanca)){
                if(is_file("./vistas/contenidos/".$vistas."-view.php")){
                    $contenido="./vistas/contenidos/".$vistas."-view.php";
                }else{
                    $contenido="404";
                }
            }elseif($vistas=="login" || $vistas=="index"){
                $contenido="login";
            }else{
                $contenido="404";
            }
            return $contenido;
        }
    }