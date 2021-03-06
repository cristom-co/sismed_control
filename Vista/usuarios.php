<?php
Vista::mostrar('plantillas/_encabezado', $datos);
Vista::mostrar('plantillas/_menuSuperior', $datos);
Vista::mostrar('plantillas/_menuLateral');
?>

<div id="page-wrapper" style=" min-height:30em ">
    <div class="container-fluid fondoFluid" id="formArea">
        <!-- encabezado wrapper -->
        <div class="row" >
            <div class="col-lg-10">
                <h1 class="page-header bg-info letraTitulos">
                    SISMED <small>Cuidarte es nuestro deber</small>
                </h1>
                <ul >
                    <li class="letraTitulos">
                        Sistema de gestión de citas y formulación médica
                    </li>
                </ul>
            </div>
            <div class="col-lg-2">
                <img src="<?php echo URL_BASE; ?>Vista/img/logo2.png" alt="" class="img-responsive" style="max-widht:150px; max-height:150px;">
            </div>
        </div>
            <div class="row">
            
            <div class=" col-md-offset-3 col-md-6 col-md-offset-3">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-5">
                                <i class="fa fa-user fa-5x"></i>
                            </div>
                            <div class="col-xs-7 text-right">
                               <div class="huge">Modulo de usuarios</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-6 col-md-6 col-sm-7 col-xs-12">
                <div class="input-group">
                    <span class="input-group-addon"><span class="glyphicon glyphicon-search"></span></span>
                    <input type="text" name="txtBuscar" id="txtBuscar" class="form-control" placeholder="Correo electronico" maxlength="30">
                    <span class="input-group-btn">
                        <button class="btn btn-info" id="btnBuscar" type="button">Buscar</button>
                    </span>
                </div>
            </div>
            <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                <button type="button" class="btn btn-info col-xs-12" data-toggle="modal" data-target="#modalRegistrarUsuario">Crear usuario</button>
            </div>
        </div>

        <div class="row" style="margin-top: 10px"></div>
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title text-center">Usuarios</h3>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table id="tblUsuarios" class="table table-condensed table-hover">
                        <thead>
                            <tr>
                                <th>
                                    Correo electronico
                                </th>
                                <th>
                                    Rol
                                </th>
                                <th>
                                    Identificacion empleado
                                </th>
                                <th>
                                    Empleado
                                </th>
                                <th colspan="2">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>              
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div><!-- /.container-fluid -->
</div><!-- /#page-wrapper -->
<?php Vista::mostrar('plantillas/_pie', $datos); ?>
<script type="text/javascript">



    $.post('<?php echo URL_BASE; ?>usuarios/listarUsuarios', {}, function (data) {
        var datos = JSON.parse(data);
        var filas;
        var cont = 0;
        $.each(datos, function (i, v) {
            cont = cont + 1;
            filas += "<tr>";
            filas += "<td>" + v.correoEmpleado + "</td>";
            filas += "<td>" + v.nombreRol + "</td>";
            filas += "<td>" + v.numeroIdentificacionEmpleado + "</td>";
            filas += "<td>" + v.nombresEmpleado + " " + v.apellidosEmpleado + "</td>";
            filas += "<td>";
            filas += "<form action='<?php echo URL_BASE; ?>usuarios/editarUsuario' method='POST'>";
            filas += "<button class='btn btn-xs btn-success' type='submit' name='btnEditarUsuario'><i class='fa fa-edit'></i></button>";
            filas += "<input type='hidden' name='idUsuario' value='" + v.idUsuario + "'>";
            filas += "</form>";
            filas += "</td>";
            filas += "<td>";
            filas += "<button class='btn btn-xs btn-danger' data-toggle='modal' data-target='#modalEliminarUsuario" + cont + "' name='btnModalEliminarUsuario'><i class='fa fa-close'></i></button>";
            filas += "<div class = 'modal fade' id='modalEliminarUsuario" + cont + "' tabindex = '-1' role = 'dialog'>";
            filas += "<div class='modal-dialog'>";
            filas += "<div class='modal-content'>";
            filas += "<div class='modal-header'>";
            filas += "<button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>";
            filas += "<h4 class='modal-title'>Eliminar usuario</h4>";
            filas += "</div>";
            filas += "<div class='modal-body'>";
            filas += "<p>¿Seguro que desea eliminar registro?</p>";
            filas += "</div>";
            filas += "<div class='modal-footer'>";
            filas += "<form action='<?php echo URL_BASE; ?>usuarios/eliminarUsuario' method='POST'>";
            filas += "<button type='button' class='btn btn-default' data-dismiss='modal'>Cancelar</button>";
            filas += "<button class='btn btn-primary' type='submit' name='btnEliminarUsuario'> Aceptar </button>";
            filas += "<input type='hidden' name='idUsuario' value='" + v.idUsuario + "'>";
            filas += "</form>";
            filas += "</div>";
            filas += "</div>";
            filas += "</div>";
            filas += "</div>";
            filas += "</td>";
            filas += "</tr>";
        });
        $('#tblUsuarios tbody').html(filas);
    });

    $('#btnBuscar').click(function () {
        var correo = $('#txtBuscar').val();
        $.post('<?php echo URL_BASE; ?>usuarios/listarCorreoUsuario', {correo: correo}, function (data) {
            var datos = JSON.parse(data);
            var cont = 0;
            if (datos != false) {
                var filas;
                $.each(datos, function (i, v) {
                    cont = cont + 1;
                    filas += "<tr>";
                    filas += "<td>" + v.correoEmpleado + "</td>";
                    filas += "<td>" + v.nombreRol + "</td>";
                    filas += "<td>" + v.numeroIdentificacionEmpleado + "</td>";
                    filas += "<td>" + v.nombresEmpleado + " " + v.apellidosEmpleado + "</td>";
                    filas += "<td>";
                    filas += "<form action='<?php echo URL_BASE; ?>usuarios/editarUsuario' method='POST'>";
                    filas += "<button class='btn btn-xs btn-success' type='submit' name='btnEditarUsuario'><i class='fa fa-edit'></i></button>";
                    filas += "<input type='hidden' name='idUsuario' value='" + v.idUsuario + "'>";
                    filas += "</form>";
                    filas += "</td>";
                    filas += "<td>";
                    filas += "<button class='btn btn-xs btn-danger' data-toggle='modal' data-target='#modalEliminarUsuario" + cont + "' name='btnModalEliminarRol'><i class='fa fa-close'></i></button>";
                    filas += "<div class = 'modal fade' id='modalEliminarUsuario" + cont + "' tabindex = '-1' role = 'dialog'>";
                    filas += "<div class='modal-dialog'>";
                    filas += "<div class='modal-content'>";
                    filas += "<div class='modal-header'>";
                    filas += "<button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>";
                    filas += "<h4 class='modal-title'>Eliminar usuario</h4>";
                    filas += "</div>";
                    filas += "<div class='modal-body'>";
                    filas += "<p>¿Seguro que desea eliminar registro?</p>";
                    filas += "</div>";
                    filas += "<div class='modal-footer'>";
                    filas += "<form action='<?php echo URL_BASE; ?>usuarios/eliminarUsuario' method='POST'>";
                    filas += "<button type='button' class='btn btn-default' data-dismiss='modal'>Cancelar</button>";
                    filas += "<button class='btn btn-primary' type='submit' name='btnEliminarUsuario'> Aceptar </button>";
                    filas += "<input type='hidden' name='idUsuario' value='" + v.idUsuario + "'>";
                    filas += "</form>";
                    filas += "</div>";
                    filas += "</div>";
                    filas += "</div>";
                    filas += "</div>";
                    filas += "</td>";
                    filas += "</tr>";
                });

            } else {
                filas += "<tr>";
                filas += "<td colspan='6'>No existe usuario con este correo</td>";
                filas += "</tr>";
            }
            $('#tblUsuarios tbody').html(filas);
        });
    });
</script>

<?php Vista::mostrar('registrarUsuario', $datos); ?>