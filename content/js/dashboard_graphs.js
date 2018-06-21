var div_canvas_solicitantes = null;
var chart_solicitantes = null;

var div_canvas_solicitudes = null;
var chart_solicitudes = null;

var div_canvas_retrabajos = null;
var chart_retrabajos = null;

var div_canvas_prospecion = null;
var chart_prospeccion = null;

var div_canvas_css_reworks = null;
var chart_csc_reworks = null;

var now_solicitantes = null;
var chart_now_solicitantes = null;

var now_solicitudes = null;
var chart_now_solicitudes = null;

var now_retrabajosc = null;
var chart_now_retrabajos = null;

var now_atencion_csc = null;
var chart_now_atencion_csc = null;

function initialize_charts(){

    now_solicitantes = document.getElementById('now_solicitantes').getContext('2d');
    chart_now_solicitantes = new Chart(now_solicitantes,{
        type: 'doughnut',
        data:{
            datasets:[{
                data:[50,50],
                borderColor: [
                    'rgba(0,204,102,1)', 
                    'rgba(255,102,102,1)'
                ],
                backgroundColor: [
                    'rgba(0,204,102,1)', 
                    'rgba(255,102,102,1)'
                ],
            }],
            labels:['Dispositivo', 'Papel']
        },
        options:{
            cutoutPercentage: 50,
            animation: {
                animateScale: true,
                animateRotate: true
            },
            title: {
                display: true,
                text: 'SOLICITANTES (ACTUAL)'
            },
        }
    });

    now_solicitudes = document.getElementById('now_solicitudes').getContext('2d');
    chart_now_solicitudes = new Chart(now_solicitudes,{
        type: 'doughnut',
        data:{
            datasets:[{
                data:[50,30,20],
                borderColor: [
                    'rgba(0,204,102,1)', 
                    'rgba(255,178,102,1)',
                    'rgba(255,102,102,1)'
                ],
                backgroundColor: [
                    'rgba(0,204,102,1)',
                    'rgba(255,178,102,1)', 
                    'rgba(255,102,102,1)'
                ],
            }],
            labels:['Dispositivo', 'Hibrido', 'Papel']
        },
        options:{
            cutoutPercentage: 50,
            animation: {
                animateScale: true,
                animateRotate: true
            },
            title: {
                display: true,
                text: 'SOLICITUDES (ACTUAL)'
            },
        }
    });

    now_retrabajos = document.getElementById('now_retrabajos').getContext('2d');
    chart_now_retrabajos = new Chart(now_retrabajos,{
        type: 'doughnut',
        data:{
            datasets:[{
                data:[50,50],
                borderColor: [
                    'rgba(0,204,102,1)', 
                    'rgba(255,102,102,1)'
                ],
                backgroundColor: [
                    'rgba(0,204,102,1)', 
                    'rgba(255,102,102,1)'
                ],
            }],
            labels:['Aceptados', 'Retrabajo']
        },
        options:{
            cutoutPercentage: 50,
            animation: {
                animateScale: true,
                animateRotate: true
            },
            title: {
                display: true,
                text: 'RETABAJOS (ACTUAL)'
            },
        }
    });

    now_atencion_csc = document.getElementById('now_atencion_csc').getContext('2d');
    chart_now_atencion_csc = new Chart(now_atencion_csc,{
        type: 'doughnut',
        data:{
            datasets:[{
                data:[50,30,20],
                borderColor: [
                    'rgba(0,204,102,1)', 
                    'rgba(255,178,102,1)',
                    'rgba(255,102,102,1)'
                ],
                backgroundColor: [
                    'rgba(0,204,102,1)',
                    'rgba(255,178,102,1)', 
                    'rgba(255,102,102,1)'
                ],
            }],
            labels:['Aprobados', 'Incidencia', 'Rechazados']
        },
        options:{
            cutoutPercentage: 50,
            animation: {
                animateScale: true,
                animateRotate: true
            },
            title: {
                display: true,
                text: 'NIVEL DE RECHAZOS (ACTUAL)'
            },
        }
    });

    div_canvas_solicitantes = document.getElementById('div_canvas_solicitantes').getContext('2d');
    chart_solicitantes = new Chart(div_canvas_solicitantes, {
        type: 'line',
        data: {
            datasets:[{
                label: 'Papel',
                type: 'line',
                borderWidth: 1,
                borderColor: 'rgba(255,102,102,1)',
                backgroundColor: 'rgba(255,102,102,1)',
                fill: false
            },{
                label: 'Dispositivo',
                type: 'line',
                borderWidth: 1,
                borderColor: 'rgba(0,204,102,1)',
                backgroundColor: 'rgba(0,204,102,1)',
                fill: false
            }],
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        min: 0,
                        max: 100
                    }
                }]
            },
            title: {
                display: true,
                text: 'SOLICITANTES'
            },
            tooltipTemplate: "<%if (label){%><%=label %>: <%}%><%= value + ' %' %>",
            multiTooltipTemplate: "<%= value + ' %' %>",
            cutoutPercentage: true
        }
    });

    div_canvas_solicitudes = document.getElementById('div_canvas_solicitudes').getContext('2d');
    chart_solicitudes = new Chart(div_canvas_solicitudes, {
        type: 'line',
        label: 'Solicitudes',
        data:{
            datasets:[{
                label: 'Papel',
                type: 'line',
                borderWidth: 1,
                borderColor: 'rgba(255,102,102,1)',
                backgroundColor: 'rgba(255,102,102,1)',
                fill: false
            },{
                label: 'Hibrido',
                type: 'line',
                borderWidth: 1,
                borderColor: 'rgba(255,178,102,1)',
                backgroundColor: 'rgba(255,178,102,1)',
                fill: false
            },{
                label: 'DM',
                type: 'line',
                borderWidth: 1,
                borderColor: 'rgba(0,204,102,1)',
                backgroundColor: 'rgba(0,204,102,1)',
                fill: false
            }],
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        min: 0,
                        max: 100
                    }
                }]
            },
            title: {
                display: true,
                text: 'SOLICITUDES'
            },
        }
    });

    div_canvas_retrabajos = document.getElementById('div_canvas_retrabajos').getContext('2d');
    chart_retrabajos = new Chart(div_canvas_retrabajos, {
        type: 'line',
        label: 'Solicitantes', 
        data: {
            datasets:[{
                label: 'Ideal',
                type: 'line',
                borderWidth: 1,
                borderColor: 'rgba(255,178,102,1)',
                backgroundColor: 'rgba(255,178,102,1)',
                fill: false
            },{
                label: 'Retrabajos',
                type: 'line',
                borderWidth: 1,
                borderColor: 'rgba(0,204,102,1)',
                backgroundColor: 'rgba(0,204,102,1)',
                fill: false
            }],
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        min: 0.5,
                        max: 2.2
                    }
                }]
            },
            title: {
                display: true,
                text: 'RETRABAJOS'
            },
        }
    });

    div_canvas_prospecion = document.getElementById('div_canvas_prospecion').getContext('2d');
    chart_prospeccion = new Chart(div_canvas_prospecion, {
        type: 'line',
        data: {
            datasets:[{
                label: 'Prospectos',
                type: 'line',
                borderWidth: 1,
                borderColor: 'rgba(255,102,102,1)',
                backgroundColor: 'rgba(255,102,102,1)',
                fill: false
            },{
                label: 'Clientes',
                type: 'line',
                borderWidth: 1,
                borderColor: 'rgba(0,204,102,1)',
                backgroundColor: 'rgba(0,204,102,1)',
                fill: false
            }],
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        min: 0,
                        max: 100
                    }
                }]
            },
            title: {
                display: true,
                text: 'PROSPECCIÓN'
            },
            tooltipTemplate: "<%if (label){%><%=label %>: <%}%><%= value + ' %' %>",
            multiTooltipTemplate: "<%= value + ' %' %>",
            cutoutPercentage: true
        }
    });

    div_canvas_csc_reworks = document.getElementById('div_canvas_csc_reworks').getContext('2d');
    chart_csc_reworks = new Chart(div_canvas_csc_reworks, {
        type: 'line',
        data: {
            datasets:[{
                label: 'Aceptados',
                type: 'line',
                borderWidth: 1,
                borderColor: 'rgba(0,204,102,1)',
                backgroundColor: 'rgba(0,204,102,1)',
                fill: false
            },{
                label: 'Rechazados',
                type: 'line',
                borderWidth: 1,
                borderColor: 'rgba(255,102,102,1)',
                backgroundColor: 'rgba(255,102,102,1)',
                fill: false
            },{
                label: 'Incidentes',
                type: 'line',
                borderWidth: 1,
                borderColor: 'rgba(255,178,102,1)',
                backgroundColor: 'rgba(255,178,102,1)',
                fill: false
            }],
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        min: 0,
                        max: 100
                    }
                }]
            },
            title: {
                display: true,
                text: 'NIVEL RETRABAJOS'
            },
            cutoutPercentage: true
        }
    });
    
}

