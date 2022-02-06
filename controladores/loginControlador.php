<?php 

    if($peticionAjax){
        require_once "../modelos/loginModelo.php";
    }else{
        require_once "./modelos/loginModelo.php";
    }

    class loginControlador extends loginModelo{
        /*--------------------Controlador iniciar sesion----------------------*/
        public function iniciar_sesion_controlador(){
            
            $usuario=mainModel::limpiar_cadena($_POST['usuario_log']);
            $clave=mainModel::limpiar_cadena($_POST['clave_log']);

            /*-------------- comprobar campos vacios-----------------*/
            if($usuario=="" || $clave==""){
                echo'<script>
                    Swal.fire({
                        title: "Ocurrio un error inesperado",
                        text: "No has llenado todos los campos que son requeridos",
                        type: "error",
                        confirmButtomText: "Aceptar"
                    });
                </script>';
                exit();
            }

            /*-----------Verificar la integridad de los datos--------------*/
            if(mainModel::verificar_datos("[a-zA-Z0-9]{1,35}", $usuario)){
                echo '
                <script>
                Swal.fire({
                    title: "Ocurrio un error inesperado",
                    text: "El nombre de usuario no coincide con el formato solicitado",
                    type: "error",
                    confirmButtomText: "Aceptar"
                });
                </script>';
                exit();
            }
            
            if(mainModel::verificar_datos("[a-zA-Z0-9$@.-]{4,100}", $clave)){
                echo '
                <script>
                Swal.fire({
                    title: "Ocurrio un error inesperado",
                    text: "La contraseña no coincide con el formato solicitado",
                    type: "error",
                    confirmButtomText: "Aceptar"
                });
                </script>';
                exit();
            }

            $clave=mainModel::encryption($clave);
            $datos_login=[
                "usuario"=>$usuario,
                "clave"=>$clave
            ];
            
            $datos_cuenta=loginModelo::iniciar_sesion_modelo($datos_login);
            if($datos_cuenta->rowCount()==1){
                $row=$datos_cuenta->fetch();

                session_start(['name'=>'SDRTC']);

                $_SESSION['id_sdrtc']=$row['id_usuario'];
                $_SESSION['nombre_sdrtc']=$row['NombreCompleto'];
                $_SESSION['usuario_sdrtc']=$row['nombre_usuario'];
                $_SESSION['tipo_sdrtc']=$row['tipo_usuario'];
                $_SESSION['token_sdrtc']=md5(uniqid(mt_rand(),true));

                if(headers_sent()){
                    echo "<script> window.location.href='".SERVERURL."home/'; </script>";
                }else{
                    return header("Location: ".SERVERURL."home/");
                }
            }else{
                echo '
                <script>
                Swal.fire({
                    title: "Ocurrio un error inesperado",
                    text: "El usuario o Clave son incorrectos",
                    type: "error",
                    confirmButtomText: "Aceptar"
                });
                </script>';
            }
        }/* fin controlador */

        /*---------------controlador forzar cierre de sesion ------------------- */
        public function forzar_cierre_sesion_controlador(){
            session_unset();
            session_destroy();
            if(headers_sent()){
                echo "<script> window.location.href='".SERVERURL."login/'; </script>";
            }else{
                return header("Location: ".SERVERURL."login/");
            }
        }/* fin controlador */

        /*---------------controlador cierre de sesion ------------------- */
        public function cerrar_sesion_controlador(){
            session_start(['name'=>'SDRTC']);
            $token=mainModel::decryption($_POST['token']);
            $usuario=mainModel::decryption($_POST['usuario']);

            if($token==$_SESSION['token_sdrtc'] && $usuario==$_SESSION['usuario_sdrtc']){
                session_unset();
                session_destroy();
                $alerta=[
                    "Alerta"=>"redireccionar",
                    "URL"=>SERVERURL."login/"
                ];
            }else{
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrio un error inesperado",
                    "Texto"=>"No se pudo cerrar la sesion en el sistema",
                    "Tipo"=>"error"
                ];
            }
            echo json_encode($alerta);
        }/* fin controlador */
    }