import { cleanDataTable, createDataTable, formatRut, getEducationalLevel, getOrganizationForSelect, getRegiones } from "../../helpers/funtions.js";
import { deletePartner } from "./deletePartner.js";
import { detailPartner } from "./detailPartner.js";
import { setPartnerForEdit } from "./editPartner.js";
import { initSaverPartner } from "./savePartner.js";

const partnersTable = document.querySelector("#table-partners")

const initPartnerModule = async ()=>{

    const regionN = document.querySelector('#regionN')
    const nivelEstudiosN = document.querySelector('#nivelEstudiosN')
    const organizacionN = document.querySelector('#organizacionN') ?? ''
    // FORM EDIT
    const nivelEstudiosEd = document.querySelector('#nivelEstudiosEd')
    const organizacionEd = document.querySelector('#organizacionEd') ?? ''
    const regionEd = document.querySelector('#regionEd')


    const listPartner = await getListPartners();
    renderTable(listPartner)
    initSaverPartner()
    
    formatRut(['rutEd', 'rutN'])
    getRegiones([regionN.id, regionEd.id])
    getEducationalLevel([nivelEstudiosN.id, nivelEstudiosEd.id])
    organizacionN && getOrganizationForSelect([organizacionN.id, organizacionEd.id])
}

document.addEventListener('DOMContentLoaded', initPartnerModule)

document.addEventListener('click', (event) => {
    const button = event.target
    if (String(event.target.classList).includes('edit')) {
        const partner = event.target.dataset.partner
        setPartnerForEdit(JSON.parse(partner) , button)
    } else if (String(event.target.classList).includes('delete')) {
        const partnerId = event.target.dataset.id
        deletePartner(partnerId, button)
    }else if ( String(event.target.classList).includes('detail') ) {
        const partnerId = event.target.dataset.id
        detailPartner(partnerId)

    }
})

export const getListPartners = async () => {

    const url = "Controllers/partners/partnersC.php";
    const response = await fetch(url, {
        method: "POST",
        body: new URLSearchParams({ action: 'getPartners' })
    })
    const data = response.json();
    return data

}

export const renderTable = (listPartner) => {
    const { data, rol } = listPartner
    cleanDataTable(partnersTable.id)
    const tbody = partnersTable.querySelector("tbody")

    const listTr = [];
    data.forEach((element, index) => {
        const tr = document.createElement('tr')
        tr.classList.add(element.rol === 'Coordinador' ? 'table-info' : 'table-light')
        tr.innerHTML = `
        <td>${index + 1}</td>
        <td>${$.formatRut(element.rut)}</td>
        <td>${element.namePartner}</td>
        <td>${element.correo}</td>
        <td>${element.address}</td>
        ${addTdAdministrador(rol,element)}
        <td> 
            <button class="btn btn-sm btn-warning edit" data-partner='${JSON.stringify(element)}' type="button">Editar</button>
            <button class="btn btn-sm btn-danger delete" data-id=${element.rut} type="button">Eliminar</button>
          <!--  <button class="btn btn-sm btn-primary detail" data-id=${element.rut} type="button">Ver Ficha</button> -->
        </td>`

        listTr.push(tr)
    });
    tbody.append(...listTr)
    createDataTable(partnersTable.id, null, 'Lista de socios')
}

const addTdAdministrador = (rol,element)=>{
    return rol === 'Administrador' ? `<td>${element.nombreOrganizacion}</td>` : ''   
}