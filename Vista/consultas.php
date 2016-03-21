<?php
Vista::mostrar('plantillas/_encabezado', $datos);
Vista::mostrar('plantillas/_menuSuperior', $datos);
Vista::mostrar('plantillas/_menuLateral'); //Cambiar por controlador segun el rol
?>

<div id="page-wrapper" style=" min-height:30em ">
    <div class="container-fluid fondoFluid" id="formArea">
        <!-- encabezado wrapper -->
        <?php Vista::mostrar('plantillas/_eslogan'); ?>
        
        <div>   
          <!-- Nav tabs -->
          <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#Episodio" aria-controls="home" role="tab" data-toggle="tab">Episodio</a></li>
            <li role="presentation"><a href="#Diagnostico" aria-controls="profile" role="tab" data-toggle="tab">Diagnostico</a></li>
            <li role="presentation"><a href="#Ordenes" aria-controls="messages" role="tab" data-toggle="tab">Ordenes</a></li>
            <li role="presentation"><a href="#FormulaMedica" aria-controls="settings" role="tab" data-toggle="tab">Formula Medica</a></li>
            <li role="presentation"><a href="#" aria-controls="settings" role="tab" data-toggle="tab">idCitaMedica: <?php echo $idCitaMedica ?></a></li>
            <li role="presentation"><a href="#" aria-controls="settings" role="tab" data-toggle="tab">idBeneficiario: <?php echo $idBeneficiario ?></a></li>
          </ul>
        <div style="margin-top:2%;"></div>
          <!-- Tab panes -->
          <div class="tab-content">
            <!-- Tab para los episodios --------------------------------------------------------------------------------------------------------------------->
            
            <div role="tabpanel" class="tab-pane active" id="Episodio">
                <form method="POST" action="<?php echo URL_BASE . 'consultas/insertarEpisodio'; ?>">
                    <div class="form-group">
                        <label for="txfFechaHora">Fecha / Hora de la atencion: </label>
                        <input type="text" id="txfFechaHora" name="txfFechaHora" class="form-control" placeholder="" required>
                    </div>
                    <div class="form-group">
                        <label for="txfPeso">Peso: </label>
                        <input type="text" id="txfPeso" name="txfPeso" class="form-control" placeholder="" required>
                    </div>
                    <div class="form-group">
                        <label for="txfTemperatura">Temperatura: </label>
                        <input type="text" id="txfTemperatura" name="txfTemperatura" class="form-control" placeholder="" required>
                    </div>
                    <div class="form-group">
                        <label for="txfPresion">Presion: </label>
                        <input type="text" id="txfPresion" name="txfPresion" class="form-control" placeholder="" required>
                    </div>
                    <div class="form-group">
                        <label for="txfAnamnesis">Anamnesis: </label>
                        <input type="text" id="txfAnamnesis" name="txfAnamnesis" class="form-control" placeholder="" required>
                    </div>
                    <div class="form-group">
                        <label for="txfExploracion">Exploracion: </label>
                        <input type="text" id="txfExploracion" name="txfExploracion" class="form-control" placeholder="" required>
                    </div>
                    <input type="hidden" name="idCitaMedica" value="<?php echo $idCitaMedica ?>"/>
                    <input type="hidden" name="idBeneficiario" value="<?php echo $idBeneficiario ?>"/>
                    <button type="submit" class="btn btn-primary" name="btnRegistrarEpisodio" id="btnRegistrarEpisodio"> ENVIAR </button>
                </form>
            </div>
            <script type="text/javascript"></script><!-- Consultar la historia clinica del beneficiario con su id enviado desde la cita medica-->
            <script type="text/javascript"></script> <!-- consultar el id del episodio creado mediante el id de la cita medica -->
            <!-------------------------------------------------------------------------------------------------------------------------------------------------->
            <!-- Tab para los diagnosticos --------------------------------------------------------------------------------------------------------------------->
            
            <div role="tabpanel" class="tab-pane" id="Diagnostico">
                <form method="POST" action="<?php echo URL_BASE . 'consulta/insertarDiagnostico'; ?>">
                    <div class="form-group">
                        <label for="txfDescripcionDiagnostico">Descripcion: </label>
                        <textarea class="form-control" rows="5" id="txfDescripcionDiagnostico" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="cmbEnfermedad">Enfermedad: </label>
                        <select class="form-control" name="cmbEnfermedad" id="cmbEnfermedad">
                            <option value="">Seleccione una enfermedad</option>
                        </select>
                    </div>
                    
                    <input type="hidden" name="idEpisodio" value=""/>

                    <button type="submit" class="btn btn-primary" name="btnRegistrarDiagnostico" id="btnRegistrarDiagnostico"> ENVIAR </button>
                </form>
            </div>
            <script type="text/javascript">
                $.post('<?php echo URL_BASE; ?>enfermedades/listarEnfermedades',function (data) {
                    var datos = JSON.parse(data);
                    $.each(datos, function (i, v) {
                    $('#cmbEnfermedad').append('<option value="' + v.idEnfermedad + '">' + v.nombreEnfermedad + '</option>');
                });
            });
            </script>
            <script type="text/javascript"></script><!-- consulta el id del diagnostico mediante el id del episodio creado anteriomente -->
            <!------------------------------------------------------------------------------------------------------------------------------------------------->
            <!-- Tab para las ordenes ------------------------------------------------------------------------------------------------------------------------->
            
            <div role="tabpanel" class="tab-pane" id="Ordenes">
            <div class="row"><button class="btn btn-primary" style="margin-left:15px;margin-bottom:15px;">Agregar Orden</button></div>
                <div class="table-responsive">
                    <table id="tblMedicamentos" class="table table-condensed table-hover">
                        <thead>
                            <tr>
                                <th>
                                    Fecha / Hora
                                </th>
                                <th>
                                    Cantidad
                                </th>
                                <th>
                                    Observaciones
                                </th>
                                <th>
                                    Tipo de Orden
                                </th>
                                <th>
                                    Id Diagnostico
                                </th>
                                <th>
                                    Cup
                                </th>
                                <th colspan="2">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>              
                        </tbody>
                    </table>
                </div>
            </div>
            <script type="text/javascript" src="">
            $.post('<?php echo URL_BASE; ?>consultas/listarOrdenes', {idDiagnostico:''}, function (data) {
                var datos = JSON.parse(data);
                var filas;
                var cont = 0;
                $.each(datos, function (i, v) {
                    cont = cont + 1;
                    filas += "<tr>";
                    filas += "<td>" + v.fechaHoraOrden +"</td>";
                    filas += "<td>" + v.cantidad +"</td>";
                    filas += "<td>" + v.observacionOrden +"</td>";
                    filas += "<td>" + v.tipoOrden +"</td>";
                    filas += "<td>" + v.diagnosticos_idDiagnostico +"<td>";
                    filas += "<td>" + v.codigoCup +"</td>";
                    filas += "<td>";
                    filas += "<form action='<?php echo URL_BASE; ?>consultas/editarOrden' method='POST'>";
                    filas += "<button class='btn btn-xs btn-success' type='submit' name='btnEditarOrden'><i class='fa fa-edit'></i></button>";
                    filas += "<input type='hidden' name='idOrden' value='" + v.idOrden + "'>";
                    filas += "</form>";
                    filas += "</td>";
                    filas += "<td>";
                    filas += "<button class='btn btn-xs btn-danger' data-toggle='modal' data-target='#modalEliminarOrden" + cont + "' name='btnModalEliminarOrden'><i class='fa fa-close'></i></button>";
                    filas += "<div class = 'modal fade' id='modalEliminarOrden" + cont + "' tabindex = '-1' role = 'dialog'>";
                    filas += "<div class='modal-dialog'>";
                    filas += "<div class='modal-content'>";
                    filas += "<div class='modal-header'>";
                    filas += "<button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>";
                    filas += "<h4 class='modal-title'>Eliminar Orden</h4>";
                    filas += "</div>";
                    filas += "<div class='modal-body'>";
                    filas += "<p>¿Seguro que desea eliminar registro?</p>";
                    filas += "</div>";
                    filas += "<div class='modal-footer'>";
                    filas += "<form action='<?php echo URL_BASE; ?>consultas/eliminarOrden' method='POST'>";
                    filas += "<button type='button' class='btn btn-default' data-dismiss='modal'>Cancelar</button>";
                    filas += "<button class='btn btn-primary' type='submit' name='btnEliminarOrden'> Aceptar </button>";
                    filas += "<input type='hidden' name='idOrden' value='" + v.idOrden + "'>";
                    filas += "</form>";
                    filas += "</div>";
                    filas += "</div>";
                    filas += "</div>";
                    filas += "</div>";
                    filas += "</td>";
                    filas += "</tr>";
                });
                $('#tblMedicamentos tbody').html(filas);
            });
            </script>

            <!-------------------------------------------------------------------------------------------------------------------------------------------------->
            <!-- Tab para las formulas medicas ----------------------------------------------------------------------------------------------------------------->
            
            <div role="tabpanel" class="tab-pane" id="FormulaMedica">
                
                <form method="POST" action="<?php echo URL_BASE . 'consulta/insertarFormulaMedica'; ?>">
                    <div class="form-group">
                        <label for="txfObservacionesFormula">Observaciones: </label>
                        <textarea class="form-control" rows="5" id="txfObservacionesFormula" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="txfPosologia">Posologia: </label>
                        <input type="text" id="txfPosologia" name="txfPosologia" class="form-control" placeholder="" required>
                    </div>
                    
                    <input type="hidden" name="idDiagnostico" value=""/>
                    
                    <button type="submit" class="btn btn-primary" name="btnRegistrar" id="btnRegistrar"> ENVIAR </button>
                </form>
                <script type="text/javascript"></script> <!-- Consultar el id de la formula medica mediante el id del diagnostico -->

                <button class="btn btn-primary" style="margin-top:20px;">Agregar Medicamento</button>
                <div class="table-responsive">
                    <table id="tblMedicamentos" class="table table-condensed table-hover">
                        <thead>
                            <tr>
                                <th>
                                    Id Formula
                                </th>
                                <th>
                                    Codigo Medicamento
                                </th>
                                <th>
                                    Nombre Generico
                                </th>
                                <th>
                                    Descripcion
                                </th>
                                <th>
                                    Cantidad
                                </th>
                                <th>
                                    Dosificacion
                                </th>
                                <th colspan="2">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>              
                        </tbody>
                    </table>
                </div>    
            </div>
            <script type="text/javascript" src="">
                $.post('<?php echo URL_BASE; ?>consultas/listarMedicamentosFormula', {idFormulaMedica:''}, function (data) {
                    var datos = JSON.parse(data);
                    var filas;
                    var cont = 0;
                    $.each(datos, function (i, v) {
                        cont = cont + 1;
                        filas += "<tr>";
                        filas += "<td>" + v.formulas_medicas_idFormulaMedica + "</td>";
                        filas += "<td>" + v.codigoMedicamento + "</td>";
                        filas += "<td>" + v.nombreGenericoMedicamento + "</td>";
                        filas += "<td>" + v.descripcionMedicamento + "</td>";
                        filas += "<td>" + v.cantidadMedicamento + "</td>";
                        filas += "<td>" + v.dosificacionMedicamento + "</td>";
                        filas += "<td>";
                        filas += "<form action='<?php echo URL_BASE; ?>consultas/editarMedicamentoFormula' method='POST'>";
                        filas += "<button class='btn btn-xs btn-success' type='submit' name='btnEditarMedicamento'><i class='fa fa-edit'></i></button>";
                        filas += "<input type='hidden' name='idMedicamento' value='" + v.idMedicamentoFormula + "'>";
                        filas += "</form>";
                        filas += "</td>";
                        filas += "<td>";
                        filas += "<button class='btn btn-xs btn-danger' data-toggle='modal' data-target='#modalEliminarMedicamento" + cont + "' name='btnModalEliminarRol'><i class='fa fa-close'></i></button>";
                        filas += "<div class = 'modal fade' id='modalEliminarMedicamento" + cont + "' tabindex = '-1' role = 'dialog'>";
                        filas += "<div class='modal-dialog'>";
                        filas += "<div class='modal-content'>";
                        filas += "<div class='modal-header'>";
                        filas += "<button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>";
                        filas += "<h4 class='modal-title'>Eliminar Medicamento</h4>";
                        filas += "</div>";
                        filas += "<div class='modal-body'>";
                        filas += "<p>¿Seguro que desea eliminar registro?</p>";
                        filas += "</div>";
                        filas += "<div class='modal-footer'>";
                        filas += "<form action='<?php echo URL_BASE; ?>consultas/eliminarMedicamentoFormula' method='POST'>";
                        filas += "<button type='button' class='btn btn-default' data-dismiss='modal'>Cancelar</button>";
                        filas += "<button class='btn btn-primary' type='submit' name='btnEliminarMedicamento'> Aceptar </button>";
                        filas += "<input type='hidden' name='idMedicamento' value='" + v.idMedicamentoFormula + "'>";
                        filas += "</form>";
                        filas += "</div>";
                        filas += "</div>";
                        filas += "</div>";
                        filas += "</div>";
                        filas += "</td>";
                        filas += "</tr>";
                    });
                    $('#tblMedicamentos tbody').html(filas);
                });
            </script>
          </div>
        </div>
        <!-------------------------------------------------------------------------------------------------------------------------------------------------->
        </div>
    </div><!-- /.container-fluid -->
</div><!-- /#page-wrapper -->
<?php Vista::mostrar('plantillas/_pie', $datos); ?>
