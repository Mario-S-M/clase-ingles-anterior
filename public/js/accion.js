$(document).ready(function() {
    var dataTable = $('#table-accion').DataTable({
        processing: true,
        serverSide: false,
        dom: "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
        "<'row justify-content-md-center'<'col-sm-12't>>" +
        "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",        
        language: {
            "url": url + "assets/vendors/general/datatables/Spanish.json"
        },
        ajax: {
            "url": dataAccion,
            "type": "GET"
        },
        columns: [
            { data: 'nombre', name: 'nombre' },
            {
                "mRender": function (data, type, row) {
                    return '<a class="btn btn-cdmx" onClick="edit_accion_modal(\''+row.id_e+'\');" href="javascript:void(0)">Editar</a>   <a class="btn btn-danger" onClick="delete_accion(\''+row.id_e+'\');" href="javascript:void(0)">Eliminar</a>';
                }
            }
        ]
        });
});

// Mostrar modal para alta de usuario
function add_accion_modal() {
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url : accionCreate,
        dataType: 'html',
        success: function(resp_success) {
            var modal = resp_success;
            $(modal).modal().on('shown.bs.modal', function() {
                $("[class='make-switch']").bootstrapSwitch('animate', true);
                $('.select2').select2({dropdownParent: $("#mod_add_accion")});
            }).on('hidden.bs.modal', function() {
                $(this).remove();
            });
        },
        error: function(respuesta) {
            Swal.fire('¡Alerta!','Error de conectividad de red USR-01','warning');
        }
    });
}
// Guardar nuevo usuario
function save_accion_create() {
    if(!formValidate('#frm_nueva_accion')){ return false; };
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url : accionStore,
        type: 'POST',
        data: $("#frm_nueva_accion").serialize(),
        dataType: 'json',
        success: function(respuesta) {
            if (respuesta.success == true) {
                $('#mod_add_accion').modal('hide').on('hidden.bs.modal', function() {
                    Swal.fire("Proceso  correcto!", respuesta.message,"success");
                    $('#table-accion').DataTable().ajax.reload();
                });
            } else {
                Swal.fire('error', respuesta.message,"error")
                $('button.swal2-confirm').on('click',function() {
                    document.getElementById('nombre_accion').value = "";  
                });
            }
        },
        error: function(xhr) {
         //   var message = getErrorAjax(xhr, 'Error de conectividad de red USR-02.');
         Swal.fire('¡Alerta!', xhr, 'warning');

        }
    });
}

// Mostrar modal para edición de accion
function edit_accion_modal(data) {
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url : url +"admin/cat_accion/"+data+"/edit",
        dataType: 'html',
        success: function(resp_success) {
            var modal = resp_success;
            $(modal).modal().on('shown.bs.modal', function() {
                $("[class='make-switch']").bootstrapSwitch('animate', true);
                $('.select2').select2({dropdownParent: $("#mod_edit_accion")});
            }).on('hidden.bs.modal', function() {
                $(this).remove();
            });
        },
        error: function(respuesta) {
            Swal.fire('¡Alerta!','Error de conectividad de red USR-03','warning');
        }
    });
}

function edit_accion() {
    let id = document.getElementById("id_accion").value;
    if(!formValidate('#editar_accion')){ return false; }
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url : url+"admin/cat_accion/"+id,
        type: 'PUT',
        data: $("#editar_accion").serialize(),
        dataType: 'json',
        success: function(respuesta) {
            if (respuesta.success == true) {
                $('#mod_edit_accion').modal('hide').on('hidden.bs.modal', function() {
                    Swal.fire("Proceso  correcto!", respuesta.message,"success");
                    $('#table-accion').DataTable().ajax.reload();
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


function delete_accion(data) {
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url : url +"admin/cat_accion/"+data,
        type: 'DELETE',
        success: function(respuesta) {
             if (respuesta.success == true) {
                Swal.fire("Proceso  correcto!", respuesta.message,"success");
                $('#table-accion').DataTable().ajax.reload();
            }else {
                Swal.fire('error', respuesta.message,"error");
            }
        },
        error: function(respuesta) {
            Swal.fire('¡Alerta!','Error de conectividad de red USR-03','warning');
        }
    });
}