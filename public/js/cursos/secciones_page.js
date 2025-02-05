var tableSeccionPages = "";
const formCrearEditarEmpleados = $("#frm_nuevo_editar_empleados");
var validatorformCrearEditarEmpleados = ""
$(document).ready(function() {
   


    listarEMpleadosTable();
});


function listarEMpleadosTable(){
    
    tableSeccionPages = $('#table-secccion-pagina').dataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        language: {
            "url": url + "assets/vendors/general/datatables/Spanish.json"
        },
        ajax: {
            "url": url + "cursos/seccion-pagina-data/"+id,
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
                "mRender": function(data, type, row) {
                    var imagen = row.imagen;
                    let img =  '<img src="'+imagen+'" width="100px">';
                     
                    return img;
                    }
            },
            {
                data: 'descripcion_imagen',
                name: 'descripcion_imagen'
            },
            
            {
                data: 'contenido',
                name: 'contenido'
            },   
            {
                "mRender": function(data, type, row) {
                    var id_seccion_pagina = row.id_seccion_pagina;
                    let button =  '<button class="btn btn-cdmx btn-sm  btn-pill" onClick="edit_seccion_page_modal(' + id_seccion_pagina + ');" href="javascript:void(0)" name="btn_in_spiner-'+id_seccion_pagina+'">Editar </button>';
                     
                    button+='<button class="btn btn-danger btn-sm  btn-pill" onClick="eliminar(' + id_seccion_pagina + ');" href="javascript:void(0)" name="btn_in_spiner-'+id_seccion_pagina+'">Eliminar </button>';
                   
                    
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


function add_seccion_page_modal(){

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: url + "cursos/create-seccion-pagina/"+id,
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
              

                CKEDITOR.replace("ckplot");
                CKEDITOR.instances["ckplot"].setData("")
   
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

function edit_seccion_page_modal(id_seccion_pagina) {

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: url + "cursos/edit-seccion-pagina",
        dataType: 'html',
        data: {
            id_seccion_pagina: id_seccion_pagina
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
                 
                CKEDITOR.replace("ckplot");
                CKEDITOR.instances["ckplot"].setData($("#valueTextArea").val())

                $('#file-selected-message').text('Imagen actual: ' + $("#valueImagen").val());
                

                
                $('#imagen').change(function() {
                    var fileName = $(this).val().split('\\').pop(); // Obtener el nombre del archivo
                    $('#file-selected-message').text('Nueva imagen seleccionada: ' + fileName);
                });

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
function save_seccion_page_create() {
  
    if (!formValidate2('#frm_nuevo_editar_seccion_page', false)) {
        return false;
    };
    
        // Obtener el contenido del editor CKEditor
        var contenido = CKEDITOR.instances['ckplot'].getData();

        // Crear un objeto FormData
        var formData = new FormData();

        // Adjuntar los campos del formulario al objeto FormData
        $("#frm_nuevo_editar_seccion_page input, #frm_nuevo_editar_seccion_page textarea").each(function() {
            formData.append($(this).attr("name"), $(this).val());
         
        });

        // Adjuntar el archivo de imagen al objeto FormData
        var imagen = $("#imagen")[0].files[0];
        formData.append("imagen", imagen);
        // Adjuntar el contenido al objeto FormData
        formData.append("contenido", contenido);
   
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: url + "cursos/create-seccion-pagina",
        type: 'POST',
        data: formData,
        processData: false,  // No procesar los datos (ya que FormData ya lo hace)
        contentType: false,
        beforeSend: function() {
            $(".btn_agregar_editar").attr("disabled", true);
            $("#crear_spiner_add_edit").removeClass("la la-plus").addClass("spinner-border spinner-border-sm");
        },
        success: function(resp) {
            
            
            if (resp.success == true) {
                $('#mod_add_edit_seccion_page').modal('hide').on('hidden.bs.modal', function() {
                    Swal.fire("!Proceso Correcto!",resp.respuesta.msg,"success");
                    tableSeccionPages.ajax.reload();
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
 function edit_empleado() {
    
    if (!formValidate2('#frm_nuevo_editar_seccion_page', true)) {
        return false;
    };
    
    
        // Obtener el contenido del editor CKEditor
        var contenido = CKEDITOR.instances['ckplot'].getData();
        // Crear un objeto FormData
        var formData = new FormData();

        // Adjuntar los campos del formulario al objeto FormData
        $("#frm_nuevo_editar_seccion_page input, #frm_nuevo_editar_seccion_page textarea").each(function() {
            formData.append($(this).attr("name"), $(this).val());
        });

        formData.append("contenido", contenido);
        // Adjuntar el archivo de imagen al objeto FormData
        var imagen = $("#imagen")[0].files[0];

        if (imagen) {
            // Si se selecciona una nueva imagen, agregala al objeto FormData
            formData.append("imagen", imagen);
        } else {
            // Si no se selecciona una nueva imagen, utiliza la imagen actual almacenada en el campo oculto
            var imagenActual = $("#valueImagen").val();
            formData.append("imagen", imagenActual);
        }
    Swal.fire({
        title: 'Alerta',
        text: "¿Deseas Actualizar el contenido?",
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
                url: url + "cursos/create-seccion-pagina",
                type: 'POST',
                data: formData,
                processData: false,  // No procesar los datos (ya que FormData ya lo hace)
                contentType: false,
                beforeSend: function() {
                    $(".btn_agregar_editar").attr("disabled", true);
                    $("#crear_spiner_add_edit").removeClass("la la-plus").addClass("spinner-border spinner-border-sm");
                },
                success: function(resp) {
                   

                    if (resp.success == true) {
                        $('#mod_add_edit_seccion_page').modal('hide').on('hidden.bs.modal', function() {
                            Swal.fire("Proceso Correcto!",resp.respuesta.msg,"success");
                            tableSeccionPages.ajax.reload();
                        });
                        
                    } else {
                        Swal.fire('error', resp.respuesta.msg,"error");
                    }

                },
                error: function(respuesta) {
                    Swal.fire('¡Alerta!', 'Error de conectividad de red USR-04', 'warning');
                    $(".btn_agregar_editar").attr("disabled", false);
                    $("#crear_spiner_add_edit").removeClass("spinner-border spinner-border-sm").addClass("la la-plus");
                }
            });

        }
    });
}



// JavaScript
function formValidate2(formId, isEditing) {
    var isValid = true;

    // Obtener todos los campos del formulario
    var fields = $(formId + " input, " + formId + " textarea");

    // Iterar sobre cada campo y realizar la validación
    fields.each(function() {
        // Validar el campo actual
        var fieldValue = $(this).val().trim();
        var fieldType = $(this).attr("type");
        var fieldRequired = $(this).prop("required");
        var fieldName = $(this).attr("name");
        var fieldErrorId = "#" + fieldName + "-error";

        // Verificar si estamos en modo de edición y si el campo actual es el campo de imagen
        if (isEditing && fieldName === "imagen") {
            return true; // Continuar con el siguiente campo sin realizar ninguna validación
        }

        // Si el campo es obligatorio y está vacío, o si es un campo de archivo y no tiene un archivo seleccionado
        if ((fieldRequired && fieldValue === "") || (fieldType === "file" && fieldValue === "")) {
            // Marcar el campo como inválido
            $(this).addClass("is-invalid");
            // Mostrar el mensaje de error
            $(fieldErrorId).text("Este campo es obligatorio");
            isValid = false;
        } else {
            // Eliminar cualquier marca de inválido
            $(this).removeClass("is-invalid");
            // Ocultar el mensaje de error
            $(fieldErrorId).text("");
        }
    });

    return isValid;
}


// Escuchar el evento change en el campo de archivo
$("#imagen").change(function() {
    // Obtener el nombre del archivo seleccionado
    var fileName = $(this).val().split("\\").pop();
    
    // Actualizar el texto del elemento de texto adyacente
    $("#file-selected-message").text("Archivo seleccionado: " + fileName);
});


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
                url: url + "cursos/delete-seccion",
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
