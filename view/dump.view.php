<div class="body">
    <?php include $views['menu']; ?>
    <div class="container mt-5">
        <h1 class="text-muted">Elementos Eliminados (<?= count($elementDelete) ?>)</h1>
        <?php if(empty($elementDelete)):?>
            <hr class="dropdown-divider">
            <h2 class="text-muted text-center"><i>No Hay Elemento Eliminados.</i></h2>
            <hr class="dropdown-divider">
        <?php else:?>
        <table class="table text-white">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Fecha</th>
                    <th>Acci&oacute;n</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($elementDelete as $element) : ?>
                    <tr>
                        <td><?= $element['name'] ?></td>
                        <td><?= date('h:i A | d M Y', strtotime($element['date'])) ?></td>
                        <td>
                            <?php if (time() < (strtotime($element['date']) + 86400)) : ?>
                                <form action="" method="post">
                                    <input type="hidden" name="delete" value="<?= $element['id'] ?>">
                                    <input type="hidden" name="origin" value="<?= $element['origin'] ?>">
                                    <button type="submit" class="btn btn-info">Restaurar</button>
                                </form>
                            <?php else:?>
                                <span class="text-muted"><i>No Disponible</i></span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php endif;?>
        <br><br>
        <span class="text-muted"><i>Nota: solo dispone de 24 horas para restaurar un elemento y 1 hora para borrar una m&uacute;sica.</i></span>
    </div>
</div>