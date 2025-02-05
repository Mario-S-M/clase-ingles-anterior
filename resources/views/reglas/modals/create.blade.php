<div class="modal fade" id="mod_add_regla" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Añadir nueva regla:</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modal_content">
                <form role="form" name="frm_nueva_regla" id="frm_nueva_regla" method="POST" action="javascript:void(0)">
                    <div class="panel panel-primary">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">                                
                                    <div class="form-group">
                                        {{ Form::label('regla', 'Regla', array('class' => 'col-xl-3 col-lg-3 control-label')) }}
                                        {{ Form::text('regla', '', array('class' => 'form-control','required'=>true)) }}
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {{ Form::label('accion', 'Acción', array('class' => 'col-xl-3 col-lg-3 control-label')) }}
                                        {{ Form::select('accion', $accion, null, array('class' => 'form-control','required'=>true,'placeholder'=>'Seleccione acción...')) }}
                                    </div>                                   
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {{ Form::label('estatus_regla', 'Estatus regla', array('class' => 'col-xl-12 col-lg-12 control-label')) }}
                                        {{ Form::select('estatus_regla', $estatusRegla, null, array('class' => 'form-control','required'=>true,'placeholder'=>'Seleccione estatus...')) }}
                                    </div>                                   
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {{ Form::label('tipo_correo', 'Tipo de correo', array('class' => 'col-xl-12 col-lg-12 control-label')) }}
                                        {{ Form::select('tipo_correo', $tipoCorreo, null, array('class' => 'form-control','required'=>true,'placeholder'=>'Seleccione un tipo...')) }}
                                    </div>                                   
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        {{ Form::label('direccion', 'Dirección', array('class' => 'col-xl-3 col-lg-3 control-label')) }}
                                        @foreach ($direcciones as $direccion)
                                        <div class="col-md-3">
                                            <span class="kt-switch kt-switch--icon">
                                                <label>
                                                    {{ Form::checkbox("direcciones[]", $direccion->id, false, array('required'=> true)) }}
                                                    {{ Form::label($direccion->nombre, ucfirst($direccion->nombre)) }}
                                                    <span></span>
                                                </label>
                                            </span>
                                        </div>
                                        @endforeach
                                    </div>                                   
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        {{ Form::label('descripcion', 'Descripción', array('class' => 'col-xl-3 col-lg-3 control-label')) }}
                                        {{ Form::textarea('descripcion','',array('class' => 'form-control', 'required'=> true, 'cols'=> 5, 'rows' => 5)) }}
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
                <button type="button" class="btn btn-primary" id="usr_js_fn_04" onclick="save_regla_create();">
                    Agregar
                </button>

            </div>
        </div>
    </div>
</div>