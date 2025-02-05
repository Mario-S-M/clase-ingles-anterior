<div  class="modal fade" id="mod_add_edit_nivel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
       <div class="modal-content">
          <div class="modal-header">
             <h5 class="modal-title" id="myModalLabel">
                @if(isset($nivelData->id_nivel_ingles))
                    Editar Nivel Ingles 
                @else
                    Añadir Nueva Nivel Ingles 
                @endif
             </h5>
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
             </button>
          </div>
          <div class="modal-body" id="modal_content">
             <div id="message_lecciones_add_edit"></div>
             <form role="form" name="frm_nuevo_editar_niveles" id="frm_nuevo_editar_niveles" method="POST">
                @if(isset($nivelData->id_nivel_ingles))
                    <input type="hidden" class="form-control" id="id_nivel_ingles" name="id_nivel_ingles" value="{{$nivelData->id_nivel_ingles}}">
                @endif
                {{ csrf_field() }}
                <div class="panel panel-primary">
                   <div class="panel-body">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Nombre del Nivel</label>
                                <input type="text" class="form-control form-control-sm" id="nombre_nivel" name="nombre_nivel" value="{{ isset($nivelData->id_nivel_ingles) ? $nivelData->nombre_nivel : ""  }}" placeholder="Escribe el nombre del nivel"  required>
                                <span id="nombres-error" class="help-block"></span>
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
             @if(isset($nivelData->id_nivel_ingles))
                <button type="button" class="btn btn-primary btn_agregar_editar" id="usr_js_fn_05" onclick="edit_nivel();">
                <i id="btn-crear_spiner_add_edit" class="far fa-edit"></i>
                Editar
                </button> 
             @else
                <button type="button" class="btn btn-primary btn_agregar_editar" id="usr_js_fn_04" onclick="save_nivel_create();">
                <i id="btn-crear_spiner_add_edit" class="fas fa-plus-circle"></i>
                Agregar
                </button>
             @endif
          </div>
       </div>
    </div>
 </div>