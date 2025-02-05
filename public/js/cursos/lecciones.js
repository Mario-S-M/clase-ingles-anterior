var tableLecciones = "";
const formCrearEditarEmpleados = $("#frm_nuevo_editar_empleados");
var validatorformCrearEditarEmpleados = ""
$(document).ready(function() {
   


    listarEMpleadosTable();
});


function listarEMpleadosTable(){
   
   tableLecciones = $('#table-lecciones').dataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        language: {
            "url": url + "assets/vendors/general/datatables/Spanish.json"
        },
        ajax: {
            "url": url + "cursos/lecciones-data/"+id,
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
                data: 'titulo_leccion',
                name: 'titulo_leccion'
            },
            
            {
                data: 'descripcion',
                name: 'descripcion'
            },   

            {
                data: 'titulo',
                name: 'titulo'
            },
            
            {
                data: 'link_video_frame',
                name: 'link_video_frame',
             
            },  
            {
                data: 'link_cuestonario',
                name: 'link_cuestonario'
            }, 
            {
                "mRender": function(data, type, row) {
                    var id_leccion = row.id_leccion;
                    let button =  '<button class="btn btn-cdmx btn-sm  btn-pill" onClick="edit_leccion_modal(' + id_leccion + ');" href="javascript:void(0)" name="btn_in_spiner-'+id_leccion+'">Editar </button>';
                     
                    button+='<button class="btn btn-secondary btn-sm  btn-pill" onClick="change_page(' + id_leccion + ');" href="javascript:void(0)" name="btn_in_spiner-'+id_leccion+'">Ver contenidos</button>';
                    
                    
                    button+='<button class="btn btn-danger btn-sm  btn-pill" onClick="eliminar(' + id_leccion + ');" href="javascript:void(0)" name="btn_in_spiner-'+id_leccion+'">Eliminar </button>';
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

function change_page(id_leccion){

    let urlNew = url +"cursos/seccion-pagina/"+id_leccion;
    window.location.href =urlNew; 
}


function add_leccion_modal(){

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: url + "cursos/create-leccion",
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

function edit_leccion_modal(id_leccion) {

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: url + "cursos/edit-leccion",
        dataType: 'html',
        data: {
            id_leccion: id_leccion
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
function save_leccion_create() {


    $("#frm_nuevo_editar_lecciones").append('<input type="hidden" name="enrol_nivel_ingles" id="enrol_nivel_ingles" value="'+id+'">');

    if (!formValidate('#frm_nuevo_editar_lecciones')) {
        return false;
    };
    
    var data = $("#frm_nuevo_editar_lecciones").serialize();
   
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: url + "cursos/store-leccion",
        type: 'POST',
        data: data,
        dataType: 'json',
        beforeSend: function() {
            $(".btn_agregar_editar").attr("disabled", true);
            $("#crear_spiner_add_edit").removeClass("la la-plus").addClass("spinner-border spinner-border-sm");
        },
        success: function(resp) {
            
            
            if (resp.success == true) {
                $('#mod_add_edit_leccion').modal('hide').on('hidden.bs.modal', function() {
                    Swal.fire("!Proceso Correcto!",resp.respuesta.msg,"success");
                 tableLecciones.ajax.reload();
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
 * EL ENVIO DE INFORMACION PARA EDITAR 
 ***********************************/
 function edit_leccion() {


    $("#frm_nuevo_editar_lecciones").append('<input type="hidden" name="enrol_nivel_ingles" id="enrol_nivel_ingles" value="'+id+'">');
  
    if (!formValidate('#frm_nuevo_editar_lecciones')) {
        return false;
    };
    
    var data = $("#frm_nuevo_editar_lecciones").serialize();

    Swal.fire({
        title: 'Alerta',
        text: "¿Deseas Actulizar la leccion?",
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
                url: url + "cursos/store-leccion",
                type: 'POST',
                data: data,
                dataType: 'json',
                beforeSend: function() {
                   
                },
                success: function(resp) {
                   

                    if (resp.success == true) {
                        $('#mod_add_edit_leccion').modal('hide').on('hidden.bs.modal', function() {
                            Swal.fire("!Proceso Correcto!",resp.respuesta.msg,"success");
                            tableLecciones.ajax.reload();
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
                url: url + "cursos/delete-leccion",
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
