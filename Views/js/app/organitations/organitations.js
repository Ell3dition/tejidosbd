import { cleanDataTable, createDataTable, getComunas, getProvincias, getRegiones } from "../../helpers/funtions.js";
import { deleteOrganitation } from "./deleteOrganitations.js";
import { editOrganitations } from "./editOrganitations.js";
import { saveOrganitations } from "./saveOrganitations.js";


const tableOrganitations = document.querySelector("#table-organitations");
const btnSaveOrganitation = document.querySelector("#btnSaveOrganitation");

const selectRegion = document.querySelector("#regionN")
const selectProvincia = document.querySelector("#provinciaN")
const selectComuna = document.querySelector("#comunaN")

const selectRegionEd = document.querySelector("#regionEd")

const eRut = document.querySelector("#rutN")
const eRutEd = document.querySelector("#rutEd")

const typeOrganitations = document.querySelector("#tipoOrganizacionN")
const typeOrganitationsEd = document.querySelector("#tipoOrganizacionEd")

const initModule =  async () => {
    getRegiones([selectRegion.id, selectRegionEd.id])
    getOrganitationsType([typeOrganitations.id, typeOrganitationsEd.id])
    const data = await getOrganitations();
    createTableOrganitations(data)
}

document.addEventListener('DOMContentLoaded',initModule)

document.addEventListener('click', (event) => {
    if (String(event.target.classList).includes('edit')) {
        const idOrganitation = event.target.dataset.id
        editOrganitations(idOrganitation , event.target)
    } else if (String(event.target.classList).includes('delete')) {
        const idOrganitation = event.target.dataset.id
        deleteOrganitation(idOrganitation , event.target)
    }
})


$(`input#${eRut.id}`).rut({
    formatOn: 'keyup',
    minimumLength: 8, // validar largo mínimo; default: 2
    validateOn: 'change' // si no se quiere validar, pasar null
});

$(`input#${eRutEd.id}`).rut({
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
        console.error(error)
        Swal.fire({
            icon: "error",
            title: "Opps!",
            text: 'Hubo un error al procesar la información si el problema persiste contacte al soporte',
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
        <td>${organitation.legalPersonalityNumber}</td>
        <td>${organitation.name}</td>
        <td>${organitation.boardElectionDate}</td>
        <td>${organitation.yearsValidityDirective}</td>
        <td>${organitation.organizationType}</td>
        <td>${organitation.address}</td>
        <td>
            <button class="btn btn-sm btn-warning edit mb-1" data-id=${organitation.organizationId} type="button">Editar</button>
            <button class="btn btn-sm btn-danger delete" data-id=${organitation.organizationId} type="button">Eliminar</button>
        </td>
        `;

        listTrs.push(tr)

    });
    tbody.append(...listTrs)
    createDataTable(tableOrganitations.id)
}

btnSaveOrganitation.addEventListener('click', saveOrganitations)

selectRegion.addEventListener('change', () => getProvincias(selectProvincia.id, selectRegion.value))
selectProvincia.addEventListener('change', () => getComunas(selectComuna.id, selectProvincia.value))


const getOrganitationsType = async(listSelectId)=>{
    const url = "Controllers/organitations/organitationsC.php";
    const response = await fetch(url, {
        method: "POST",
        body: new URLSearchParams({ action: "getOrganitationsType" })
    })
    const listRegion = await response.json();

    listSelectId.forEach((selectId)=>{
        $(`#${selectId}`).empty();
        const select = document.querySelector(`#${selectId}`);
        const option = document.createElement("option");
        option.value = "0";
        option.text = "Seleccione un Tipo de organización";
        select.add(option);
        listRegion.data.forEach((region) => {
            const option = document.createElement("option");
            option.value = region.id;
            option.text = region.name;
            select.add(option);
        });
    })
}



