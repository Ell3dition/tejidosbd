<section>
    <div class="container">

        <div class="row m-3 d-flex justify-content-center">
            <div class="col-md-4 d-flex justify-content-center">

                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
                    Crear
                </button>
            </div>
        </div>

        <div class="row d-flex justify-content-center">
            <div class="col-md-10">
                <table class="table table-light">
                    <thead class="thead-light">
                        <tr>
                            <th>#</th>
                            <th>Rut</th>
                            <th>Nombre</th>
                            <th>Tipo de Organización</th>
                            <th>Dirección</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>77777777</td>
                            <td>Fundación Condorito</td>
                            <td></td>
                            <td>Cumpeo</td>
                            <td>
                                <button class="btn btn-sm btn-warning" type="button">Editar</button>
                                <button class="btn btn-sm btn-danger" type="button">Eliminar</button>
                            </td>
                        </tr>
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
                <h5 class="modal-title" id="createModalLabel">Crear Organización</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="mb-3 col-md-4">
                        <label for="rutN" class="form-label">Rut</label>
                        <input type="text" class="form-control" id="rutN" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3 col-md-8">
                        <label for="nombreN" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombreN">
                    </div>
                    <div class="mb-3 col-md-4">
                        <label class="form-label" for="regionN">Región</label>
                        <select name="" id="regionN" class="form-control">
                            <option value="">Seleccione una Región</option>
                        </select>
                    </div>
                    <div class="mb-3 col-md-4">
                        <label class="form-label" for="provinciaN">Provincia</label>
                        <select name="" id="provinciaN" class="form-control">
                            <option value="">Seleccione una Provincia</option>
                        </select>
                    </div>
                    <div class="mb-3 col-md-4">
                        <label class="form-label" for="Comuna">Comuna</label>
                        <select name="" id="Comuna" class="form-control">
                            <option value="">Seleccione una Comuna</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>