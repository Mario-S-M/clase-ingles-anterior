@extends('home')
@section('content')
<div class="kt-portlet kt-portlet--mobile">
    <div class="kt-portlet__head kt-portlet__head--lg">
        <div class="kt-portlet__head-label">
            <span class="kt-portlet__head-icon">
                <i class="kt-font-brand flaticon-user-add"></i>
            </span>
            <h3 class="kt-portlet__head-title">
               Control de reglas - <span id="titulo"></span>
            </h3>
        </div>
        <div class="kt-portlet__head-toolbar">
            <div class="kt-portlet__head-wrapper">
                <div class="kt-portlet__head-actions">
                    <a href="javascript:void(0);" onclick="add_regla_modal();" class="btn btn-cdmx swal2-center">
                        <i class="la la-plus"></i>
                       Nueva regla
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
                    <th>Ver más</th>
                    <th>Regla</th>
                    <th>Acción</th>
                    <th>Dirección</th>
                    <th>Descripción</th>
                    <th>Acciones</th>
                </tr>
            </thead>
        </table>
        <!--end: Datatable -->
    </div>
</div>

    @section('scripts')
    <script type="text/javascript">
        let dataRegla = "{{ route('reglas.dataEstado') }}";
        let reglaCreate = "{{ route('reglas.create') }}";
        let reglaStore = "{{ route('reglas.store') }}";
    </script>
        <script src="{{ URL::asset('js/regla_estado.js')}}" type="text/javascript"></script>
    @endsection
@endsection
