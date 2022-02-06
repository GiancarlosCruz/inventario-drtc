<?php 

if($peticionAjax){
	require_once "../modelos/equipoModelo.php";
}else{
	require_once "./modelos/equipoModelo.php";
}

class equipoControlador extends equipoModelo{
	/*---------------- Controlador agregar conductor ----------------*/
        public function agregar_equipo_controlador(){
            
            $equipo_tipo=mainModel::limpiar_cadena($_POST['equipo_tipo_reg']);
            $compu_tipo=mainModel::limpiar_cadena($_POST['compu_tipo_reg']);
            $impre_tipo=mainModel::limpiar_cadena($_POST['impre_tipo_reg']);
            $procesador=mainModel::limpiar_cadena($_POST['equipo_procesador_reg']);
            $ram=mainModel::limpiar_cadena($_POST['equipo_ram_reg']);
            $so=mainModel::limpiar_cadena($_POST['equipo_so_reg']);
            $disco=mainModel::limpiar_cadena($_POST['equipo_disco_reg']);
            $tarjeta=mainModel::limpiar_cadena($_POST['equipo_tarjeta_reg']);
            $pantalla=mainModel::limpiar_cadena($_POST['equipo_pantalla_reg']);
            $marca=mainModel::limpiar_cadena($_POST['equipo_marca_reg']);
            $modelo=mainModel::limpiar_cadena($_POST['equipo_modelo_reg']);
            $puertos=mainModel::limpiar_cadena($_POST['equipo_puertos_reg']);
            $color=mainModel::limpiar_cadena($_POST['equipo_color_reg']);
            $estado=mainModel::limpiar_cadena($_POST['equipo_estado_reg']);
            $fecha=mainModel::limpiar_cadena($_POST['equipo_fecha_reg']);
            $ip=mainModel::limpiar_cadena($_POST['equipo_ip_reg']);
            $area=mainModel::limpiar_cadena($_POST['equipo_area_reg']);

            /*--------comprobar campos vacios---------*/
            if($equipo_tipo=="" || $compu_tipo=="" ||$impre_tipo=="" ||$procesador=="" || $ram=="" || $so=="" || $disco=="" || $tarjeta=="" || $pantalla=="" || $marca=="" || $modelo=="" || $puertos=="" || $color=="" || $estado=="" || $fecha=="" || $ip=="" || $area==""){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"No has llenado todos los campos que son obligatorios",
                    "Tipo"=>"error"
                ];
                echo json_encode($alerta);
                exit();
            }/*
            if ($equipo_tipo=="Computadora"){                               
                $pantalla = ! empty( $_POST['equipo_pantalla_reg'] ) ? $_POST['equipo_pantalla_reg']:'' ;                
            }
            if ($equipo_tipo=="Impresora") {               
                $compu_tipo=="";
                $procesador=="";
                $ram=="";  
                $so==""; 
                $disco=="";         
                $tarjeta=="";
                $pantalla=="";
                $puertos=="";
            }
             if ($equipo_tipo=="Switch") {               
                $compu_tipo=="";
                $procesador=="";
                $ram=="";
                $so==""; 
                $disco=="";         
                $tarjeta=="";
                $pantalla=="";
                $puertos=="";
            }    */         
            
