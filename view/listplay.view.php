<div class="body">
    <?php include $views['menu']; ?>
    <div class="container-fluid mt-4">
        <?php if (!isset($_GET['listmusic'])) : ?>
            <h1 class="text-muted">Listas de Reproducci&oacute;n</h1>
            <div class="dropdown-divider"></div>
            <?php if (count($listsName) == 0) : ?>
                <h3 class="text-muted text-center">No hay listas de reproducci&oacute;n disponibles.</h3>
            <?php else : ?>
                <?php foreach ($listsName as $listName) : ?>
                    <form action="" method="post" id="form_<?= $listName['listName'] ?>">
                        <a href="./?view=<?= $view ?>&listmusic=<?= md5($listName['idList']) ?>">
                            <h2 class="text-white"><i class="fas fa-plus"></i> <?= $listName['listName'] ?>
                                <a href="#" onclick="document.getElementById('form_<?= $listName['listName'] ?>').submit()"><i class="fas fa-trash-alt text-danger cursor-pointer"></i></a>
                                <input type="hidden" name="deleteList" value="<?= $listName['idList'] ?>">
                            </h2>
                        </a>
                    </form>
                <?php endforeach; ?>
            <?php endif; ?>
            <div class="dropdown-divider"></div>
            <button class="btn btn-primary" id="show-add-new-list" onclick="onClick.home.hidden('new-list');onClick.home.hidden('show-add-new-list');">Nueva Lista</button>
            <div id="new-list" hidden>
                <br>
                <form action="" method="post">
                    <div class="form-group">
                        <label for="listname" class="text-white">Nombre de Lista</label><br>
                        <input type="text" name="txtListName" id="listname" minlength="3" required><br>
                        <button class="btn btn-danger" type="button" onclick="onClick.home.hidden('new-list');onClick.home.hidden('show-add-new-list');">Cancelar</button>
                        <button class="btn btn-primary" type="submit">Crear</button>
                    </div>
                </form>
            </div>
        <?php else : ?>
            <h1 class="text-muted">Lista de Reproducci&oacute;n <?=$listMusics['listName']?></h1>
            <div class="dropdown-divider"></div>
            <?php foreach($listMusics['musics'] as $music):?>
                <?php $sound = $music['music'];?>
                <?php include $views['sound'];?>
            <?php endforeach;?>
        <?php endif; ?>
    </div>
</div>