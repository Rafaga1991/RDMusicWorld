<div style="width: 19rem;display: inline-block;">
    <div class="card">
        <div class="card-header" style="background-color: #212529;">
            <div class="row">
                <div class="col text-uppercase"><strong class="text-muted"><?= $sound['nameMusic'] ?></strong></div>
                <div class="col text-right">
                    <span class="icon icon-shape rounded-circle bg-gray text-white">
                        <i class="fas fa-music"></i>
                    </span>
                </div>
            </div>
        </div>
        <div class="card-body" style="background-color: #212529;">
            <audio id="sound_<?= $sound['idMusic'] ?>">
                <source src="<?= $assets['SOUND']['FILE_DIR'][$sound['fileNameMusic']] ?>" type="<?= $sound['formatMusic'] ?>">
            </audio>
            <div class="music">
                <div class="progress-wrapper">
                    <div class="progress-info">
                        <div class="progress-label">
                            <i class="fas fa-play" progress="progress_<?= $sound['idMusic'] ?>" time="time_<?= $sound['idMusic'] ?>" onclick="onClick.home.play(this, 'sound_<?= $sound['idMusic'] ?>')"></i>
                            <i class="fas fa-stop" progress="progress_<?= $sound['idMusic'] ?>" time="time_<?= $sound['idMusic'] ?>" onclick="onClick.home.stop()"></i>
                        </div>
                        <div class="progress-percentage">
                            <span id="time_<?= $sound['idMusic'] ?>"></span>
                            <i class="fas fa-volume-up" onclick="onClick.home.hidden('vol_<?= $sound['idMusic'] ?>')"></i>
                            <input class="volumeSound" id="vol_<?= $sound['idMusic'] ?>" type="range" onchange="onClick.home.volume(this, 'sound_<?= $sound['idMusic'] ?>')" onmousemove="onClick.home.volume(this, 'sound_<?= $sound['idMusic'] ?>')" hidden>
                        </div>
                    </div>
                    <div class="progress">
                        <div class="progress-bar bg-primary" id="progress_<?= $sound['idMusic'] ?>" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>
                    </div>
                </div>
            </div>
            <?php if (!empty($sound['descriptionMusic'])) : ?>
                <div id="description_<?= $sound['idMusic'] ?>" hidden>
                    <div class="dropdown-divider"></div>
                    <span><?= $sound['descriptionMusic'] ?></span>
                </div>
            <?php endif; ?>
            <div class="dropdown-divider"></div>
            <div class="row">
                <div class="col">
                    <h6 class="form-label text-gray" style="font-weight: normal;">G&eacute;nero: <i><span class="text-uppercase badge badge-danger"><?= $sound['genner']['gennerName'] ?></span></i></h6>
                </div>
                <div class="col">
                    <?php if (!empty($sound['descriptionMusic'])) : ?>
                        <button class="btn-description bg-info" onclick="onClick.home.hidden('description_<?= $sound['idMusic'] ?>')">Descripci&oacute;n</button>
                    <?php endif; ?>
                </div>
            </div>
            <h6 class="form-label text-gray" style="font-weight: normal;">Publicado por: <i><span class="text-uppercase text-white"><?= $sound['user']['username'] ?></span></i></h6>
            <h6 class="form-label text-gray" style="font-weight: normal;">Fecha de Pub.: <i><span class="text-uppercase text-white"><?= date('h:i A | d M Y', strtotime($sound['dateMusic'])) ?></span></i></h6>
            <div class="dropdown-divider"></div>
            <a href="./?view=<?= $view ?>&search=<?= $sound['authorMusic'] ?>" class="badge badge-success text-center"><?= $sound['authorMusic'] ?></a>
        </div>
        <div class="card-footer" style="background-color: #212529;">
            <div class="row">
                <?php if (Session::Auth()) : ?>
                    <div class="col text-success"><span class="cursor-pointer"><?= $sound['likes'] ?> <i class="<?= $sound['like'] ? 'fas' : 'far' ?> fa-thumbs-up" onclick="onClick.home.like(this, '<?= $sound['idMusic'] ?>')"></i></span></div>
                <?php else : ?>
                    <a href="./?view=login">
                        <div class="col text-success"><?= $sound['likes'] ?> <i class="<?= $sound['like'] ? 'fas' : 'far' ?> fa-thumbs-up"></i></div>
                    </a>
                <?php endif; ?>
                <div class="col text-center">
                    <?php if (Session::Auth()) : ?>
                        <form action="" method="post" id="form_footer_<?= $sound['idMusic'] ?>">
                            <a href="<?= $assets['SOUND']['FILE_DIR'][$sound['fileNameMusic']] ?>" download="<?= $sound['nameMusic'] . '.' . (explode('.', $assets['SOUND']['FILE_DIR'][$sound['fileNameMusic']])[2]) ?>"><i class="fas fa-cloud-download-alt cursor-pointer"></i></a>
                            <?php if (time() <= (strtotime($sound['dateMusic']) + 3600) && $sound['idUser'] == Session::getUserID()) : ?>
                                <input type="hidden" name="delete" value="<?= $sound['idMusic'] ?>">
                                | <a href="#" onclick="document.getElementById('form_footer_<?= $sound['idMusic'] ?>').submit()"><i class="fas fa-trash-alt text-danger cursor-pointer"></i></a>
                            <?php endif; ?>
                        </form>
                    <?php endif; ?>
                </div>
                <div class="col text-right">
                    <?php if (Session::Auth()) : ?>
                        <div class="card" id="list_<?= $sound['idMusic'] ?>" style="position: absolute;bottom: 0px;right: 20px;width: 15rem;" hidden>
                            <div class="card-header text-center text-uppercase text-muted" style="background-color: #212529;">Mis Listas</div>
                            <div class="card-body text-left" style="background-color: #212529;">
                                <div class="dropdown-divider"></div>
                                <?php foreach ($listsName as $listName) : ?>
                                    <form action="./?view=listplay" method="post" id="form_<?= $sound['idMusic'] ?>_<?= $listName['idList'] ?>">
                                        <input type="hidden" name="idMusic" value="<?= $sound['idMusic'] ?>">
                                        <input type="hidden" name="idList" value="<?= $listName['idList'] ?>">
                                        <a onclick="document.getElementById('form_<?= $sound['idMusic'] ?>_<?= $listName['idList'] ?>').submit()" class="dropdown-item text-white cursor-pointer"><i class="fas fa-plus"></i> <?= $listName['listName'] ?></a>
                                    </form>
                                <?php endforeach; ?>
                                <div class="dropdown-divider"></div>
                            </div>
                            <a href="./?view=listplay" class="btn bg-info text-white card-footer"><i class="fas fa-plus"></i> Nueva Lista</a>
                        </div>
                        <i class="fas fa-plus cursor-pointer" onclick="onClick.home.hidden('list_<?= $sound['idMusic'] ?>')"></i>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>