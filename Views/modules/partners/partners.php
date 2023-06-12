<section>
    <div class="container">

        <div class="row m-3 d-flex justify-content-center">
            <div class="col-md-4 d-flex justify-content-center">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
                    Crear
                </button>
            </div>
        </div>

        <style>
            #table-partners th:nth-child(4) {
                max-width: 80px !important;
            }
        </style>

        <div class="row d-flex justify-content-center">
            <div class="col-md-12">
                <table class="table table-light" id="table-partners">
                    <thead class="thead-light">
                        <tr>
                            <th>#</th>
                            <th>Rut</th>
                            <th>Nombre</th>
                            <th>Correo</th>
                            <th>Dirección</th>
                            <?php if($_SESSION["rol"] === 'Administrador'){echo ' <th>Organización</th>';} ?>
                            <th class="no-exportar">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>

                </table>
            </div>
        </div>
    </div>
</section>

<!-- MODAL CREAR -->

<!-- Modal Crear-->
<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="createModalLabel">Crear Socio</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">

                    <div class="mb-3 col-md-12">
                        <h6 class="fw-bold">Datos personales</h6>
                        <hr class="w-70" />
                    </div>
                    <div class="mb-3 col-md-4">
                        <label for="rutN" class="form-label">Rut</label>
                        <input type="text" class="form-control" id="rutN" maxlength="12">
                    </div>
                    <div class="mb-3 col-md-4">
                        <label for="primerNombreN" class="form-label">Primer Nombre</label>
                        <input type="text" class="form-control" id="primerNombreN">
                    </div>
                    <div class="mb-3 col-md-4">
                        <label for="segundoNombreN" class="form-label">Segundo Nombre</label>
                        <input type="text" class="form-control" id="segundoNombreN">
                    </div>
                    <div class="mb-3 col-md-4">
                        <label for="apellidoPaternoN" class="form-label">Apellido Paterno</label>
                        <input type="text" class="form-control" id="apellidoPaternoN">
                    </div>
                    <div class="mb-3 col-md-4">
                        <label for="apellidoMaternoN" class="form-label">Apellido Materno</label>
                        <input type="text" class="form-control" id="apellidoMaternoN">
                    </div>

                    <div class="mb-3 col-md-4">
                        <label class="form-label" for="fechaNacimientoN">Fecha Nacimiento</label>
                        <input type="date" class="form-control" id="fechaNacimientoN">
                    </div>

                    <div class="mb-3 col-md-4">
                        <label class="form-label" for="generoN">Género</label>
                        <select name="" id="generoN" class="form-control">
                            <option value="0">Seleccione un Género</option>
                            <option value="Mujer">Mujer</option>
                            <option value="Hombre">Hombre</option>
                            <option value="Otro">Otro</option>
                        </select>
                    </div>
                    <div class="mb-3 col-md-4">
                        <label class="form-label" for="nivelEstudiosN">Nivel Estudios</label>
                        <select name="" id="nivelEstudiosN" class="form-control">
                            <option value="0">Seleccione Nivel Estudios</option>
                        </select>
                    </div>

                    <div class="mb-3 col-md-4">
                        <label class="form-label" for="ocupacionN">Ocupación</label>
                        <input type="text" class="form-control" id="ocupacionN">
                    </div>

                    <div class="mb-3 col-md-4">
                        <label class="form-label" for="fechaIngresoN">Fecha Ingreso</label>
                        <input type="date" class="form-control" id="fechaIngresoN">
                    </div>

                    <?php if($_SESSION["rol"] === 'Administrador'){

                        echo '<div class="mb-3 col-md-4">
                        <label class="form-label" for="rolN">Rol</label>
                        <select name="" id="rolN" class="form-control">
                            <option value="">Seleccione un Rol</option>
                            <option value="Administrador">Administrador</option>
                            <option value="Coordinador">Coordinador</option>
                            <option value="Socio">Socio</option>
                        </select>
                    </div>
                    <div class="mb-3 col-md-4">
                    <label class="form-label" for="organizacionN">Organización</label>
                    <select name="" id="organizacionN" class="form-control">
                        <option value="">Seleccione una Organización</option>
                    </select>
                </div>

                    ';
                    } ?>

                    <div class="mb-3 col-md-12">
                        <h6 class="fw-bold">Datos Contacto</h6>
                        <hr class="w-70" />
                    </div>
                    <div class="mb-3 col-md-4">
                        <label class="form-label" for="celularN">Celular</label>
                        <input type="text" class="form-control" id="celularN">
                    </div>

                    <div class="mb-3 col-md-4">
                        <label class="form-label" for="telefonoN">Telefono</label>
                        <input type="text" class="form-control" id="telefonoN">
                    </div>

                    <div class="mb-3 col-md-4">
                        <label class="form-label" for="correoN">Correo</label>
                        <input type="mail" class="form-control" id="correoN">
                    </div>

                    <div class="mb-3 col-md-4">
                        <label class="form-label" for="calleN">Calle <span
                                class="text-danger fw-bold">(*)</span></label>
                        <input type="text" class="form-control" id="calleN">
                    </div>

                    <div class="mb-3 col-md-4">
                        <label class="form-label" for="numeroN">Número <span
                                class="text-danger fw-bold">(*)</span></label>
                        <input type="text" class="form-control" id="numeroN">
                    </div>

                    <div class="mb-3 col-md-4">
                        <label class="form-label" for="referenciaN">Referencia</label>
                        <input type="text" class="form-control" id="referenciaN">
                    </div>

                    <div class="mb-3 col-md-4">
                        <label class="form-label" for="regionN">Región <span
                                class="text-danger fw-bold">(*)</span></label>
                        <select name="" id="regionN" class="form-control">
                            <option value="">Seleccione una Región</option>
                        </select>
                    </div>
                    <div class="mb-3 col-md-4">
                        <label class="form-label" for="provinciaN">Provincia <span
                                class="text-danger fw-bold">(*)</span></label>
                        <select name="" id="provinciaN" class="form-control">
                            <option value="">Seleccione una Provincia</option>
                        </select>
                    </div>
                    <div class="mb-3 col-md-4">
                        <label class="form-label" for="comunaN">Comuna <span
                                class="text-danger fw-bold">(*)</span></label>
                        <select name="" id="comunaN" class="form-control">
                            <option value="">Seleccione una Comuna</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" id="btnSavePartner" class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </div>
