export { cleanDataTable, createDataTable, getRegiones, getProvincias, getComunas }


function cleanDataTable(idTabla) {
    let tabla = $("#" + idTabla).DataTable();
    if (tabla != null) {
        tabla.clear();
        tabla.destroy();
    }
}

//CREAR DATATABLE
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


async function getRegiones(idSelect) {
    const url = "Controllers/helpers/functionsC.php";
    const response = await fetch(url, {
        method: "POST",
        body: new URLSearchParams({ action: "getRegiones" })
    })
    const listRegion = await response.json();

    $(`#${idSelect}`).empty();
    const select = document.querySelector(`#${idSelect}`);
    const option = document.createElement("option");
    option.value = "0";
    option.text = "Selecciones una Región";
    select.add(option);
    listRegion.data.forEach((region) => {

        const option = document.createElement("option");
        option.value = region.id;
        option.text = region.name;
        select.add(option);

    });

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