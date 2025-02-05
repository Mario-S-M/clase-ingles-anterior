$(document).ready(function() {
    var tableLogs = $('#table-logs').DataTable({
        processing: true,
        serverSide: false,
        ordering: false,
        scrollX: true,
        dom: "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
        "<'row justify-content-md-center'<'col-sm-12't>>" +
        "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",        
        language: {
            "url": url + "assets/vendors/general/datatables/Spanish.json"
        },
        ajax: {
            "url": dataLogs,
            "type": "GET"
        },
        columns: [
            { "mRender": function(data, type, row){
                let estatusRegla = "";
                if(row.estatus_regla == 'Activa'){
                    estatusRegla = '<span class="kt-badge kt-badge--success kt-badge--dot"></span>';
                }
                else if (row.estatus_regla == 'Pendiente'){
                    estatusRegla = '<span class="kt-badge kt-badge--warning kt-badge--dot"></span>';
                }
                else{
                    estatusRegla = '<span class="kt-badge kt-badge--danger kt-badge--dot"></span>';
                }
                return estatusRegla;
            }},
            { data: 'regla', name: 'regla' },
            { data: 'accion', name: 'accion' },
            { data: 'estatus', name: 'estatus' },
            { data: 'usuario', name: 'usuario' },
            {
                "className":      'details-control',
                "orderable":      false,
                "data":           null,
                "defaultContent": ''
            }
        ]
    });

    $('#table-logs tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = tableLogs.row( tr );
 
        if ( row.child.isShown() ) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
            // Open this row
            row.child( format(row.data()) ).show();
            tr.addClass('shown');
        }
    } ); 

});

function show_regla(data) {
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url : url+"admin/reglas/"+data,
        dataType: 'html',
        success: function(resp_success) {
            var modal = resp_success;
            $(modal).modal().on('shown.bs.modal', function() {
                $("[class='make-switch']").bootstrapSwitch('animate', true);
                $('.select2').select2({dropdownParent: $("#mod_ver_regla")});
            }).on('hidden.bs.modal', function() {
                $(this).remove();
            });
        },
        error: function(respuesta) {
            Swal.fire('¡Alerta!','Error de conectividad de red USR-01','warning');
        }
    });
}

function format ( d ) {
    // `d` is the original data object for the row
     let estatus_regla = "";
    if(d.estatus_regla == 'Activa'){
        estatus_regla = '<span class="text-success">'+d.estatus_regla+'</span>';
    }
    else if(d.estatus_regla == 'Pendiente'){
        estatus_regla = '<span class="text-warning">'+d.estatus_regla+'</span>';
    }
    else{
        estatus_regla = '<span class="text-danger">'+d.estatus_regla+'</span>';   
    }
    let table = '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
        '<tr>'+
            '<td>Usuario:</td>'+
            '<td>'+d.usuario+'</td>'+
             '<td>Fecha creación:</td>'+
            '<td>'+d.fecha_creacion+'</td>'+
             '<td>Fecha modificación:</td>'+
            '<td>'+d.fecha_modificacion+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>Estatus regla:</td>'+
            '<td>'+estatus_regla+'</td>'+
            '<td>Tipo de correo:</td>'+
            '<td>'+d.tipo_correo+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>Dirección:</td>'+
            '<td colspan="5">'+d.direccion+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>Descripción:</td>'+
            '<td colspan="5">'+d.descripcion+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>Nota Edición:</td>'+
            '<td colspan="5">'+d.nota+'</td>'+
        '</tr>'+
    '</table>';

    return table;
}