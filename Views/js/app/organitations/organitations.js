import { cleanDataTable, createDataTable, getComunas, getProvincias, getRegiones } from "../../helpers/funtions.js";
import { editOrganitations } from "./editOrganitations.js";

//VARIABLES
const tableOrganitations = document.querySelector("#table-organitations");
const btnSaveOrganitation = document.querySelector("#btnSaveOrganitation");

const selectRegion = document.querySelector("#regionN")
const selectProvincia = document.querySelector("#provinciaN")
const selectComuna = document.querySelector("#comunaN")

const eRut = document.querySelector("#rutN")
const nameOrganitations = document.querySelector("#nombreN")
const typeOrganitations = document.querySelector("#tipoOrganizacionN")
const street = document.querySelector("#calleN")
const number = document.querySelector("#numeroN")
const reference = document.querySelector("#referenciaN")


document.addEventListener('DOMContentLoaded', async () => {
    getRegiones(selectRegion.id)
    const data = await getOrganitations();
    createTableOrganitations(data)
    getOrganitationsType()
})

document.addEventListener('click', (event) => {

    if (String(event.target.classList).includes('edit')) {
        const idOrganitation = event.target.dataset.id
        editOrganitations(idOrganitation)
    } else if (String(event.target.classList).includes('delete')) {
        const idOrganitation = event.target.dataset.id
        deleteOrganitation(idOrganitation)
    }


})


$(`input#${eRut.id}`).rut({
    formatOn: 'keyup',
    minimumLength: 8, // validar largo mínimo; default: 2
    validateOn: 'change' // si no se quiere validar, pasar null
});


export const getOrganitations = async () => {
    try {
        const url = "Controllers/organitations/organitationsC.php";
        const response = await fetch(url, {
            method: "POST",
            body: new URLSearchParams({ action: 'getOrganitations' })
        })
        const listOrganitatios = await response.json()
        if (!listOrganitatios.state) {
            throw listOrganitatios.data
        }
        return listOrganitatios.data;
    } catch (error) {
        Swal.fire({
            icon: "error",
            title: "Opps!",
            text: error,
        })
    }
}

export const createTableOrganitations = (data) => {
    cleanDataTable(tableOrganitations.id)
    const tbody = tableOrganitations.querySelector("tbody");
    tbody.innerHTML = '';

    const listTrs = []
    data.forEach((organitation, index) => {
        const tr = document.createElement('tr');

        tr.innerHTML = `
        <td>${index + 1}</td>
        <td>${ $.formatRut(organitation.erut)}</td>
        <td>${organitation.name}</td>
        <td>${organitation.type}</td>
        <td>${organitation.address}</td>
        <td>
            <button class="btn btn-sm btn-warning edit" data-id=${organitation.id} type="button">Editar</button>
            <button class="btn btn-sm btn-danger delete" data-id=${organitation.id} type="button">Eliminar</button>
        </td>
        `;

        listTrs.push(tr)

    });
    tbody.append(...listTrs)
    createDataTable(tableOrganitations.id)
}

btnSaveOrganitation.addEventListener('click', async () => {
    const dataSave = {
        eRut: eRut.value,
        nameOrganitations: nameOrganitations.value,
        typeOrganitations: typeOrganitations.value,
        street: street.value,
        number: number.value,
        reference: reference.value,
        idRegion: selectRegion.value,
        idProvincia: selectProvincia.value,
        idComuna: selectComuna.value

    }

    const url = "Controllers/organitations/organitationsC.php";
    const response = await fetch(url, {
        method: "POST",
        body: new URLSearchParams({ action: "saveOrganitations", data: JSON.stringify(dataSave) })
    })

    const { state, data } = await response.json();

    if (state) {
        cleanForm();
        $("#createModal").modal('hide')
    }

    Swal.fire({
        icon: state ? "success" : "error",
        title: state ? "Exito" : "Opps!",
        text: data,
    })

})


const cleanForm = () => {
    eRut.value = ""
    nameOrganitations.value = ""
    typeOrganitations.value = "0"
    street.value = ""
    number.value = ""
    reference.value = ""
    selectRegion.value = "0"
    selectProvincia.value = "0"
    selectComuna.value = "0"

}

/*EVENTOS SELECT REGION , PROVINCIAS, COMUNAS*/

selectRegion.addEventListener('change', () => getProvincias(selectProvincia.id, selectRegion.value))
selectProvincia.addEventListener('change', () => getComunas(selectComuna.id, selectProvincia.value))




const deleteOrganitation = (idOrganitation) => {

    console.log(idOrganitation)

}

const getOrganitationsType = async()=>{
    const url = "Controllers/organitations/organitationsC.php";
    const response = await fetch(url, {
        method: "POST",
        body: new URLSearchParams({ action: "getOrganitationsType" })
    })
    const listRegion = await response.json();

    $(`#tipoOrganizacionN`).empty();
    const select = document.querySelector(`#tipoOrganizacionN`);
    const option = document.createElement("option");
    option.value = "0";
    option.text = "Seleccione un Tipo";
    select.add(option);
    listRegion.data.forEach((region) => {
        const option = document.createElement("option");
        option.value = region.id;
        option.text = region.name;
        select.add(option);
    });
}

