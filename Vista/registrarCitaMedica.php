<div id="modalRegistrarCitaMedica" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Insertar Cita Medica</h4>
            </div>
            <div class="modal-body">
                <form method="POST" action="<?php echo URL_BASE . 'citasMedicas/insertarCitaMedica'; ?>">
                   <div class="form-group">
                        <label for="">Beneficiario:</label>
                        <select class="form-control" name="cmbBeneficiario" id="cmbBeneficiario" required>
                            <option value="">Seleccione un Beneficiario</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="cmbEmpleado">Medico:</label>
                        <select class="form-control" name="cmbEmpleado" id="cmbEmpleado" required>
                            <option value="">Seleccione un medico</option>
                        </select>
                    </div>
                     <div class="form-group">
                        <label for="txfFechaCita">Fecha:</label>
                        <input type="text" name="txfFechaCita" id="txfFechaCita" class="form-control" placeholder="Seleccione fecha" required disabled>
                    </div>
                    <div class="form-group">
                        <label for="txfHoraCita">Horas Disponibles:</label>
                        <input type="text" name="txfHoraCita" id="txfHoraCita" class="form-control" placeholder="Seleccione una hora" required disabled>
                    </div>
                    <div class="form-group">
                        <label for="">Consultorio:</label>
                        <select class="form-control" name="" id="cmbConsultorio" required>
                            <option value="">Seleccione un consultorio</option>
                        </select>
                    </div>

                    <div class="form-group">
                      <label for="comment">Comentarios:</label>
                      <textarea class="form-control" rows="5" id=""></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label for="">Estado</label>
                        <select class="form-control" name="" id="" required>
                            <option value="">Seleccione un estado</option>
                            <option value="1">Activo</option>
                            <option value="0">Inactivo</option>
                        </select>
                    </div>

                <button type="submit" class="btn btn-primary" name="btnRegistrarCitaMedica" id="btnRegistrarCitaMedica"> Crear Cita Medica</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

//Lista los empleados existente en la base de datos
 $.post('<?php echo URL_BASE; ?>empleados/listarEmpleados', {}, function (data) {
        var datos = JSON.parse(data);
        $.each(datos, function (i, v) {
            $('#cmbEmpleado').append('<option value="' + v.idEmpleado + '">' + v.nombresEmpleado + " "+ v.apellidosEmpleado + '</option>');
        });
    });

   
$('#cmbEmpleado').change(function () {
    var idEmpleado = $(this).val();
    $('#txfFechaCita').removeAttr('disabled');
    $.post('<?php echo URL_BASE; ?>agendasMedicas/listarFechasDisponibles', {idEmpleado: idEmpleado}, function (data) {
        var f=0;
        var fechasDisponibles=[]; 
        var datos = JSON.parse(data);
        $.each(datos, function (i, v) {
            fechasDisponibles[f]=v.fechaAgendaMedica;
	        f++;
        });
        if(fechasDisponibles.length !== 0){
            $('#txfFechaCita').datetimepicker({
	            timepicker: false,
	            format: 'Y-m-d',
	            allowDates: fechasDisponibles, 
	            formatDate:'Y-m-d'
            });
        }else{
           $('#txfFechaCita').datetimepicker({
	            timepicker: false,
	            format: 'Y-m-d',
	            allowDates: ['1900-01-01'], 
	            formatDate:'Y-m-d'
            });
        }
    });
});

$('#txfFechaCita').change(function (){
    var fecha = $(this).val();
    var idEmpleado = $('#cmbEmpleado').val();
    alert(fecha+' '+idEmpleado);
});




    
//Lista las horas disponible de un doctor en una fecha especifica   //agregar una consulta al modelo
    //  $.post('<?php echo URL_BASE; ?>agendasMedicas/listarHorasEmpleado', {}, function (data) { 
    //     var datos = JSON.parse(data);
    //     $.each(datos, function (i, v) {
    //         $('#cmbHoras').append('<option value="' + v.idEmpleado + '">' + v.numeroIdentificacionEmpleado + '</option>');
    //     });
    // });

//Lista todos los consultorios de la base de datos
     $.post('<?php echo URL_BASE; ?>consultorios/listarConsultorios', {}, function (data) {
        var datos = JSON.parse(data);
        $.each(datos, function (i, v) {
            $('#cmbConsultorio').append('<option value="' + v.idConsultorio + '">' + v.numeroConsultorio + '</option>');
        });
    });

//Lista todos los beneficiarios de la base de datos
    $.post('<?php echo URL_BASE; ?>beneficiarios/listarBeneficiarios', {}, function (data) {
        var datos = JSON.parse(data);
        $.each(datos, function (i, v) {
            $('#cmbBeneficiario').append('<option value="' + v.idBeneficiario + '">'+ v.numeroIdentificacionBeneficiario + " : " + v.nombresBeneficiario + " " +v.apellidosBeneficiario + '</option>');
        });
    });
</script>