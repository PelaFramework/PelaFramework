<?php use Configuracion\Idiomas; ?>

<div class="page-header">
    <h1><?php echo $data['titulo'] ?></h1>
</div>

<a class="btn btn-md btn-success" href="<?php echo DIR;?>Logout">
    <?php echo Idiomas::mostrar('salir', 'usuarios/inicio'); ?>
</a>