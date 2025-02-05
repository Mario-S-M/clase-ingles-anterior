@extends('home')
@section('content')
<div class="kt-portlet kt-portlet--mobile">
    <div class="kt-portlet__head kt-portlet__head--lg">
        <div class="kt-portlet__head-label">
            <span class="kt-portlet__head-icon">
                <i class="kt-font-brand flaticon-user-add"></i>
            </span>
            <h3 class="kt-portlet__head-title">
              Niveles de Ingles
            </h3>
        </div>
        <div class="kt-portlet__head-toolbar">
            <div class="kt-portlet__head-wrapper">
                <div class="kt-portlet__head-actions">
                    @if( Auth::user()->hasRole('SuperAdmin'))
                    <a href="javascript:void(0);" onclick="add_nivel_modal();" class="btn btn-cdmx">
                        <i id="btn-crear_spiner" class="la la-plus"></i>
                      Nuevo Nivel
                    </a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="kt-portlet__body">
        <!--begin: Datatable -->
        <table class="table table-bordered table-striped" id="table-niveles">
            <thead>
                <tr>
                   
                    <th>Nombre de Nivel</th>
                
                    <th>Acciones</th>
                </tr>
            </thead>
        </table>
        <!--end: Datatable -->
    </div>
</div>

    @section('scripts')
    <script type="text/javascript">
        var id = "{{ $id }}"
        var isSuperAdmin = "{{Auth::user()->hasRole('SuperAdmin')}}"
        console.log(isSuperAdmin);
    </script>
    <script src="{{ asset('js/cursos/niveles.js?v=1.0.3') }}"></script>
    @endsection
@endsection

