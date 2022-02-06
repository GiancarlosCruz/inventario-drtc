<?php

    require_once "mainModel.php";
    class loginModelo extends mainModel{

        /*--------------------Modelo iniciar sesion----------------------*/
        
        protected static function iniciar_sesion_modelo($datos){
            $sql=mainModel::conectar()->prepare("SELECT * FROM usuario WHERE nombre_usuario=:Usuario AND clave_usuario=:Clave AND estado_usuario='Activo'");
            $sql->bindparam(":Usuario",$datos['usuario']);
            $sql->bindparam(":Clave",$datos['clave']);
            $sql->execute();
            return $sql;
        }
    }