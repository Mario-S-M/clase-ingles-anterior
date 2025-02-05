var tablaNivles = "";
const formCrearEditarEmpleados = $("#frm_nuevo_editar_empleados");
var validatorformCrearEditarEmpleados = ""
$(document).ready(function() {
   


    listarEMpleadosTable();
});


function listarEMpleadosTable(){

   tablaNivles = $('#table-niveles').dataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        language: {
            "url": url + "assets/vendors/general/datatables/Spanish.json"
        },
        ajax: {
            "url": url + "cursos/niveles-data",
            "data": function (data) {
                /*data.dispositivo = $('#dispositivo').val(),
                data.area =        $('#area').val(), 
                data.switch =      $('#switch').val(), 
                data.privilegio =  $('#privilegio').val(),*/
               
            },
            complete: function (data) {
                //$("#btn_spiner_filtro").removeClass("spinner-border spinner-border-sm").addClass("fas fa-search");
                //$(".btn-find").attr("disabled", false);
            },
        },
        
        type: "GET",
        columns: [
          
           
            {
                data: 'nombre_nivel',
                name: 'nombre_nivel'
            }, 
            {
                "mRender": function(data, type, row) {


                    var id_nivel_ingles = row.id_nivel_ingles;


                    let button = "";
                    
                    if(  isSuperAdmin == "1"){
                        button+='<button class="btn btn-cdmx btn-sm  btn-pill" onClick="edit_leccion_modal(' + id_nivel_ingles + ');" href="javascript:void(0)" name="btn_in_spiner-'+id_nivel_ingles+'">Editar </button>';
    
                        
                    
                        button+='<button class="btn btn-danger btn-sm  btn-pill" onClick="eliminar(' + id_nivel_ingles + ');" href="javascript:void(0)" name="btn_in_spiner-'+id_nivel_ingles+'">Eliminar </button>';
                    
                    } 
                  
                    button+='<button class="btn btn-secondary btn-sm  btn-pill" onClick="change_page(' + id_nivel_ingles + ');" href="javascript:void(0)" name="btn_in_spiner-'+id_nivel_ingles+'">Ver Lecciones </button>';
                    
                    return button;
                    }
            }

        ]
    });

   /* $('#asignacionips-table').DataTable().on( 'order.dt search.dt', function () {
        $('#asignacionips-table').DataTable().column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();*/
   
    //CUANDO CARGUE VA LEVANTAR SELECT
    //$('.select-listar').select2();

}

function change_page(id_nivel_ingles){

    let urlNew = url +"cursos/lecciones/"+id_nivel_ingles;
    window.location.href =urlNew; 
}


function add_nivel_modal(){

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: url + "cursos/create-nivel",
        dataType: 'html',
        beforeSend: function() {
        
            $(".btn").attr("disabled", true);
            $("#btn-crear_spiner").removeClass("la la-plus").addClass("spinner-border spinner-border-sm");
        },
        success: function(resp) {
            $(".btn").attr("disabled", false);
            $("#btn-crear_spiner").removeClass("spinner-border spinner-border-sm").addClass("la la-plus");
            try {
                /*SI VIENE LA VISTA ES QUE TODO OK */
               $(resp).modal().on('shown.bs.modal', function() {
                $('.select2').select2({
                    dropdownParent: $("#mod_add_edit_empleados")
                });

                /* var time = $('#hora_entrada').timepicker('showWidget'); */
                $('div[onload]').trigger('onload');
   
               }).on('hidden.bs.modal', function() {
                   $(this).remove();
                   $(".btn").attr("disabled", false);
               });
              
           } catch (e) {
               json = $.parseJSON(resp);
               Swal.fire('error', json.respuesta.msg,"error"); 
           }


        },
        error: function(respuesta) {
            $(".btn").attr("disabled", false);
            $("#btn-crear_spiner").removeClass("spinner-border spinner-border-sm").addClass("la la-plus");
            Swal.fire('¡Alerta!', 'Error de conectividad de red USR-01', 'warning');
        }
    });
}

function edit_leccion_modal(id_nivel_ingles) {

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: url + "cursos/edit-nivel",
        dataType: 'html',
        data: {
            id_nivel_ingles: id_nivel_ingles
        },
        beforeSend: function() {
           
            $(".btn").attr("disabled", true);
            $("#btn-crear_spiner").removeClass("la la-plus").addClass("spinner-border spinner-border-sm");
        },
        success: function(resp) {
            $(".btn").attr("disabled", false);
            $("#btn-crear_spiner").removeClass("spinner-border spinner-border-sm").addClass("la la-plus");
            

            try {
                /*SI VIENE LA VISTA ES QUE TODO OK */
               $(resp).modal().on('shown.bs.modal', function() {
                 
               

                /* var time = $('#hora_entrada').timepicker('showWidget'); */
                $('div[onload]').trigger('onload');
               }).on('hidden.bs.modal', function() {
                   $(this).remove();
                
               });
              
           } catch (e) {
               json = $.parseJSON(resp);
               Swal.fire('error', json.respuesta.msg,"error"); 
           }

          

        },
        error: function(respuesta) {
           
            $(".btn").attr("disabled", false);
            $("#btn-crear_spiner").removeClass("spinner-border spinner-border-sm").addClass("la la-plus");
            Swal.fire('¡Alerta!', 'Error de conectividad de red USR-03', 'warning');
        }
    });
}



