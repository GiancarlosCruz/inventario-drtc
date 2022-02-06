<?php
require_once "mainModel.php";

class areaModelo extends mainModel{


    /*---------------- Modelo agregar area ----------------*/
    protected static function agregar_area_modelo($datos){
        $sql=mainModel::conectar()->prepare("INSERT INTO area (descripcion)
        VALUES(:Descripcion)");

        $sql->bindParam(":Descripcion",$datos['descripcion']);
        $sql->execute();
        return $sql;
    }

    /*---------Modelo eliminar area---------*/
    protected static function eliminar_area_modelo($id){
        $sql=mainModel::conectar()->prepare("DELETE FROM area WHERE id_area=:ID");
         
        $sql->bindParam(":ID",$id);
        $sql->execute();
        return $sql;
    }

    /* Modelo datos area */
    protected static function datos_area_modelo($tipo,$id){
        if($tipo=="Unico"){
            $sql=mainModel::conectar()->prepare("SELECT * FROM area WHERE id_area=:ID");

            $sql->bindParam(":ID",$id);
            $sql->execute();
            return $sql;

        }elseif($tipo=="Conteo"){

            $sql=mainModel::conectar()->prepare("SELECT id_area FROM area");

        }
        $sql->execute();
        return $sql;
    }

    /*-------------- Modelo Actualizar area -------------*/
    protected static function actualizar_area_modelo($datos){
        $sql=mainModel::conectar()->prepare("UPDATE area SET descripcion=:Descripcion  WHERE id_area=:ID");
        $sql->bindParam(":Descripcion",$datos['descripcion']);
        $sql->execute();
        return $sql;
    }
    
}