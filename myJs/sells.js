$(document).ready(()=>{

    var ctx = $('#formaDePago');
    var ctp = $('#students');
    var cts=$('#studentsByCourse');


    var myChart = new Chart(ctx, {
        type: 'bar',//'doughnut''pie',
        data: {
            labels: ['Tarjeta', 'Paypal'],
            datasets: [{
                label: 'Total de ingresos',
                data: [50000, 5000],
                backgroundColor: [
                
                    'rgba(255, 99, 132, 0.7)',
                    'rgba(54, 162, 235, 0.7)',
                    
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive:false,
        }
    });

    var myChart = new Chart(ctp, {
        type: 'pie',//'doughnut''pie',
        data: {
            labels: ['Programacion en C++', 'Programación en C#','Programación en MySql','Programación en C'],
            datasets: [{
                label: 'Total de ingresos',
                data: [30, 40,80,90],
                backgroundColor: [
                
                    'rgba(255, 99, 132, 0.4)',
                    'rgba(54, 162, 235, 0.4)',
                    'rgba(54, 50, 140, 0.4)',
                    'rgba(205, 162, 154, 0.4)',
                    
                ],
                borderColor: [
                    'rgba(0, 0, 0, 0)',
               
                 
                ],
                borderWidth: 1
            }]
        },
        
    });
   
    var myChart = new Chart(cts, {
        type: 'pie',//'doughnut''pie',
        data: {
            labels: ['Jose Gon', 'Juan Lopez Junior'],
            datasets: [{
                label: 'Total de ingresos',
                data: [50000, 5000],
                backgroundColor: [
                
                    'rgba(255, 99, 132, 0.7)',
                    'rgba(54, 162, 235, 0.7)',
                    
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive:false,
        }
    });


    $('#courseInfo').click((element)=>{
       
        $('#courseInfo').removeClass('btn-inactive-color');
        $('#courseInfo').addClass('btn-active-color');
        $('#courseLevels').removeClass('btn-active-color');
        $('#courseLevels').addClass('btn-inactive-color');
       
       
    });
    
    $('#courseLevels').click((element)=>{
      
        $('#courseLevels').removeClass('btn-inactive-color');
        $('#courseLevels').addClass('btn-active-color');
        $('#courseInfo').removeClass('btn-active-color');
        $('#courseInfo').addClass('btn-inactive-color');
        
       
    });
});