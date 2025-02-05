@extends('home')
@section('content')
<div class="kt-portlet kt-portlet--mobile">
    <div class="kt-portlet__head kt-portlet__head--lg">
        <div class="kt-portlet__head-label">
            <span class="kt-portlet__head-icon">
                <i class="kt-font-brand flaticon-user-add"></i>
            </span>
            <h3 class="kt-portlet__head-title">
               Control de Usuarios
            </h3>
        </div>
        <div class="kt-portlet__head-toolbar">
            <div class="kt-portlet__head-wrapper">
                <div class="kt-portlet__head-actions">
                    <div class="dropdown dropdown-inline">
                        
                        
                    </div>
                    &nbsp;
                    <a href="javascript:void(0);" onclick="add_user_modal();" class="btn btn-brand btn-elevate btn-cdmx">
                        <i class="la la-plus"></i>
                       Nuevo Usuario
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="kt-portlet__body">
        <!--begin: Datatable -->
        <table class="table table-striped- table-bordered table-hover table-checkable" id="users-table">
            <thead>
            <tr>
                <th> ID </th>
                <th> Nombre </th>
                <th> Apellido Paterno </th>
                <th> Apellido Materno </th>
                <th> Nombre de Usuario </th>
                <th> Correo </th>
                <th> Acciones</th>
            </tr>
            </thead>
        </table>
        <!--end: Datatable -->
    </div>
</div>
@section('scripts')
<script src="{{ URL::asset('js/users.js')}}" type="text/javascript"></script>
@endsection
@endsection
