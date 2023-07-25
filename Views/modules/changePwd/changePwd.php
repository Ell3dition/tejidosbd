<div class="modal fade" id="changePwd-modal" tabindex="-1" aria-labelledby="changePwd-modalLabel" aria-hidden="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">

                <h5> <strong>La contraseña ingresada es la contraseña por defecto. Por motivos de seguridad, se
                        recomienda cambiarla. </strong> </h5>
                <hr />

               <div class="container">
                <div class="row">
                <div class="mb-3 col-md-12">
                    <label class="form-label" for="username">Nombre Usuario</label>
                    <input type="text" class="form-control" readonly value="<?php echo  $_SESSION["nombreUsuario"] ?>">
                </div>

                <div class="mb-3 col-md-12">
                    <label class="form-label" for="pwdNew">Nueva Contraseña</label>
                     <label class="text-muted">Mínimo 6 carácteres</label>
                    <input type="password" class="form-control" id="pwdNew">
                </div>

                <div class="mb-3 col-md-12">
                    <label class="form-label" for="repeatPwd">Repita Nueva Contraseña</label>
                    <input type="password" class="form-control" id="repeatPwd">
                </div>
                </div>
               </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" id="exit-btn">Salir del sistema</button>
                <button type="button" class="btn btn-primary" id="changePwd-btn">Cambiar contraseña</button>
            </div>
        </div>
    </div>
</div>

<script src="Views/assets/jquery.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>

<script src="Views/js/app/changePwd/changePwd.js" type="module"></script>