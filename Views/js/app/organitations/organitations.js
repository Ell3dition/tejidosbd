import { cleanDataTable, createDataTable, disableButtonAnimation, enableButtonAnimation, getComunas, getProvincias, getRegiones, handleErrorsMessage } from "../../helpers/funtions.js";
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


const legalPersonalityNumber = document.querySelector("#personalidadJuridicaN")
const boardElectionDate = document.querySelector("#eleccionDirecctivaN")
const yearsValidityDirective = document.querySelector("#duracionDirectivaN")


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
        console.log(listOrganitatios)
        if (!listOrganitatios.state) {
            throw listOrganitatios.data
        }
        return listOrganitatios.data;
    } catch (error) {
        console.log(error)
        Swal.fire({
            icon: "error",
            title: "Opps!",
            text: 'Hubo un error al procesar la información si el problema persiste contacte al soporte',
        })
    }
}

export const createTableOrganitations = (data) => {
    console.log(data)
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
        <td>${organitation.organizationType}</td>
        <td>${organitation.address}</td>
        <td>
            <button class="btn btn-sm btn-warning edit" data-id=${organitation.organizationId} type="button">Editar</button>
            <button class="btn btn-sm btn-danger delete" data-id=${organitation.organizationId} type="button">Eliminar</button>
        </td>
        `;

        listTrs.push(tr)

    });
    tbody.append(...listTrs)
    createDataTable(tableOrganitations.id)
}

btnSaveOrganitation.addEventListener('click', async () => {

    if(!($.validateRut( eRut.value))){
        Swal.fire({
            icon: "error",
            title: "Opps!",
            text: "Debe ingresar un Rut válido",
        })
        return
    }

    enableButtonAnimation(btnSaveOrganitation, 'Espere...')
    const dataSave = {
        eRut: eRut.value,
        nameOrganitations: nameOrganitations.value,
        typeOrganitations: typeOrganitations.value,
        street: street.value,
        number: number.value,
        reference: reference.value,
        idRegion: selectRegion.value,
        idProvincia: selectProvincia.value,
        idComuna: selectComuna.value,
        legalPersonalityNumber : legalPersonalityNumber.value,
        boardElectionDate : boardElectionDate.value,
        yearsValidityDirective : yearsValidityDirective.value
    }

    const url = "Controllers/organitations/organitationsC.php";
    const response = await fetch(url, {
        method: "POST",
        body: new URLSearchParams({ action: "saveOrganitations", data: JSON.stringify(dataSave) })
    })

    const data = await response.json();

    disableButtonAnimation(btnSaveOrganitation, 'Guardar')

    if('errors' in data){
        handleErrorsMessage(data.errors)
        return
    }

    if (data.state) {
        cleanForm();
        $("#createModal").modal('hide')
        const data = await getOrganitations();
        createTableOrganitations(data)
    }
    Swal.fire({
        icon: data.state ? "success" : "error",
        title: data.state ? "Exito" : "Opps!",
        text: data.data,
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




const deleteOrganitation = async (idOrganitation) => {

     
const {isConfirmed, isDenied} = await Swal.fire({
        title: '¿Seguro que desea eliminar esta organización?',
        icon: 'info',
        showDenyButton: true,
        showCancelButton: false,
        confirmButtonText: 'Si, Eliminar',
        denyButtonText: `Nooo.`,
      })

if(!isConfirmed || isDenied ) return

      //acion eliminar

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



