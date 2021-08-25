<div class="body">
    <?php include $views['menu']; ?>
    <div class="container mt-5">
        <?php if (!isset($_GET['message'])) : ?>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="card" style="background-color: #212529;">
                    <div class="card-header" style="background-color: #212529;">
                        <h1 class="text-muted"><i class="fas fa-music"></i> Nueva M&uacute;sica</h1>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="title" class="text-white">T&iacute;tulo de la M&uacute;sica</label>
                            <input type="text" class="form-control" name="txtTitle" id="title" placeholder="título..." minlength="6" required>
                        </div>
                        <div class="form-group">
                            <label for="author" class="text-white">Nombre del Autor</label>
                            <input type="text" class="form-control" name="txtAuthor" id="author" placeholder="author..." minlength="6" required>
                        </div>
                        <div class="form-group">
                            <label for="description" class="text-white">Descripci&oacute;n de la M&uacute;sica</label>
                            <textarea class="form-control form-control-alternative" name="txtDescription" id="description" rows="3" placeholder="(opcional)"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="" class="text-white">G&eacute;nero Musical</label>
                            <select name="genner" id="genner" class="form-control">
                                <?php foreach ($gennerMusical as $index => $genner) : ?>
                                    <option value="<?= $index ?>"><?= $genner['gennerName'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="fileMusic" class="text-white">Cargar el archivo musical</label>
                            <input type="file" name="fileMusic" id="fileMusic" class="form-control" accept=".WAV, .AIFF, .AU, .FLAC, .MPEG-4, .Shorten, .TTA, .ATRAC, .Apple Lossless, .MP3, .Vorbis, .Musepack, .AAC, .WMA, .Opus, .OGG, .DSD, .MQA" required>
                        </div>
                    </div>
                    <div class="card-footer text-right" style="background-color: #212529;">
                        <button type="submit" class="btn btn-success">Cargar</button>
                    </div>
                </div>
            </form>
        <?php else:?>
            <div class="card bg-<?=$_GET['action']?>">
                <div class="card-body alert alert-<?=$_GET['action']?>">
                    <span class="display-3"><?=$_GET['message']?></span>
                </div>
                <div class="card-footer" style="background-color: #212529;">
                    <a href="./" class="btn btn-success"><i class="fas fa-arrow-left"></i> Inicio</a>
                </div>
            </div>
        <?php endif; ?>
    </div>
    <br><br><br><br><br>
</div>