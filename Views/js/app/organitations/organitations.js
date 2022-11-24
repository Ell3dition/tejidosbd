import { cleanDataTable, createDataTable, getComunas, getProvincias, getRegiones } from "../../helpers/funtions.js";

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
document.addEventListener('DOMContentLoaded', () => {
    getOrganitations();
    getRegiones(selectRegion.id)
    createTableOrganitations()
})

$(`input#${eRut.id}`).rut({
    formatOn: 'keyup',
    minimumLength: 8, // validar largo mínimo; default: 2
    validateOn: 'change' // si no se quiere validar, pasar null
});


const getOrganitations = () => {
    console.log("Data obtenida")
}

const createTableOrganitations = () => {
    // cleanDataTable(tableOrganitations.id)
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