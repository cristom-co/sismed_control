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
                      <textarea class="form-control" rows="5" id=""></textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Estado:</label>
                        <select class="form-control" name="" id="" required>
                            <option value="">Seleccione un estado</option>
                        </select>                    
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
                        <label for="">Consultorio:</label>
                        <select class="form-control" name="" id="" required>
                            <option value="">Seleccione un consultorio</option>
                        </select>
                    </div>
            
            <button type="submit" class="btn btn-primary" name="btnGuardar" id="btnGuardar"> GUARDAR </button>
            <button class="btn btn-primary" name="btnContrasena" id="btnContrasena">CAMBIAR CONTRASEÑA</button> 
            <button class="btn btn-primary" name="btnAtras" id="btnAtras"><a style="text-decoration: none;color:#fff" href="<?php echo URL_BASE . 'citasMedicas/citasMedicas'; ?>">ATRAS</a></button>
            <input type="hidden" name="idcitaMedica" value="<?php echo $citaMedica[0]['idcitaMedica']; ?>">
        </form>
    </div><!-- /.container-fluid -->
</div><!-- /#page-wrapper -->
<?php Vista::mostrar('plantillas/_pie'); ?>
<script type="text/javascript">
</script>

