<div class="modal fade" id="mod_edit_accion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Editar accion: {{ $catAccion->nombre }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modal_content">
               
                <form role="form" id="editar_accion">
                  <div class="panel panel-primary">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">                                
                                    {{ Form::hidden('id_accion', $catAccion->id_e, array('id'=>"id_accion")) }}
                                    <div class="form-group">
                                        {{ Form::label('nombre_accion', 'Nombre acción', array('class' => 'col-xl-6 col-lg-6 control-label')) }}
                                        {{ Form::text('nombre_accion', $catAccion->nombre, array('class' => 'form-control','required'=>true)) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    Cancelar
                </button>
                <button type="button" class="btn btn-primary" id="usr_js_fn_05" onclick="edit_accion();">
                
                    Editar
                </button>

            </div>
        </div>
    </div>
</div>