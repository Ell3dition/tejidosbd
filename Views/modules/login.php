<link rel="stylesheet" href="Views/css/estilosLogin.css">
<div class="container login-container">
    <div class="row">
        <div class="col-md-6 login-form-1 d-flex justify-content-center">

            <img src="Views/img/login/login-1.jpeg" class="img-fluid" alt="">

        </div>
        <div class="col-md-6 login-form-2">

            <form id="formIngreso" class="mt-5">
                <h3 class="mb-3"><strong>Bienvenido</strong> </h3>
                <div class="form-group mb-2">
                    <input type="text" id="inputEmail" class="form-control" placeholder="Usuario" name="usuario-Ing"
                        required autofocus>
                </div>
                <div class="form-group mb-2">
                    <input type="password" id="inputPassword" class="form-control" placeholder="Contraseña"
                        name="clave-Ing" required>
                </div>
                <div class="form-group d-flex justify-content-center mb-2">

                    <div id="html_element"></div>

                </div>
                <div class="form-group d-flex justify-content-center mb-2">
                    <input type="submit" class="btnSubmit btn btn-lg btn-block" />
                </div>

            </form>
        </div>
    </div>
</div>

<script src="Views/js/app/login.js"></script>
<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer>
</script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>

</script>