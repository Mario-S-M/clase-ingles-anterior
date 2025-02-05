<div class="modal fade" id="mod_edit_regla" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Editar regla: {{ $regla->regla }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modal_content">
               
                <form role="form" id="editar_regla">
                  <div class="panel panel-primary">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">                                
                                    <div class="form-group">
                                        Usuario creo: {{ $regla->usuario->name }}<br>
                                        Fecha de creación: {{ $regla->fecha_creacion }}
                                    </div>
                                </div>
                                <div class="col-md-12">             
                                    {{ Form::hidden('id_regla', $aux, array('id'=>"id_regla")) }}
                                    <div class="form-group">
                                        {{ Form::label('regla', 'Regla', array('class' => 'col-xl-6 col-lg-6 control-label')) }}
                                        {{ Form::text('regla', $regla->regla, array('class' => 'form-control','required'=>true)) }}
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {{ Form::label('accion', 'Acción', array('class' => 'col-xl-3 col-lg-3 control-label')) }}
                                        {{ Form::select('accion', $accion,$regla->accion->id, array('class' => 'form-control','required'=>true,'placeholder'=>$regla->accion->nombre)) }}
                                    </div>                                   
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {{ Form::label('estatus_regla', 'Estatus regla', array('class' => 'col-xl-12 col-lg-12 control-label')) }}
                                        {{ Form::select('estatus_regla', $estatusRegla, $regla->estatus_regla->id, array('class' => 'form-control','required'=>true,'placeholder'=>$regla->estatus_regla->nombre)) }}
                                    </div>                                   
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {{ Form::label('tipo_correo', 'Tipo de correo', array('class' => 'col-xl-12 col-lg-12 control-label')) }}
                                        {{ Form::select('tipo_correo', $tipoCorreo, $regla->tipo_correo->id, array('class' => 'form-control','required'=>true,'placeholder'=>$regla->tipo_correo->nombre)) }}
                                    </div>                                   
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        {{ Form::label('direccion', 'Dirección', array('class' => 'col-xl-3 col-lg-3 control-label')) }}
                                        @foreach ($direcciones as $direccion)
                                        @php
                                            $activo = 0
                                        @endphp
                                            <div class="col-md-3">
                                                <span class="kt-switch kt-switch--icon">
                                                    <label>
                                                        @foreach ($regla->direcciones as $reglaDireccion)
                                                            @if ($reglaDireccion->id == $direccion->id)
                                                                {{ Form::checkbox("direcciones[]", $direccion->id, true,array('id'=>$direccion->nombre, 'required' => true)) }}
                                                                {{ Form::label($direccion->nombre, ucfirst($direccion->nombre)) }}
                                                                <span></span>
                                                                @php
                                                                    $activo = 1;
                                                                @endphp
                                                            @endif
                                                        @endforeach
                                                        @if($activo != 1)
                                                            {{ Form::checkbox("direcciones[]", $direccion->id, false,array('id'=>$direccion->nombre, 'required'=> true)) }}
                                                            {{ Form::label($direccion->nombre, ucfirst($direccion->nombre)) }}
                                                            <span></span>
                                                        @endif
                                                    </label>
                                                </span>
                                            </div>
                                        @endforeach
                                    </div>                                   
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        {{ Form::label('descripcion', 'Descripcion', array('class' => 'col-xl-3 col-lg-3 control-label')) }}
                                        {{ Form::textarea('descripcion',$regla->descripcion,array('class' => 'form-control', 'required'=> true, 'cols' => 5, 'rows' => 5)) }}
                                    </div>                                   
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        {{ Form::label('nota', 'Nota', array('class' => 'col-xl-3 col-lg-3 control-label')) }}
                                        {{ Form::textarea('nota','',array('class' => 'form-control', 'required'=> true, 'cols'=> 2, 'rows' => 2)) }}
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
                <button type="button" class="btn btn-primary" id="usr_js_fn_05" onclick="edit_regla();">
                
                    Editar
                </button>

            </div>
        </div>
    </div>
</div>