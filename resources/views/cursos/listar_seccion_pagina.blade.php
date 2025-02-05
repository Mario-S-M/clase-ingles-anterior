@extends('home')
@section('content')
<div class="kt-portlet kt-portlet--mobile">
    <div class="kt-portlet__head kt-portlet__head--lg">
        <div class="kt-portlet__head-label">
            <span class="kt-portlet__head-icon">
                <i class="kt-font-brand flaticon-user-add"></i>
            </span>
            <h3 class="kt-portlet__head-title">
              Contenidos de la Lección
            </h3>
        </div>
        <div class="kt-portlet__head-toolbar">
            <div class="kt-portlet__head-wrapper">
                <div class="kt-portlet__head-actions">
                    <a href="javascript:void(0);" onclick="add_seccion_page_modal();" class="btn btn-cdmx">
                        <i id="btn-crear_spiner" class="la la-plus"></i>
                      Nuevo Contenido
                    </a>

                </div>
            </div>
        </div>
    </div>
,
    <div class="kt-portlet__body">
        <!--begin: Datatable -->
        <table class="table table-bordered table-striped" id="table-secccion-pagina">
            <thead>
                <tr>
                    <th>Imagen</th>
                    <th>Descripcion Imagen</th>
                    <th>Contenido Textual</th>
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
    </script>
    <script src="{{ asset('js/cursos/secciones_page.js?v=1.0.3') }}"></script>
    @endsection
@endsection
