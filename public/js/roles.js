$(document).ready(function() {
    $('.rol-table').each(function () {
        $(this).dataTable(window.dtDefaultOptions);
    });    
    var dataTable = $('#rol-table').dataTable({
        processing: true,
        serverSide: true,  
        dom: 'Bfrtip',
        buttons: [
            { extend: 'copyHtml5', className: 'kt-hidden', name: '' },
            { extend: 'excelHtml5', className: 'kt-hidden' },
            { extend: 'csvHtml5', className: 'kt-hidden' },
            { extend: 'pdfHtml5', className: 'kt-hidden', text: 'PDF',
            //orientation: 'landscape'
            },
            { extend: 'print', className: 'kt-hidden', text: 'Imprimir', name: 'print' },
        ],
        language: {
            "url": url + "assets/vendors/general/datatables/Spanish.json"                        
        },      
        ajax: {
            "url": url + "admin/data_listar_roles",
            "type": "GET"
        },
        columns: [
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },                      
            {
                "mRender": function (data, type, row) {
                    var id_rol = row.id;
                    console.log(row);                                        
                    return '<a class="btn btn-primary" onClick="edit_rol_modal('+id_rol+');" href="javascript:void(0)">Editar</a>';
                }
            }
              
        ]
        });
});

// Mostrar modal para alta de usuario
function add_rol_modal() {
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url : url + "roles/create",        
        dataType: 'html',
        success: function(resp_success) {
            var modal = resp_success;
            $(modal).modal().on('shown.bs.modal', function() {
                $("[class='make-switch']").bootstrapSwitch('animate', true);
                $('.select2').select2({dropdownParent: $("#mod_add_user")});
            }).on('hidden.bs.modal', function() {
                $(this).remove();
            });
        },
        error: function(respuesta) {
            swal('¡Alerta!','Error de conectividad de red USR-01','warning');
        }
    });
}
// Guardar nuevo usuario
function save_user_create() {
    if(!formValidate('#frm_nuevo_usuario')){ return false; };
    alert("dfsafads");
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: '../rol/store',     
        type: 'POST',
        data: $("#frm_nuevo_usuario").serialize(),
        dataType: 'json',
        success: function(respuesta) {
            if (respuesta.success == true) {
                $('#mod_add_user').modal('hide').on('hidden.bs.modal', function() {
                    Swal.fire("Proceso  correcto!", "Se  creó  correctamente  el usuario!",
                        "success");
                    $('#rol-table').dataTable().ajax.reload();
                });
            } else {
                showByIdTime('error_usuario_add', respuesta.message);
            }
        },
        error: function(xhr) {
         //   var message = getErrorAjax(xhr, 'Error de conectividad de red USR-02.');
         Swal.fire('¡Alerta!', xhr, 'warning');
            
        }
    });
}

// Mostrar modal para edición de usuario
function edit_user_modal(data) {
    var id=data;

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')           
        },
        url: '../rol/edit',
        dataType: 'html',
        data:{
            id:id
        },
        success: function(resp_success) {
            var modal = resp_success;
            $(modal).modal().on('shown.bs.modal', function() {
                $("[class='make-switch']").bootstrapSwitch('animate', true);
                $('.select2').select2({dropdownParent: $("#mod_edit_user")});
            }).on('hidden.bs.modal', function() {
                $(this).remove();
            });
        },
        error: function(respuesta) {
            swal('¡Alerta!','Error de conectividad de red USR-03','warning');
        }
    });
}

function edit_user() {
    if(!formInputRequired('editar_usuario')){ return false; }
    var password = $('#password').removeClass('has-error').val();
    var password2 = $('#password2').removeClass('has-error').val();
    if (password != password2){
        showElementError('password2','Las contraseñas no son iguales.');
        return false;
    }
    var dataString = ($("#editar_usuario").serialize());
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: '../rol/update',
        type: 'POST',
        data: dataString,
        dataType: 'json',
        success: function(respuesta) {
            if (respuesta.success == true) {
                $('#mod_edit_user').modal('hide').on('hidden.bs.modal', function() {
                    swal("Proceso  correcto!", "Usuario actualizado correctamente!",
                        "success");
                    $('#rol-table').dataTable().ajax.reload();
                });
            } else {
                showByIdTime('message_usuario_edit',respuesta.message);
            }
        },
        error: function(respuesta) {
            swal('¡Alerta!','Error de conectividad de red USR-04','warning');
        }
     });
}

   
