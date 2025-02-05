<div class="modal fade" id="mod_add_accion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Añadir nueva acción:</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modal_content">
                <form role="form" name="frm_nueva_accion" id="frm_nueva_accion" method="POST" action="javascript:void(0)">
                    <div class="panel panel-primary">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">                                
                                    <div class="form-group">
                                        {{ Form::label('nombre_accion', 'Nombre acción', array('class' => 'col-xl-3 col-lg-3 control-label')) }}
                                        {{ Form::text('nombre_accion', '', array('class' => 'form-control','required'=>true)) }}
                                    </div><br>                                   
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
                <button type="button" class="btn btn-primary" id="usr_js_fn_04" onclick="save_accion_create();">
                    Agregar
                </button>

            </div>
        </div>
    </div>
</div>