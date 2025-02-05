<div  class="modal fade" id="mod_add_edit_seccion_page" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
       <div class="modal-content">
          <div class="modal-header">
             <h5 class="modal-title" id="myModalLabel">
                @if(isset($seccionPaginaData->id_seccion_pagina))
                    Editar Contenido 
                @else
                    Añadir Nuevo Contenido
                @endif
             </h5>
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
             </button>
          </div>
          <div class="modal-body" id="modal_content">
             <div id="message_asignacionips_add_edit"></div>

             <input type="hidden" class="form-control" id="valueTextArea" name="valueTextArea" value="{{ isset($seccionPaginaData->contenido) ? $seccionPaginaData->contenido : "" }}">

             <input type="hidden" class="form-control" id="valueImagen" name="valueImagen" value="{{ isset($seccionPaginaData->imagen) ? $seccionPaginaData->imagen : "" }}">
             <form role="form" name="frm_nuevo_editar_seccion_page" id="frm_nuevo_editar_seccion_page" method="POST">
                @if(isset($seccionPaginaData->id_seccion_pagina))
                    <input type="hidden" class="form-control" id="id_seccion_pagina" name="id_seccion_pagina" value="{{$seccionPaginaData->id_seccion_pagina}}">
                @else
                  <input type="hidden" class="form-control" id="clv_pagina_leccion" name="clv_pagina_leccion" value="{{$paginaLeccion}}">
                @endif

               
                
                {{ csrf_field() }}
                <div class="panel panel-primary">
                   <div class="panel-body">

                  
                    <div class="row">
                        <div class="col-md-12">
                              <div class="form-group">
                                 <label class="control-label">Contenido</label>
                                
                                 <!--<textarea class="form-control form-control-sm" id="contenido" name="contenido" placeholder="Escribe el contenido" rows="3" required>{{ isset($seccionPaginaData->contenido) ? $seccionPaginaData->contenido : "" }}</textarea>
                                 --> <textarea id="ckplot"></textarea><span id="descripcion-error" class="help-block"></span>
                              </div>
                        </div>

                        <div class="col-md-12">
                           <div class="form-group">
                              <label class="control-label">Descripcion Imagen</label>
                              <textarea class="form-control form-control-sm" id="descripcion_imagen" name="descripcion_imagen" placeholder="Escribe la descripción de la imagen" rows="3" required>{{ isset($seccionPaginaData->descripcion_imagen) ? $seccionPaginaData->descripcion_imagen : "" }}</textarea>
                              <span id="descripcion-error" class="help-block"></span>
                           </div>
                     </div>
                      
                    </div>
                   
                      <hr>
                      <div class="row">
                        
                        <div class="col-lg-12">
                           <div class="form-group">
                               <label class="control-label">Imagen</label>
                               <input type="file" class="form-control-file" id="imagen" name="imagen" accept="image/png, image/jpeg" required>
                               <span id="imagen-error" class="help-block"></span>
                               <b><small id="file-selected-message" class="form-text text-muted"></small></b>
                           </div>
                       </div>
                       
                      </div>
                   </div>
                </div>
                <div id="error_alerta"> </div>
             </form>
          </div>
          <div class="modal-footer">
             <button type="button" class="btn btn-secondary" data-dismiss="modal">
             Cancelar
             </button>
             @if(isset($seccionPaginaData->id_seccion_pagina))
                <button type="button" class="btn btn-primary btn_agregar_editar" id="usr_js_fn_05" onclick="edit_empleado();">
                <i id="btn-crear_spiner_add_edit" class="far fa-edit"></i>
                Editar
                </button> 
             @else
                <button type="button" class="btn btn-primary btn_agregar_editar" id="usr_js_fn_04" onclick="save_seccion_page_create();">
                <i id="btn-crear_spiner_add_edit" class="fas fa-plus-circle"></i>
                Agregar
                </button>
             @endif
          </div>
       </div>
    </div>
 </div>