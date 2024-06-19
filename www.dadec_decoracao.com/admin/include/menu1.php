
<style>
    .cliente{
        margin-top: 9px;
    }
</style>

<nav id="sidebar" class="sidebar js-sidebar">
			<div class="sidebar-content js-simplebar">
				<a class="sidebar-brand" href="client_profile.phpp">
          <div class="text-center p">DADEC - Cliente</div>
          <div class="text-center p">
          <img src="<?= $cliente_profile->profile_picture_picture(); ?>" class="img-fluid rounded-circle" width="80" height="80" alt="">
          <div class="user-profile"> <?= $cliente_profile->nome; ?></div>
          </div>
          
        </a>

				<ul class="sidebar-nav">
					<li class="sidebar-header">
						Menu
					</li>

					<li class="sidebar-item active">
						<a class="sidebar-link" href="client_profile.php">
                        <i class="mdi mdi-account mr-3"></i> <span class="align-middle">Perfil</span>
            </a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="alugar_material.php">
                        <i class="mdi mdi-cart mr-3"></i> <span class="align-middle">Alugar Materiais</span>
            </a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="decoracao.php">
                        <i class="mdi mdi-briefcase service-icon mr-3"></i> <span class="align-middle">Agendar Evento</span>
            </a>
					</li>


					<li class="sidebar-item">
						<a class="sidebar-link" href="pagamento_cliente.php">
                        <i class="mdi mdi-credit-card mr-3"></i> <span class="align-middle">Pagamentos</span>
            </a>
					</li>

                     
                    <li class="sidebar-item">
						<a class="sidebar-link" href="php-chat-app-main/home1.php">
                        <i class="mdi mdi-message message-icon mr-3"></i> <span class="align-middle">Chat</span>
            </a>
					</li>

					<!--
					<li class="sidebar-item">
						<a class="sidebar-link" href="pages-blank.html">
              <i class="align-middle" data-feather="book"></i> <span class="align-middle">Página em Branco</span>
            </a>
					</li>
-->


					<li class="sidebar-header">
						Configurações
					</li>

                    <li class="sidebar-item">
						<a class="sidebar-link" href="logout1.php">
              <i class="align-middle" data-feather="log-in"></i> <span class="align-middle">Sair</span>
            </a>
					</li>

			
					
				</ul>

				
			</div>
		</nav>