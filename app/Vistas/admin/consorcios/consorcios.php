<div class="row">
    <div id="breadcrumb" class="col-md-12">
        <ol class="breadcrumb">
            <li><a href="<?php echo DIR;?>Admin">Inicio</a></li>
            <li><a href="<?php echo DIR;?>Admin/Consorcios">Consorcios</a></li>
        </ol>
    </div>
</div>
<h1>Consorcios</h1>
<p><a href='<?php echo DIR;?>admin/consorcios/agregar' class = 'btn btn-info'>Agregar Consorcio</a></p>
<table class = 'table table-striped table-hover table-bordered responsive'>
    <tr>
        <th>Direccion</th>
        <th>Altura</th>
        <th>CUIT</th>
        <th>Acciones</th>
    </tr>
    <?php
    if($data['consorcios']){
        foreach($data['consorcios'] as $row){
            echo "<tr>";
            echo "<td>$row->Direccion</td>";
            echo "<td>$row->Altura</td>";
            echo "<td>$row->CUIT</td>";
            echo "<td>
                    <a href='".DIR."Admin/Consorcios/Editar/$row->IdConsorcio'>Editar</a>
                    <a href='".DIR."Admin/Consorcios/Eliminar/$row->IdConsorcio'>Eliminar</a>
                  </td>";
            echo "</tr>";
        }
    }
    ?>
</table>