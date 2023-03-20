import { disableButtonAnimation, enableButtonAnimation } from "../helpers/funtions.js";

const formulario = document.querySelector("#formIngreso");
formulario.addEventListener("submit", async function (e) {
  e.preventDefault();
  const btnForm = e.submitter

  console.log(btnForm)
  enableButtonAnimation(btnForm, 'Validando...')

  const data = new FormData(formulario);
  data.append("accion", "ingresar");
  const response = await fetch("Controllers/loginC.php", {
    method: "POST",
    body: data,
  });

  const { Estado, Motivo } = await response.json();

  if (!Estado) {
    disableButtonAnimation(btnForm, 'Ingresar')
    const { isConfirmed, isDenied, isDismissed } = await Swal.fire({
      icon: "error",
      title: "Oops...",
      text: Motivo,
    });

    if (isConfirmed || isDenied || isDismissed) {
      grecaptcha.reset();
    }
    return
  }
    window.location = "home";
});
