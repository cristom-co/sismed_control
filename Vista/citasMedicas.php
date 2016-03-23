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
                <button type="button" class="btn btn-info col-xs-12" data-toggle="modal" data-target="#modalRegistrarCitaMedica">Crear Cita Medica</button>
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
                                    Registro
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
                                    Cedula
                                </th>
                                <th>
                                    Beneficiario
                                </th>
                                <th>
                                    Consultorio
                                </th>
                                <th>
                                    Doctor
                                </th>
                                <th colspan="3" class='text-center'>Acciones</th>
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
    $.post('<?php echo URL_BASE; ?>citasMedicas/listarCitasMedicas', {}, function (data) {
        var datos = JSON.parse(data);
        var filas;
        var cont = 0;
        var estadoCita;
        $.each(datos, function (i, v) {
            cont = cont + 1;
            filas += "<tr>";
            filas += "<td>" + v.fechaHoraRegistroCitaMedica + "</td>";
            filas += "<td>" + v.fechaAgendaMedica + "</td>";
            filas += "<td>" + v.hora + "</td>";
            filas += "<td>" + v.duracionCitaMedica + "</td>";
            filas += "<td>" + v.comentariosCitaMedica + "</td>";
            switch (v.estadoCitaMedica) {
                case '1':
                    estadoCita = "Asignada";
                    break;
                case '2':
                    estadoCita = "En progreso";
                    break;
                case '3':
                    estadoCita = "Cancelada";
                    break;
                case '4':
                    estadoCita ="Atendida";
                    break;
                case '5':
                    estadoCita ="Perdida";
                    break;
            }
            filas += "<td>" + estadoCita + "</td>";
            filas += "<td>" + v.numeroIdentificacionBeneficiario + "</td>";
            filas += "<td>" + v.nombresBeneficiario + " "+ v.apellidosBeneficiario + "</td>";
            filas += "<td>" + v.numeroConsultorio + "</td>";
            //filas += "<td>" + v.agendas_medicas_idAgendasMedica + "</td>";
            filas += "<td>" + v.nombresEmpleado + " " + v.apellidosEmpleado + "</td>";
            filas += "<td>";
            filas += "<form action='<?php echo URL_BASE; ?>consultas/consulta' method='POST'>";
            filas += "<button class='btn btn-xs btn-warning' type='submit' name='btnConstulaCitaMedica'><i class='fa fa-stethoscope'></i></button>";
            filas += "<input type='hidden' name='idCitaMedica' value='" + v.idCitaMedica  + "'>";
            filas += "<input type='hidden' name='idBeneficiario' value ='"+v.idBeneficiario+"'>"; //idBeneficiario para la insercion del episodio
            filas += "</form>";
            filas += "</td>";
            filas += "<td>";
            filas += "<form action='<?php echo URL_BASE; ?>citasMedicas/editarCitaMedica' method='POST'>";
            filas += "<button class='btn btn-xs btn-success' type='submit' name='btnEditarCitaMedica'><i class='fa fa-edit'></i></button>";
            filas += "<input type='hidden' name='idCitaMedica' value='" + v.idCitaMedica  + "'>";
            filas += "</form>";
            filas += "</td>";
            filas += "<td>";
            filas += "<button class='btn btn-xs btn-danger' data-toggle='modal' data-target='#modalEliminarCitaMedica" + cont + "' name='btnModalEliminarCitaMedica'><i class='fa fa-close'></i></button>";
            filas += "<div class = 'modal fade' id='modalEliminarCitaMedica" + cont + "' tabindex = '-1' role = 'dialog'>";
            filas += "<div class='modal-dialog'>";
            filas += "<div class='modal-content'>";
            filas += "<div class='modal-header'>";
            filas += "<button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>";
            filas += "<h4 class='modal-title'>Eliminar Cita Medica</h4>";
            filas += "</div>";
            filas += "<div class='modal-body'>";
            filas += "<p>¿Seguro que desea eliminar registro?</p>";
            filas += "</div>";
            filas += "<div class='modal-footer'>";
            filas += "<form action='<?php echo URL_BASE; ?>citasMedicas/eliminarCitaMedica' method='POST'>";
            filas += "<button type='button' class='btn btn-default' data-dismiss='modal'>Cancelar</button>";
            filas += "<button class='btn btn-primary' type='submit' name='btnEliminarCitaMedica'> Aceptar </button>";
            filas += "<input type='hidden' name='idCitaMedica' value='" + v.idCitaMedica + "'>";
            filas += "</form>";
            filas += "</div>";
            filas += "</div>";
            filas += "</div>";
            filas += "</div>";
            filas += "</td>";
            filas += "</tr>";
        });
        $('#tblCitasMedicas tbody').html(filas);
    });


</script>

<?php Vista::mostrar('registrarCitaMedica', $datos); ?>