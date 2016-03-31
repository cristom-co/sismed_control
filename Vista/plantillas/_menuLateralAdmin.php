<div id="menuLateralAdmin" class="collapse navbar-collapse navbar-ex1-collapse fondoblack">
    <ul class="nav navbar-nav side-nav fondoblack letraTitulos menu" id="navLateral">
        <li>
            <a href="<?php echo URL_BASE ?>"><i class="glyphicon glyphicon-home"></i> Inicio</a>
        </li>
        <li>
            <a href="javascript:;" data-toggle="collapse" data-target="#lstUsuarios"><i class="fa fa-child fa-2x"></i> Usuarios <i class="fa fa-fw fa-caret-down"></i></a>
            <ul id="lstUsuarios" class="collapse">
                <li>
                    <a href="<?php echo URL_BASE; ?>usuarios/usuarios">Usuarios</a>
                </li>
                <!--<li>-->
                <!--    <a href="<?php //echo URL_BASE; ?>roles/roles">Roles</a>-->
                <!--</li>-->
            </ul>
        </li>
        <li>
            <a href="javascript:;" data-toggle="collapse" data-target="#centrosMedicos"><i class="fa fa-building fa-2x"></i> Centros Médicos <i class="fa fa-fw fa-caret-down"></i></a>
            <ul id="centrosMedicos" class="collapse">
                <li>
                    <a href="<?php echo URL_BASE; ?>centrosMedicos/centrosMedicos">Centros médicos</a>
                </li>
                <li>
                    <a href="<?php echo URL_BASE; ?>medicamentos/medicamentos">Medicamentos</a>
                </li>
                <li>
                    <a href="<?php echo URL_BASE; ?>consultorios/consultorios">Consultorios</a>
                </li>
                <li>
                    <a href="<?php echo URL_BASE; ?>tipoOrdenes/tipoOrdenes">Tipos de ordenes</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:;" data-toggle="collapse" data-target="#personal"><i class="fa fa-male fa-2x"></i> Personal <i class="fa fa-fw fa-caret-down"></i></a>
            <ul id="personal" class="collapse">
                <li>
                    <a href="<?php echo URL_BASE; ?>empleados/empleados">Empleados</a>
                </li>
                <li>
                    <a href="<?php echo URL_BASE; ?>especialidades/especialidades">Especialidades</a>
                </li>
                <li>
                    <a href="<?php echo URL_BASE; ?>cargos/cargos">Cargos</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="<?php echo URL_BASE; ?>centrosFormacion/centrosFormacion"><i class="fa fa-building-o fa-2x"></i> Centros De Formacion </a>
        </li>
        <li>
            <a href="javascript:;" data-toggle="collapse" data-target="#funcionariosSena"><i class="fa fa-users fa-2x"></i> Funcionarios SENA <i class="fa fa-fw fa-caret-down"></i></a>
            <ul id="funcionariosSena" class="collapse">
                <li>
                    <a href="<?php echo URL_BASE; ?>funcionarios/funcionarios"> Funcionarios </a>
                </li>
                <li>
                    <a href="<?php echo URL_BASE; ?>beneficiarios/beneficiarios"> Beneficiarios</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:;" data-toggle="collapse" data-target="#citasMedicas"><i class="fa fa-calendar-o fa-2x"> </i>  Citas Medicas <i class="fa fa-fw fa-caret-down"></i></a>
            <ul id="citasMedicas" class="collapse">
                <li>
                    <a href="<?php echo URL_BASE; ?>citasMedicas/citas">Citas medicas</a>
                </li>
                <li>
                    <a href="<?php echo URL_BASE; ?>agendasMedicas/agenda">Agendas medicas</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="<?php echo URL_BASE; ?>historialMedico/historial"><i class="fa fa-h-square fa-2x"></i> Historial Medico </a>
        </li>
        
    </ul>
</div>
</nav>