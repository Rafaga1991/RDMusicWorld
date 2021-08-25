<div class="body">
    <?php include $views['menu']; ?>
    <div class="container-fluid mt-3">
        <div class="card" style="background-color: #212529;">
            <div class="card-body">
                <h1 class="text-muted">Busca tu m&uacute;sica favorita</h1>
                <form action="" method="get">
                    <div class="form-group">
                        <input type="text" name="search" class="form-control" placeholder="Nombre o Autor de Música a Buscar" required>
                    </div>
                </form>
            </div>
        </div>
        <?php if (isset($_GET['search'])) : ?>
            <div class="card" style="background-color: #212529;">
                <div class="card-header" style="background-color: #212529;">
                    <h2 class="text-muted">Resultados de Busqueda (<?= count($musics) ?>)</h2>
                    <hr class="dropdown-divider">
                    <br>
                    <?php foreach ($musics as $sound) : ?>
                        <?php include $views['sound']; ?>
                    <?php endforeach; ?>
                </div>
                <div class="card-body">
                    <br><br><br><br><br>
                </div>
            </div>
        <?php endif; ?>
    </div>
    <?php if (!isset($_GET['search'])) : ?>
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <?php for ($i = 0; $i < count($assets['IMAGE']['CAROUSEL']['FILE_DIR']); $i++) : ?>
                    <li data-target="#carouselExampleIndicators" data-slide-to="<?= $i ?>" class="<?= $i == 0 ? 'active' : '' ?>"></li>
                <?php endfor; ?>
            </ol>
            <div class="carousel-inner">
                <?php foreach ($assets['IMAGE']['CAROUSEL']['FILE_DIR'] as $index => $path) : ?>
                    <div class="carousel-item <?= $index == 'bfmv' ? 'active' : '' ?>">
                        <img class="d-block w-100" src="<?= $path ?>">
                    </div>
                <?php endforeach; ?>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
        <div class="container-fluid mt-5">
            <h1 class="text-muted">LO NUEVO HASTA AHORA</h1>
            <div class="dropdown-divider"></div><br>
            <?php foreach($musics as $sound):?>
                <?php include $views['sound'];?>
            <?php endforeach;?>
        </div>
    <?php endif; ?>
    <br><br><br><br><br>
</div>