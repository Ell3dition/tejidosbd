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


<!-- Modal -->
<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Crear Socio</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                  
                    <div class="mb-3 col-md-12">
                        <h6>Datos personales</h6>
                    <hr class="w-70" />
                    </div>
                    <div class="mb-3 col-md-4">
                        <label for="rutN" class="form-label">Rut</label>
                        <input type="text" class="form-control" id="rutN">
                    </div>
                    <div class="mb-3 col-md-4">
                        <label for="nombreN" class="form-label">Primer Nombre</label>
                        <input type="text" class="form-control" id="nombreN">
                    </div>
                    <div class="mb-3 col-md-4">
                        <label for="nombreN" class="form-label">Segundo Nombre</label>
                        <input type="text" class="form-control" id="nombreN">
                    </div>
                    <div class="mb-3 col-md-4">
                        <label for="nombreN" class="form-label">Apellido Paterno</label>
                        <input type="text" class="form-control" id="nombreN">
                    </div>
                    <div class="mb-3 col-md-4">
                        <label for="nombreN" class="form-label">Apellido Materno</label>
                        <input type="text" class="form-control" id="nombreN">
                    </div>
                
                    <div class="mb-3 col-md-4">
                        <label class="form-label" for="calleN">Fecha Nacimiento</label>
                        <input type="text" class="form-control" id="calleN">
                    </div>

                  

                    <div class="mb-3 col-md-4">
                        <label class="form-label" for="numeroN">Ocupación</label>
                        <input type="text" class="form-control" id="numeroN">
                    </div>

                    <div class="mb-3 col-md-4">
                        <label class="form-label" for="calleN">Fecha Ingreso</label>
                        <input type="text" class="form-control" id="calleN">
                    </div>

                    <div class="mb-3 col-md-4">
                        <label class="form-label" for="regionN">Rol</label>
                        <select name="" id="regionN" class="form-control">
                            <option value="">Seleccione un Rol</option>
                            <option value="">Administrador</option>
                            <option value="">Socio</option>
                        </select>
                    </div>
                    <div class="mb-3 col-md-4">
                        <label class="form-label" for="regionN">Género</label>
                        <select name="" id="regionN" class="form-control">
                            <option value="">Seleccione un Género</option>
                            <option value="">Mujer</option>
                            <option value="">Hombre</option>
                            <option value="">Otro</option>
                        </select>
                    </div>
                    <div class="mb-3 col-md-4">
                        <label class="form-label" for="calleN">Nivel Estudios</label>
                        <input type="text" class="form-control" id="calleN">
                    </div>

                    <div class="mb-3 col-md-12">
                        <h6>Datos Contacto</h6>
                    <hr class="w-70" />
                    </div>
                    <div class="mb-3 col-md-4">
                        <label class="form-label" for="calleN">Celular</label>
                        <input type="text" class="form-control" id="calleN">
                    </div>

                    <div class="mb-3 col-md-4">
                        <label class="form-label" for="calleN">Telefono</label>
                        <input type="text" class="form-control" id="calleN">
                    </div>

                    <div class="mb-3 col-md-4">
                        <label class="form-label" for="calleN">Correo</label>
                        <input type="text" class="form-control" id="calleN">
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
                <button type="button" id="btnSaveOrganitation" class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </div>
</div>