/**********************************
EL ENVIO DE INFORMACION PARA GUARDAR 
***********************************/
function save_nivel_create() {


    if (!formValidate('#frm_nuevo_editar_niveles')) {
        return false;
    };
    
    var data = $("#frm_nuevo_editar_niveles").serialize();
   
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: url + "cursos/store-nivel",
        type: 'POST',
        data: data,
        dataType: 'json',
        beforeSend: function() {
            $(".btn_agregar_editar").attr("disabled", true);
            $("#crear_spiner_add_edit").removeClass("la la-plus").addClass("spinner-border spinner-border-sm");
        },
        success: function(resp) {
            
            
            if (resp.success == true) {
                $('#mod_add_edit_nivel').modal('hide').on('hidden.bs.modal', function() {
                    Swal.fire("!Proceso Correcto!",resp.respuesta.msg,"success");
                 tablaNivles.ajax.reload();
                });
            } else {
                Swal.fire('error', resp.respuesta.msg,"error");
            }
        },
        error: function(xhr) {
            //   var message = getErrorAjax(xhr, 'Error de conectividad de red USR-02.');
            Swal.fire('¡Alerta!', xhr, 'warning');
            $(".btn_agregar_editar").attr("disabled", false);
            $("#crear_spiner_add_edit").removeClass("spinner-border spinner-border-sm").addClass("la la-plus");

        }
    });
}




/**********************************
 * EL ENVIO DE INFORMACION PARA EDITAR (DISPOSITIVO)
 ***********************************/
 function edit_nivel() {
  
    if (!formValidate('#frm_nuevo_editar_niveles')) {
        return false;
    };
    
    var data = $("#frm_nuevo_editar_niveles").serialize();

    Swal.fire({
        title: 'Alerta',
        text: "¿Deseas Actulizar el nivel?",
        type: "warning",
        buttons: true,
        dangerMode: true,
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Aceptar!'
    }).then((result) => {
        if (result.value) {

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url + "cursos/store-nivel",
                type: 'POST',
                data: data,
                dataType: 'json',
                beforeSend: function() {
                   
                },
                success: function(resp) {
                   

                    if (resp.success == true) {
                        $('#mod_add_edit_nivel').modal('hide').on('hidden.bs.modal', function() {
                            Swal.fire("!Proceso Correcto!",resp.respuesta.msg,"success");
                            tablaNivles.ajax.reload();
                        });
                    } else {
                        Swal.fire('error', resp.respuesta.msg,"error");
                    }

                },
                error: function(respuesta) {
                    Swal.fire('¡Alerta!', 'Error de conectividad de red USR-04', 'warning');
                    
                }
            });

        }
    });
}





/**********************************
 * ELIMINAR ELEMENTO
 ***********************************/
function eliminar(id) {
  
    Swal.fire({
        title: 'Alerta',
        text: "¿Seguro que quieres eliminar el elemento?",
        type: "warning",
        buttons: true,
        dangerMode: true,
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Aceptar!'
    }).then((result) => {
        if (result.value) {

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url + "cursos/delete-nivel",
                type: 'POST',
                data: {
                    id:id
                },
                dataType: 'json',
                beforeSend: function() {
                    $(".btn").attr("disabled", true);
                    $("#btn-crear_spiner").removeClass("la la-plus").addClass("spinner-border spinner-border-sm");
                },
                success: function(resp) {
                    $(".btn").attr("disabled", false);
                    $("#btn-crear_spiner").removeClass("spinner-border spinner-border-sm").addClass("la la-plus");

                    if (resp.success == true) {
                        
                            Swal.fire("!Proceso Correcto!",resp.respuesta.msg,"success");
                            tablaNivles.ajax.reload();
                       
                    } else {
                        Swal.fire('error', resp.respuesta.msg,"error");
                    }

                },
                error: function(respuesta) {
                    $(".btn").attr("disabled", false);
                    $("#btn-crear_spiner").removeClass("spinner-border spinner-border-sm").addClass("la la-plus");
                    Swal.fire('¡Alerta!', 'Error de conectividad de red USR-04', 'warning');
                    
                }
            });

        }
    });
}





