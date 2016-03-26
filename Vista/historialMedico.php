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
                                    Médico
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
    $.post('<?php echo URL_BASE; ?>citasMedicas/listarCitasMedicasAtentidas', {}, function (data) {
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
                    estadoCita = "<span class='label label-primary'>Asignada</span>";
                    break;
                case '2':
                    estadoCita = "<span class='label label-info'>En progreso</span>";
                    break;
                case '3':
                    estadoCita = "<span class='label label-warning'>Cancelada</span>";
                    break;
                case '4':
                    estadoCita = "<span class='label label-success'>Atendida</span>";
                    break;
                case '5':
                    estadoCita = "<span class='label label-danger'>Perdida</span>";
                    break;
            }
            filas += "<td>" + estadoCita + "</td>";
            filas += "<td>" + v.numeroIdentificacionBeneficiario + "</td>";
            filas += "<td>" + v.nombresBeneficiario + " " + v.apellidosBeneficiario + "</td>";
            filas += "<td>" + v.numeroConsultorio + "</td>";
            filas += "<td>" + v.nombresEmpleado + " " + v.apellidosEmpleado + "</td>";
            filas += "<td>";
            filas += "<form action='<?php echo URL_BASE; ?>consultas/editarConsulta' method='POST'>";
            filas += "<button class='btn btn-xs btn-warning center-block' type='submit' name='btnConstulaCitaMedica'><i class='fa fa-stethoscope'></i></button>";
            filas += "<input type='hidden' name='idCitaMedica' value='" + v.idCitaMedica + "'>";
            filas += "</form>";
            filas += "</td>";
            filas += "<td>";
            filas += "<form action='<?php echo URL_BASE; ?>consultas/listarConsulta' method='POST'>";
            filas += "<button class='btn btn-xs btn-success center-block' type='submit' name='btnConstulaCitaMedica'><i class='fa fa-list-alt'></i></button>";
            filas += "<input type='hidden' name='idCitaMedica' value='" + v.idCitaMedica + "'>";
            filas += "<input type='hidden' name='idBeneficiario' value ='" + v.idBeneficiario + "'>"; //idBeneficiario para la insercion del episodio
            filas += "</form>";
            filas += "</td>";
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
