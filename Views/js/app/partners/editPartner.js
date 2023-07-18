export const initEditPartner = ()=> console.log('initEditPartner') 
import { disableButtonAnimation, enableButtonAnimation, getComunas, getProvincias, handleErrorsMessage } from "../../helpers/funtions.js"
import { getListPartners, renderTable } from "./partners.js"

// datos personales
const rutEd = document.querySelector('#rutEd')
const primerNombreEd = document.querySelector('#primerNombreEd')
const segundoNombreEd = document.querySelector('#segundoNombreEd')
const apellidoPaternoEd = document.querySelector('#apellidoPaternoEd')
const apellidoMaternoEd = document.querySelector('#apellidoMaternoEd')
const fechaNacimientoEd = document.querySelector('#fechaNacimientoEd')
const ocupacionEd = document.querySelector('#ocupacionEd')
const fechaIngresoEd = document.querySelector('#fechaIngresoEd')
const rolEd = document.querySelector('#rolEd')  ?? {value:''}
const generoEd = document.querySelector('#generoEd')
const nivelEstudiosEd = document.querySelector('#nivelEstudiosEd')
const organizacionEd = document.querySelector('#organizacionEd') ?? {value:''}
const direccionId = document.querySelector('#direccionIdEd')
const rutGuardado = document.querySelector('#rutGuardadoEd') 


// datos contacto
const celularEd = document.querySelector('#celularEd')
const telefonoEd = document.querySelector('#telefonoEd')
const correoEd = document.querySelector('#correoEd')
const calleEd = document.querySelector('#calleEd')
const numeroEd = document.querySelector('#numeroEd')
const referenciaEd = document.querySelector('#referenciaEd')
const regionEd = document.querySelector('#regionEd')
const provinciaEd = document.querySelector('#provinciaEd')
const comunaEd = document.querySelector('#comunaEd')
const recordId = document.querySelector('#recordIdEd')
const rolActual = document.querySelector('#rolActualEd')




const btnEditPartner = document.querySelector('#btnEditPartner')

regionEd.addEventListener('change', ()=>getProvincias([provinciaEd.id], regionEd.value))
provinciaEd.addEventListener('change', ()=>getComunas([comunaEd.id], provinciaEd.value))


btnEditPartner.addEventListener('click', async()=>{

    if(!($.validateRut( rutEd.value))){
        Swal.fire({
            icon: "error",
            title: "Opps!",
            text: "Debe ingresar un Rut válido",
        })
        return
    }

    enableButtonAnimation(btnEditPartner, 'Espere...')

    const dataSave = {
        rolActual: rolActual.value,
        recordId: recordId.value,
        rutGuardado:rutGuardado.value,
        direccionId:direccionId.value, 
        organizacionId: organizacionEd ? organizacionEd.value : null,
        rut: rutEd.value,
        firstName: primerNombreEd.value,
        secondName: segundoNombreEd.value,
        lastname: apellidoPaternoEd.value,
        secondLastname: apellidoMaternoEd.value,
        birthdate: fechaNacimientoEd.value,
        gender: generoEd.value,
        educationalLevel: nivelEstudiosEd.value,
        occupation: ocupacionEd.value,
        admissionDate: fechaIngresoEd.value,
        rol: rolEd ? rolEd.value : null,
        cellPhone: celularEd.value,
        phone: telefonoEd.value,
        mail:correoEd.value,
        street: calleEd.value,
        number: numeroEd.value,
        references: referenciaEd.value,
        regionId: regionEd.value,
        provinceId: provinciaEd.value,
        communeId:comunaEd.value
    }


    const url = "Controllers/partners/partnersC.php";
    const response = await fetch(url, {
        method: "POST",
        body: new URLSearchParams({ action: "updatePartner", data: JSON.stringify(dataSave) })
    })

    const data = await response.json();

    disableButtonAnimation(btnEditPartner, 'Guardar')

    if('errors' in data){
        handleErrorsMessage(data.errors)
        return
    }

    Swal.fire({
        icon: data.state ? "success" : "error",
        title: data.state ? "Exito" : "Opps!",
        text: data.data,
    })
    
    if (data.state) {
        cleanFormEditPartner();
        $("#editarModal").modal('hide')
        const data = await getListPartners();
        renderTable(data)
    }

})


const cleanFormEditPartner = ()=>{
    if(organizacionEd)  organizacionEd.value = ""
    rutEd.value = ""
    primerNombreEd.value = ""
    segundoNombreEd.value = ""
    apellidoPaternoEd.value = ""
    apellidoMaternoEd.value = ""
    fechaNacimientoEd.value = ""
    generoEd.value = "0"
    nivelEstudiosEd.value = "0"
    ocupacionEd.value = ""
    fechaIngresoEd.value = ""
    if(rolEd)rolEd.value = ""
    celularEd.value = ""
    telefonoEd.value = ""
    correoEd.value = ""
    calleEd.value = ""
    numeroEd.value = ""
    referenciaEd.value = ""
    regionEd.value = "0"
    provinciaEd.value = "0"
    comunaEd.value = "0"
}


export const setPartnerForEdit = async (partner, buttonEdit)=>{
   try {
    enableButtonAnimation(buttonEdit, 'Espere...')
    organizacionEd.value = partner.organizacion
    rolEd.value = partner.rol
    recordId.value = partner.recordId
    rutGuardado.value = partner.rut
    rutEd.value = $.formatRut(partner.rut)
    correoEd.value = partner.correo
    rolActual.value = partner.rol
    primerNombreEd.value = partner.nombreUno
    segundoNombreEd.value = partner.nombreDos
    apellidoPaternoEd.value = partner.apellidoUno
    apellidoMaternoEd.value = partner.apellidoDos
    fechaNacimientoEd.value = partner.fechaNacimiento
    generoEd.value = partner.genero
    ocupacionEd.value = partner.ocupacion
    nivelEstudiosEd.value = partner.nivelEstudios
    fechaIngresoEd.value = partner.fechaIngreso
    celularEd.value = partner.celular
    telefonoEd.value = partner.telefono
    direccionId.value = partner.direccionId
    regionEd.value = partner.regionId

    
    await getProvincias([provinciaEd.id], partner.regionId)
    await getComunas([comunaEd.id], partner.provinciaId)

    provinciaEd.value = partner.provinciaId
    comunaEd.value = partner.comunaId

    calleEd.value = partner.calle
    numeroEd.value = partner.numero
    referenciaEd.value = partner.referencia

    disableButtonAnimation(buttonEdit, 'Editar')
   } catch (error) {
    disableButtonAnimation(buttonEdit, 'Editar')
    console.log(error)
   }

    $("#editarModal").modal('show')



}