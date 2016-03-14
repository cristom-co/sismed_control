<?php
Vista::mostrar('plantillas/_encabezado', $datos);
Vista::mostrar('plantillas/_menuSuperior', $datos);
Vista::mostrar('plantillas/_menuLateral'); //Cambiar por controlador segun el rol
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
        <div class="row" style="margin-top: 10px"></div>
                <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-7 col-xs-12">
                <div class="input-group">
                    <span class="input-group-addon"><span class="glyphicon glyphicon-search"></span></span>
                    <input type="text" name="txtBuscar" id="txtBuscar" class="form-control" placeholder="Identificacion benficiario">
                    <span class="input-group-btn">
                        <button class="btn btn-info" id="btnBuscar" type="button">Buscar</button>
                    </span>
                </div>
            </div>
            <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                <button type="button" class="btn btn-info col-xs-12" data-toggle="modal" data-target="#modalRegistrarAgendaMedica">Crear Cita Medica</button>
            </div>
        </div>
        <div class="row" style="margin-top: 10px"></div>
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title text-center">Citas Medicas</h3>
            </div>
            <div class="panel-body">
                
                <div class="table-responsive">
                    <table id="tblCitasMedicas" class="table table-condensed table-hover">
                        <thead>
                            <tr>
                                <th>
                                    Fecha Hora Registro
                                </th>
                                <th>
                                    Fecha
                                </th>
                                <th>
                                   Hora
                                </th>
                                <th>
                                    Duracion
                                </th>
                                <th>
                                    Comentarios
                                </th>
                                <th>
                                    Estado
                                </th>
                                <th>
                                    Id Beneficiario
                                </th>
                                <th>
                                    Id Consultorio
                                </th>
                                <th>
                                    Id Agenda Medica
                                </th>
                                <th class='text-center'>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>              
                        </tbody>
                    </table>
                    <div id="oculto"></div>
                </div>
            </div>

        </div>
    </div><!-- /.container-fluid -->
</div><!-- /#page-wrapper -->
<?php Vista::mostrar('plantillas/_pie', $datos); ?>

<script type="text/javascript">
    $.post('<?php echo URL_BASE; ?>agendasMedicas/listarAgendasMedicas', {}, function (data) {
        var datos = JSON.parse(data);
        var filas;
        var cont = 0;
        $.each(datos, function (i, v) {
            cont = cont + 1;
            idEmpleado = v.empleados_idEmpleado;
            filas += "<tr>";
            filas += "<td>" + v.numeroIdentificacionEmpleado + "</td>";
            filas += "<td>" + v.nombresEmpleado + " " + v.apellidosEmpleado + "</td>";
            filas += "<td>";
            filas += "</td>";
            filas += "<td class='text-center'>";
            filas += "<button class='btn btn-xs btn-danger' data-toggle='modal' data-target='#modalEliminarAgendaMedica" + cont + "' name='btnModalEliminarAgendaMedica'><i class='fa fa-close'></i></button>";
            filas += "<div class = 'modal fade' id='modalEliminarAgendaMedica" + cont + "' tabindex = '-1' role = 'dialog'>";
            filas += "<div class='modal-dialog'>";
            filas += "<div class='modal-content'>";
            filas += "<div class='modal-header'>";
            filas += "<button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>";
            filas += "<h4 class='modal-title'>Eliminar Agenda Medica</h4>";
            filas += "</div>";
            filas += "<div class='modal-body'>";
            filas += "<p>¿Seguro que desea eliminar registro?</p>";
            filas += "</div>";
            filas += "<div class='modal-footer'>";
            filas += "<form action='<?php echo URL_BASE; ?>agendasMedicas/eliminarAgendaMedica' method='POST'>";
            filas += "<button type='button' class='btn btn-default' data-dismiss='modal'>Cancelar</button>";
            filas += "<button class='btn btn-primary' type='submit' name='btnEliminarAgendaMedica'> Aceptar </button>";
            filas += "<input type='hidden' name='idAgendaMedica' value='" + v.idAgendaMedica + "'>";
            filas += "</form>";
            filas += "</div>";
            filas += "</div>";
            filas += "</div>";
            filas += "</div>";
            filas += "</td>";
            filas += "</tr>";
        });
        $('#tblAgendaMedica tbody').html(filas);
    });
</script>
<script type="text/javascript">
    //Revisar funcionamiento
    $('#btnBuscar').click(function () {
        var AgendaMedica = $('#txtBuscar').val();
        $.post('<?php echo URL_BASE; ?>agendaMedica/listarDocumentoEmpleado', {AgendaMedica: AgendaMedica}, function (data) {
            var datos = JSON.parse(data);
            var cont = 0;
            if (datos != false) {
                var filas;
                $.each(datos, function (i, v) {
                    cont = cont + 1;
                    filas += "<tr>";
                    filas += "<td>" + v.numeroIdentificacionEmpleado + "</td>";
                    filas += "<td>" + v.nombresEmpleado + " " + v.apellidosEmpleado + "</td>";
                    filas += "<td>" + horasDiarias + "</td>";
                    filas += "<td>";
                    filas += "<form action='<?php echo URL_BASE; ?>agendasMedicas/editarAgendaMedica' method='POST'>";
                    filas += "<button class='btn btn-xs btn-success' type='submit' name='btnEditarAgendaMedica'><i class='fa fa-edit'></i></button>";
                    filas += "<input type='hidden' name='idAgendaMedica' value='" + v.idAgendaMedica + "'>";
                    filas += "</form>";
                    filas += "</td>";
                    filas += "<td>";
                    filas += "<button class='btn btn-xs btn-danger' data-toggle='modal' data-target='#modalEliminarAgendaMedica" + cont + "' name='btnModalEliminarAgendaMedica'><i class='fa fa-close'></i></button>";
                    filas += "<div class = 'modal fade' id='modalEliminarAgendaMedica" + cont + "' tabindex = '-1' role = 'dialog'>";
                    filas += "<div class='modal-dialog'>";
                    filas += "<div class='modal-content'>";
                    filas += "<div class='modal-header'>";
                    filas += "<button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>";
                    filas += "<h4 class='modal-title'>Eliminar Agenda Medica</h4>";
                    filas += "</div>";
                    filas += "<div class='modal-body'>";
                    filas += "<p>¿Seguro que desea eliminar registro?</p>";
                    filas += "</div>";
                    filas += "<div class='modal-footer'>";
                    filas += "<form action='<?php echo URL_BASE; ?>agendasMedicas/eliminarAgendaMedica' method='POST'>";
                    filas += "<button type='button' class='btn btn-default' data-dismiss='modal'>Cancelar</button>";
                    filas += "<button class='btn btn-primary' type='submit' name='btnEliminarAgendaMedica'> Aceptar </button>";
                    filas += "<input type='hidden' name='idAgendaMedica' value='" + v.idAgendaMedica + "'>";
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
                filas += "<td colspan='6'>No existe Funcionario con este Numero de documento</td>";
                filas += "</tr>";
            }
            $('#tblFuncionarios tbody').html(filas);
        });
    });
</script>
<?php Vista::mostrar('registrarAgendaMedica', $datos); ?>