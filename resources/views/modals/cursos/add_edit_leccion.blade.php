<div  class="modal fade" id="mod_add_edit_leccion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
       <div class="modal-content">
          <div class="modal-header">
             <h5 class="modal-title" id="myModalLabel">
                @if(isset($leccionData->id_leccion))
                    Editar Leccion 
                @else
                    Añadir Nueva Leccion
                @endif
             </h5>
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
             </button>
          </div>
          <div class="modal-body" id="modal_content">
             <div id="message_lecciones_add_edit"></div>
             <form role="form" name="frm_nuevo_editar_lecciones" id="frm_nuevo_editar_lecciones" method="POST">
                @if(isset($leccionData->id_leccion))
                    <input type="hidden" class="form-control" id="id_leccion" name="id_leccion" value="{{$leccionData->id_leccion}}">
                @endif
                {{ csrf_field() }}
                <div class="panel panel-primary">
                   <div class="panel-body">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Titulo de la Leccion</label>
                                <input type="text" class="form-control form-control-sm" id="titulo_leccion" name="titulo_leccion" value="{{ isset($leccionData->titulo_leccion) ? $leccionData->titulo_leccion : ""  }}" placeholder="Escribe el titulo leccion corto"  required>
                                <span id="nombres-error" class="help-block"></span>
                             </div>
                        </div>

                        <div class="col-md-12">
                           <div class="form-group">
                               <label class="control-label">Descripción</label>
                               <textarea class="form-control form-control-sm" id="descripcion" name="descripcion" placeholder="Escribe la descripción" rows="3" required>{{ isset($leccionData->descripcion) ? $leccionData->descripcion : "" }}</textarea>
                               <span id="descripcion-error" class="help-block"></span>
                           </div>
                       </div>

                       <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label">Titulo de la Leccion</label>
                            <input type="text" class="form-control form-control-sm" id="titulo_leccion" name="titulo" value="{{ isset($paginaLeccionData->titulo) ? $paginaLeccionData->titulo : ""  }}" placeholder="Escribe el titulo completo"  required>
                            <span id="nombres-error" class="help-block"></span>
                         </div>
                    </div>
                       
                       <div class="col-md-12">
                           <div class="form-group">
                               <label class="control-label">Link del video</label>
                               <textarea class="form-control form-control-sm" id="link_video_frame" name="link_video_frame" placeholder="Ingresa el link del video" rows="3" required>{{ isset($paginaLeccionData->link_video_frame) ? $paginaLeccionData->link_video_frame : "" }}</textarea>
                               <span id="link_video_frame-error" class="help-block"></span>
                           </div>
                       </div>
                       
                       <div class="col-md-12">
                           <div class="form-group">
                               <label class="control-label">Link del cuestionario</label>
                               <textarea class="form-control form-control-sm" id="link_cuestonario" name="link_cuestonario" placeholder="Ingresa el link del cuestionario" rows="3" required>{{ isset($paginaLeccionData->link_cuestonario) ? $paginaLeccionData->link_cuestonario : "" }}</textarea>
                               <span id="link_cuestonario-error" class="help-block"></span>
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
             @if(isset($leccionData->id_leccion))
                <button type="button" class="btn btn-primary btn_agregar_editar" id="usr_js_fn_05" onclick="edit_leccion();">
                <i id="btn-crear_spiner_add_edit" class="far fa-edit"></i>
                Editar
                </button> 
             @else
                <button type="button" class="btn btn-primary btn_agregar_editar" id="usr_js_fn_04" onclick="save_leccion_create();">
                <i id="btn-crear_spiner_add_edit" class="fas fa-plus-circle"></i>
                Agregar
                </button>
             @endif
          </div>
       </div>
    </div>
 </div>