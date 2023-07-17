export const initSaverPartner = ()=>console.log('form inicializado')

import { disableButtonAnimation, enableButtonAnimation, getComunas, getProvincias, handleErrorsMessage } from "../../helpers/funtions.js"
import { getListPartners, renderTable } from "./partners.js"

// datos personales
const rutN = document.querySelector('#rutN')
const primerNombreN = document.querySelector('#primerNombreN')
const segundoNombreN = document.querySelector('#segundoNombreN')
const apellidoPaternoN = document.querySelector('#apellidoPaternoN')
const apellidoMaternoN = document.querySelector('#apellidoMaternoN')
const fechaNacimientoN = document.querySelector('#fechaNacimientoN')
const ocupacionN = document.querySelector('#ocupacionN')
const fechaIngresoN = document.querySelector('#fechaIngresoN')
const rolN = document.querySelector('#rolN') ?? ''
const generoN = document.querySelector('#generoN')
const nivelEstudiosN = document.querySelector('#nivelEstudiosN')
const organizacionN = document.querySelector('#organizacionN') ?? ''


// datos contacto
const celularN = document.querySelector('#celularN')
const telefonoN = document.querySelector('#telefonoN')
const correoN = document.querySelector('#correoN')
const calleN = document.querySelector('#calleN')
const numeroN = document.querySelector('#numeroN')
const referencia = document.querySelector('#referenciaN')
const regionN = document.querySelector('#regionN')
const provinciaN = document.querySelector('#provinciaN')
const comunaN = document.querySelector('#comunaN')

const btnGuardarPartner = document.querySelector('#btnSavePartner')



regionN.addEventListener('change', ()=>getProvincias([provinciaN.id], regionN.value))
provinciaN.addEventListener('change', ()=>getComunas([comunaN.id], provinciaN.value))


btnGuardarPartner.addEventListener('click', async()=>{

    if(!($.validateRut( rutN.value))){
        Swal.fire({
            icon: "error",
            title: "Opps!",
            text: "Debe ingresar un Rut válido",
        })
        return
    }

    enableButtonAnimation(btnGuardarPartner, 'Espere...')

    const dataSave = {
        organizacionId: organizacionN ? organizacionN.value : null,
        rut: rutN.value,
        firstName: primerNombreN.value,
        secondName: segundoNombreN.value,
        lastname: apellidoPaternoN.value,
        secondLastname: apellidoMaternoN.value,
        birthdate: fechaNacimientoN.value,
        gender: generoN.value,
        educationalLevel: nivelEstudiosN.value,
        occupation: ocupacionN.value,
        admissionDate: fechaIngresoN.value,
        rol: rolN ? rolN.value : null,
        cellPhone: celularN.value,
        phone: telefonoN.value,
        mail:correoN.value,
        street: calleN.value,
        number: numeroN.value,
        references: referencia.value,
        regionId: regionN.value,
        provinceId: provinciaN.value,
        communeId:comunaN.value
    }


    const url = "Controllers/partners/partnersC.php";
    const response = await fetch(url, {
        method: "POST",
        body: new URLSearchParams({ action: "savePartner", data: JSON.stringify(dataSave) })
    })

    const data = await response.json();

    disableButtonAnimation(btnGuardarPartner, 'Guardar')

    if('errors' in data){
        handleErrorsMessage(data.errors)
        return
    }

    if (data.state) {
        cleanFormSavePartner();
        $("#createModal").modal('hide')
        const data = await getListPartners();
        renderTable(data)
    }
    Swal.fire({
        icon: data.state ? "success" : "error",
        title: data.state ? "Exito" : "Opps!",
        text: data.data,
    })

})


const cleanFormSavePartner = ()=>{
    if(organizacionN)  organizacionN.value = ""
    rutN.value = ""
    primerNombreN.value = ""
    segundoNombreN.value = ""
    apellidoPaternoN.value = ""
    apellidoMaternoN.value = ""
    fechaNacimientoN.value = ""
    generoN.value = "0"
    nivelEstudiosN.value = "0"
    ocupacionN.value = ""
    fechaIngresoN.value = ""
    if(rolN)rolN.value = ""
    celularN.value = ""
    telefonoN.value = ""
    correoN.value = ""
    calleN.value = ""
    numeroN.value = ""
    referencia.value = ""
    regionN.value = "0"
    provinciaN.value = "0"
    comunaN.value = "0"
}