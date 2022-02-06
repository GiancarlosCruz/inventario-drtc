<?php 

if($peticionAjax){
	require_once "../modelos/equipoModelo.php";
}else{
	require_once "./modelos/equipoModelo.php";
}

class impresoraControlador extends equipoModelo{
//----------------------------------------------------------------
        /*---------------- Controlador paginador impresora ----------------*/
        //----------------------------------------------------------------
        public function paginador_impresora_controlador($pagina,$registros,$privilegio,$url,$busqueda){
            $pagina=mainModel::limpiar_cadena($pagina);
            $registros=mainModel::limpiar_cadena($registros);
            $privilegio=mainModel::limpiar_cadena($privilegio);

            $url=mainModel::limpiar_cadena($url);
            $url=SERVERURL.$url."/";

            $busqueda=mainModel::limpiar_cadena($busqueda);
            $tabla="";

            $pagina= (isset($pagina) && $pagina>0) ? (int) $pagina : 1 ;
            $inicio= ($pagina>0) ? (($pagina*$registros)-$registros) : 0 ;

            if(isset($busqueda) && $busqueda!=""){
                $consulta="SELECT id_equipo_computo,tipo_equipo_computo,tipo_impre,marca,modelo,color,estado FROM equipo_computo
                WHERE tipo_equipo_computo = 'Impresora' 
                ORDER BY tipo_equipo_computo ASC limit $inicio,$registros";
            }else{
                $consulta="SELECT id_equipo_computo,tipo_equipo_computo,tipo_impre,marca,modelo,color,estado FROM equipo_computo ORDER BY tipo_impre ASC limit $inicio,$registros";
            }
            $conexion = mainModel::conectar();
            $datos = $conexion->query($consulta);
            $datos = $datos->fetchAll();

            $total = $conexion->query("SELECT FOUND_ROWS()");
            $total = (int) $total->fetchColumn();

            $Npaginas=ceil($total/$registros);

            $tabla.='<div class="table-responsive">
            <table class="table table-dark table-sm">
                <thead>
                    <tr class="text-center roboto-medium">
                        <th>#</th>
                        <th>TIPO</th>
                        <th>MARCA</th>
                        <th>MODELO</th>
                        <th>COLOR</th>
                        <th>ESTADO</th>';
                        if($privilegio==1 || $privilegio==2){
                            $tabla.='<th>ACTUALIZAR</th>';
                        }
                        if($privilegio==1){
                            $tabla.='<th>ELIMINAR</th>';
                        }
                    $tabla.='</tr>
                </thead>
                <tbody>';
            if($total>=1 && $pagina<=$Npaginas){
                $contador=$inicio+1;
                $reg_inicio=$inicio+1;
                foreach($datos as $rows){
                    $tabla.='<tr class="text-center" >
                        <td>'.$contador.'</td>
                        <td>'.$rows['tipo_impre'].'</td>
                        <td>'.$rows['marca'].'</td>
                        <td>'.$rows['modelo'].'</td>
                        <td>'.$rows['color'].'</td>
                        <td>'.$rows['estado'].'</td>';
                        if($privilegio==1 || $privilegio==2){
                        $tabla.='<td>
                            <a href="'.SERVERURL.'equipo-update/'.mainModel::encryption($rows['id_equipo_computo']).'/" class="btn btn-success">
                                <i class="fas fa-sync-alt"></i>	
                            </a>
                        </td>';
                        }
                        if($privilegio==1){
                        $tabla.='<td>
                            <form class="FormularioAjax" action="'.SERVERURL.'ajax/equipoAjax.php" method="POST" data-form="delete" autocomplete="off">
                            <input type="hidden" name="equipo_id_del" value="'.mainModel::encryption($rows['id_equipo_computo']).'"> 
                            <button type="submit" class="btn btn-warning">
                                    <i class="far fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>';
                        }
                        
                    $tabla.='</tr>';
                    $contador++;

                }
                $reg_final=$contador-1;
            }else{
                if($total>=1){
                    $tabla.='<tr class="text-center"><td colspan="9">
                    <a href="'.$url.'" class="btn btn-raised btn-primary btn-sm">haga click para recargar el listado</a>
                    </td></tr>';
                }else{
                    $tabla.='<tr class="text-center"><td colspan="9">No hay Registros en el sistema</td></tr>';
                }
                
            }
            $tabla.='</tbody></table></div>';

            
            if($total>=1 && $pagina<=$Npaginas){
                $tabla.='<p class="text-right">Mostrando equipo de computo '.$reg_inicio.' al '.$reg_final.' de un total de '.$total.'</p>';
                $tabla.=mainModel::paginador_tablas($pagina,$Npaginas,$url,7);
            }

            return $tabla;
        }/*------------------Fin Controlador---------------------- */
}