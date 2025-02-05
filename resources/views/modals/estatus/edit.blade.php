<div class="modal fade" id="mod_edit_estatus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Editar estatus de: {{ $catEstatus->nombre }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modal_content">
               
                <form role="form" id="editar_estatus">
                  <div class="panel panel-primary">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">                                
                                    {{ Form::hidden('id_estatus', $catEstatus->id_e, array('id'=>"id_estatus")) }}
                                    <div class="form-group">
                                        {{ Form::label('nombre_estatus', 'Nombre estatus', array('class' => 'col-xl-6 col-lg-6 control-label')) }}
                                        {{ Form::text('nombre_estatus', $catEstatus->nombre, array('class' => 'form-control','required'=>true)) }}
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
                <button type="button" class="btn btn-primary" id="usr_js_fn_05" onclick="edit_estatus();">
                    Editar
                </button>

            </div>
        </div>
    </div>
</div>