$(document).ready(function() {

    dataTable = $('#table-logs').DataTable();

    $('.select2').select2({ 
        placeholder: "Selecciona una opción",
        width : 'style',
        language: {

            noResults: function() {        
              return "No hay archivos";        
            },
            searching: function() {        
              return "Buscando..";
            }
          }
       });

    reglasAll();   

    $('#table-logs tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = dataTable.row( tr );
 
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

     

 
  

  

























    $('#button').click( function () {
        let data = dataTable.rows('.selected').data();
        if(data.length != 0)
        {
            let reglas_id = [];
            let reglas_nombre = "";
            for(let i = 0; i < data.length; i++){
                reglas_id[i] = data[i].id;
                if (i < data.length-1){
                    reglas_nombre += data[i].regla+", ";
                }
                else{
                    reglas_nombre += data[i].regla;   
                }
            } 
            Swal.fire({
              title: '¿Inactivar estas reglas?',
              html: '<p>'+reglas_nombre+'</p><p>Nota:</p><textarea id="nota" required cols="30" rows="2"> </textarea>',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Inactivar'
            }).then((result) => {
              if (result.value) {
                let nota = document.getElementById('nota').value;
                if (nota.trim() != ""){
                    updateInactivas(JSON.stringify(reglas_id),nota);
                }
                else{
                    Swal.fire('error','Tiene que agregar una nota',"error");
                }
              }
            });
        }
        else{
            Swal.fire('error','Selecciona una o más reglas',"error");       
        }
    } );

});



function reglasAll(){

    dataTable.destroy();

    document.getElementById('titulo').innerHTML = "Todas las reglas";

    dataTable = $('#table-logs').DataTable({
        processing: true,
        serverSide: true,
        scrollX: true,
        dom: "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
        "<'row justify-content-md-center'<'col-sm-12'rt>>" +   
        "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",        
        language: {
            "url": url + "assets/vendors/general/datatables/Spanish.json"
        },
        fnPreDrawCallback: function () {
            // recopila información para redactar un mensaje
       
        },
        "fnDrawCallback": function () {
            // en caso de que tu superposición deba
           
        },
        ajax: {
            "url": dataRegla,
            "type": "GET"
        },
        columns: [
            {
                "className":      '',
                "orderable":      false,
                "data":           null,
                "render": function(data,type,row){                        
                    return  '&nbsp;&nbsp;<label class="kt-checkbox kt-checkbox--tick kt-checkbox--danger"><input type="checkbox" id="eliminar"><span></span></label>';                 
                } 
            },
           {
                "className":      'details-control',
                "orderable":      false,
                "data":           null,
                "defaultContent": ''
            },
            { data: 'servidor', name: 'servidor' },
            { data: 'fecha_converted', name: 'fecha_converted' },
            { data: 'ip_cliente', name: 'ip_cliente' },
            { data: 'url', name: 'url' },

                       {
                "mRender": function (data, type, row) {
                    return '<a class="btn btn-cdmx" onClick="edit_regla_modal(\''+row.id_log+'\');" href="javascript:void(0)">Editar</a>';
                }
            }
        ]
        });
}

function format ( d ) {
    // `d` is the original data object for the row
    
    if(d.ip==null){d.ip="Sin Dato"}
    if(d.mac==null){d.mac="Sin Dato"}
    if(d.nombre_usuario==null){d.nombre_usuario="Sin Dato"}
    if(d.area==null){d.area="Sin Dato"}

    let table = '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
        '<tr>'+
            '<th>ip:</th>'+
            '<td>'+d.ip+'</td>'+
             '<th>MAC Adrress:</th>'+
            '<td>'+d.mac+'</td>'+         
        '</tr>'+
        '<tr>'+
            '<th>Usuario:</th>'+
            '<td>'+d.nombre_usuario+'</td>'+
        '</tr>'+
        '<tr>'+
            '<th>Area:</th>'+
            '<td colspan="5">'+d.area+'</td>'+
        '</tr>'+
    '</table>';

    return table;
}


$('#table-logs tbody').on( 'click', '#eliminar', function () {        
    $(this).closest('tr').toggleClass('selected');
} );


function import_archivos() {   
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url : importfile,
        data: $('#fileslog').serialize(),
        dataType: 'json',
        success: function(resp_success) {          
            if(resp_success.success){
                 Swal.fire('¡Completado!',''+resp_success.mensaje,'success');
                 reglasAll();
            }else{
                Swal.fire('¡Alertaa!',''+resp_success.mensaje,'warning');
            }
 
           

          
        },
        error: function(respuesta) {
            Swal.fire('¡Alerta!','Error al insertar EIPA0001','warning');
        }
    });
  }
 
function importar(){
    let archivo = document.getElementById('archivo').value;
    if(archivo != ""){
        $('#import').attr('disabled','disabled');
        $('#cancel').attr('disabled','disabled');
        $('#import').addClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light');
        $('#frm_import_regla').submit();
    }
}

























$(document).on('focus', '#regla', function () {
    let list = [];
    $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: dataRegla,
            dataType: 'json',
            contentType: 'application/json; charset=utf-8',
            merhod: 'GET',
            success: function(data){
                for(let i in data.data){
                    list[i] = data.data[i].regla;
                }
            },
            error: function(data){
            }
        });

  $(this).autocomplete({
      //source take a list of data
      source: list,
      minLength: 3//min = 2 characters
  });
});

