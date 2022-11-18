var onloadCallback = () => {
  grecaptcha.render("html_element", {
    sitekey: "6Lf-9F4dAAAAAJWdtKr6bbbcA22Zm5UCPCEvhbRk",
    theme: "light",
  });
};

const formulario = document.querySelector("#formIngreso");
formulario.addEventListener("submit", async function (e) {
  e.preventDefault();
  const data = new FormData(formulario);
  data.append("accion", "ingresar");
  const response = await fetch("Controllers/loginC.php", {
    method: "POST",
    body: data,
  });

  const { Estado, Motivo } = await response.json();

  if (Estado) {
    window.location = "home";
  } else {
    const { isConfirmed, isDenied, isDismissed } = await Swal.fire({
      icon: "error",
      title: "Oops...",
      text: Motivo,
    });

    if (isConfirmed || isDenied || isDismissed) {
      grecaptcha.reset();
    }
  }
});
