<?php
include "menu.php";

include "../negociacion/NegCategorias.php";

$negCategoria = new NegCategoria();
$dato = $negCategoria->mostrar();

?>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <button id="btnNuevo" type="button" class="btn btn-success">Nuevo</button>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <table id="tbCategoria" class="table table-striped table-bordered table-condensed" style="width:100%">
                <thead class="text-center">
                    <tr>
                        <th>id_categoria</th>
                        <th>Nombre</th>
                        <th>Estatus</th>  
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    foreach ($dato as $dat) {
                    ?>
                        <tr>
                            <th><?php echo ($dat->{"id_categoria"}); ?> </th>
                            <td><?php echo ($dat->{"nombre"}); ?></td>
                            <td><?php echo ($dat->{"estatus"}); ?></td>
                            <td></td>
                        </tr>
                    <?php
                    }
                    ?>


                </tbody>
            </table>

        </div>

    </div>




</div>
<!--Modal para CRUD-->
<div class="modal fade" id="modalCRUD" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formCategorias">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nombre" class="col-form-label">Nombre:</label>
                        <input type="text" class="form-control" id="nombre">
                    </div>
                    <div class="form-group">
                        <label for="estatus" class="col-form-label">estatus:</label>
                        <input type="text" class="form-control" id="estatus">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                    <button type="submit" id="btnGuardar" class="btn btn-dark">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>


</div>

</div>

<?php include "menuFin.php"; ?>

<script src="js/categorias.js"></script>

</body>
</html>