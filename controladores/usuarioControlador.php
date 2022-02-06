<?php 

    if($peticionAjax){
        require_once "../modelos/usuarioModelo.php";
    }else{
        require_once "./modelos/usuarioModelo.php";
    }

    class usuarioControlador extends usuarioModelo{
        /*---------------- Controlador agregar usuario ----------------*/
        public function agregar_usuario_controlador(){
            $nombres=mainModel::limpiar_cadena($_POST['usuario_nombre_reg']);
            $usuario=mainModel::limpiar_cadena($_POST['usuario_usuario_reg']);
            $clave1=mainModel::limpiar_cadena($_POST['usuario_clave_1_reg']);
            $clave2=mainModel::limpiar_cadena($_POST['usuario_clave_2_reg']);
            $tipo=mainModel::limpiar_cadena($_POST['usuario_tipo_reg']);

            /*--------comprobar campos vacios---------*/
            if($nombres=="" || $usuario=="" || $clave1=="" || $clave2=="" || $tipo ==""){
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
            if(mainModel::verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{7,100}",$nombres)){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"El nombre no coincide con el formato solicitado",
                    "Tipo"=>"error"
                ];
                echo json_encode($alerta);
                exit();
            }

            if(mainModel::verificar_datos("[a-zA-Z0-9]{5,35}",$usuario)){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"El usuario no coincide con el formato solicitado",
                    "Tipo"=>"error"
                ];
                echo json_encode($alerta);
                exit();
            }

            if(mainModel::verificar_datos("[a-zA-Z0-9$@.-]{4,100}",$clave1) || mainModel::verificar_datos("[a-zA-Z0-9$@.-]{4,100}",$clave2)){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"Las contraseñas no coinciden con el formato solicitado",
                    "Tipo"=>"error"
                ];
                echo json_encode($alerta);
                exit();
            }

            /*------------Comprobando usuario-----------*/
            $check_usuario=mainModel::ejecutar_consulta_simple("SELECT nombre_usuario FROM usuario WHERE nombre_usuario='$usuario'");
            if($check_usuario->rowCount()>0){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"El nombre de usuario ya se encuentra registrado en el sistema",
                    "Tipo"=>"error"
                ];
                echo json_encode($alerta);
                exit();
            }

            /*------------Comprobando Claves-----------*/
            if($clave1!=$clave2){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"Las contraseñas no coinciden",
                    "Tipo"=>"error"
                ];
                echo json_encode($alerta);
                exit();
            }else{
                $clave=mainModel::encryption($clave1);
            }  
            /*---------------Comprobando Tipo de usuario-------------------*/
            if($tipo<1 || $tipo>3){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"El tipo de usuario seleccionado no es valido",
                    "Tipo"=>"error"
                ];
                echo json_encode($alerta);
                exit();
            }

            $datos_usuario_reg=[
                "nombrecompleto"=>$nombres,
                "usuario"=>$usuario,
                "clave"=>$clave,
                "tipo"=>$tipo,
                "estado"=>"Activo",
            ];
            $agregar_usuario=usuarioModelo::agregar_usuario_modelo($datos_usuario_reg);

            if($agregar_usuario->rowCount()==1){
                $alerta=[
                    "Alerta"=>"limpiar",
                    "Titulo"=>"usuario registrado",
                    "Texto"=>"Los datos del usuario se registraron correctamente",
                    "Tipo"=>"success"
                ];
            }else{
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"No hemos podido registrar el usuario",
                    "Tipo"=>"error"
                ];
            }
            echo json_encode($alerta);
            
        }/*------------------Fin Controlador---------------------- */
        
        //----------------------------------------------------------------
        /*---------------- Controlador paginador usuario ----------------*/
        //----------------------------------------------------------------
        public function paginador_usuario_controlador($pagina,$registros,$privilegio,$id,$url,$busqueda){
            $pagina=mainModel::limpiar_cadena($pagina);
            $registros=mainModel::limpiar_cadena($registros);
            $privilegio=mainModel::limpiar_cadena($privilegio);
            $id=mainModel::limpiar_cadena($id);

            $url=mainModel::limpiar_cadena($url);
            $url=SERVERURL.$url."/";

            $busqueda=mainModel::limpiar_cadena($busqueda);
            $tabla="";

            $pagina= (isset($pagina) && $pagina>0) ? (int) $pagina : 1 ;
            $inicio= ($pagina>0) ? (($pagina*$registros)-$registros) : 0 ;

            if(isset($busqueda) && $busqueda!=""){
                $consulta="SELECT id_usuario,NombreCompleto,nombre_usuario,
                CASE
                        WHEN tipo_usuario = 1 THEN 'Administrador'
                        WHEN tipo_usuario = 2 THEN 'Asistente'
                        WHEN tipo_usuario = 3 THEN 'Invitado'
                        ELSE 'Indefinido'
                    END as tipo_usuario,estado_usuario FROM usuario 
                WHERE ((id_usuario!='$id' AND id_usuario!='1') AND (NombreCompleto LIKE '%$busqueda%' OR nombre_usuario LIKE '%$busqueda%')) 
                ORDER BY NombreCompleto ASC limit $inicio,$registros";
            }else{
                $consulta="SELECT id_usuario,NombreCompleto,nombre_usuario,
                CASE
                        WHEN tipo_usuario = 1 THEN 'Administrador'
                        WHEN tipo_usuario = 2 THEN 'Asistente'
                        WHEN tipo_usuario = 3 THEN 'Invitado'
                        ELSE 'Indefinido'
                    END as tipo_usuario,estado_usuario FROM usuario 
                WHERE id_usuario!='$id' AND id_usuario!='1' ORDER BY NombreCompleto ASC limit $inicio,$registros";
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
                        <th>NOMBRES Y APELLIDOS</th>
                        <th>NOMBRE DE USUARIO</th>
                        <th>TIPO DE USUARIO</th>
                        <th>ESTADO</th>
                        <th>ACTUALIZAR</th>
                        <th>ELIMINAR</th>
                    </tr>
                </thead>
                <tbody>';
            if($total>=1 && $pagina<=$Npaginas){
                $contador=$inicio+1;
                $reg_inicio=$inicio+1;
                foreach($datos as $rows){
                    $tabla.='<tr class="text-center" >
                        <td>'.$contador.'</td>
                        <td>'.$rows['NombreCompleto'].'</td>
                        <td>'.$rows['nombre_usuario'].'</td>
                        <td>'.$rows['tipo_usuario'].'</td>
                        <td>'.$rows['estado_usuario'].'</td>
                        <td>
                            <a href="'.SERVERURL.'user-update/'.mainModel::encryption($rows['id_usuario']).'/" class="btn btn-success">
                                <i class="fas fa-sync-alt"></i>	
                            </a>
                        </td>
                        <td>
                            <form class="FormularioAjax" action="'.SERVERURL.'ajax/usuarioAjax.php" method="POST" data-form="delete" autocomplete="off">
                            <input type="hidden" name="usuario_id_del" value="'.mainModel::encryption($rows['id_usuario']).'"> 
                            <button type="submit" class="btn btn-warning">
                                    <i class="far fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>
                    </tr>';
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
                $tabla.='<p class="text-right">Mostrando usuario '.$reg_inicio.' al '.$reg_final.' de un total de '.$total.'</p>';
                $tabla.=mainModel::paginador_tablas($pagina,$Npaginas,$url,7);
            }

            return $tabla;
        }/*------------------Fin Controlador---------------------- */
        
        //==============================================================
        //==============================================================
        /*-----------------Controlador Eliminar Usuario-------------------*/
        //================================================================
        public function eliminar_usuario_controlador(){
            
            /* recibiendo id del usuario */
            $id=mainModel::decryption($_POST['usuario_id_del']);
            $id=mainModel::limpiar_cadena($id);

            /* comprobando el usuario principal*/
            if($id==1){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"No se puede eliminar el usuario principal del sistema",
                    "Tipo"=>"error"
                ];
                echo json_encode($alerta);
                exit();
            }

            /* comprobando el usuario en BD */
            $check_usuario=mainModel::ejecutar_consulta_simple("SELECT id_usuario FROM usuario WHERE id_usuario='$id'");
            if($check_usuario->rowCount()<=0){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"El usuario que intenta eliminar no existe en el sistema",
                    "Tipo"=>"error"
                ];
                echo json_encode($alerta);
                exit(); 
            }

            /* comprobando privilegios */
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

            $eliminar_usuario=usuarioModelo::eliminar_usuario_modelo($id);
            if($eliminar_usuario->rowCount()==1){
                $alerta=[
                    "Alerta"=>"recargar",
                    "Titulo"=>"Usuario eliminado",
                    "Texto"=>"El usuario ah sido eliminado del sistema exitosamente",
                    "Tipo"=>"success"
                ];
                
            }else{
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"No hemos podido eliminar el usuario, porfavor intente nuevamente",
                    "Tipo"=>"error"
                ];
            }
            echo json_encode($alerta);

        }/*--------Fin controlador---------*/


        /*--------------Controlador datos usuario----------------*/

        public function datos_usuario_controlador($tipo,$id){
            $tipo=mainModel::limpiar_cadena($tipo);

            $id=mainModel::decryption($id);
            $id=mainModel::limpiar_cadena($id);

            return usuarioModelo::datos_usuario_modelo($tipo,$id);
        }/*--------Fin controlador---------*/

        //=====================================================
        //=====================================================
        /*----------- controlador Actualizar usuario ----------*/
        //=====================================================
        //=====================================================

        public function actualizar_usuario_controlador(){
            // Recibiendo id
            $id=mainModel::decryption($_POST['usuario_id_up']);
            $id=mainModel::limpiar_cadena($id);

            //comprobar el usuario en la BD
            $check_user=mainModel::ejecutar_consulta_simple("SELECT * FROM usuario WHERE id_usuario='$id'");

            if($check_user->rowCount()<=0){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"No hemos encontrado el usuario en el sistema",
                    "Tipo"=>"error"
                ];
                echo json_encode($alerta);
                exit(); 
            }else{
                $campos=$check_user->fetch();
            }

            $nombre=mainModel::limpiar_cadena($_POST['usuario_nombre_up']);
            $usuario=mainModel::limpiar_cadena($_POST['usuario_usuario_up']);

            if(isset($_POST['usuario_estado_up'])){
                $estado=mainModel::limpiar_cadena($_POST['usuario_estado_up']);
            }else{
                $estado=$campos['estado_usuario'];
            }

            if(isset($_POST['usuario_tipo_up'])){
                $tipo=mainModel::limpiar_cadena($_POST['usuario_tipo_up']);
            }else{
                $tipo=$campos['tipo_usuario'];
            }

                        
            /*--------comprobar campos vacios---------*/
            if($nombre=="" || $usuario==""){
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
            if(mainModel::verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{7,100}",$nombre)){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"El nombre no coincide con el formato solicitado",
                    "Tipo"=>"error"
                ];
                echo json_encode($alerta);
                exit();
            }

            if(mainModel::verificar_datos("[a-zA-Z0-9]{5,35}",$usuario)){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"El usuario no coincide con el formato solicitado",
                    "Tipo"=>"error"
                ];
                echo json_encode($alerta);
                exit();
            }

            if($tipo<1 || $tipo>3){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"El tipo de usuario no corresponde a un valor valido",
                    "Tipo"=>"error"
                ];
                echo json_encode($alerta);
                exit();
            }

            if($estado!="Activo" && $estado !="Inactivo"){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"El estado de la cuenta no coincide con el formato solicitado",
                    "Tipo"=>"error"
                ];
                echo json_encode($alerta);
                exit();
            }

            /*------------Comprobando usuario-----------*/
            if($usuario!=$campos['nombre_usuario']){
                $check_usuario=mainModel::ejecutar_consulta_simple("SELECT nombre_usuario FROM usuario WHERE nombre_usuario='$usuario'");
                if($check_usuario->rowCount()>0){
                    $alerta=[
                        "Alerta"=>"simple",
                        "Titulo"=>"Ocurrio un error inesperado",
                        "Texto"=>"El nombre de usuario ya se encuentra registrado en el sistema",
                        "Tipo"=>"error"
                    ];
                    echo json_encode($alerta);
                    exit();
                }
            }
            
            /*-----------Comprobando Claves ------------ */
            if($_POST['usuario_clave_nueva_1']!="" || $_POST['usuario_clave_nueva_2']!=""){
                if($_POST['usuario_clave_nueva_1']!=$_POST['usuario_clave_nueva_2']){
                    $alerta=[
                        "Alerta"=>"simple",
                        "Titulo"=>"Ocurrio un error inesperado",
                        "Texto"=>"Las nuevas claves ingresadas no coinciden",
                        "Tipo"=>"error"
                    ];
                    echo json_encode($alerta);
                    exit();
                }else{
                    if(mainModel::verificar_datos("[a-zA-Z0-9$@.-]{4,100}",$_POST['usuario_clave_nueva_1']) || 
                    mainModel::verificar_datos("[a-zA-Z0-9$@.-]{4,100}",$_POST['usuario_clave_nueva_2'])){
                        $alerta=[
                            "Alerta"=>"simple",
                            "Titulo"=>"Ocurrio un error inesperado",
                            "Texto"=>"Las nuevas claves no coinciden con el formato solicitado",
                            "Tipo"=>"error"
                        ];
                        echo json_encode($alerta);
                        exit();
                    }
                    $clave=mainModel::encryption($_POST['usuario_clave_nueva_1']);

                }
            }else{
                $clave=$campos['clave_usuario'];
            }

            /* Preparando datos para enviarlo al modelo */
            $datos_usuario_up=[
                "nombrecompleto"=>$nombre,
                "usuario"=>$usuario,
                "clave"=>$clave,
                "tipo"=>$tipo,
                "estado"=>$estado,
                "id"=>$id,
            ];

            
            if(usuarioModelo::actualizar_usuario_modelo($datos_usuario_up)){
                $alerta=[
                    "Alerta"=>"recargar",
                    "Titulo"=>"Datos Actualizados",
                    "Texto"=>"Los datos han sido actualizados con exito",
                    "Tipo"=>"success"
                ];
            }else{
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"No hemos podido actualizar los datos, por favor intente nuevamente",
                    "Tipo"=>"error"
                ];
            }
            echo json_encode($alerta);

            /*$actualizar_usuario=usuarioModelo::actualizar_usuario_modelo($datos_usuario_up);

            if($actualizar_usuario->rowCount()==1){
                $alerta=[
                    "Alerta"=>"limpiar",
                    "Titulo"=>"usuario registrado",
                    "Texto"=>"Los datos del usuario se actualizaron correctamente",
                    "Tipo"=>"success"
                ];
            }else{
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"No hemos podido actualizar el usuario",
                    "Tipo"=>"error"
                ];
            }
            echo json_encode($alerta);*/


        }/* fin controlador */
    }