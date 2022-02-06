<?php
require_once "mainModel.php";

class mantenimientoModelo extends mainModel{
    /*---------------- Modelo agregar mantenimiento ----------------*/
    protected static function agregar_mantenimiento_modelo($datos){
        $sql=mainModel::conectar()->prepare("INSERT INTO mantenimiento_equipo (id_equipo_mante,tipo_mantenimiento,
        estado_matenimiento,observacion,fecha_entrada,fecha_salida,hora_entrada,hora_salida)
        VALUES(:Equipo,:Tipo,:Estado,:Observacion,:Fechainicio,:Fechafin,:Horainicio,:Horafin)");

        $sql->bindParam(":Equipo",$datos['equipo']);
        $sql->bindParam(":Tipo",$datos['tipo']);
        $sql->bindParam(":Estado",$datos['estado']);
        
        $sql->bindParam(":Observacion",$datos['observacion']);
        $sql->bindParam(":Fechainicio",$datos['inicio']);
        $sql->bindParam(":Fechafin",$datos['fin']);
        $sql->bindParam(":Horainicio",$datos['horainicio']);
        $sql->bindParam(":Horafin",$datos['horafin']);
        $sql->execute();
        return $sql;
    }

    /*---------------- Modelo eliminar mantenimiento ----------------*/
    protected static function eliminar_mantenimiento_modelo($id){
        $sql=mainModel::conectar()->prepare("DELETE FROM mantenimiento_equipo WHERE id_mante_equipo=:ID");

        $sql->bindParam(":ID",$id);
        
        $sql->execute();
        return $sql;
    }

    /*---------------- Modelo datos mantenimiento ----------------*/
    protected static function datos_mantenimiento_modelo($tipo,$id){
        if($tipo=="Unico"){
            $sql=mainModel::conectar()->prepare("SELECT * FROM mantenimiento_equipo WHERE id_mante_equipo=:ID");
            $sql->bindParam(":ID",$id);
        }elseif($tipo=="Conteo"){
            $sql=mainModel::conectar()->prepare("SELECT id_mante_equipo FROM mantenimiento_equipo");

        }
        $sql->execute();
        return $sql;
    }

    /*------------- Modelo actualizar mantenimiento -------------*/
    protected static function actualizar_mantenimiento_modelo($datos){
        $sql=mainModel::conectar()->prepare("UPDATE mantenimiento_equipo SET tipo_mantenimiento=:Tipo ,estado_matenimiento=:Estado,
        descripcion=:Descripcion,observacion=:Observacion,fecha_entrada=:Entrada,fecha_salida=:Salida,hora_entrada=:Horainicio,hora_salida=:Horafin
        WHERE id_mante_equipo =:ID");

        $sql->bindParam(":Tipo",$datos['tipo']);
        $sql->bindParam(":Estado",$datos['estado']);
        $sql->bindParam(":Descripcion",$datos['descripcion']);
        $sql->bindParam(":Observacion",$datos['observacion']);
        $sql->bindParam(":Entrada",$datos['entrada']);
        $sql->bindParam(":Salida",$datos['salida']);
        $sql->bindParam(":Horainicio",$datos['inicio']);
        $sql->bindParam(":Horafin",$datos['fin']);
        $sql->bindParam(":ID",$datos['id']);

        $sql->execute();
        return $sql;
    }
}