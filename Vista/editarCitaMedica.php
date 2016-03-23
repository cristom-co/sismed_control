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
        <form method="POST" action="<?php echo URL_BASE . 'citasMedicas/editarCitaMedica'; ?>">
            
                    <div class="form-group">
                      <label for="comment">Comentarios:</label>
                      <textarea value="<?php echo $citaMedica[0]['comentariosCitaMedica']; ?>" class="form-control" rows="5" id=""><?php echo $citaMedica[0]['comentariosCitaMedica']; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Estado: <?php echo ($citaMedica[0]['estadoCitaMedica']==1)?"Activo":"Inactivo"  ?></label>
                        <select class="form-control" name="" id="" required>
                            <option value="">Seleccione un estado</option>
                            <option value="1">Activo</option>
                            <option value="2">Inactivo</option>
                        </select>                    
                    </div>
                    <div class="form-group">
                        <label for="cmbEmpleado">Doctor: <?php echo $citaMedica[0]['nombresEmpleado'] ." ".$citaMedica[0]['apellidosEmpleado']; ?></label>
                        <select class="form-control" name="cmbEmpleado" id="cmbEmpleado" required>
                            <option value="">Seleccione un Doctor</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="txfFechaCita">Fecha programada: <?php echo $citaMedica[0]['fechaAgendaMedica'] ?></label>
                        <input class="form-control" type="text" name="txfFechaCita" id="txfFechaCita" placeholder="Digite una fecha"/>
                    </div>
                    <div class="form-group">
                        <label for="cmbHoraCita">Horas programada: <?php echo $citaMedica[0]['hora']; ?></label>
                        <select class="form-control" name="cmbHoraCita" id="cmbHoraCita" required>
                            <option value="">Seleccione una Hora Disponible</option>
                        </select>                    
                    </div>
                    <div class="form-group">
                        <label for="cmbConsultorio">Consultorio:  <?php echo $citaMedica[0]['numeroConsultorio']; ?></label>
                        <select class="form-control" name="cmbConsultorio" id="cmbConsultorio" required>
                            <option value="">Seleccione un consultorio</option>
                        </select>
                    </div>
            
            <button type="submit" class="btn btn-primary" name="btnGuardar" id="btnGuardar"> GUARDAR </button>
            <button class="btn btn-primary" name="btnAtras" id="btnAtras"><a style="text-decoration: none;color:#fff" href="<?php echo URL_BASE . 'citasMedicas/citas'; ?>">ATRAS</a></button>
            <input type="hidden" name="idcitaMedica" value="<?php echo $citaMedica[0]['idcitaMedica']; ?>">
        </form>
    </div><!-- /.container-fluid -->
</div><!-- /#page-wrapper -->
<?php Vista::mostrar('plantillas/_pie'); ?>
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

//Lista las horas disponible de un doctor en una fecha especifica   //agregar una consulta al modelo
$('#txfFechaCita').change(function (){
    var fecha = $(this).val();
    var idEmpleado = $('#cmbEmpleado').val();
    $('#cmbHoraCita').removeAttr('disabled');
    $.post('<?php echo URL_BASE; ?>agendasMedicas/listarHorasDisponibles', {fecha:fecha, idEmpleado:idEmpleado}, function (data) { 
        var datos = JSON.parse(data);
        $.each(datos, function (i, v) {
            $('#cmbHoraCita').append('<option value="' + v.idAgendaMedica + '">' + v.hora + '</option>')
        });
    });
});

//Lista todos los consultorios de la base de datos
     $.post('<?php echo URL_BASE; ?>consultorios/listarConsultorios', {}, function (data) {
        var datos = JSON.parse(data);
        $.each(datos, function (i, v) {
            $('#cmbConsultorio').append('<option value="' + v.idConsultorio + '">' + v.numeroConsultorio + '</option>');
        });
    });


</script>

