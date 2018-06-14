var canvas_solicitantes = null;
var canvas_prospectos = null;
var canvas_solicitudes = null;
var canvas_retrabajos = null;
var chart_solicitantes = null;
var chatr_prospectos = null;
var chart_solicitudes = null;
var chart_retrabajos = null;

var canvas_historic_solicitantes = null;
var chart_historic_solicitantes = null;


function init_charts_now(){
    canvas_solicitantes = document.getElementById('canvas_ctx_solicitantes').getContext('2d');
    chart_solicitantes = new Chart(canvas_solicitantes,{
        type: 'doughnut',
        data:{
            labels:['Dispositivo', 'Papel'],
            datasets:[{
                label: 'Solicitantes',
                backgroundColor:[
                    'rgba(51, 250, 250, 0.2)',
                    'rgba(54, 162, 235, 0.2)'
                ],
                borderColor: [
                    'rgb(40, 244, 244, 0.2)',
                    'rgba(49, 166, 229, 0.2)'
                ],
                data:[50,50]
            }]
        },
        options:{
            legend:{
                fontColor:'black'
            },
            title: {
                display: true,
                text: 'Solicitantes'
            }
        }
    });

    canvas_prospectos = document.getElementById('canvas_ctx_prospectos').getContext('2d');
    chatr_prospectos = new Chart(canvas_prospectos,{
        type: 'doughnut',
        data:{
            labels:['% Conversion', '% No exitoso'],
            datasets:[{
                label: 'Solicitantes',
                backgroundColor:[
                    'rgba(51, 250, 250, 0.2)',
                    'rgba(54, 162, 235, 0.2)'
                ],
                borderColor: [
                    'rgb(40, 244, 244, 0.2)',
                    'rgba(49, 166, 229, 0.2)'
                ],
                data:[50,50]
            }]
        },
        options:{
            legend:{
                fontColor:'black'
            },
            title: {
                display: true,
                text: 'Prospectos'
            }
        }
    });

    canvas_solicitudes = document.getElementById('canvas_ctx_solicitudes').getContext('2d');
    chart_solicitudes = new Chart(canvas_solicitudes,{
        type: 'doughnut',
        data:{
            labels:['Dispositivo', 'Hibrido', 'Papel'],
            datasets:[{
                label: 'Solicitantes',
                backgroundColor:[
                    'rgba(51, 250, 250, 0.2)',
                    'rgba(244, 208, 163, 02)',
                    'rgba(54, 162, 235, 0.2)'
                ],
                borderColor: [
                    'rgb(40, 244, 244, 0.2)',
                    'rgba(239, 202, 150, 0.2)',
                    'rgba(49, 166, 229, 0.2)'
                ],
                data:[30,50, 20]
            }]
        },
        options:{
            legend:{
                fontColor:'black'
            },
            title: {
                display: true,
                text: 'Solicitudes'
            }
        }
    });

    canvas_retrabajos = document.getElementById('canvas_ctx_retrabajos').getContext('2d');
    chart_retrabajos = new Chart(canvas_retrabajos,{
        type: 'doughnut',
        data:{
            labels:['% Incremento Retrabajos', 'Vacio'],
            datasets:[{
                label: 'Solicitantes',
                backgroundColor:[
                    'rgba(51, 250, 250, 0.2)',
                    'rgba(54, 162, 235, 0.2)'
                ],
                borderColor: [
                    'rgb(40, 244, 244, 0.2)',
                    'rgba(49, 166, 229, 0.2)'
                ],
                data:[30,70]
            }]
        },
        options:{
            legend:{
                fontColor:'black'
            },
            title: {
                display: true,
                text: 'Retrabajos'
            }
        }
    });


}

function inut_charts_historic(){
    canvas_historic_solicitantes = document.getElementById('canvas_historic_chart').getContext('2d');
    chart_historic_solicitantes = new Chart(canvas_historic_solicitantes, {
        type: 'line',
        data: {
            labels: ['1', '2', '3', '4', '5'],
            datasets: [{
            label: 'A',
            yAxisID: 'A',
            data: [100, 96, 84, 76, 69]
            }, 
            {
                label: 'B',
                yAxisID: 'B',
                data: [1, 1, 1, 1, 0]
            }]
        },
        options: {
            scales: {
            yAxes: [{
                id: 'A',
                type: 'linear',
                position: 'left',
            }, {
                id: 'B',
                type: 'linear',
                position: 'right',
                ticks: {
                max: 1,
                min: 0
                }
            }]
            }
        }
        });
}
