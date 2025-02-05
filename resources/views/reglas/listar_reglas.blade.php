@extends('home')
@section('content')
    @if(session('mensaje_success'))
        <div class="row">
            <div class="alert alert-success">
                {{ session('mensaje_success') }}
            </div>
        </div>
    @endif
<div class="kt-portlet kt-portlet--mobile">
    <div class="kt-portlet__head kt-portlet__head--lg">
        <div class="kt-portlet__head-label">
            <span class="kt-portlet__head-icon">
                <i class="kt-font-brand flaticon-user-add"></i>
            </span>
            <h3 class="kt-portlet__head-title">
               Control de Reglas - <span id="titulo" ></span>
            </h3>
        </div>
        <div class="kt-portlet__head-toolbar">
            <div class="kt-portlet__head-wrapper">
                <div class="kt-portlet__head-actions">
                    <div class="dropdown dropdown-inline">
                        <button type="button" class="btn btn-default btn-icon-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="la la-download"></i> Regla por estatus   
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <ul class="kt-nav">
                                <li class="kt-nav__section kt-nav__section--first">
                                    <span class="kt-nav__section-text">Selecciona una opción</span>
                                </li>
                                <li class="kt-nav__item">
                                    <a href="javascript:void(0);" onclick="reglasAll();" class="kt-nav__link">
                                        <i class="kt-nav__link-icon la la-book"></i>
                                        <span class="kt-nav__link-text">Todas las reglas</span>
                                    </a>
                                </li>
                                <li class="kt-nav__item">
                                    <a href="javascript:void(0);" onclick="reglaEstado('Activa');" class="kt-nav__link">
                                        <i class="kt-nav__link-icon la la-check"></i>
                                        <span class="kt-nav__link-text">Reglas activas</span>
                                    </a>
                                </li>
                                <li class="kt-nav__item">
                                    <a href="javascript:void(0);" onclick="reglaEstado('Pendiente');" class="kt-nav__link">
                                        <i class="kt-nav__link-icon la la-clock-o"></i>
                                        <span class="kt-nav__link-text">Reglas Pendientes</span>
                                    </a>
                                </li>
                                <li class="kt-nav__item">
                                    <a href="javascript:void(0);" onclick="reglaEstado('Inactiva');" class="kt-nav__link">
                                        <i class="kt-nav__link-icon la la-times"></i>
                                        <span class="kt-nav__link-text">Reglas Inactivas</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <a href="javascript:void(0);" onclick="add_regla_modal();" class="btn btn-cdmx swal2-center">
                        <i class="la la-plus"></i>
                       Nueva regla
                    </a>
                    <a href="javascript:void(0);" onclick="import_regla_modal();" class="btn btn-primary swal2-center">
                        <i class="la la-upload"></i>
                       Importar reglas
                    </a>
                </div>
            </div>

        </div>
    </div>

    <div class="kt-portlet__body">
        <!--begin: Datatable -->
        <table class="table table-bordered table-striped" id="table-regla">
            <thead>
                <tr>
                    <th></th>
                    <th>Ver más</th>
                    <th>Regla</th>
                    <th>Acción</th>
                    <th>Dirección</th>
                    <th>Tipo de correo</th>
                    <th>Descripción</th>
                    <th>Acciones</th>
                </tr>
            </thead>
        </table>
        <!--end: Datatable -->
    </div>
    <div class="col-lg-2" id="inactivas">
        <button id="button" class="btn btn-danger">Inactivar</button>
    </div>
</div>

    @section('scripts')
        <script type="text/javascript">
            let dataRegla = "{{ route('reglas.dataRegla')}}";
            let reglaCreate = "{{ route('reglas.create') }}";
            let reglaStore = "{{ route('reglas.store') }}";
            let reglasEstado = "{{ route('reglas.dataEstado', ['estado' => '']) }}";
            let updateInactiva = "{{ route('reglas.updateInactivas') }}";
            let importView = "{{ route('reglas.importView') }}";
        </script>
            <script src="{{ URL::asset('js/regla.js')}}" type="text/javascript"></script>
        @endsection
@endsection
