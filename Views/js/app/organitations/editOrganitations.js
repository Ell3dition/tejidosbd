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


export const editOrganitations = async (idOrganitations) => {
    console.log(idOrganitations)

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

    await getProvincias(selectProvinciaEd.id, data.region_fk)
    await getComunas(selectComunaEd.id, data.provincia_fk)

    selectRegionEd.value = data.region_fk
    selectProvinciaEd.value = data.provincia_fk
    selectComunaEd.value = data.comuna_fk

    idOrganitationsInput.value = data.idOrganizacion
    idAddress.value = data.idAddress
    eRutEd.value = $.formatRut(data.rut)
    nameOrganitationsEd.value = data.nombre
    typeOrganitationsEd.value = data.type
    streetEd.value = data.calle
    numberEd.value = data.numero
    referenceEd.value = data.referencia

    $("#editModal").modal("show")

}


selectRegionEd.addEventListener('change', () => getProvincias(selectProvinciaEd.id, selectRegionEd.value))
selectProvinciaEd.addEventListener('change', () => getComunas(selectComunaEd.id, selectProvinciaEd.value))



btnEditOrganitation.addEventListener('click', async () => {
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
        idComuna: selectComunaEd.value
    }


    const url = "Controllers/organitations/organitationsC.php";
    const response = await fetch(url, {
        method: "POST",
        body: new URLSearchParams({ action: "editOrganitation", data: JSON.stringify(editData) })
    })

    const { state, data } = await response.json();

    if (state) {
        const data = await getOrganitations();
        createTableOrganitations(data)
        cleanFormEdit();
        $("#editModal").modal('hide')
    }

    Swal.fire({
        icon: state ? "success" : "error",
        title: state ? "Exito" : "Opps!",
        text: data,
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
}
