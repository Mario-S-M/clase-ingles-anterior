@extends('home')
@section('content')
<!--begin::Portlet-->
    <div class="kt-portlet " data-ktportlet="true" id="kt_portlet_tools_4">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="fas fa-pencil-alt icon-lg"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    BIENVENIDOS AL SISTEMA DE ADMINISTRACIÓN DE LECCIONES
                </h3>
            </div>
        </div>
    </div>

    <!--begin::Encuesta sistemas-->
   <!-- <div class="row">
        
        <div class="col-xl-6 col-lg-6 order-lg-4 order-xl-2">
            <div class="kt-portlet kt-portlet--height-fluid">
                <div class="kt-widget14">
                    <div class="kt-widget14__header">
                        <h3 class="kt-widget14__title">
                                        
                        </h3>
                        <span class="kt-widget14__desc">
                            Usuarios que han agregado más reglas
                        </span>
                    </div>   
                    <div class="kt-widget14__content">  
                        <div class="kt-widget14__chart">
                            <div class="kt-widget14__stat" id="total"></div>
                            <canvas id="usuarios_reglas" style="height: 140px; width: 140px;"></canvas>
                        </div> 
                        <div class="kt-widget14__legends" id="etiquetas_usuarios">
                        </div>          
                    </div> 
                </div>
            </div>      
        </div>
    </div>-->
    
    

    

    @section('scripts')
        <script type="text/javascript">
                let ultimosLogs = "{{ route('reglas.ultimosLogs') }}";
                let ultimasReglas = "{{ route('reglas.ultimasReglas') }}";
        </script>
        <script src="{{ URL::asset('assets/vendors/general/raphael/raphael.js') }}" type="text/javascript"></script>
        <script src="{{ URL::asset('assets/vendors/general/morris.js/morris.js') }}" type="text/javascript"></script>
        <script src="{{ URL::asset('assets/vendors/general/chart.js/dist/Chart.bundle.js') }}" type="text/javascript"></script>
        <script src="{{ URL::asset('assets/js/dashboard.js') }}" type="text/javascript"></script>
    @endsection
@endsection
