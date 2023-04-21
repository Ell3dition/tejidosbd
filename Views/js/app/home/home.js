import { executeChart } from "./charts.js"

document.addEventListener('DOMContentLoaded', () => {
    executeChart()
    executeGenreTable()
})



const executeGenreTable = async()=>{
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