</div>



<!-- Modal Editar-->
<div class="modal fade" id="editarModal" tabindex="-1" aria-labelledby="editarModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="editarModalLabel">Crear Socio</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">

                    <div class="mb-3 col-md-12">
                        <h6 class="fw-bold">Datos personales</h6>
                        <hr class="w-70" />
                    </div>
                    <div class="mb-3 col-md-4">
                        <label for="rutEd" class="form-label">Rut</label>
                        <input type="text" class="form-control" id="rutEd" maxlength="12">
                    </div>
                    <div class="mb-3 col-md-4">
                        <label for="primerNombreEd" class="form-label">Primer Nombre</label>
                        <input type="text" class="form-control" id="primerNombreEd">
                    </div>
                    <div class="mb-3 col-md-4">
                        <label for="segundoNombreEd" class="form-label">Segundo Nombre</label>
                        <input type="text" class="form-control" id="segundoNombreEd">
                    </div>
                    <div class="mb-3 col-md-4">
                        <label for="apellidoPaternoEd" class="form-label">Apellido Paterno</label>
                        <input type="text" class="form-control" id="apellidoPaternoEd">
                    </div>
                    <div class="mb-3 col-md-4">
                        <label for="apellidoMaternoEd" class="form-label">Apellido Materno</label>
                        <input type="text" class="form-control" id="apellidoMaternoEd">
                    </div>

                    <div class="mb-3 col-md-4">
                        <label class="form-label" for="fechaNacimientoEd">Fecha Nacimiento</label>
                        <input type="date" class="form-control" id="fechaNacimientoEd">
                    </div>

                    <div class="mb-3 col-md-4">
                        <label class="form-label" for="generoEd">Género</label>
                        <select name="" id="generoEd" class="form-control">
                            <option value="0">Seleccione un Género</option>
                            <option value="Mujer">Mujer</option>
                            <option value="Hombre">Hombre</option>
                            <option value="Otro">Otro</option>
                        </select>
                    </div>
                    <div class="mb-3 col-md-4">
                        <label class="form-label" for="nivelEstudiosEd">Nivel Estudios</label>
                        <select name="" id="nivelEstudiosEd" class="form-control">
                            <option value="0">Seleccione Nivel Estudios</option>
                        </select>
                    </div>

                    <div class="mb-3 col-md-4">
                        <label class="form-label" for="ocupacionEd">Ocupación</label>
                        <input type="text" class="form-control" id="ocupacionEd">
                    </div>

                    <div class="mb-3 col-md-4">
                        <label class="form-label" for="fechaIngresoEd">Fecha Ingreso</label>
                        <input type="date" class="form-control" id="fechaIngresoEd">
                    </div>

                    <?php if($_SESSION["rol"] === 'Administrador'){

                        echo '<div class="mb-3 col-md-4">
                        <label class="form-label" for="rolEd">Rol</label>
                        <select name="" id="rolEd" class="form-control">
                            <option value="">Seleccione un Rol</option>
                            <option value="Administrador">Administrador</option>
                            <option value="Coordinador">Coordinador</option>
                            <option value="Socio">Socio</option>
                        </select>
                    </div>
                    <div class="mb-3 col-md-4">
                    <label class="form-label" for="organizacionEd">Organización</label>
                    <select name="" id="organizacionEd" class="form-control">
                        <option value="">Seleccione una Organización</option>
                    </select>
                </div>

                    ';
                    } ?>

                    <div class="mb-3 col-md-12">
                        <h6 class="fw-bold">Datos Contacto</h6>
                        <hr class="w-70" />
                    </div>
                    <div class="mb-3 col-md-4">
                        <label class="form-label" for="celularEd">Celular</label>
                        <input type="text" class="form-control" id="celularEd">
                    </div>

                    <div class="mb-3 col-md-4">
                        <label class="form-label" for="telefonoEd">Telefono</label>
                        <input type="text" class="form-control" id="telefonoEd">
                    </div>

                    <div class="mb-3 col-md-4">
                        <label class="form-label" for="correoEd">Correo</label>
                        <input type="mail" class="form-control" id="correoEd">
                    </div>

                    <div class="mb-3 col-md-4">
                        <label class="form-label" for="calleEd">Calle <span
                                class="text-danger fw-bold">(*)</span></label>
                        <input type="text" class="form-control" id="calleEd">
                    </div>

                    <div class="mb-3 col-md-4">
                        <label class="form-label" for="numeroEd">Número <span
                                class="text-danger fw-bold">(*)</span></label>
                        <input type="text" class="form-control" id="numeroEd">
                    </div>

                    <div class="mb-3 col-md-4">
                        <label class="form-label" for="referenciaEd">Referencia</label>
                        <input type="text" class="form-control" id="referenciaEd">
                    </div>

                    <div class="mb-3 col-md-4">
                        <label class="form-label" for="regionEd">Región <span
                                class="text-danger fw-bold">(*)</span></label>
                        <select name="" id="regionEd" class="form-control">
                            <option value="">Seleccione una Región</option>
                        </select>
                    </div>
                    <div class="mb-3 col-md-4">
                        <label class="form-label" for="provinciaEd">Provincia <span
                                class="text-danger fw-bold">(*)</span></label>
                        <select name="" id="provinciaEd" class="form-control">
                            <option value="">Seleccione una Provincia</option>
                        </select>
                    </div>
                    <div class="mb-3 col-md-4">
                        <label class="form-label" for="comunaEd">Comuna <span
                                class="text-danger fw-bold">(*)</span></label>
                        <select name="" id="comunaEd" class="form-control">
                            <option value="">Seleccione una Comuna</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" id="btnEditPartner" class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </div>
</div>