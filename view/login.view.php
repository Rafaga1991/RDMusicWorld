<div class="body">
    <?php include $views['menu'] ?>
    <div class="container px-lg-9 mt-8">
        <div class="card text-white px-lg-8 py-lg-5" style="background-color: #212529;">
            <div class="card-header" style="background-color: #212529;">
                <h2 class="text-white">Inicio de Sesión</h2>
            </div>
            <div class="card-body">
                <?php if (isset($_POST['username'])) : ?>
                    <label for="" class="alert alert-danger">Usuario y/o clave inválido.</label>
                <?php endif; ?>
                <form action="" method="post">
                    <div class="form-group">
                        <div class="input-group input-group-alternative mb-4">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input class="form-control form-control-alternative" name="username" placeholder="Usuario" type="text" minlength="6" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group input-group-alternative mb-4">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                            </div>
                            <input class="form-control form-control-alternative" name="password" placeholder="Contraseña" type="password" minlength="6" required>
                        </div>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Acceder</button>
                    </div>
                </form>
            </div>
            <div class="card-footer" style="background-color: #212529;">
                <a href="./?view=register">Registrarme</a>
            </div>
        </div>
    </div>
    <br><br><br><br><br>
</div>