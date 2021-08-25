<div class="navbar navbar-expand-lg navbar-dark" style="background-color: #212529;box-shadow: 0px 1px 15px 2px #6c757d;">
    <div class="container">
        <a class="navbar-brand" href="./"><?= $html->getTitle() ?></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-default" aria-controls="navbar-default" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbar-default">
            <div class="navbar-collapse-header">
                <div class="row">
                    <div class="col-6 collapse-brand">
                        <a href="javascript:void(0)">
                            <img src="<?= $html->getIconPage() ?>">
                        </a>
                    </div>
                    <div class="col-6 collapse-close">
                        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar-default" aria-controls="navbar-default" aria-expanded="false" aria-label="Toggle navigation">
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>

            <ul class="navbar-nav ml-lg-auto">
                <?php if (Session::Auth()) : ?>
                    <li class="nav-item">
                        <a class="nav-link nav-link-icon" href="./?view=loadmusic">
                            <span><i class="fas fa-cloud-upload-alt"></i> Cargar M&uacute;sica</span>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link nav-link-icon" href="#" id="navbar-default_dropdown_1" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span><?=strtoupper(Session::getUsername())?></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbar-default_dropdown_1" style="background-color: #212529;">
                            <a class="dropdown-item text-white disabled" href="#"><?=Session::Admin()?'Administrador':'Miembro'?></a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item text-white" href="./?view=dump">Papeler&iacute;a de Recliclaje</a>
                            <a class="dropdown-item text-white" href="./?view=listplay">Lista de Reproducci&oacute;n</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item text-white" href="./?view=logout"><i class="fas fa-sign-out-alt"></i>Cerrar Sesi&oacute;n</a>
                        </div>
                    </li>
                <?php else : ?>
                    <li class="nav-item">
                        <a class="nav-link nav-link-icon" href="./?view=login">
                            <span><i class="fas fa-sign-in-alt"></i> Acceder</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-icon" href="./?view=register">
                            <span><i class="fas fa-user-plus"></i> Registrarse</span>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</div>