function reglaEstado(estado){

    dataTable.destroy();

    document.getElementById('titulo').innerHTML = "Reglas "+ estado;
    if(estado == "Inactiva"){
        $('#inactivas').css('display','none');
    }else {
        $('#inactivas').css('display','block');
    }

    let check = "";
    if(estado == "Activa" || estado == "Pendiente" ){
        check = '<label class="kt-checkbox kt-checkbox--tick kt-checkbox--danger"><input type="checkbox" id="eliminar"><span></span></label>';
    }

     dataTable = $('#table-logs').DataTable({
        processing: true,
        serverSide: false,
        scrollX: true,
        dom: "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
        "<'row justify-content-md-center'<'col-sm-12't>>" +
        "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",        
        language: {
            "url": url + "assets/vendors/general/datatables/Spanish.json"
        },
        ajax: {
            "url": reglasEstado+'/'+estado,
            "type": "GET"
        },
        columns: [
            {
                "className":      '',
                "orderable":      false,
                "data":           null,
                "defaultContent": check
            },
           {
                "className":      'details-control',
                "orderable":      false,
                "data":           null,
                "defaultContent": ''
            },
            { data: 'regla', name: 'regla' },
            { data: 'accion', name: 'accion' },
            { data: 'direccion', name: 'direccion' },
            { data: 'tipo_correo', name: 'tipo_correo' },
            { "mRender": function(data, type, row){
                return row.descripcion.substring(0,20);
            }  },
            {
                "mRender": function (data, type, row) {
                    return '<a class="btn btn-cdmx" onClick="edit_regla_modal(\''+row.id+'\');" href="javascript:void(0)">Editar</a>';
                }
            }
        ]
        });
}


// Mostrar modal para alta de reglas
function add_regla_modal() {
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url : reglaCreate,
        dataType: 'html',
        success: function(resp_success) {
            var modal = resp_success;
            $(modal).modal().on('shown.bs.modal', function() {
                $("[class='make-switch']").bootstrapSwitch('animate', true);
                $('.select2').select2({dropdownParent: $("#mod_add_regla")});
            }).on('hidden.bs.modal', function() {
                $(this).remove();
            });
        },
        error: function(respuesta) {
            Swal.fire('¡Alerta!','Error de conectividad de red USR-01','warning');
        }
    });
}
// Guardar nuevas reglas
function save_regla_create() {
    if(!formValidate('#frm_nueva_regla')){ return false; };
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url : reglaStore,
        type: 'POST',
        data: $("#frm_nueva_regla").serialize(),
        dataType: 'json',
        success: function(respuesta) {
            if (respuesta.success == true) {
                $('#mod_add_regla').modal('hide').on('hidden.bs.modal', function() {
                    Swal.fire("Proceso  correcto!", respuesta.message,"success");
                    $('#table-logs').DataTable().ajax.reload();
                });
            } else {
                Swal.fire('error', respuesta.message,"error")
                $('button.swal2-confirm').on('click',function() {
                    document.getElementById('regla').value = "";  
                });
            }
        },
        error: function(xhr) {
         //   var message = getErrorAjax(xhr, 'Error de conectividad de red USR-02.');
         Swal.fire('¡Alerta!', xhr, 'warning');

        }
    });
}

// Mostrar modal para edición de regla
function edit_regla_modal(data) {
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url : url +"admin/reglas/"+data+"/edit",
        dataType: 'html',
        success: function(resp_success) {
            var modal = resp_success;
            $(modal).modal().on('shown.bs.modal', function() {
                $("[class='make-switch']").bootstrapSwitch('animate', true);
                $('.select2').select2({dropdownParent: $("#mod_edit_regla")});
            }).on('hidden.bs.modal', function() {
                $(this).remove();
            });
        },
        error: function(respuesta) {
            Swal.fire('¡Alerta!','Error de conectividad de red USR-03','warning');
        }
    });
}

function edit_regla() {
    let id = document.getElementById("id_regla").value;
    if(!formValidate('#editar_regla')){ return false; }
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url : url+"admin/reglas/"+id,
        type: 'PUT',
        data: $("#editar_regla").serialize(),
        dataType: 'json',
        success: function(respuesta) {
            if (respuesta.success == true) {
                $('#mod_edit_regla').modal('hide').on('hidden.bs.modal', function() {
                    Swal.fire("Proceso  correcto!", respuesta.message,"success");
                    $('#table-logs').DataTable().ajax.reload();
                });
            }else {
                Swal.fire('error', respuesta.message,"error");
            }
        },
        error: function(respuesta) {
            Swal.fire('¡Alerta!','Error de conectividad de red USR-04','warning');
        }
     });
}

function updateInactivas(reglas_id, nota){
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url : updateInactiva,
        type: 'POST',
        data: {ids : reglas_id, nota: nota},
        dataType: 'json',
        success: function(respuesta) {
           if (respuesta.success == true) {
                Swal.fire("Proceso  correcto!", respuesta.message,"success");
                $('#table-logs').DataTable().ajax.reload();
            } else {
                Swal.fire('error', respuesta.message,"error");
            }
        },
        error: function(respuesta) {
            Swal.fire('¡Alerta!','Error de conectividad de red USR-04','warning');
        }
     });
}


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

function import_regla_modal() {
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url : importView,
        dataType: 'html',
        success: function(resp_success) {
            var modal = resp_success;
            $(modal).modal().on('shown.bs.modal', function() {
                $("[class='make-switch']").bootstrapSwitch('animate', true);
                $('.select2').select2({dropdownParent: $("#mod_add_regla")});
            }).on('hidden.bs.modal', function() {
                $(this).remove();
            });
        },
        error: function(respuesta) {
            Swal.fire('¡Alerta!','Error de conectividad de red USR-01','warning');
        }
    });
}

