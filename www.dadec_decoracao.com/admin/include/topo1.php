<style>


	@media (max-width: 890px) {

		.cliente{
        margin-top: 9px;
    }

    .navbar{
		position: fixed;
		z-index: 1;
    }
	
	.content{
		margin-top: 30px;
	}
}
</style>

<nav class="navbar navbar-expand navbar-light navbar-bg">
				<a class="sidebar-toggle js-sidebar-toggle">
          <i class="hamburger align-self-center"></i>
        </a>

				<div class="navbar-collapse collapse">
					<ul class="navbar-nav navbar-align">
						
						
						<li class="nav-item cliente">
                                <div class="user-profile"> <b> <?= $users_profile->nome; ?> </b></div>
						</li>

						

						<li class="nav-item dropdown">
							<a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
                <i class="align-middle" data-feather="settings"></i>
							
				
							
							<div class="dropdown-menu dropdown-menu-end">
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="logout.php">Sair</a>
							</div>
						</li>
					</ul>
				</div>
			</nav>