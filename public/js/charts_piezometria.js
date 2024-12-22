
function chart_last_piezometria(id, cota, data)
{
    try{
        data    = data.replaceAll('"', '').split(',');
    }catch(e){
        console.log('Error trying split the data by \"');
    }

    var labels      = [],
        background  = [],
        borders     = [];

    const multipler = 255;

    for (let index = 0; index < data.length; index++) {
        let label   = 'Pcg ' + (index + 1);

        let red     = Math.floor(Math.random() * multipler);
        let green   = Math.floor(Math.random() * multipler);
        let blue    = Math.floor(Math.random() * multipler);

        let bg_val  = 'rgba(' + red + ',' + green + ',' + blue + '0.2)';
        let bd_val  = 'rgba(' + red + ',' + green + ',' + blue + '1)';

        labels.push(label);
        background.push(bg_val);
        borders.push(bd_val);
    }

    const ctx = document.getElementById(id).getContext('2d');
    const myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Cota: ' + cota,
                data: data,
                backgroundColor: background,
                borderColor: borders,
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
}

function chart_piezometria_by_pits(id, data)
{
    var values      = [],
        labels      = [],
        background  = [],
        borders     = [];

    const multipler = 255;

    for (let index = 0; index < data.length; index++) {
        let value   = data[index].value;
        let label   = data[index].date;

        let red     = Math.floor(Math.random() * multipler);
        let green   = Math.floor(Math.random() * multipler);
        let blue    = Math.floor(Math.random() * multipler);

        let bg_val  = 'rgba(' + red + ',' + green + ',' + blue + '0.2)';
        let bd_val  = 'rgba(' + red + ',' + green + ',' + blue + '1)';

        values.push(value);
        labels.push(label);
        background.push(bg_val);
        borders.push(bd_val);
    }

    const ctx = document.getElementById(id).getContext('2d');
    const myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label:              'Label',
                data:               values,
                backgroundColor:    background,
                borderColor:        borders,
                borderWidth:        1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            },
            legend: {
                display: false
            },
            tooltips: {
                callbacks: {
                  label: function(tooltipItem) {
                console.log(tooltipItem)
                    return tooltipItem.yLabel;
                }
              }
            }
        }
    });
}