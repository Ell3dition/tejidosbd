export const executeChart = async() => {
    const url='Controllers/home/homeC.php'
    const response = await fetch(url, {
      method:'POST',
      body: new URLSearchParams({action:'getDataChart'})
    })

    const dataResponse = await response.json();
    const grafico = document.querySelector('#myChart');

    const data = {
      datasets: [
          {
            label: 'Organizaciones',
            data: [
                { x: "Organizaciones", y: String(dataResponse.data.numberOfOrganizations )}],
            backgroundColor: 'green'
          },
          {
            label: 'Socios',
            data:[
              { x: "Socios", y: String(dataResponse.data.numberOfPartners) },
            ],
            backgroundColor: 'blue',
          }
      ],

    };

    const config = {
        type: 'bar', //pie, line, bar, scatter, doughnut
        data: data,
        options: {
          responsive: true,
          plugins: {
              datalabels: {
                  color: '#36A2EB'
              }
          },
          legend: {
              position: 'top',
              backgroundColor: 'rgba(255, 255, 255, 0.7)',
          },
      },
    };

    new Chart(grafico, config);

}