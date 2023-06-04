import { executeChart } from "./charts.js"

document.addEventListener('DOMContentLoaded', () => {
    executeChart()
    renderPartnerByOrganitation()
    renderGenreTable()
    renderAreaRanteTable()
})


const renderPartnerByOrganitation = async()=>{

    const url='Controllers/home/homeC.php'
    const response = await fetch(url, {
      method:'POST',
      body: new URLSearchParams({action:'getNumberOfPeopleByOrganization'})
    })
    const dataResponse = await response.json();
    console.log(dataResponse)
    const tbody = document.querySelector("#tbody-partenerByOrganitations")
    tbody.innerHTML = '';

    const listTrs = []
    dataResponse.data.forEach((item, index) => {
        const tr = document.createElement('tr')
        tr.innerHTML = `
        <td>${item.organitationName}</td>
        <td>${item.amountOfPeople}</td>
        `;
        listTrs.push(tr)
    });
    tbody.append(...listTrs)
}


const renderGenreTable = async()=>{
    const url='Controllers/home/homeC.php'
    const response = await fetch(url, {
      method:'POST',
      body: new URLSearchParams({action:'getDataGenres'})
    })
    const dataResponse = await response.json();
    const tbody = document.querySelector("#tbody-genres")
    tbody.innerHTML = '';

    const listTrs = []
    Object.keys(dataResponse.data).forEach((genre, index) => {
        const tr = document.createElement('tr')
        tr.innerHTML = `
        <td>${genre}</td>
        <td>${dataResponse.data[genre]}</td>
        `;
        listTrs.push(tr)
    });
    tbody.append(...listTrs)
}

const renderAreaRanteTable = async()=>{
    const url='Controllers/home/homeC.php'
    const response = await fetch(url, {
      method:'POST',
      body: new URLSearchParams({action:'getAgeRange'})
    })
    const dataResponse = await response.json();
    const tbody = document.querySelector("#tbody-AgeRange")
    tbody.innerHTML = '';

    const listTrs = []
    dataResponse.data.forEach((item, index) => {
        const tr = document.createElement('tr')
        tr.innerHTML = `
        <td>${item.ageRange}</td>
        <td>${item.amountOfPeople}</td>
        `;
        listTrs.push(tr)
    });
    tbody.append(...listTrs)
}