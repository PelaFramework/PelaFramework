<?php use Configuracion\Idiomas; ?>

<div class="page-header">
    <h1><?php echo $data['titulo'] ?></h1>
</div>

<p><?php echo $data['subpagina_mensaje'] ?></p>

<a class="btn btn-md btn-success" href="<?php echo DIR;?>">
    <?php echo Idiomas::mostrar('inicio', 'Inicio'); ?>
</a>