function update_indicators(year_consult, type_report, index_consult){
    var element_solicitantes_labels = [];
    var element_solicitantes_dispositivo = [];
    var element_solicitantes_papel = [];

    var element_solicitudes_labels = [];
    var element_solicitudes_DM = [];
    var element_solicitudes_Hibridos = [];
    var element_solicitudes_Papel = [];

    var element_retrabajos_labels = [];
    var element_retrabajos_ideal = [];
    var element_retrabajos_retrabajos = [];

    var element_prospeccion_labels = [];
    var element_prospeccion_prospectos = [];
    var element_prospeccion_clientes = [];

    var element_csc_reworks_labels = [];
    var element_csc_reworks_accept = [];
    var element_csc_reworks_incident = [];
    var element_csc_reworks_rework = [];

    var element_now_solicitantes_data = [];
    $.ajax({
      type: 'POST',
      dataType: 'json',
      data:{
        'year': year_consult,
        'type_index': type_report,
        'index_consult': index_consult
      },
      url: '../../web_services/web/indicators/web_get_indicators_json.php',
      success: function(data){
        if(data.result = true){
    
            $.each(data.data.applicants, function(index, value){
                element_solicitantes_labels[index] =  value.Month; 
                element_solicitantes_dispositivo[index] = value.DM;
                element_solicitantes_papel[index] = value.Papel;
            });

            $.each(data.data.requests, function(index, value){
                element_solicitudes_labels[index] = value.Month;
                element_solicitudes_DM[index] = value.DM ;
                element_solicitudes_Hibridos[index] = value.DM_OS;
                element_solicitudes_Papel[index] = value.Papel;
            });

            $.each(data.data.reworks, function(index, value){
                element_retrabajos_labels[index] = value.Month;
                element_retrabajos_ideal[index] = 1.2;
                element_retrabajos_retrabajos[index]= value.value;
            });

            $.each(data.data.csc_reworks, function(index, value){
                element_csc_reworks_labels[index] = value.Month;
                element_csc_reworks_accept[index] = value.Aprobados;
                element_csc_reworks_incident[index] = value.Incidencia;
                element_csc_reworks_rework[index] = value.Recuperaciones;
            });

            $.each(data.data.now_solicitantes, function(index, value){
                element_now_solicitantes_data[0] = value.DM;
                element_now_solicitantes_data[1] = value.Papel;
            });

          chart_solicitantes.data.labels = element_solicitantes_labels;
          chart_solicitantes.data.datasets[0].data = element_solicitantes_dispositivo;
          chart_solicitantes.data.datasets[1].data = element_solicitantes_papel;

          chart_solicitudes.data.labels = element_solicitudes_labels;
          chart_solicitudes.data.datasets[0].data = element_solicitudes_Papel;
          chart_solicitudes.data.datasets[1].data = element_solicitudes_Hibridos;
          chart_solicitudes.data.datasets[2].data = element_solicitudes_DM;

          chart_retrabajos.data.labels = element_retrabajos_labels;
          chart_retrabajos.data.datasets[0].data = element_retrabajos_ideal;
          chart_retrabajos.data.datasets[1].data = element_retrabajos_retrabajos;

          chart_csc_reworks.data.labels = element_csc_reworks_labels;
          chart_csc_reworks.data.datasets[0].data = element_csc_reworks_accept;
          chart_csc_reworks.data.datasets[1].data = element_csc_reworks_rework;
          chart_csc_reworks.data.datasets[2].data = element_csc_reworks_incident;

          chart_now_solicitantes.data.datasets[0].data = element_now_solicitantes_data;

          chart_solicitantes.update();
          chart_solicitudes.update();
          chart_retrabajos.update();
          chart_csc_reworks.update();
          chart_now_solicitantes.update();
  
        }else{
          alert('Error');
        }
      },
      error:function(data){
        alert(data);
      }
    });
}
