<section class="full-box nav-lateral">
		<div class="full-box nav-lateral-bg show-nav-lateral"></div>
			<div class="full-box nav-lateral-content">
				<figure class="full-box nav-lateral-avatar">
					<i class="far fa-times-circle show-nav-lateral"></i>
					<img src="<?php echo SERVERURL;?>vistas/assets/avatar/Avatar.png" class="img-fluid" alt="Avatar">
					<figcaption class="roboto-medium text-center">
						<?php echo $_SESSION['nombre_sdrtc'];?> <br>
						<small class="roboto-condensed-light"><?php
						$tipo=$_SESSION['tipo_sdrtc'];
						if($tipo==1){
							echo "Administrador";
						}else if($tipo==2){
							echo "Asistente";
						}else if($tipo==3){
							echo "Invitado";
						}
						?> </small><br>
						<small class="roboto-condensed-light"><?php echo $_SESSION['usuario_sdrtc']; ?></small>
					</figcaption>
				</figure>
				<div class="full-box nav-lateral-bar"></div>
				<nav class="full-box nav-lateral-menu">
					<ul>
						<li>
							<a href="<?php echo SERVERURL;?>home/"><i class="fab fa-dashcube fa-fw"></i> &nbsp; Menu Principal</a>
						</li>						
						<li>
							<a href="#" class="nav-btn-submenu"><i class="fas fa-laptop"></i> &nbsp; Equipo de computo <i class="fas fa-chevron-down"></i></a>
							<ul>
								<li><?php if($_SESSION['tipo_sdrtc']==1){ ?>
									<a href="<?php echo SERVERURL;?>equipo-new/"><i class="fas fa-plus fa-fw"></i> &nbsp; Agregar Equipo de computo</a>
								<?php } ?>
								</li>
								<li>
									<a href="<?php echo SERVERURL;?>compu-list/"><i class="fas fa-list-alt"></i> &nbsp; Lista de computadoras</a>
								</li>
								<li>
									<a href="<?php echo SERVERURL;?>impre-list/"><i class="fas fa-list-alt"></i> &nbsp; Lista de impresoras</a>
								</li>
								<li>
									<a href="<?php echo SERVERURL;?>switch-list/"><i class="fas fa-list-alt"></i> &nbsp; Lista de switchs</a>
								</li>
							</ul>
						</li>
						<li>
							<a href="#" class="nav-btn-submenu"><i class="fas  fa-tools"></i> &nbsp; Mantenimiento <i class="fas fa-chevron-down"></i></a>
							<ul>
								<li>
									<a href="<?php echo SERVERURL;?>mante-new/"><i class="fas fa-plus fa-fw"></i> &nbsp; Nuevo mantenimiento</a>
								</li>
								<li>
									<a href="<?php echo SERVERURL;?>mante-list/"><i class="fas fa-list-alt"></i> &nbsp; Lista de mantenimientos</a>
								</li>
								<li>
									<a href="<?php echo SERVERURL;?>mante-search/"><i class="fas fa-search fa-fw"></i> &nbsp; Buscar mantenimiento</a>
								</li>
							</ul>
						</li>						
						<?php if($_SESSION['tipo_sdrtc']==1){ ?>
						<li>
							<a href="#" class="nav-btn-submenu"><i class="fas  fa-user-secret fa-fw"></i> &nbsp; Usuarios <i class="fas fa-chevron-down"></i></a>
							<ul>
								<li>
									<a href="<?php echo SERVERURL;?>user-new/"><i class="fas fa-plus fa-fw"></i> &nbsp; Nuevo usuario</a>
								</li>
								<li>
									<a href="<?php echo SERVERURL;?>user-list/"><i class="fas fa-list-alt"></i> &nbsp; Lista de usuarios</a>
								</li>
								<li>
									<a href="<?php echo SERVERURL;?>user-search/"><i class="fas fa-search fa-fw"></i> &nbsp; Buscar usuario</a>
								</li>
							</ul>
						</li>
						<?php } ?>												
					</ul>
				</nav>
			</div>
</section>