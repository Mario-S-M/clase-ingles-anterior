"use strict";

// Class definition
var KTDashboard = function() {

    var estatusReglas = function() {        
        if (!KTUtil.getByID('estatus_reglas')) {
            return;
        }

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: url+'admin/regla/grafica_estatus/',
            dataType: 'json',
            contentType: 'application/json; charset=utf-8',
            merhod: 'GET',
            success: function(data){
                let total = 0;
                let activas = 0;
                let inactivas = 0;
                let pendientes = 0;
                for(let i in data){
                    total += data[i].total;
                    activas += data[i].activas;
                    inactivas += data[i].inactivas;
                    pendientes += data[i].pendientes;
                }
                document.getElementById('total').innerHTML = total;
                document.getElementById('etiquetas_estatus').innerHTML = '<div class="kt-widget14__legend">'
                                    +'<span class="kt-widget14__bullet kt-bg-success"></span>'
                                    +'<span class="kt-widget14__stats"><a href="'+url+'admin/regla/Activa">'+activas+' Activas</a></span>'
                                    +'</div>'
                                    +'<div class="kt-widget14__legend">'
                                    +'<span class="kt-widget14__bullet kt-bg-warning"></span>'
                                    +'<span class="kt-widget14__stats"><a href="'+url+'admin/regla/Pendiente">'+pendientes+' Pendiente</span></a>'
                                    +'</div>'
                                    +'<div class="kt-widget14__legend">'
                                    +'<span class="kt-widget14__bullet kt-bg-danger"></span>'
                                    +'<span class="kt-widget14__stats"><a href="'+url+'admin/regla/Inactiva">'+inactivas+' Inactivas</span></a>'
                                    +'</div>';

                var config = {
                    type: 'doughnut',
                    data: {
                        datasets: [{
                            data: [
                                activas, pendientes, inactivas
                            ],
                            backgroundColor: [
                                KTApp.getStateColor('success'),
                                KTApp.getStateColor('warning'),
                                KTApp.getStateColor('danger')
                            ]
                        }],
                        labels: [
                            'Activas',
                            'Pendientes',
                            'Inactivas'
                        ]
                    },
                    options: {
                        cutoutPercentage: 75,  //ancho de las lineas
                        responsive: true,
                        maintainAspectRatio: false,
                        legend: {
                            display: false,  //etiquetas 
                            position: 'top',
                        },
                        animation: {
                            animateScale: true,
                            animateRotate: true
                        },
                        tooltips: {
                            enabled: true,
                            intersect: false,
                            mode: 'nearest',
                            bodySpacing: 5,
                            yPadding: 10,
                            xPadding: 10, 
                            caretPadding: 0,
                            displayColors: false,
                            backgroundColor: KTApp.getStateColor('brand'),
                            titleFontColor: '#ffffff', 
                            cornerRadius: 4,
                            footerSpacing: 0,
                            titleSpacing: 0
                        }
                    }
                };

                var ctx = KTUtil.getByID('estatus_reglas').getContext('2d');
                var myDoughnut = new Chart(ctx, config);
            },
            error: function(data){
                document.getElementById('total').innerHTML = "Error al cargar la regla";
            }
        })
    }

  

    return {
        // Init demos
        init: function() {
            // init charts
            estatusReglas();
     
            
            // demo loading
            var loading = new KTDialog({'type': 'loader', 'placement': 'top center', 'message': 'Loading ...'});
            loading.show();

            setTimeout(function() {
                loading.hide();
            }, 3000);
        }
    };
}();



