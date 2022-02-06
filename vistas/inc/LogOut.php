<script>
    let btn_salir=document.querySelector(".btn-exit-system");

    btn_salir.addEventListener('click', function(e){
        e.preventDefault();
        Swal.fire({
			title: '¿Desea Cerrar Sesion?',
			text: "Esta a punto de salir del sistema",
			type: 'question',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Si, salir!',
			cancelButtonText: 'No, cancelar'
		}).then((result) => {
			if (result.value) {
				let url='<?php echo SERVERURL;?>ajax/loginAjax.php';
                let token='<?php echo $lc->encryption($_SESSION['token_sdrtc']);?>';
                let usuario='<?php echo $lc->encryption($_SESSION['usuario_sdrtc']);?>';

                let datos = new FormData();
                datos.append("token",token);
                datos.append("usuario",usuario);

                fetch(url,{
                    method: 'POSt',
                    body: datos
                })
                .then(respuesta => respuesta.json())
                .then(respuesta => {
                    return alertas_ajax(respuesta);
                });
			}
		});
    });
</script>