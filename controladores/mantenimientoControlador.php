<?php 

    if($peticionAjax){
        require_once "../modelos/mantenimientoModelo.php";
    }else{
        require_once "./modelos/mantenimientoModelo.php";
    }

    class mantenimientoControlador extends mantenimientoModelo{
        /* ----Controlador para buscar equipo mantenimiento---- */
        public function buscar_equipo_mantenimiento_controlador(){
            //recuperar el texto
            $equipo=mainModel::limpiar_cadena($_POST['buscar_equipo']);

            //comprobar texto
            if($equipo==""){
                
                return '<div class="alert alert-warning" role="alert">
                <p class="text-center mb-0">
                    <i class="fas fa-exclamation-triangle fa-2x"></i><br>
                    Debes de introducir el ruc o la razon social
                </p>
                </div>';
                exit();
            }

            //Seleccionando equipos de la base de datos
            $datos_equipo=mainModel::ejecutar_consulta_simple("SELECT * FROM equipo_computo WHERE tipo_equipo_computo LIKE '%$equipo%' 
            OR area_designada LIKE '%$equipo%' OR direccion_ip LIKE '%$equipo%' ORDER BY area_designada ASC");

            if($datos_equipo->rowCount()>=1){
                $datos_equipo=$datos_equipo->fetchAll();
                $tabla='<div class="table-responsive"><table class="table table-hover table-bordered table-sm"><tbody>';

                foreach($datos_equipo as $rows){
                    $tabla.='<tr class="text-center">
                                    <td>'.$rows['tipo_equipo_computo'].' - '.$rows['area_designada'].' '.$rows['direccion_ip'].'</td>
                                    <td>
                                        <button type="button" class="btn btn-primary" onclick="agregar_equipo('.$rows['id_equipo_computo'].')"><i class="fas fa-check-square"></i></button>
                                    </td>
                                </tr>';
                }

                $tabla.='</tbody></table></div>';
                return $tabla;
            }else{
                return '<div class="alert alert-warning" role="alert">
                    <p class="text-center mb-0">
                        <i class="fas fa-exclamation-triangle fa-2x"></i><br>
                        No hemos encontrado ningúna equipo en el sistema que coincida con <strong>“'.$equipo.'”</strong>
                    </p>
                </div>';
                exit();
            }

        }/* Fin Controlador */

        /*controlador Agregar equipo al mantenimiento */
        public function agregar_equipo_mantenimiento_controlador(){

            //recuperar el texto
            $id=mainModel::limpiar_cadena($_POST['id_agregar_equipo']);

            //Comprobando la equipo en la bd
            $check_equipo=mainModel::ejecutar_consulta_simple("SELECT * FROM equipo_computo WHERE id_equipo_computo='$id'");

            if($check_equipo->rowCount()<=0){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"No hemos podido encontrar la equipo en la base de datos",
                    "Tipo"=>"error"
                ];
                echo json_encode($alerta);
                exit();
            }else{
                $campos=$check_equipo->fetch();
            }

            //Iniciando la sesion
            session_start(['name'=>'SDRTC']);

            if(empty($_SESSION['datos_equipo'])){
                $_SESSION['datos_equipo']=[
                    'ID'=>$campos['id_equipo_computo'],
                    'Tipo'=>$campos['tipo_equipo_computo'],
                    'Area'=>$campos['area_designada'],
                    'Ip'=>$campos['direccion_ip'],
                ];

                $alerta=[
                    "Alerta"=>"recargar",
                    "Titulo"=>"Equipo agregado",
                    "Texto"=>"El equipo se agrego correctamente",
                    "Tipo"=>"success"
                ];
                echo json_encode($alerta);
            }else{
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"No hemos podido agregar el equipo ",
                    "Tipo"=>"error"
                ];
                echo json_encode($alerta);
            }

        }/* Fin Controlador */
        
        /* controlador eliminar equipo del mantenimiento*/
        public function eliminar_equipo_mantenimiento_controlador(){

            //Iniciando la sesion
            session_start(['name'=>'SDRTC']);

            unset($_SESSION['datos_equipo']);

            if(empty($_SESSION['datos_equipo'])){
                $alerta=[
                    "Alerta"=>"recargar",
                    "Titulo"=>"Equipo removido",
                    "Texto"=>"Los datos de la equipo se removio correctamente",
                    "Tipo"=>"success"
                ]; 
            }else{
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"ocurrio un error inesperado",
                    "Texto"=>"No hemos podido remover los datos de la equipo",
                    "Tipo"=>"success"
                ];
            }
            echo json_encode($alerta);
            
        }/* Fin Controlador */

        //---------------------------------------------
        //* controlador agregar documento mantenimiento*/
        public function agregar_mantenimiento_controlador(){
            //iniciando la sesion
            session_start(['name'=>'SDRTC']);


            $tipo=mainModel::limpiar_cadena($_POST['mante_tipo_reg']);
            $estado=mainModel::limpiar_cadena($_POST['mante_estado_reg']);
            
            $observacion=mainModel::limpiar_cadena($_POST['mante_observacion_reg']);
            $entrada=mainModel::limpiar_cadena($_POST['mante_fecha_entrada_reg']);
            $horainicio=mainModel::limpiar_cadena($_POST['mante_hora_entrada_reg']);
            $salida=mainModel::limpiar_cadena($_POST['mante_fecha_salida_reg']);
            $horafin=mainModel::limpiar_cadena($_POST['mante_hora_salida_reg']);

            //comprobando equipo
            if(empty($_SESSION['datos_equipo'])){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"No has seleccionado ningun equipo para registrar",
                    "Tipo"=>"error"
                ];
                echo json_encode($alerta);
                exit();
            }

            /*--------comprobar campos vacios---------*/
            if($estado=="" || $tipo==""){
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
            

            if(mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,150}",$observacion)){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"La observacion no coincide con el formato solicitado",
                    "Tipo"=>"error"
                ];
                echo json_encode($alerta);
                exit();
            }

            
                         
            $datos_mantenimiento_reg=[
                "equipo"=>$_SESSION['datos_equipo']['ID'],
                "tipo"=>$tipo,
                "estado"=>$estado,
                
                "observacion"=>$observacion,
                "inicio"=>$entrada,
                "horainicio"=>$horainicio,
                "fin"=>$salida,
                "horafin"=>$horafin,
            ];
            $agregar_mantenimiento=mantenimientoModelo::agregar_mantenimiento_modelo($datos_mantenimiento_reg);

            if($agregar_mantenimiento->rowCount()==1){
                $alerta=[
                    "Alerta"=>"limpiar",
                    "Titulo"=>"mantenimiento registrado",
                    "Texto"=>"Los datos del mantenimiento se registraron correctamente",
                    "Tipo"=>"success"
                ];
            }else{
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"No hemos podido registrar el mantenimiento",
                    "Tipo"=>"error"
                ];
            }
            echo json_encode($alerta);
            
        }/*------------------Fin Controlador---------------------- */

        /*--CONTROLADOR PAGINADOR mantenimiento*/

        public function paginador_mantenimiento_controlador($pagina,$registros,$privilegio,$url,$tipo,$fecha_inicio,$fecha_fin){
            $pagina=mainModel::limpiar_cadena($pagina);
            $registros=mainModel::limpiar_cadena($registros);
            $privilegio=mainModel::limpiar_cadena($privilegio);

            $url=mainModel::limpiar_cadena($url);
            $url=SERVERURL.$url."/";

            $tipo=mainModel::limpiar_cadena($tipo);
            $fecha_inicio=mainModel::limpiar_cadena($fecha_inicio);
            $fecha_fin=mainModel::limpiar_cadena($fecha_fin);
            $tabla="";

            $pagina= (isset($pagina) && $pagina>0) ? (int) $pagina : 1 ;
            $inicio= ($pagina>0) ? (($pagina*$registros)-$registros) : 0 ;

            if ($tipo=="busqueda") {
                if (mainModel::verificar_fecha($fecha_inicio) || mainModel::verificar_fecha($fecha_fin)) {
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
            $campos="id_mante_equipo,
            tipo_mantenimiento,
            tipo_equipo_computo,
            direccion_ip,
            estado,
            mantenimiento_equipo.id_equipo_mante,
            estado_matenimiento,
            area_designada,
            descripcion,
            observacion,
            fecha_entrada,
            fecha_salida,
            hora_entrada,
            hora_salida";

                /***/
            if($tipo=="busqueda" && $fecha_inicio!="" && $fecha_fin!=""){
                $consulta="SELECT SQL_CALC_FOUND_ROWS $campos FROM mantenimiento_equipo INNER JOIN equipo_computo ON 
                equipo_computo.id_equipo_computo=mantenimiento_equipo.id_equipo_mante 
                WHERE (fecha_entrada BETWEEN '$fecha_inicio' AND '$fecha_fin')
                ORDER BY tipo_equipo_computo DESC limit $inicio,$registros";
            }else{
                $consulta="SELECT SQL_CALC_FOUND_ROWS $campos FROM mantenimiento_equipo INNER JOIN equipo_computo ON 
                equipo_computo.id_equipo_computo=mantenimiento_equipo.id_equipo_mante 
                ORDER BY tipo_equipo_computo DESC limit $inicio,$registros";
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
                        <th>EQUIPO</th>
                        <th>ESTADO</th>
                        <th>AREA</th>
                        <th>IP</th>
                        
                        <th>OBSERVACION</th>
                        <th>INGRESO</th>
                        <th>HORA</th>
                        <th>SALIDA</th>
                        <th>HORA</th>
                        <th>IMPRIMIR</th>';
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
                        <td>'.$rows['tipo_mantenimiento'].'</td>
                        <td>'.$rows['tipo_equipo_computo'].'</td>
                        <td>'.$rows['estado_matenimiento'].'</td>
                        <td>'.$rows['area_designada'].'</td>
                        <td>'.$rows['direccion_ip'].'</td>
                        
                        <td>'.$rows['observacion'].'</td>
                        <td>'.$rows['fecha_entrada'].'</td>
                        <td>'.$rows['hora_entrada'].'</td>
                        <td>'.$rows['fecha_salida'].'</td>
                        <td>'.$rows['hora_salida'].'</td>
                        ';
                        $tabla.= '
                        <td>
                            <a href="'.SERVERURL.'documentos/invoice.php?id='.mainModel::encryption($rows['id_mante_equipo']).'" class="btn btn-info" target="_blank">
                                    <i class="fas fa-file-pdf"></i>	
                            </a>
                        </td>
                        ';
                        if($privilegio==1 || $privilegio==2){
                        $tabla.='<td>
                            <a href="'.SERVERURL.'mante-update/'.mainModel::encryption($rows['id_mante_equipo']).'/" class="btn btn-success">
                                <i class="fas fa-sync-alt"></i>	
                            </a>
                        </td>';
                        }
                        if($privilegio==1){
                        $tabla.='<td>
                            <form class="FormularioAjax" action="'.SERVERURL.'ajax/manteAjax.php" method="POST" data-form="delete" autocomplete="off">
                            <input type="hidden" name="mante_id_del" value="'.mainModel::encryption($rows['id_mante_equipo']).'"> 
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
                $tabla.='<p class="text-right">Mostrando autorizacion '.$reg_inicio.' al '.$reg_final.' de un total de '.$total.'</p>';
                $tabla.=mainModel::paginador_tablas($pagina,$Npaginas,$url,7);
            }

            return $tabla;
        }/**FIN */

        /* controlador eliminar mantenimiento */
        public function eliminar_mantenimiento_controlador(){

            //recuperar id de mantenimiento
            $id=mainModel::decryption($_POST['mante_id_del']);
            $id=mainModel::limpiar_cadena($id);

            //comprobar el mantenimiento en la bd
            $check_mantenimiento=mainModel::ejecutar_consulta_simple("SELECT id_mante_equipo FROM mantenimiento_equipo WHERE id_mante_equipo='$id'");

            if($check_mantenimiento->rowCount()<=0){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"No hemos encontrado el mantenimiento en el sistema",
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

            $eliminar_mantenimiento=mantenimientoModelo::eliminar_mantenimiento_modelo($id);

            if($eliminar_mantenimiento->rowCount()==1){
                $alerta=[
                    "Alerta"=>"recargar",
                    "Titulo"=>"mantenimiento eliminada",
                    "Texto"=>"La mantenimiento ha sido eliminado con exito",
                    "Tipo"=>"success"
                ];
            }else{
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"No hemos podido eliminar la ajutorizacion porfavor intente nuevamente",
                    "Tipo"=>"error"
                ];
            }
            echo json_encode($alerta);

        }/*------fin controlador-------*/

        //------------------------------------------------
        /*----------Controlador datos mantenimiento ---------- */
        //------------------------------------------------
        public function datos_mantenimiento_controlador($tipo,$id){
            $tipo=mainModel::limpiar_cadena($tipo);
            
            $id=mainModel::decryption($id);
            $id=mainModel::limpiar_cadena($id);

            return mantenimientoModelo::datos_mantenimiento_modelo($tipo,$id);
        }/*------fin controlador-------*/

        //-------------------------------------------
        /*-------Controlador actualizar mantenimiento-------*/
        //-------------------------------------------
        public function actualizar_mantenimiento_controlador(){

            //recuperar el id
            $id=mainModel::decryption($_POST['mante_id_up']);
            $id=mainModel::limpiar_cadena($id);

            //Comprobar el autorizacion en la db
            $check_autorizacion=mainModel::ejecutar_consulta_simple("SELECT * FROM mantenimiento_equipo WHERE id_mante_equipo='$id'");

            if($check_autorizacion->rowCount()<=0){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"No hemos encontrado la autorizacion en el sistema",
                    "Tipo"=>"error"
                ];
                echo json_encode($alerta);
                exit();
            }else{
                $campos=$check_autorizacion->fetch();
            }

            $tipo=mainModel::limpiar_cadena($_POST['mante_tipo_up']);
            $estado=mainModel::limpiar_cadena($_POST['equipo_estado_up']);
            $descripcion=mainModel::limpiar_cadena($_POST['descripcion_equipo_up']);
            $observacion=mainModel::limpiar_cadena($_POST['mante_observacion_up']);
            $fechainicio=mainModel::limpiar_cadena($_POST['mante_fecha_entrada_up']);
            $horainicio=mainModel::limpiar_cadena($_POST['mante_hora_entrada_up']);
            $fechafin=mainModel::limpiar_cadena($_POST['mante_fecha_salida_up']);
            $horafin=mainModel::limpiar_cadena($_POST['mante_hora_salida_up']);

            /*--------comprobar campos vacios---------*/
            if($descripcion=="" || $tipo=="" || $estado==""){
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
            if(mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,150}",$descripcion)){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"La descripcion no coincide con el formato solicitado",
                    "Tipo"=>"error"
                ];
                echo json_encode($alerta);
                exit();
            }
            

            /* Comprobar Privilegios */
            session_start(['name'=>'SDRTC']);

            if($_SESSION['tipo_sdrtc']<1 || $_SESSION['tipo_sdrtc']>2){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"No tienes los permisos necesarios para realizar esta operacion",
                    "Tipo"=>"error"
                ];
                echo json_encode($alerta);
                exit();
            }
            
            $datos_mantenimiento_up=[
            "tipo"=>$tipo,
            "estado"=>$estado,
            "descripcion"=>$descripcion,
            "observacion"=>$observacion,
            "entrada"=>$fechainicio,
            "inicio"=>$horainicio,
            "salida"=>$fechafin,
            "fin"=>$horafin,
            "id"=>$id
            ];

            if(mantenimientoModelo::actualizar_mantenimiento_modelo($datos_mantenimiento_up)){
                $alerta=[
                    "Alerta"=>"recargar",
                    "Titulo"=>"Mantenimiento Actualizada",
                    "Texto"=>"Los datos del mantenimiento se registraron con exito",
                    "Tipo"=>"success"
                ];
            }else{
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"No Hemos podido Actualizar los datos",
                    "Tipo"=>"error"
                ];
            }  
            echo json_encode($alerta); 

        }/* ---fin controlador---- */
    }