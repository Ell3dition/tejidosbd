import {disableButtonAnimation, enableButtonAnimation,handleErrorsMessage } from "../../helpers/funtions.js";
import { createTableOrganitations, getOrganitations } from "./organitations.js";


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

export const saveOrganitations = async () => {

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
        cleanSaveOrganitationSave();
        $("#createModal").modal('hide')
        const data = await getOrganitations();
        createTableOrganitations(data)
    }
    Swal.fire({
        icon: data.state ? "success" : "error",
        title: data.state ? "Exito" : "Opps!",
        text: data.data,
    })
}




const cleanSaveOrganitationSave = () => {
    eRut.value = ""
    nameOrganitations.value = ""
    typeOrganitations.value = "0"
    street.value = ""
    number.value = ""
    reference.value = ""
    selectRegion.value = "0"
    selectProvincia.value = "0"
    selectComuna.value = "0"
    legalPersonalityNumber.value = "0"
    boardElectionDate.value = "yyyy-MM-dd"
    yearsValidityDirective.value = "0"
}