export const executeChart = () => {

    const grafico = document.querySelector('#myChart');

    const data = {
        datasets: [
            {
                data: [{ x: "Organizaciones", y: "12" }, { x: "Socios", y: "120" }],
                backgroundColor: ["green", "blue"],
            },
        ],

    };

    const config = {
        type: 'bar', //pie, line, bar, scatter, doughnut
        data: data,
        options:  {
            plugins: {
              // Change options for ALL labels of THIS CHART
              datalabels: {
                color: '#36A2EB'
              }
            }
          },
    };

    new Chart(grafico, config);

}