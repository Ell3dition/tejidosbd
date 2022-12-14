import { cleanDataTable, createDataTable } from "../../helpers/funtions.js";

const partnersTable = document.querySelector("#table-partners")

document.addEventListener('DOMContentLoaded', async () => {

    const listPartner = await getListPartners();
    renderTable(listPartner)

})

const getListPartners = async () => {

    const url = "Controllers/partners/partnersC.php";
    const response = await fetch(url, {
        method: "POST",
        body: new URLSearchParams({ action: 'getPartners' })
    })
    const data = response.json();
    return data

}


const renderTable = (listPartner) => {
    const { data } = listPartner
    cleanDataTable(partnersTable.id)
    const tbody = partnersTable.querySelector("tbody")

    const listTr = [];
    data.forEach((element, index) => {
        const tr = document.createElement('tr')
        tr.innerHTML = `
        <td>${index + 1}</td>
        <td>${$.formatRut(element.rut)}</td>
        <td>${element.namePartner}</td>
        <td>${element.emailPartner}</td>
        <td>${element.address}</td>
        <td> 
            <button class="btn btn-sm btn-warning edit" data-id=${element.id} type="button">Editar</button>
            <button class="btn btn-sm btn-danger delete" data-id=${element.id} type="button">Eliminar</button>
        </td>`

        listTr.push(tr)
    });
    tbody.append(...listTr)
    createDataTable(partnersTable.id, null, 'Lista de socios')
}