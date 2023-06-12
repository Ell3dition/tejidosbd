export { 
    cleanDataTable, 
    createDataTable, 
    getRegiones, 
    getProvincias, 
    getComunas, 
    enableButtonAnimation, 
    disableButtonAnimation,
    handleErrorsMessage,
    getEducationalLevel,
    getOrganizationForSelect,
    formatRut
}



const handleErrorsMessage =(errors)=>{
    const labelError = errors.map((errorMessage, index)=> `<li class="mb-1 "><strong>${index + 1}-. ${errorMessage.data}</strong></li>`).join('')
    Swal.fire({
        icon: "error",
        title: "Opps!",
        html:`<p>Por favor resuelva los siguientes errores</p>
              <ul class="text-start" style="list-style:none;">${labelError}</ul>`
    })
}

function cleanDataTable(idTabla) {
    let tabla = $("#" + idTabla).DataTable();
    if (tabla != null) {
        tabla.clear();
        tabla.destroy();
    }
}

function createDataTable(idTabla, title, filename, page = 20, footer = false) {
    $("#" + idTabla).DataTable({
        paging: true,
        processing: true,
        pageLength: page,
        language: {
            decimal: "",
            emptyTable: "No hay información",
            info: "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
            infoEmpty: "Mostrando 0 de 0 Entradas",
            infoFiltered: "(Filtrado de _MAX_ total entradas)",
            infoPostFix: "",
            thousands: ",",
            lengthMenu: "Mostrar _MENU_ Entradas",
            loadingRecords: "Cargando...",
            processing: "Procesando...",
            search: "",
            zeroRecords: "Sin resultados encontrados",
            paginate: {
                first: "Primero",
                last: "Ultimo",
                next: "Siguiente",
                previous: "Anterior",
            },
        },

        dom: "Bfrtip",
        buttons: {
            dom: {
                button: {
                    className: "btn",
                },
            },
            buttons: [
                {
                    exportOptions: {
                        columns: ":not(.no-exportar)",
                    },
                    extend: "excelHtml5",
                    footer: footer,
                    title: null,
                    filename: filename,
                    //definimos estilos del boton de excel
                    extend: "excel",
                    text: '<i class="fa fa-download" aria-hidden="true"></i> Exportar',

                    className: "btn btn-secondary m-3",

                    excelStyles: [
                        {
                            template: ["blue_medium", "header_green", "title_medium"],
                        },

                        {
                            cells: "sh",
                            style: {
                                font: {
                                    size: 20,
                                    b: false,
                                },
                                fill: {
                                    pattern: {
                                        color: "1C3144",
                                    },
                                },
                            },
                        },
                    ],

                },
            ],
        },
    });
    const contenedor = document.querySelector(`#${idTabla}_filter`);
    const input = document.querySelector(`#${idTabla}_filter input`)

    contenedor.classList.add("d-flex");
    contenedor.classList.add("justify-content-end");
    input.setAttribute("placeholder", "Buscar...");
    input.classList.remove("form-control", "form-control-sm");
    input.classList.add("search-input-personalizado");
    input.style.width = "300px";

    //SE CREA UN ELEMENTO DE TIPO i
    const icon = document.createElement("i");
    //SE AGREGA CLASES FA DEL ICON LUPA
    icon.classList.add("fa", "fa-search");
    icon.style.color = "#3C5BE7";
    icon.style.position = "absolute";
    icon.style.marginLeft = "25px"
    icon.style.marginTop = "15px"
    icon.style.fontSize = "20px"

    //LO AGREGO ANTES DEL INPUT
    input.insertAdjacentElement("beforebegin", icon);

}


async function getRegiones(idSelects) {
    const url = "Controllers/helpers/functionsC.php";
    const response = await fetch(url, {
        method: "POST",
        body: new URLSearchParams({ action: "getRegiones" })
    })
    const listRegion = await response.json();

    idSelects.forEach((idSelect)=>{

        $(`#${idSelect}`).empty();
        const select = document.querySelector(`#${idSelect}`);
        const option = document.createElement("option");
        option.value = "0";
        option.text = "Seleccione una Región";
        select.add(option);
        listRegion.data.forEach((region) => {
            const option = document.createElement("option");
            option.value = region.id;
            option.text = region.name;
            select.add(option);
        });

    })

}

