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
                        <label for="rutN" class="form-label" >Rut</label>
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

                    <div class="mb-3 col-md-4">
                        <label class="form-label" for="rolN">Rol</label>
                        <select name="" id="rolN" class="form-control">
                            <option value="">Seleccione un Rol</option>
                            <option value="Administrador">Administrador</option>
                            <option value="Socio">Socio</option>
                        </select>
                    </div>

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
                        <label class="form-label" for="calleN">Calle <span class="text-danger fw-bold">(*)</span></label>
                        <input type="text" class="form-control" id="calleN">
                    </div>

                    <div class="mb-3 col-md-4">
                        <label class="form-label" for="numeroN">Número <span class="text-danger fw-bold">(*)</span></label>
                        <input type="text" class="form-control" id="numeroN">
                    </div>

                    <div class="mb-3 col-md-4">
                        <label class="form-label" for="referenciaN">Referencia</label>
                        <input type="text" class="form-control" id="referenciaN">
                    </div>

                    <div class="mb-3 col-md-4">
                        <label class="form-label" for="regionN">Región <span class="text-danger fw-bold">(*)</span></label>
                        <select name="" id="regionN" class="form-control">
                            <option value="">Seleccione una Región</option>
                        </select>
                    </div>
                    <div class="mb-3 col-md-4">
                        <label class="form-label" for="provinciaN">Provincia <span class="text-danger fw-bold">(*)</span></label>
                        <select name="" id="provinciaN" class="form-control">
                            <option value="">Seleccione una Provincia</option>
                        </select>
                    </div>
                    <div class="mb-3 col-md-4">
                        <label class="form-label" for="comunaN">Comuna <span class="text-danger fw-bold">(*)</span></label>
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