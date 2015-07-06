<?php use Configuracion\Idiomas; ?>

<div class="page-header">
    <h1><?php echo $data['titulo'] ?></h1>
</div>

<p><?php echo $data['inicio_mensaje'] ?></p>

<a class="btn btn-md btn-success" href="<?php echo DIR;?>SubPagina">
    <?php echo Idiomas::mostrar('abrir_subpagina', 'Inicio'); ?>
</a>

