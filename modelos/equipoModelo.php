<?php
require_once "mainModel.php";

class equipoModelo extends mainModel{


    /*---------------- Modelo agregar equipo ----------------*/
    protected static function agregar_equipo_modelo($datos){
        $sql=mainModel::conectar()->prepare("INSERT INTO equipo_computo (tipo_equipo_computo,tipo_compu,tipo_impre,procesador,ram,sistema_operativo,capacidad_disco_duro,tarjeta_video,pantalla,marca,modelo,cantidad_puertos,color,estado,anio_adquisicion,direccion_ip,area_designada)
        VALUES(:Tipo_equipo_computo,:Tipo_compu,:Tipo_impre,:Procesador,:Ram,:Sistema_operativo,:Capacidad_disco_duro,:Tarjeta_video,:Pantalla,:Marca,:Modelo,:Cantidad_puertos,:Color,:Estado,:Anio_adquisicion,:Direccion_ip,:Area_designada)");

        $sql->bindParam(":Tipo_equipo_computo",$datos['tipo_equipo_computo']);
        $sql->bindParam(":Tipo_compu",$datos['tipo_compu']);
        $sql->bindParam(":Tipo_impre",$datos['tipo_impre']);
        $sql->bindParam(":Procesador",$datos['procesador']);
        $sql->bindParam(":Ram",$datos['ram']);
        $sql->bindParam(":Sistema_operativo",$datos['sistema_operativo']);
        $sql->bindParam(":Capacidad_disco_duro",$datos['capacidad_disco_duro']);
        $sql->bindParam(":Tarjeta_video",$datos['tarjeta_video']);
        $sql->bindParam(":Pantalla",$datos['pantalla']);
        $sql->bindParam(":Marca",$datos['marca']);
        $sql->bindParam(":Modelo",$datos['modelo']);
        $sql->bindParam(":Cantidad_puertos",$datos['cantidad_puertos']);
        $sql->bindParam(":Color",$datos['color']);
        $sql->bindParam(":Estado",$datos['estado']);
        $sql->bindParam(":Anio_adquisicion",$datos['anio_adquisicion']);
        $sql->bindParam(":Direccion_ip",$datos['direccion_ip']);
        $sql->bindParam(":Area_designada",$datos['area_designada']);
        $sql->execute();
        return $sql;
    }

    /*---------------- Modelo eliminar equipo ----------------*/
    protected static function eliminar_equipo_modelo($id){
        $sql=mainModel::conectar()->prepare("DELETE FROM equipo_computo WHERE id_equipo_computo=:ID");
        $sql->bindParam(":ID",$id);
        $sql->execute();
        return $sql;

    }

    /*---------------- Modelo datos equipo ----------------*/
    protected static function datos_equipo_modelo($tipo,$id){
        if($tipo=="Unico"){
            $sql=mainModel::conectar()->prepare("SELECT * FROM equipo_computo WHERE id_equipo_computo=:ID");
            $sql->bindParam(":ID",$id);
        }elseif($tipo=="Conteo"){
            $sql=mainModel::conectar()->prepare("SELECT id_equipo_computo FROM equipo_computo");

        }
        $sql->execute();
        return $sql;
    }

    /**-------modelo actualizar equipo */
    protected static function actualizar_equipo_modelo($datos){
        $sql=mainModel::conectar()->prepare("UPDATE equipo_computo SET tipo_compu=:Tipo_compu,procesador=:Procesador,ram=:Ram,
        sistema_operativo=:Sistema,capacidad_disco_duro=:Discoduro,tarjeta_video=:Tarjeta,pantalla=:Pantalla,modelo=:Modelo,
        estado=:Estado,anio_adquisicion=:Anio,direccion_ip=:Ip,area_designada=:Area
           WHERE id_equipo_computo=:ID");

       
        $sql->bindParam(":Tipo_compu",$datos['tipo_compu']);
        $sql->bindParam(":Procesador",$datos['procesador']);
        $sql->bindParam(":Ram",$datos['ram']);
        $sql->bindParam(":Sistema",$datos['sistema_operativo']);
        $sql->bindParam(":Discoduro",$datos['capacidad_disco_duro']);
        $sql->bindParam(":Tarjeta",$datos['tarjeta_video']);
        $sql->bindParam(":Pantalla",$datos['pantalla']);
        $sql->bindParam(":Modelo",$datos['modelo']);
        $sql->bindParam(":Estado",$datos['estado']);
        $sql->bindParam(":Anio",$datos['anio_adquisicion']);
        $sql->bindParam(":Ip",$datos['direccion_ip']);
        $sql->bindParam(":Area",$datos['area_designada']);
        $sql->bindParam(":ID",$datos['id']);
        $sql->execute();
        return $sql;

    }

    /**-------modelo actualizar equipo */
    protected static function actualizar_impresora_modelo($datos){
        $sql=mainModel::conectar()->prepare("UPDATE equipo_computo SET tipo_impre=:Tipo,marca=:Marca,modelo=:Modelo,color=:Color,
        anio_adquisicion=:Fecha,direccion_ip=:Ip,area_designada=:Area,estado=:Estado
        WHERE id_equipo_computo=:ID");

        $sql->bindParam(":Tipo",$datos['tipo']);
        $sql->bindParam(":Marca",$datos['marca']);
        $sql->bindParam(":Modelo",$datos['modelo']);
        $sql->bindParam(":Color",$datos['color']);
        $sql->bindParam(":Fecha",$datos['fecha']);
        $sql->bindParam(":Ip",$datos['ip']);
        $sql->bindParam(":Area",$datos['area']);
        $sql->bindParam(":Estado",$datos['estado']);
        $sql->bindParam(":ID",$datos['id']);
        $sql->execute();
        return $sql;

    }

    /**-------modelo actualizar equipo */
    protected static function actualizar_switch_modelo($datos){
        $sql=mainModel::conectar()->prepare("UPDATE equipo_computo SET estado=:Estado,marca=:Marca,modelo=:Modelo,cantidad_puertos=:Puertos,
        area_designada=:Area
           WHERE id_equipo_computo=:ID");

         $sql->bindParam(":Estado",$datos['estado']);
        $sql->bindParam(":Marca",$datos['marca']);
        $sql->bindParam(":Modelo",$datos['modelo']);
        $sql->bindParam(":Puertos",$datos['puertos']);
        $sql->bindParam(":Area",$datos['area']);
        $sql->bindParam(":ID",$datos['id']);
        $sql->execute();
        return $sql;

    }

   
}
