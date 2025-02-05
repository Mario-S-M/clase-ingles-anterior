<div class="modal fade" id="mod_ver_regla" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Vista regla: </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modal_content">
              <div class="panel panel-primary">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="kt-widget19__text"> <strong>Usuario:</strong> {{ $regla->usuario->name }} </div>
                             </div>
                             <div class="col-lg-4">
                                <div class="kt-widget19__text"> <strong>Fecha creación:</strong> {{ $regla->fecha_creacion }} </div>
                             </div>
                             <div class="col-lg-5">
                                <div class="kt-widget19__text"> <strong>Fecha eliminación:</strong> {{ $regla->fecha_eliminacion }} </div>
                             </div>
                            <div class="col-lg-12">
                                <div class="kt-widget19__text"> <strong>Regla:</strong> {{ $regla->regla }} </div>
                             </div>
                             <div class="col-lg-12">
                                <div class="kt-widget19__text"> <strong>Acción:</strong> {{ $regla->accion->nombre }} </div>
                             </div>
                             <div class="col-lg-12">
                                <strong>Dirección:</strong>
                                <ul>
                                @foreach ($regla->direcciones as $reglaDireccion)
                                    <li> {{ $reglaDireccion->nombre }} </li>
                                @endforeach
                                </ul>
                             </div>
                             <div class="col-lg-12">
                                <div class="kt-widget19__text"> <strong>Estatus:</strong> <span @if ($regla->estatus->id == 2)
                                    class="text-danger" @else class="text-success" @endif>{{ $regla->estatus->nombre }}</span> </div>
                             </div>
                             <div class="col-lg-12">
                                <div class="kt-widget19__text"> <strong>Descripción:</strong> {{ $regla->descripcion }} </div>
                             </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>