async function getProvincias(idSelect, idRegion) {
    const url = "Controllers/helpers/functionsC.php";
    const response = await fetch(url, {
        method: "POST",
        body: new URLSearchParams({ action: "getProvincias", idRegion })
    })
    const listProvincias = await response.json();

    $(`#${idSelect}`).empty();
    const select = document.querySelector(`#${idSelect}`);
    const option = document.createElement("option");
    option.value = "0";
    option.text = "Selecciones una Provincia";
    select.add(option);
    listProvincias.data.forEach((provincia) => {

        const option = document.createElement("option");
        option.value = provincia.id;
        option.text = provincia.name;
        select.add(option);

    });

}

async function getComunas(idSelect,  idProvincia) {
    const url = "Controllers/helpers/functionsC.php";
    const response = await fetch(url, {
        method: "POST",
        body: new URLSearchParams({ action: "getComunas", idProvincia })
    })
    const listComunas = await response.json();

    $(`#${idSelect}`).empty();
    const select = document.querySelector(`#${idSelect}`);
    const option = document.createElement("option");
    option.value = "0";
    option.text = "Selecciones una Comuna";
    select.add(option);
    listComunas.data.forEach((comuna) => {

        const option = document.createElement("option");
        option.value = comuna.id;
        option.text = comuna.name;
        select.add(option);

    });

}

function enableButtonAnimation(btn, texto) {
    const spanSpinner = document.createElement("SPAN");
    spanSpinner.classList.add("spinner-grow", "spinner-grow-sm");
    spanSpinner.setAttribute("role", "status");
    spanSpinner.setAttribute("aria-hidden", "true");
  
    const spanText = document.createElement("SPAN");
    spanText.textContent = ` ${texto}`;
  
    btn.textContent = "";
    btn.appendChild(spanSpinner);
    btn.appendChild(spanText);
    btn.setAttribute("disabled", true);
  }
  
function disableButtonAnimation(btn, texto, icon = false) {
    btn.removeAttribute("disabled");
    btn.textContent = texto;
    if (icon) {
      btn.textContent = "";
      const i = document.createElement("i");
      i.classList.add("fa", "fa-search");
      btn.append(i, texto);
    }
}


async function getEducationalLevel(idSelects){
    const url = "Controllers/partners/partnersC.php";
    const response = await fetch(url, {
        method: "POST",
        body: new URLSearchParams({ action: "getEducationalLevel" })
    })
    const listRegion = await response.json();

    idSelects.forEach((idSelect)=>{

        $(`#${idSelect}`).empty();
        const select = document.querySelector(`#${idSelect}`);
        const option = document.createElement("option");
        option.value = "0";
        option.text = "Seleccione un Nivel";
        select.add(option);
        listRegion.data.forEach((region) => {
            const option = document.createElement("option");
            option.value = region.id;
            option.text = region.name;
            select.add(option);
        });

    })
}


async function getOrganizationForSelect(idSelects){
    const url = "Controllers/organitations/organitationsC.php";
    const response = await fetch(url, {
        method: "POST",
        body: new URLSearchParams({ action: "getOrganitatiosForSelect" })
    })
    const listData = await response.json();

    idSelects.forEach((idSelect)=>{

        $(`#${idSelect}`).empty();
        const select = document.querySelector(`#${idSelect}`);
        const option = document.createElement("option");
        option.value = "0";
        option.text = "Seleccione una organización";
        select.add(option);
        listData.data.forEach((data) => {
            const option = document.createElement("option");
            option.value = data.id;
            option.text = data.name;
            select.add(option);
        });

    })
}

const formatRut = (listIdInputs)=>{
    listIdInputs.forEach((id)=>{
        $(`input#${id}`).rut({
            formatOn: 'keyup',
            minimumLength: 8, // validar largo mínimo; default: 2
            validateOn: 'change' // si no se quiere validar, pasar null
        });
    })
}