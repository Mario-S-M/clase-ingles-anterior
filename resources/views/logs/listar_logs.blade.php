@extends('home')
@section('content')
<div class="kt-portlet kt-portlet--mobile">
    <div class="kt-portlet__head kt-portlet__head--lg">
        <div class="kt-portlet__head-label">
            <span class="kt-portlet__head-icon">
                <i class="kt-font-brand flaticon-user-add"></i>
            </span>
            <h3 class="kt-portlet__head-title">
               Logs
            </h3>
        </div>
    </div>

    <div class="kt-portlet__body">
        <!--begin: Datatable -->
        <table class="table table-bordered table-striped" id="table-logs">
            <thead>
                <tr>
                    <th></th>
                    <th>Regla</th>
                    <th>Acción</th>
                    <th>Estatus</th>
                    <th>Usuario</th>
                    <th>Acciones</th>
                </tr>
            </thead>
        </table>
        <!--end: Datatable -->
    </div>
</div>

    @section('scripts')
    <script type="text/javascript">
        let dataLogs = "{{ route('logs.dataLogs') }}";
    </script>
        <script src="{{ URL::asset('js/logs.js')}}" type="text/javascript"></script>
    @endsection
@endsection
