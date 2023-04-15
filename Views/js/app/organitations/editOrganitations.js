import { handleErrorsMessage } from "../../helpers/funtions.js";
import { disableButtonAnimation } from "../../helpers/funtions.js";
import { enableButtonAnimation } from "../../helpers/funtions.js";
import { getComunas, getProvincias, getRegiones } from "../../helpers/funtions.js";
import { createTableOrganitations, getOrganitations } from "./organitations.js";

const btnEditOrganitation = document.querySelector("#btnEditOrganitation");

const selectRegionEd = document.querySelector("#regionEd")
const selectProvinciaEd = document.querySelector("#provinciaEd")
const selectComunaEd = document.querySelector("#comunaEd")

const idOrganitationsInput = document.querySelector("#idOrganitations")
const idAddress = document.querySelector("#idAddress")
const eRutEd = document.querySelector("#rutEd")
const nameOrganitationsEd = document.querySelector("#nombreEd")
const typeOrganitationsEd = document.querySelector("#tipoOrganizacionEd")
const streetEd = document.querySelector("#calleEd")
const numberEd = document.querySelector("#numeroEd")
const referenceEd = document.querySelector("#referenciaEd")


const legalPersonalityNumberEd = document.querySelector("#personalidadJuridicaEd")
const boardElectionDateEd = document.querySelector("#eleccionDirecctivaEd")
const yearsValidityDirectiveEd = document.querySelector("#duracionDirectivaEd")

export const editOrganitations = async (idOrganitations) => {
    const url = "Controllers/organitations/organitationsC.php";
    const response = await fetch(url, {
        method: "POST",
        body: new URLSearchParams({ action: 'getOrganitation', idOrganitations })
    })

    const organitation = await response.json();

    if (!organitation.state) {
        throw organitation.data

    }
    const data = organitation.data

    console.log(data)

    await getProvincias(selectProvinciaEd.id, data.region_fk)
    await getComunas(selectComunaEd.id, data.provincia_fk)

    selectRegionEd.value = data.region_fk
    selectProvinciaEd.value = data.provincia_fk
    selectComunaEd.value = data.comuna_fk

    idOrganitationsInput.value = data.idOrganizacion
    idAddress.value = data.idAddress
    eRutEd.value = $.formatRut(data.rut)
    nameOrganitationsEd.value = data.nombre
    typeOrganitationsEd.value = data.typeOrganitationId
    streetEd.value = data.calle
    numberEd.value = data.numero
    referenceEd.value = data.referencia

    legalPersonalityNumberEd.value = data.legalPersonalityNumber
    boardElectionDateEd.value = data.boardElectionDate
    yearsValidityDirectiveEd.value = data.yearsValidityDirective

    $("#editModal").modal("show")

}


selectRegionEd.addEventListener('change', () => getProvincias(selectProvinciaEd.id, selectRegionEd.value))
selectProvinciaEd.addEventListener('change', () => getComunas(selectComunaEd.id, selectProvinciaEd.value))



btnEditOrganitation.addEventListener('click', async () => {

    if(!($.validateRut( eRutEd.value))){
        Swal.fire({
            icon: "error",
            title: "Opps!",
            text: "Debe ingresar un Rut válido",
        })
        return
    }

    enableButtonAnimation(btnEditOrganitation, 'Espere...')

    const editData = {
        idAddress: idAddress.value,
        idOrganitation: idOrganitationsInput.value,
        eRut: eRutEd.value,
        nameOrganitations: nameOrganitationsEd.value,
        typeOrganitations: typeOrganitationsEd.value,
        street: streetEd.value,
        number: numberEd.value,
        reference: referenceEd.value,
        idRegion: selectRegionEd.value,
        idProvincia: selectProvinciaEd.value,
        idComuna: selectComunaEd.value,
        legalPersonalityNumber : legalPersonalityNumberEd.value,
        boardElectionDate : boardElectionDateEd.value,
        yearsValidityDirective : yearsValidityDirectiveEd.value
    }


    const url = "Controllers/organitations/organitationsC.php";
    const response = await fetch(url, {
        method: "POST",
        body: new URLSearchParams({ action: "editOrganitation", data: JSON.stringify(editData) })
    })

    const data = await response.json();
    disableButtonAnimation(btnEditOrganitation, 'Actualizar')

    if('errors' in data){
        handleErrorsMessage(data.errors)
        return
    }

    if (data.state) {
        const data = await getOrganitations();
        createTableOrganitations(data)
        cleanFormEdit();
        $("#editModal").modal('hide')
    }

    Swal.fire({
        icon: data.state ? "success" : "error",
        title: data.state ? "Exito" : "Opps!",
        text: data.data,
    })

})

const cleanFormEdit = () => {
    idAddress.value = ""
    idOrganitationsInput.value = ""
    eRutEd.value = ""
    nameOrganitationsEd.value = ""
    typeOrganitationsEd.value = "0"
    streetEd.value = ""
    numberEd.value = ""
    referenceEd.value = ""
    selectRegionEd.value = "0"
    selectProvinciaEd.value = "0"
    selectComunaEd.value = "0"
    legalPersonalityNumberEd.value = "0"
    boardElectionDateEd.value = "yyyy-MM-dd"
    yearsValidityDirectiveEd.value = "0"
}
