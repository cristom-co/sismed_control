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
          </ul>
        <div style="margin-top:2%;"></div>
          <!-- Tab panes -->
          <div class="tab-content">
              <!-- Tab para los episodios -->
            <div role="tabpanel" class="tab-pane active" id="Episodio">
                <form method="POST" action="<?php echo URL_BASE . 'consulta/'; ?>">
                    <div class="form-group">
                        <label for="txf">Fecha / Hora de la atencion: </label>
                        <input type="text" id="txf" name="txf" class="form-control" placeholder="" required>
                    </div>
                    <div class="form-group">
                        <label for="txf">Peso: </label>
                        <input type="text" id="txf" name="txf" class="form-control" placeholder="" required>
                    </div>
                    <div class="form-group">
                        <label for="txf">Temperatura: </label>
                        <input type="text" id="txf" name="txf" class="form-control" placeholder="" required>
                    </div>
                    <div class="form-group">
                        <label for="txf">Presion: </label>
                        <input type="text" id="txf" name="txf" class="form-control" placeholder="" required>
                    </div>
                    <div class="form-group">
                        <label for="txf">Anamnesis: </label>
                        <input type="text" id="txf" name="txf" class="form-control" placeholder="" required>
                    </div>
                    <div class="form-group">
                        <label for="txf">Exploracion: </label>
                        <input type="text" id="txf" name="txf" class="form-control" placeholder="" required>
                    </div>
                    <button type="submit" class="btn btn-primary" name="btnRegistrarFuncionario" id="btnRegistrarFuncionario"> ENVIAR </button>
                </form>
            </div>
              <!-- Tab para los diagnosticos -->
            <div role="tabpanel" class="tab-pane" id="Diagnostico">
                <form method="POST" action="<?php echo URL_BASE . 'consulta/'; ?>">
                    <div class="form-group">
                        <label for="txf">Descripcion: </label>
                        <input type="text" id="txf" name="txf" class="form-control" placeholder="" required>
                    </div>
                    <div class="form-group">
                        <label for="txf">Enfermedad: </label>
                        <input type="text" id="txf" name="txf" class="form-control" placeholder="" required>
                    </div>
                    <button type="submit" class="btn btn-primary" name="btnRegistrarFuncionario" id="btnRegistrarFuncionario"> ENVIAR </button>
                </form>
            </div>
            
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
                                    Id Dignostico
                                </th>
                                <th>
                                    Id Cup
                                </th>

                                <th colspan="2">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>              
                        </tbody>
                    </table>
                </div>
            </div>
            
            <div role="tabpanel" class="tab-pane" id="FormulaMedica">
                
                <form method="POST" action="<?php echo URL_BASE . 'consulta/'; ?>">
                    <div class="form-group">
                        <label for="txf">Observaciones: </label>
                        <input type="text" id="txf" name="txf" class="form-control" placeholder="" required>
                    </div>
                    <div class="form-group">
                        <label for="txf">Posologia: </label>
                        <input type="text" id="txf" name="txf" class="form-control" placeholder="" required>
                    </div>
                    <button type="submit" class="btn btn-primary" name="btnRegistrarFuncionario" id="btnRegistrarFuncionario"> ENVIAR </button>
                </form>
                
                <button class="btn btn-primary" style="">Agregar Medicamento</button>
                <div class="table-responsive">
                    <table id="tblMedicamentos" class="table table-condensed table-hover">
                        <thead>
                            <tr>
                                <th>
                                    Medicamento
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
            
          </div>
        </div>
        
        </div>
    </div><!-- /.container-fluid -->
</div><!-- /#page-wrapper -->
<?php Vista::mostrar('plantillas/_pie', $datos); ?>
