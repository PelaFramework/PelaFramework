<section class="container">
    <section class="login-form">
        <form method="post" action="" role="login" >
            <h3>Sistemas BCO</h3>
            <div class="row">
                <div class="col-xs-12"><?php echo \Configuracion\Error::mostrarError($error); ?></div>
                <div class="col-xs-12">
                    <input type="email" name="usuario" placeholder="Usuario" required class="form-control input-lg" />
                    <span class="glyphicon glyphicon-user"></span>
                </div>
                <div class="col-xs-12">
                    <input type="password" name="password" placeholder="Contraseña" required class="form-control input-lg" />
                    <span class="glyphicon glyphicon-lock"></span>
                </div>
            </div>
            <button type="submit" name="submit" class='btn btn-info btn-block'>Ingresar</button>
            <!--<section>class="btn btn-lg btn-block btn-success"
                <a href="#">Registrarse</a> or <a href="#">Olvidé mi contraseña</a>
            </section>-->
        </form>
    </section>
</section>