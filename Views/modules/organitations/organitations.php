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
            #table-organitations th:nth-child(4) {
                max-width: 80px !important;
            }

           
        </style>

        <div class="row d-flex justify-content-center">
            <div class="col-md-12">
                <table class="table table-light" id="table-organitations">
                    <thead class="thead-light">
                        <tr>
                            <th>#</th>
                            <th>Rut</th>
                            <th>N° Personalidad Jurídica</th>
                            <th>Nombre</th>
                            <th>Fecha Eleccion Direcctiva</th>
                            <th>Años Duración Directiva</th>
                            <th>Tipo</th>
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

<!-- MODAL Editar -->

<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Editar Organización</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="mb-3 col-md-3">
                        <label for="rutEd" class="form-label">E-Rut</label>
                        <input type="text" class="form-control" id="rutEd">
                        <input type="hidden" class="form-control" id="idOrganitations">
                        <input type="hidden" class="form-control" id="idAddress">
                    </div>
                    <div class="mb-3 col-md-3">
                        <label for="personalidadJuridicaEd" class="form-label">N° Personalidad jurídica <span class="text-danger fw-bold">(*)</span></label>
                        <input type="text" class="form-control" id="personalidadJuridicaEd">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="nombreEd" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombreEd">
                    </div>
                    <div class="mb-3 col-md-4">
                        <label class="form-label" for="tipoOrganizacionEd">Tipo de Organización</label>
                        <select name="" id="tipoOrganizacionEd" class="form-control">
                            <option value="0">Seleccione una Tipo</option>
                            <option value="tipoUno">tipo 1</option>
                            <option value="tipoDos">tipo 2</option>
                        </select>
                    </div>

                    <div class="mb-3 col-md-3">
                        <label for="eleccionDirecctivaEd" class="form-label"> Fecha Elección Directiva <span class="text-danger fw-bold">(*)</span></label>
                        <input type="date"  class="form-control" id="eleccionDirecctivaEd">
                    </div>
                    <div class="mb-3 col-md-3">
                        <label for="duracionDirectivaEd" class="form-label"> Años Duración Directiva <span class="text-danger fw-bold">(*)</span></label>
                        <input type="number" class="form-control" id="duracionDirectivaEd">
                    </div>

                    <div class="mb-3 col-md-4">
                        <label class="form-label" for="calleEd">Calle</label>
                        <input type="text" class="form-control" id="calleEd">
                    </div>

                    <div class="mb-3 col-md-3">
                        <label class="form-label" for="numeroEd">Número</label>
                        <input type="text" class="form-control" id="numeroEd">
                    </div>

                    <div class="mb-3 col-md-5">
                        <label class="form-label" for="referenciaEd">Referencia</label>
                        <input type="text" class="form-control" id="referenciaEd">
                    </div>

                    <div class="mb-3 col-md-4">
                        <label class="form-label" for="regionEd">Región</label>
                        <select name="" id="regionEd" class="form-control">
                            <option value="">Seleccione una Región</option>
                        </select>
                    </div>
                    <div class="mb-3 col-md-4">
                        <label class="form-label" for="provinciaEd">Provincia</label>
                        <select name="" id="provinciaEd" class="form-control">
                            <option value="">Seleccione una Provincia</option>
                        </select>
                    </div>
                    <div class="mb-3 col-md-4">
                        <label class="form-label" for="comunaEd">Comuna</label>
                        <select name="" id="comunaEd" class="form-control">
                            <option value="">Seleccione una Comuna</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" id="btnEditOrganitation" class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </div>
</div>


<!-- MODAL Crear -->

<!-- Modal -->
<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Crear Organización</h5>
             
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 mb-3 d-flex justify-content-center">
                    <span class="text-danger fw-bold">Campos obligatorios (*)</span> 
                    </div>
                    <div class="mb-3 col-md-3">
                        <label for="rutN" class="form-label">E-Rut <span class="text-danger fw-bold">(*)</span></label>
                        <input type="text" class="form-control" id="rutN">
                    </div>
                    <div class="mb-3 col-md-3">
                        <label for="personalidadJuridicaN" class="form-label">N° Personalidad jurídica <span class="text-danger fw-bold">(*)</span></label>
                        <input type="text" class="form-control" id="personalidadJuridicaN">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="nombreN" class="form-label">Nombre <span class="text-danger fw-bold">(*)</span></label>
                        <input type="text" class="form-control" id="nombreN">
                    </div>
                    <div class="mb-3 col-md-4">
                        <label class="form-label" for="tipoOrganizacionN">Tipo de Organización <span class="text-danger fw-bold">(*)</span></label>
                        <select name="" id="tipoOrganizacionN" class="form-control">
                            <option value="0">Seleccione una Tipo</option>
                        </select>
                    </div>

                    <div class="mb-3 col-md-3">
                        <label for="eleccionDirecctivaN" class="form-label"> Fecha Elección Directiva <span class="text-danger fw-bold">(*)</span></label>
                        <input type="date"  class="form-control" id="eleccionDirecctivaN">
                    </div>
                    <div class="mb-3 col-md-3">
                        <label for="duracionDirectivaN" class="form-label"> Años Duración Directiva <span class="text-danger fw-bold">(*)</span></label>
                        <input type="number" class="form-control" id="duracionDirectivaN">
                    </div>

                    <div class="mb-3 col-md-4">
                        <label class="form-label" for="calleN">Calle <span class="text-danger fw-bold">(*)</span></label>
                        <input type="text" class="form-control" id="calleN">
                    </div>

                    <div class="mb-3 col-md-3">
                        <label class="form-label" for="numeroN">Número <span class="text-danger fw-bold">(*)</span></label>
                        <input type="text" class="form-control" id="numeroN">
                    </div>

                    <div class="mb-3 col-md-5">
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