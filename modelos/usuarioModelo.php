<?php
require_once "mainModel.php";

class usuarioModelo extends mainModel{


    /*---------------- Modelo agregar usuario ----------------*/
    protected static function agregar_usuario_modelo($datos){
        $sql=mainModel::conectar()->prepare("INSERT INTO usuario (NombreCompleto,nombre_usuario,clave_usuario,tipo_usuario,estado_usuario)
        VALUES(:Nombre,:Nomusuario,:Clave,:Tipo,:Estado)");

        $sql->bindParam(":Nombre",$datos['nombrecompleto']);
        $sql->bindParam(":Nomusuario",$datos['usuario']);
        $sql->bindParam(":Clave",$datos['clave']);
        $sql->bindParam(":Tipo",$datos['tipo']);
        $sql->bindParam(":Estado",$datos['estado']);
        $sql->execute();
        return $sql;
    }

    /*---------Modelo eliminar usuario---------*/
    protected static function eliminar_usuario_modelo($id){
        $sql=mainModel::conectar()->prepare("DELETE FROM usuario WHERE id_usuario=:ID");
         
        $sql->bindParam(":ID",$id);
        $sql->execute();
        return $sql;
    }

    /* Modelo datos usuario */
    protected static function datos_usuario_modelo($tipo,$id){
        if($tipo=="Unico"){
            $sql=mainModel::conectar()->prepare("SELECT * FROM usuario WHERE id_usuario=:ID");

            $sql->bindParam(":ID",$id);
            $sql->execute();
            return $sql;

        }elseif($tipo=="Conteo"){

            $sql=mainModel::conectar()->prepare("SELECT id_usuario FROM usuario WHERE id_usuario!='1'");

        }
        $sql->execute();
        return $sql;
    }

    /*-------------- Modelo Actualizar usuario -------------*/
    protected static function actualizar_usuario_modelo($datos){
        $sql=mainModel::conectar()->prepare("UPDATE usuario SET NombreCompleto=:Nombre,nombre_usuario=:Usuario,clave_usuario=:Clave,tipo_usuario=:Tipo,estado_usuario=:Estado  WHERE id_usuario=:ID");
        $sql->bindParam(":Nombre",$datos['nombrecompleto']);
        $sql->bindParam(":Usuario",$datos['usuario']);
        $sql->bindParam(":Clave",$datos['clave']);
        $sql->bindParam(":Tipo",$datos['tipo']);
        $sql->bindParam(":Estado",$datos['estado']);
        $sql->bindParam(":ID",$datos['id']);

        $sql->execute();
        return $sql;
    }
    
}