<script>

    // buscar equipo
    function buscar_equipo(){

        let input_equipo=document.querySelector('#input_equipo').value;

        input_equipo=input_equipo.trim();

        if(input_equipo!=""){
            let datos = new FormData();
            datos.append("buscar_equipo",input_equipo);

            fetch("<?php echo SERVERURL;?>ajax/manteAjax.php",{
                method: 'POST',
                body:datos
            })
            .then(respuesta => respuesta.text())
            .then(respuesta => {
                let tabla_equipo=document.querySelector('#tabla_equipos');
                tabla_equipo.innerHTML=respuesta;
            });
        }else{
            Swal.fire({
            title: 'Ocurrio un error',
            text: 'Debes introducir el area, marca o tipo de quipo',
            type: 'error',
            confirmButtomText: 'Aceptar'
        });
        }
    }

    //agregar equipo
    function agregar_equipo(id){
        $('#ModalEquipo').modal('hide');
        Swal.fire({
            title: '¿Quieres agregar esta equipo?',
            text: 'Se va a agregar esta equipo para registrar un mantenimiento',
            type: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'si, Aceptar',
            cancelButtontext:'No, Cancelar'
        }).then((result) => {
            if(result.value){
                let datos = new FormData();
                datos.append("id_agregar_equipo",id);

                fetch("<?php echo SERVERURL;?>ajax/manteAjax.php",{
                    method: 'POST',
                    body:datos
                })
                .then(respuesta => respuesta.json())
                .then(respuesta => {
                    return alertas_ajax(respuesta);
                });
            }else{
                $('#ModalEquipo').modal('show');
            }
        });
    }

</script>