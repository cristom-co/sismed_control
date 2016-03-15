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
                        <input type="number" name="" id="" class="form-control" placeholder="cedula" value="" required>
                    </div>
                    <div class="form-group">
                        <label for="">Fecha:</label>
                        <input type="text" name="" id="" class="form-control" placeholder="" value="" required>
                    </div>
                    <div class="form-group">
                        <label for="">Doctor:</label>
                        <input type="text" name="" id="" class="form-control" placeholder="nombre / cedula" value="" required>
                    </div>
                    <div class="form-group">
                        <label for="">Horas Disponibles:</label>
                        <select class="form-control" name="" id="" required>
                            <option value="">Seleccione una hora</option>
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
                            <option value="2">Inactivo</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Consultorio:</label>
                        <select class="form-control" name="" id="" required>
                            <option value="">Seleccione un consultorio</option>
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

<script>
        //Listar los consultorios existentes
    $.post('<?php echo URL_BASE; ?>consultorios/listarConsultorios', {}, function (data) {
        var datos = JSON.parse(data);
        $.each(datos, function (i, v) {
            $('').append('<option value="' + v.idConsultorio + '">' + v.numeroConsultorio + '</option>');
        });
    });
    
    //Listar los doctores existentes
    $.post('<?php echo URL_BASE; ?>empleados/listarEmpleados', {}, function (data) {
        var datos = JSON.parse(data);
        $.each(datos, function (i, v) {
            $('').append('<option value="' + v.idEmpleado + '">' + v.nombresEmpleado +" "+ v.apellidosEmpleado+'</option>');
        });
    });
    
    //Listar las horas disponible por doctor y fecha
    //select * from agendas_medicas where idEmpleado = valor and fechaAgendaMedica = valor
    //inner join hora_20 on idhora_20 = hora_20_idhora_20;
    $.post('<?php echo URL_BASE; ?>empleados/listarEmpleados', {}, function (data) {
        var datos = JSON.parse(data);
        $.each(datos, function (i, v) {
            $('').append('<option value="' + v.idhora_20 + '">' + v.hora +'</option>');
        });
    });
</script>