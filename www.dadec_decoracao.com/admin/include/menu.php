
<style>
    .cliente{
        margin-top: 9px;
    }

    .navbar{
        background-attachment: red;
    }
</style>

<nav id="sidebar" class="sidebar js-sidebar">
			<div class="sidebar-content js-simplebar">
				<a class="sidebar-brand" href="users_profile.php">
          <div class="text-center p">DADEC - <?= $users_profile->designacao; ?></div>
          <div class="text-center p">
          <img src="<?= $users_profile->profile_picture_picture(); ?>" class="img-fluid rounded-circle" width="80" height="80" alt="">
          <div class="user-profile"> <?=$users_profile->nome; ?></div>
          </div>
          
        </a>

				<ul class="sidebar-nav">
					<li class="sidebar-header">
						Menu
					</li>

					<li class="sidebar-item active">
						<a class="sidebar-link" href="dashboard.php">
                        <i class="mdi mdi-home mr-3"></i><span class="align-middle">Dashboard</span>
            </a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="blog_events.php">
                        <i class="mdi mdi-comment-text mr-3"></i> <span class="align-middle">Publicações</span>
            </a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="material.php">
                        <i class="mdi mdi-cart mr-3"></i> <span class="align-middle">Produtos</span>
            </a>
					</li>

                    <li class="sidebar-item">
						<a class="sidebar-link" href="funcionario.php">
                        <i class="mdi mdi-account-multiple mr-3"></i> <span class="align-middle">Funcionários</span>
            </a>
					</li>


					<li class="sidebar-item">
						<a class="sidebar-link" href="cliente1.php">
                        <i class="mdi mdi-account mr-3"></i> <span class="align-middle">Clientes</span>
            </a>
					</li>

                    <li class="sidebar-item">
						<a class="sidebar-link" href="pagamento1.php">
                        <i class="mdi mdi-cash budget-icon mr-3"></i> <span class="align-middle">Pagamentos</span>
            </a>
					</li>
                    
                    <li class="sidebar-item">
						<a class="sidebar-link" href="service_list.php">
                        <i class="mdi mdi-verified mr-3"></i> <span class="align-middle">Serviços</span>
            </a>
					</li>
                    <li class="sidebar-header">
						Extras
					
					</li>
                    <li class="sidebar-item">
						<a class="sidebar-link" href="Fasmapay/index.php">
                        <i class="mdi mdi-check-circle mr-3"></i> <span class="align-middle">Validar Pagamentos</span>
            </a>
                    </li>
                    <li class="sidebar-item">
						<a class="sidebar-link" href="php-chat-app-main/home.php">
                        <i class="mdi mdi-message message-icon mr-3"></i> <span class="align-middle">Chat</span>
            </a>
					</li>

                    <li class="sidebar-item">
						<a class="sidebar-link" href="photos_view.php">
                        <i class="mdi mdi-image-multiple mr-3"></i> <span class="align-middle">Galeria de Fotos</span>
            </a>
					</li>
            <li class="sidebar-header">
						Relatórios
					
					</li>
                    <li class="sidebar-item">
						<a class="sidebar-link" href="relatorio.php">
                        <i class="mdi mdi-printer mr-3"></i> <span class="align-middle">Material</span>
            </a>
					</li>
                    <li class="sidebar-item">
						<a class="sidebar-link" href="relatorio1.php">
                        <i class="mdi mdi-printer mr-3"></i> <span class="align-middle">Eventos</span>
            </a>
					</li>

                    

					<li class="sidebar-header">
						Configurações
					</li>



                    <li class="sidebar-item">
						<a class="sidebar-link" href="users_profile.php">
                        <i class="mdi mdi-account mr-3"></i> <span class="align-middle">Perfil</span>
            </a>
					</li>
                    <li class="sidebar-item">
						<a class="sidebar-link" href="users.php">
                        <i class="mdi mdi-calendar-text mr-3" ></i> <span class="align-middle">Usuários</span>
            </a>
					</li>

                    </li>
                    <li class="sidebar-item">
						<a class="sidebar-link" href="task_all_calendar.php">
                        <i class="mdi mdi-calendar-text mr-3"></i> <span class="align-middle">Calendário</span>
            </a>
					</li>
					
				
                <li class="sidebar-item">
						<a class="sidebar-link" href="logout1.php">
              <i class="align-middle" data-feather="log-in"></i> <span class="align-middle">Sair</span>
            </a>
					</li>

                    </ul>
			</div>
		</nav>