            /*------------------Verificando la integridad de los datos-----------------------*/  
            if(mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,150}",$procesador)){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"Los datos ingresados no coinciden con el formato solicitado",
                    "Tipo"=>"error"
                ];
                echo json_encode($alerta);
                exit();
            }
            if(mainModel::verificar_datos("[0-9]{1,8}",$ram)){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"Los datos ingresados no coinciden con el formato solicitado",
                    "Tipo"=>"error"
                ];
                echo json_encode($alerta);
                exit();
            }
            if(mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,150}",$so)){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"Los datos ingresados no coinciden con el formato solicitado",
                    "Tipo"=>"error"
                ];
                echo json_encode($alerta);
                exit();
            }
            if(mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,150}",$disco)){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"Los datos ingresados no coinciden con el formato solicitado",
                    "Tipo"=>"error"
                ];
                echo json_encode($alerta);
                exit();
            }
            if(mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,150}",$tarjeta)){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"Los datos ingresados no coinciden con el formato solicitado",
                    "Tipo"=>"error"
                ];
                echo json_encode($alerta);
                exit();
            }
            if(mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,4}",$pantalla)){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"Los datos ingresados no coinciden con el formato solicitado",
                    "Tipo"=>"error"
                ];
                echo json_encode($alerta);
                exit();
            }
            if(mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,150}",$marca)){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"Los datos ingresados no coinciden con el formato solicitado",
                    "Tipo"=>"error"
                ];
                echo json_encode($alerta);
                exit();
            }
            if(mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,150}",$modelo)){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"Los datos ingresados no coinciden con el formato solicitado",
                    "Tipo"=>"error"
                ];
                echo json_encode($alerta);
                exit();
            }
            if(mainModel::verificar_datos("[0-9]{1,8}",$puertos)){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"Los datos ingresados no coinciden con el formato solicitado",
                    "Tipo"=>"error"
                ];
                echo json_encode($alerta);
                exit();
            }
            if(mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,150}",$color)){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"Los datos ingresados no coinciden con el formato solicitado",
                    "Tipo"=>"error"
                ];
                echo json_encode($alerta);
                exit();
            }
            if(mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,150}",$ip)){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"Los datos ingresados no coinciden con el formato solicitado",
                    "Tipo"=>"error"
                ];
                echo json_encode($alerta);
                exit();
            }
            if(mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,150}",$area)){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"Los datos ingresados no coinciden con el formato solicitado",
                    "Tipo"=>"error"
                ];
                echo json_encode($alerta);
                exit();
            }                

            $datos_equipo_reg=[
            	"tipo_equipo_computo"=>$equipo_tipo,
            	"tipo_compu"=>$compu_tipo,
            	"tipo_impre"=>$impre_tipo,
            	"procesador"=>$procesador,
            	"ram"=>$ram,
            	"sistema_operativo"=>$so,
            	"capacidad_disco_duro"=>$disco,
            	"tarjeta_video"=>$tarjeta,
            	"pantalla"=>$pantalla,
            	"marca"=>$marca,
            	"modelo"=>$modelo,
            	"cantidad_puertos"=>$puertos,
            	"color"=>$color,
            	"estado"=>$estado,
            	"anio_adquisicion"=>$fecha,
            	"direccion_ip"=>$ip,
            	"area_designada"=>$area,
     
            ];
            $agregar_equipo=equipoModelo::agregar_equipo_modelo($datos_equipo_reg);

            if($agregar_equipo->rowCount()==1){
                $alerta=[
                    "Alerta"=>"limpiar",
                    "Titulo"=>"Equipo de computo registrado exitosamente",
                    "Texto"=>"Se registro correctamente",
                    "Tipo"=>"success"
                ];
            }else{
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"No hemos podido registrar ",
                    "Tipo"=>"error"
                ];
            }
            echo json_encode($alerta);
            
        }/*------------------Fin Controlador---------------------- */
        
        //controlador busqueda computadora
        public function paginador_compu_busqueda_controlador($pagina,$registros,$privilegio,$url,$busqueda){
            $pagina=mainModel::limpiar_cadena($pagina);
            $registros=mainModel::limpiar_cadena($registros);
            $privilegio=mainModel::limpiar_cadena($privilegio);

            $url=mainModel::limpiar_cadena($url);
            $url=SERVERURL.$url."/";

            $busqueda=mainModel::limpiar_cadena($busqueda);
            $tabla="";

            $pagina= (isset($pagina) && $pagina>0) ? (int) $pagina : 1 ;
            $inicio= ($pagina>0) ? (($pagina*$registros)-$registros) : 0 ;

            /**variable de campos  */
            $campos="
            id_equipo_computo,
            tipo_equipo_computo,
            tipo_compu,
            tipo_impre,
            procesador,
            ram,
            sistema_operativo,
            capacidad_disco_duro,
            tarjeta_video,
            pantalla,
            marca,
            modelo,
            cantidad_puertos,
            color,
            estado,
            anio_adquisicion,
            direccion_ip,
            area_designada";

                /***/
            if(isset($busqueda) && $busqueda!=""){
                $consulta="SELECT SQL_CALC_FOUND_ROWS $campos FROM equipo_computo WHERE tipo_equipo_computo='Computadora' 
                AND area_designada LIKE '%$busqueda%' OR sistema_operativo like '%$busqueda%' or capacidad_disco_duro like '%$busqueda%' or ram like '%$busqueda%' OR direccion_ip LIKE '%$busqueda%' 
                ORDER BY sistema_operativo, ram, capacidad_disco_duro, area_designada DESC limit $inicio,$registros";
            }else{
                $consulta="SELECT SQL_CALC_FOUND_ROWS $campos FROM equipo_computo  
                WHERE tipo_equipo_computo='$tipo' ORDER BY tipo_equipo_computo DESC limit $inicio,$registros";
            }

                    /******/
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
                        <th>PROCESADOR</th>
                        <th>RAM</th>
                        <th>SO</th>
                        <th>DISCO DURO</th>
                        <th>TARJETA DE VIDEO</th>
                        <th>PANTALLA</th>
                        <th>MODELO DE PLACA</th>
                        <th>IP</th>
                        <th>ESTADO</th>
                        <th>AÑO</th>
                        <th>AREA</th>';
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
                        <td>'.$rows['tipo_compu'].'</td>
                        <td>'.$rows['procesador'].'</td>
                        <td>'.$rows['ram'].'</td>
                        <td>'.$rows['sistema_operativo'].'</td>
                        <td>'.$rows['capacidad_disco_duro'].'</td>
                        <td>'.$rows['tarjeta_video'].'</td>
                        <td>'.$rows['pantalla'].'</td>
                        <td>'.$rows['modelo'].'</td>
                        <td>'.$rows['direccion_ip'].'</td>
                        <td>'.$rows['estado'].'</td>
                        <td>'.$rows['anio_adquisicion'].'</td>
                        <td>'.$rows['area_designada'].'</td>
                        ';

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
                    <a href="'.$url.'" class="btn btn-raised btn-primary btn-sm">Haga click para recargar el listado</a>
                    </td></tr>';
                }else{
                    $tabla.='<tr class="text-center"><td colspan="9">No hay Registros en el sistema</td></tr>';
                }
                
            }
            $tabla.='</tbody></table></div>';

            
            if($total>=1 && $pagina<=$Npaginas){
                $tabla.='<p class="text-right">Mostrando equipo '.$reg_inicio.' al '.$reg_final.' de un total de '.$total.'</p>';
                $tabla.=mainModel::paginador_tablas($pagina,$Npaginas,$url,7);
            }

            return $tabla;
        }/**FIN */

        //controlador busqueda impresora
        public function paginador_impresora_busqueda_controlador($pagina,$registros,$privilegio,$url,$busqueda){
            $pagina=mainModel::limpiar_cadena($pagina);
            $registros=mainModel::limpiar_cadena($registros);
            $privilegio=mainModel::limpiar_cadena($privilegio);

            $url=mainModel::limpiar_cadena($url);
            $url=SERVERURL.$url."/";

            $busqueda=mainModel::limpiar_cadena($busqueda);
            $tabla="";

            $pagina= (isset($pagina) && $pagina>0) ? (int) $pagina : 1 ;
            $inicio= ($pagina>0) ? (($pagina*$registros)-$registros) : 0 ;

            /**variable de campos  */
            $campos="
            id_equipo_computo,
            tipo_equipo_computo,
            tipo_compu,
            tipo_impre,
            procesador,
            ram,
            sistema_operativo,
            capacidad_disco_duro,
            tarjeta_video,
            pantalla,
            marca,
            modelo,
            cantidad_puertos,
            color,
            estado,
            anio_adquisicion,
            direccion_ip,
            area_designada";

                /***/
            if(isset($busqueda) && $busqueda!=""){
                $consulta="SELECT SQL_CALC_FOUND_ROWS $campos FROM equipo_computo WHERE tipo_equipo_computo='Impresora' 
                AND area_designada LIKE '%$busqueda%' OR tipo_impre LIKE '%$busqueda%' OR marca LIKE '%$busqueda%'
                ORDER BY tipo_impre,marca,area_designada DESC limit $inicio,$registros";
            }else{
                $consulta="SELECT SQL_CALC_FOUND_ROWS $campos FROM equipo_computo  
                WHERE tipo_equipo_computo='$tipo' ORDER BY tipo_equipo_computo DESC limit $inicio,$registros";
            }

                    /******/
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
                        <th>ESTADO</th>
                        <th>IP</th>
                        <th>AÑO</th>
                        <th>AREA</th>';
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
                        <td>'.$rows['estado'].'</td>
                        <td>'.$rows['direccion_ip'].'</td>
                        <td>'.$rows['anio_adquisicion'].'</td>
                        <td>'.$rows['area_designada'].'</td>
                        ';

                        if($privilegio==1 || $privilegio==2){
                        $tabla.='<td>
                            <a href="'.SERVERURL.'impre-update/'.mainModel::encryption($rows['id_equipo_computo']).'/" class="btn btn-success">
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
                    <a href="'.$url.'" class="btn btn-raised btn-primary btn-sm">Haga click para recargar el listado</a>
                    </td></tr>';
                }else{
                    $tabla.='<tr class="text-center"><td colspan="9">No hay Registros en el sistema</td></tr>';
                }
                
            }
            $tabla.='</tbody></table></div>';

            
            if($total>=1 && $pagina<=$Npaginas){
                $tabla.='<p class="text-right">Mostrando equipo '.$reg_inicio.' al '.$reg_final.' de un total de '.$total.'</p>';
                $tabla.=mainModel::paginador_tablas($pagina,$Npaginas,$url,7);
            }

            return $tabla;
        }/**FIN */

        //controlador busqueda switch
        public function paginador_switch_busqueda_controlador($pagina,$registros,$privilegio,$url,$busqueda){
            $pagina=mainModel::limpiar_cadena($pagina);
            $registros=mainModel::limpiar_cadena($registros);
            $privilegio=mainModel::limpiar_cadena($privilegio);

            $url=mainModel::limpiar_cadena($url);
            $url=SERVERURL.$url."/";

            $busqueda=mainModel::limpiar_cadena($busqueda);
            $tabla="";

            $pagina= (isset($pagina) && $pagina>0) ? (int) $pagina : 1 ;
            $inicio= ($pagina>0) ? (($pagina*$registros)-$registros) : 0 ;

            /**variable de campos  */
            $campos="
            id_equipo_computo,
            tipo_equipo_computo,
            tipo_compu,
            tipo_impre,
            procesador,
            ram,
            sistema_operativo,
            capacidad_disco_duro,
            tarjeta_video,
            pantalla,
            marca,
            modelo,
            cantidad_puertos,
            color,
            estado,
            anio_adquisicion,
            direccion_ip,
            area_designada";

                /***/
            if(isset($busqueda) && $busqueda!=""){
                $consulta="SELECT SQL_CALC_FOUND_ROWS $campos FROM equipo_computo WHERE tipo_equipo_computo='Switch' 
                AND area_designada LIKE '%$busqueda%' OR marca LIKE '%$busqueda%'  
                ORDER BY marca,cantidad_puertos,area_designada DESC limit $inicio,$registros";
            }else{
                $consulta="SELECT SQL_CALC_FOUND_ROWS $campos FROM equipo_computo  
                WHERE tipo_equipo_computo='$tipo' ORDER BY tipo_equipo_computo DESC limit $inicio,$registros";
            }

                    /******/
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
                        <th>MARCA</th>
                        <th>MODELO</th>
                        <th>PUERTOS</th>
                        <th>COLOR</th>
                        <th>ESTADO</th>                        
                        <th>AREA</th>';
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
                        <td>'.$rows['marca'].'</td>
                        <td>'.$rows['modelo'].'</td>
                        <td>'.$rows['cantidad_puertos'].'</td>
                        <td>'.$rows['color'].'</td>
                        <td>'.$rows['estado'].'</td>                    
                        <td>'.$rows['area_designada'].'</td>
                        ';

                        if($privilegio==1 || $privilegio==2){
                        $tabla.='<td>
                            <a href="'.SERVERURL.'switch-update/'.mainModel::encryption($rows['id_equipo_computo']).'/" class="btn btn-success">
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
                    <a href="'.$url.'" class="btn btn-raised btn-primary btn-sm">Haga click para recargar el listado</a>
                    </td></tr>';
                }else{
                    $tabla.='<tr class="text-center"><td colspan="9">No hay registros en el sistema</td></tr>';
                }
                
            }
            $tabla.='</tbody></table></div>';

            
            if($total>=1 && $pagina<=$Npaginas){
                $tabla.='<p class="text-right">Mostrando equipo '.$reg_inicio.' al '.$reg_final.' de un total de '.$total.'</p>';
                $tabla.=mainModel::paginador_tablas($pagina,$Npaginas,$url,7);
            }

            return $tabla;
        }/**FIN */

        public function paginador_equipo_controlador($pagina,$registros,$privilegio,$url,$tipo,$busqueda){
            $pagina=mainModel::limpiar_cadena($pagina);
            $registros=mainModel::limpiar_cadena($registros);
            $privilegio=mainModel::limpiar_cadena($privilegio);

            $url=mainModel::limpiar_cadena($url);
            $url=SERVERURL.$url."/";

            $tipo=mainModel::limpiar_cadena($tipo);
            $busqueda=mainModel::limpiar_cadena($busqueda);
            $tabla="";

            $pagina= (isset($pagina) && $pagina>0) ? (int) $pagina : 1 ;
            $inicio= ($pagina>0) ? (($pagina*$registros)-$registros) : 0 ;

            /**variable de campos  */
            $campos="
            id_equipo_computo,
            tipo_equipo_computo,
            tipo_compu,
            tipo_impre,
            procesador,
            ram,
            sistema_operativo,
            capacidad_disco_duro,
            tarjeta_video,
            pantalla,
            marca,
            modelo,
            cantidad_puertos,
            color,
            estado,
            anio_adquisicion,
            direccion_ip,
            area_designada";

                /***/
            if(isset($busqueda) && $busqueda!=""){
                $consulta="SELECT SQL_CALC_FOUND_ROWS $campos FROM equipo_computo WHERE tipo_equipo_computo='$tipo' AND tipo_compu LIKE'%$busqueda%' 
                OR area_designada LIKE '%$busqueda%'
                ORDER BY area_designada, direccion_ip DESC limit $inicio,$registros";
            }else{
                $consulta="SELECT SQL_CALC_FOUND_ROWS $campos FROM equipo_computo  
                WHERE tipo_equipo_computo='$tipo' ORDER BY tipo_equipo_computo DESC limit $inicio,$registros";
            }

                    /******/
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
                        <th>PROCESADOR</th>
                        <th>RAM</th>
                        <th>SISTEMA OPERATIVO</th>
                        <th>DISCO DURO</th>
                        <th>TARJETA VIDEO</th>
                        <th>PANTALLA</th>
                        <th>MODELO</th>
                        <th>ESTADO</th>
                        <th>AÑO</th>
                        <th>IP</th>
                        <th>AREA</th>';
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
                        <td>'.$rows['tipo_compu'].'</td>
                        <td>'.$rows['procesador'].'</td>
                        <td>'.$rows['ram'].'</td>
                        <td>'.$rows['sistema_operativo'].'</td>
                        <td>'.$rows['capacidad_disco_duro'].'</td>
                        <td>'.$rows['tarjeta_video'].'</td>
                        <td>'.$rows['pantalla'].'</td>
                        <td>'.$rows['modelo'].'</td>
                        <td>'.$rows['estado'].'</td>
                        <td>'.$rows['anio_adquisicion'].'</td>
                        <td>'.$rows['direccion_ip'].'</td>
                        <td>'.$rows['area_designada'].'</td>
                        ';

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
                    $tabla.='<tr class="text-center"><td colspan="9">No hay registros en el sistema</td></tr>';
                }
                
            }
            $tabla.='</tbody></table></div>';

            
            if($total>=1 && $pagina<=$Npaginas){
                $tabla.='<p class="text-right">Mostrando equipo '.$reg_inicio.' al '.$reg_final.' de un total de '.$total.'</p>';
                $tabla.=mainModel::paginador_tablas($pagina,$Npaginas,$url,7);
            }

            return $tabla;
        }/**FIN */

        /*--CONTROLADOR PAGINADOR impresora*/

        public function paginador_impresora_controlador($pagina,$registros,$privilegio,$url,$tipo,$fecha_inicio,$Fechaentrega){
            $pagina=mainModel::limpiar_cadena($pagina);
            $registros=mainModel::limpiar_cadena($registros);
            $privilegio=mainModel::limpiar_cadena($privilegio);

            $url=mainModel::limpiar_cadena($url);
            $url=SERVERURL.$url."/";

            $tipo=mainModel::limpiar_cadena($tipo);
            $fecha_inicio=mainModel::limpiar_cadena($fecha_inicio);
            $Fechaentrega=mainModel::limpiar_cadena($Fechaentrega);
            $tabla="";

            $pagina= (isset($pagina) && $pagina>0) ? (int) $pagina : 1 ;
            $inicio= ($pagina>0) ? (($pagina*$registros)-$registros) : 0 ;

            if ($tipo=="busqueda") {
                if (mainModel::verificar_fecha($fecha_inicio) || mainModel::verificar_fecha($Fechaentrega)) {
                    return '
                    
                    <div class="alert alert-danger text-center" role="alert">
                        <p><i class="fas fa-exclamation-triangle fa-5x"></i></p>
                            <h4 class="alert-heading">¡Ocurrió un error inesperado!</h4>
                        <p class="mb-0">Lo sentimos, no podemos realizar la busqueda solicitada debido a que la fecha es incorrecta.</p>
                    </div>

                    ';
                    exit();
                }
            }

            /**variable de campos  */
            $campos="
            id_equipo_computo,
            tipo_equipo_computo,
            tipo_compu,
            tipo_impre,
            procesador,
            ram,
            sistema_operativo,
            capacidad_disco_duro,
            tarjeta_video,
            pantalla,
            marca,
            modelo,
            cantidad_puertos,
            color,
            estado,
            anio_adquisicion,
            direccion_ip,
            area_designada";

                /***/
            if($tipo=="busqueda" && $fecha_inicio!="" && $Fechaentrega!=""){
                $consulta="SELECT SQL_CALC_FOUND_ROWS $campos FROM equipo_computo 
                ORDER BY area_designada,direccion_ip asc limit $inicio,$registros";
            }else{
                $consulta="SELECT SQL_CALC_FOUND_ROWS $campos FROM equipo_computo  
                WHERE tipo_equipo_computo='$tipo' ORDER BY tipo_equipo_computo DESC limit $inicio,$registros";
            }

                    /******/
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
                        <th>ESTADO</th>
                        <th>AÑO</th>
                        <th>IP</th>
                        <th>AREA</th>';
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
                        <td>'.$rows['estado'].'</td>
                        <td>'.$rows['anio_adquisicion'].'</td>
                        <td>'.$rows['direccion_ip'].'</td>
                        <td>'.$rows['area_designada'].'</td>
                        ';

                        if($privilegio==1 || $privilegio==2){
                        $tabla.='<td>
                            <a href="'.SERVERURL.'impre-update/'.mainModel::encryption($rows['id_equipo_computo']).'/" class="btn btn-success">
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
                    <a href="'.$url.'" class="btn btn-raised btn-primary btn-sm">Haga click para recargar el listado</a>
                    </td></tr>';
                }else{
                    $tabla.='<tr class="text-center"><td colspan="9">No hay registros en el sistema</td></tr>';
                }
                
            }
            $tabla.='</tbody></table></div>';

            
            if($total>=1 && $pagina<=$Npaginas){
                $tabla.='<p class="text-right">Mostrando equipo '.$reg_inicio.' al '.$reg_final.' de un total de '.$total.'</p>';
                $tabla.=mainModel::paginador_tablas($pagina,$Npaginas,$url,7);
            }

            return $tabla;
        }/**FIN */
        
        /*--CONTROLADOR PAGINADOR switch*/

        public function paginador_switch_controlador($pagina,$registros,$privilegio,$url,$tipo,$fecha_inicio,$Fechaentrega){
            $pagina=mainModel::limpiar_cadena($pagina);
            $registros=mainModel::limpiar_cadena($registros);
            $privilegio=mainModel::limpiar_cadena($privilegio);

            $url=mainModel::limpiar_cadena($url);
            $url=SERVERURL.$url."/";

            $tipo=mainModel::limpiar_cadena($tipo);
            $fecha_inicio=mainModel::limpiar_cadena($fecha_inicio);
            $Fechaentrega=mainModel::limpiar_cadena($Fechaentrega);
            $tabla="";

            $pagina= (isset($pagina) && $pagina>0) ? (int) $pagina : 1 ;
            $inicio= ($pagina>0) ? (($pagina*$registros)-$registros) : 0 ;

            if ($tipo=="busqueda") {
                if (mainModel::verificar_fecha($fecha_inicio) || mainModel::verificar_fecha($Fechaentrega)) {
                    return '
                    
                    <div class="alert alert-danger text-center" role="alert">
                        <p><i class="fas fa-exclamation-triangle fa-5x"></i></p>
                            <h4 class="alert-heading">¡Ocurrió un error inesperado!</h4>
                        <p class="mb-0">Lo sentimos, no podemos realizar la busqueda solicitada debido a que la fecha es incorrecta.</p>
                    </div>

                    ';
                    exit();
                }
            }

            /**variable de campos  */
            $campos="
            id_equipo_computo,
            tipo_equipo_computo,
            tipo_compu,
            tipo_impre,
            procesador,
            ram,
            sistema_operativo,
            capacidad_disco_duro,
            tarjeta_video,
            pantalla,
            marca,
            modelo,
            cantidad_puertos,
            color,
            estado,
            anio_adquisicion,
            direccion_ip,
            area_designada";

                /***/
            if($tipo=="busqueda" && $fecha_inicio!="" && $Fechaentrega!=""){
                $consulta="SELECT SQL_CALC_FOUND_ROWS $campos FROM equipo_computo 
                ORDER BY area_designada DESC limit $inicio,$registros";
            }else{
                $consulta="SELECT SQL_CALC_FOUND_ROWS $campos FROM equipo_computo  
                WHERE tipo_equipo_computo='$tipo' ORDER BY tipo_equipo_computo DESC limit $inicio,$registros";
            }

                    /******/
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
                        <th>PUERTOS</th>
                        <th>ESTADO</th>
                        <th>AREA</th>';
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
                        <td>'.$rows['tipo_equipo_computo'].'</td>
                        <td>'.$rows['marca'].'</td>
                        <td>'.$rows['modelo'].'</td>
                        <td>'.$rows['cantidad_puertos'].'</td>
                        <td>'.$rows['estado'].'</td>
                        <td>'.$rows['area_designada'].'</td>
                        ';

                        if($privilegio==1 || $privilegio==2){
                        $tabla.='<td>
                            <a href="'.SERVERURL.'switch-update/'.mainModel::encryption($rows['id_equipo_computo']).'/" class="btn btn-success">
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
                $tabla.='<p class="text-right">Mostrando equipo '.$reg_inicio.' al '.$reg_final.' de un total de '.$total.'</p>';
                $tabla.=mainModel::paginador_tablas($pagina,$Npaginas,$url,7);
            }

            return $tabla;
        }/**FIN */

        /* controlador eliminar documento */
        public function eliminar_equipo_controlador(){

            //recuperar id de documento
            $id=mainModel::decryption($_POST['equipo_id_del']);
            $id=mainModel::limpiar_cadena($id);

            //comprobar la documento en la bd
            $check_documento=mainModel::ejecutar_consulta_simple("SELECT id_equipo_computo FROM equipo_computo WHERE id_equipo_computo='$id'");

            if($check_documento->rowCount()<=0){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"No hemos encontrado el documento en el sistema",
                    "Tipo"=>"error"
                ];
                echo json_encode($alerta);
                exit();
            }        
            
            //comprobar los privilegios
            session_start(['name'=>'SDRTC']);
            if($_SESSION['tipo_sdrtc']!=1){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"No tienes los permisos necesarios para realizar esta operacion",
                    "Tipo"=>"error"
                ];
                echo json_encode($alerta);
                exit();
            }

            $eliminar_equipo=equipoModelo::eliminar_equipo_modelo($id);

            if($eliminar_equipo->rowCount()==1){
                $alerta=[
                    "Alerta"=>"recargar",
                    "Titulo"=>"Equipo eliminado",
                    "Texto"=>"El equipo de computo ha sido eliminado",
                    "Tipo"=>"success"
                ];
            }else{
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"No hemos podido eliminar el documento porfavor intente nuevamente",
                    "Tipo"=>"error"
                ];
            }
            echo json_encode($alerta);

        }/*------fin controlador-------*/

        //------------------------------------------------
        /*----------Controlador datos equipo ---------- */
        //------------------------------------------------
        public function datos_equipo_controlador($tipo,$id){
            $tipo=mainModel::limpiar_cadena($tipo);
            
            $id=mainModel::decryption($id);
            $id=mainModel::limpiar_cadena($id);

            return equipoModelo::datos_equipo_modelo($tipo,$id);
        }/*------fin controlador-------*/

        //-------------------------------------------
        /*-------Controlador actualizar equipo-------*/
        //-------------------------------------------
        public function actualizar_equipo_controlador(){
            //recuperar el id
            $id=mainModel::decryption($_POST['equipo_id_up']);
            $id=mainModel::limpiar_cadena($id);

            //Comprobar el cliente en la db
            $check_equipo=mainModel::ejecutar_consulta_simple("SELECT * FROM equipo_computo WHERE id_equipo_computo='$id'");

            if($check_equipo->rowCount()<=0){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"No hemos encontrado la empresa en el sistema",
                    "Tipo"=>"error"
                ];
                echo json_encode($alerta);
                exit();
            }else{
                $campos=$check_equipo->fetch();
            }
            $tipo=mainModel::limpiar_cadena($_POST['compu_tipo_up']); 
            $procesador=mainModel::limpiar_cadena($_POST['equipo_procesador_up']);
            $ram=mainModel::limpiar_cadena($_POST['equipo_ram_up']);
            $so=mainModel::limpiar_cadena($_POST['equipo_so_up']);
            $disco=mainModel::limpiar_cadena($_POST['equipo_disco_up']);
            $tarjeta=mainModel::limpiar_cadena($_POST['equipo_tarjeta_up']);
            $pantalla=mainModel::limpiar_cadena($_POST['equipo_pantalla_up']);
            $modelo=mainModel::limpiar_cadena($_POST['equipo_modelo_up']);
            $estado=mainModel::limpiar_cadena($_POST['equipo_estado_up']);
            $fecha=mainModel::limpiar_cadena($_POST['equipo_fecha_up']);
            $ip=mainModel::limpiar_cadena($_POST['equipo_ip_up']);
            $area=mainModel::limpiar_cadena($_POST['equipo_area_up']);

            /*--------comprobar campos vacios---------*/
            if($procesador=="" || $ram=="" || $disco=="" || $tarjeta=="" || $pantalla ==""){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"No has llenado todos los campos que son obligatorios",
                    "Tipo"=>"error"
                ];
                echo json_encode($alerta);
                exit();
            }

            /*------------------Verificando la integridad de los datos-----------------------*/
            if(mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ@().,#\- ]{1,150}",$procesador)){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"El procesador no coincide con el formato solicitado",
                    "Tipo"=>"error"
                ];
                echo json_encode($alerta);
                exit();
            }

            if(mainModel::verificar_datos("[0-9]{1,8}",$ram)){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"La ram no coincide con el formato solicitado",
                    "Tipo"=>"error"
                ];
                echo json_encode($alerta);
                exit();
            }

            if(mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,150}",$so)){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"El sistema operativo no coincide con el formato solicitado",
                    "Tipo"=>"error"
                ];
                echo json_encode($alerta);
                exit();
            }

            if(mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,150}",$tarjeta)){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"La Tarjeta grafica no coincide con el formato solicitado",
                    "Tipo"=>"error"
                ];
                echo json_encode($alerta);
                exit();
            }

            
            $datos_equipo_up=[
            "tipo_compu"=>$tipo,
            "procesador"=>$procesador,
            "ram"=>$ram,
            "sistema_operativo"=>$so,
            "capacidad_disco_duro"=>$disco,
            "tarjeta_video"=>$tarjeta,
            "pantalla"=>$pantalla,
            "modelo"=>$modelo,
            "estado"=>$estado,
            "anio_adquisicion"=>$fecha,
            "direccion_ip"=>$ip,
            "area_designada"=>$area,
            "id"=>$id
            ];

            if(equipoModelo::actualizar_equipo_modelo($datos_equipo_up)){
                $alerta=[
                    "Alerta"=>"recargar",
                    "Titulo"=>"Equipo Actualizada",
                    "Texto"=>"Los datos del equipo se actualizaron con exito",
                    "Tipo"=>"success"
                ];
            }else{
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"No Hemos podido Actualizar los datos del equipo",
                    "Tipo"=>"error"
                ];
            }  
            echo json_encode($alerta); 

        }/* ---fin controlador---- */

        //-------------------------------------------
        /*-------Controlador actualizar impresora-------*/
        //-------------------------------------------
        public function actualizar_impresora_controlador(){
            //recuperar el id
            $id=mainModel::decryption($_POST['impresora_id_up']);
            $id=mainModel::limpiar_cadena($id);

            //Comprobar el cliente en la db
            $check_impresora=mainModel::ejecutar_consulta_simple("SELECT * FROM equipo_computo WHERE id_equipo_computo='$id'");

            if($check_impresora->rowCount()<=0){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"No hemos encontrado la empresa en el sistema",
                    "Tipo"=>"error"
                ];
                echo json_encode($alerta);
                exit();
            }else{
                $campos=$check_impresora->fetch();
            }

            $marca=mainModel::limpiar_cadena($_POST['impre_marca_up']); 
            $modelo=mainModel::limpiar_cadena($_POST['impre_modelo_up']);
            $color=mainModel::limpiar_cadena($_POST['impre_color_up']);
            $fecha=mainModel::limpiar_cadena($_POST['impre_fecha_up']);
            $ip=mainModel::limpiar_cadena($_POST['impre_ip_up']);
            $area=mainModel::limpiar_cadena($_POST['impre_area_up']);
            $estado=mainModel::limpiar_cadena($_POST['impre_estado_up']);
            $tipo=mainModel::limpiar_cadena($_POST['impre_tipo_up']); 

            /*--------comprobar campos vacios---------*/
            if($marca=="" || $modelo=="" || $color=="" || $fecha=="" || $ip ==""){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"No has llenado todos los campos que son obligatorios",
                    "Tipo"=>"error"
                ];
                echo json_encode($alerta);
                exit();
            }

            /*------------------Verificando la integridad de los datos-----------------------*/
            if(mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ@().,#\- ]{1,150}",$marca)){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"La marca no coincide con el formato solicitado",
                    "Tipo"=>"error"
                ];
                echo json_encode($alerta);
                exit();
            }


            if(mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,150}",$modelo)){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"El sistema operativo no coincide con el formato solicitado",
                    "Tipo"=>"error"
                ];
                echo json_encode($alerta);
                exit();
            }

            if(mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,150}",$color)){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"La Tarjeta grafica no coincide con el formato solicitado",
                    "Tipo"=>"error"
                ];
                echo json_encode($alerta);
                exit();
            }

            
            $datos_impresora_up=[
            "marca"=>$marca,
            "modelo"=>$modelo,
            "color"=>$color,
            "fecha"=>$fecha,
            "ip"=>$ip,
            "area"=>$area,
            "estado"=>$estado,
            "tipo"=>$tipo,
            "id"=>$id
            ];

            if(equipoModelo::actualizar_impresora_modelo($datos_impresora_up)){
                $alerta=[
                    "Alerta"=>"recargar",
                    "Titulo"=>"Impresora actualizada",
                    "Texto"=>"Los datos del impresora se actualizaron con exito",
                    "Tipo"=>"success"
                ];
            }else{
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"No Hemos podido Actualizar los datos del impresora",
                    "Tipo"=>"error"
                ];
            }  
            echo json_encode($alerta); 

        }/* ---fin controlador---- */

        //-------------------------------------------
        /*-------Controlador actualizar switch-------*/
        //-------------------------------------------
        public function actualizar_switch_controlador(){
            //recuperar el id
            $id=mainModel::decryption($_POST['switch_id_up']);
            $id=mainModel::limpiar_cadena($id);

            //Comprobar el cliente en la db
            $check_impresora=mainModel::ejecutar_consulta_simple("SELECT * FROM equipo_computo WHERE id_equipo_computo='$id'");

            if($check_impresora->rowCount()<=0){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"No hemos encontrado la empresa en el sistema",
                    "Tipo"=>"error"
                ];
                echo json_encode($alerta);
                exit();
            }else{
                $campos=$check_impresora->fetch();
            }

            $estado=mainModel::limpiar_cadena($_POST['switch_estado_up']);
            $marca=mainModel::limpiar_cadena($_POST['switch_marca_up']); 
            $modelo=mainModel::limpiar_cadena($_POST['switch_modelo_up']);
            $puertos=mainModel::limpiar_cadena($_POST['switch_puertos_up']);
            $area=mainModel::limpiar_cadena($_POST['switch_area_up']);
            

            /*--------comprobar campos vacios---------*/
            if($marca=="" || $modelo=="" || $puertos==""){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"No has llenado todos los campos que son obligatorios",
                    "Tipo"=>"error"
                ];
                echo json_encode($alerta);
                exit();
            }

            /*------------------Verificando la integridad de los datos-----------------------*/
            if(mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ@().,#\- ]{1,150}",$marca)){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"La marca no coincide con el formato solicitado",
                    "Tipo"=>"error"
                ];
                echo json_encode($alerta);
                exit();
            }


            if(mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,150}",$modelo)){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"El sistema operativo no coincide con el formato solicitado",
                    "Tipo"=>"error"
                ];
                echo json_encode($alerta);
                exit();
            }

            if(mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,150}",$puertos)){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"La Tarjeta grafica no coincide con el formato solicitado",
                    "Tipo"=>"error"
                ];
                echo json_encode($alerta);
                exit();
            }

            
            $datos_switch_up=[
            "estado"=>$estado,
            "marca"=>$marca,
            "modelo"=>$modelo,
            "puertos"=>$puertos,
            "area"=>$area,
            "id"=>$id
            ];

            if(equipoModelo::actualizar_switch_modelo($datos_switch_up)){
                $alerta=[
                    "Alerta"=>"recargar",
                    "Titulo"=>"Switch actualizado",
                    "Texto"=>"Los datos del switch se actualizaron con exito",
                    "Tipo"=>"success"
                ];
            }else{
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"No Hemos podido Actualizar los datos del switch",
                    "Tipo"=>"error"
                ];
            }  
            echo json_encode($alerta); 

        }/* ---fin controlador---- */
}