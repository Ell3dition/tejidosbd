// datos personales

import { getComunas, getProvincias, getRegiones } from "../../helpers/funtions.js"

const rutN = document.querySelector('#rutN')
const primerNombreN = document.querySelector('#primerNombreN')
const segundoNombreN = document.querySelector('#segundoNombreN')
const apellidoPaternoN = document.querySelector('#apellidoPaternoN')
const apellidoMaternoN = document.querySelector('#apellidoMaternoN')
const fechaNacimientoN = document.querySelector('#fechaNacimientoN')
const ocupacionN = document.querySelector('#ocupacionN')
const fechaIngresoN = document.querySelector('#fechaIngresoN')
const rolN = document.querySelector('#rolN')
const generoN = document.querySelector('#generoN')
const nivelEstudiosN = document.querySelector('#nivelEstudiosN')

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


export const initSaverPartner = ()=>{

    $(`input#${rutN.id}`).rut({
        formatOn: 'keyup',
        minimumLength: 8, // validar largo mínimo; default: 2
        validateOn: 'change' // si no se quiere validar, pasar null
    });


    getRegiones([regionN.id])



}

regionN.addEventListener('change', ()=>getProvincias([provinciaN.id], regionN.value))
provinciaN.addEventListener('change', ()=>getComunas([comunaN.id], provinciaN.value))

