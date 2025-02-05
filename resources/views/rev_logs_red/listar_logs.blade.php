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
    <div class="kt-portlet__head kt-portlet__head">
        <div class="kt-portlet__head-label">
            <span class="kt-portlet__head-icon">
                <i class="kt-font-brand flaticon-user-add"></i>
            </span>
            <h3 class="kt-portlet__head-title">
               Control de logs - <span id="titulo" ></span>
            </h3>
        </div>
        <div class="kt-portlet__head-toolbar">
            <div class="kt-portlet__head-wrapper">
                <div class="kt-portlet__head-actions"> 
                  
                        <div class="input-group">
                            <div class="input-group-prepend ">
                                
                            @if($selectfiles['error'])
                                    <span class="input-group-text bg-danger"></span>
                                    @else
                                    @if($selectfiles['nuevos'])
                                    <span class="input-group-text bg-warning text-white">{{$selectfiles['total']}}</span>        
                                    @else    
                                    <span class="input-group-text bg-success text-white">{{$selectfiles['total']}}</span>       
                                @endif  
                            @endif    
                               
                            </div>                           
                            <select class="select2" name="fileslog" id="fileslog" aria-placeholder="dsd"  style="width: max-content">
                              
                                @foreach ($selectfiles['archivos'] as $file)
                                <option value="{{$file['value']}}">{{$file['name']}}</option>     
                                @endforeach                               
                    
                              </select>
                              <div class="input-group-append">
                                @if($selectfiles['error'])
                                <button class="btn btn-primary btn-icon" disabled type="button"><i class="fa fa-upload" aria-hidden="true"></i></button>
                                @else
                                @if($selectfiles['nuevos'])
                                <button class="btn btn-primary btn-icon"type="button" onclick="import_archivos();"><i class="fa fa-upload" aria-hidden="true"></i></button>   
                                @else 
                                <div class="input-group-append">
                                    <button class="btn btn-primary btn-icon" disabled type="button"><i class="fa fa-upload" aria-hidden="true"></i></button>
                                </div>
                            @endif  
                        @endif   
                            </div>
                        </div>
                        <span class="form-text text-muted">
                            @if($selectfiles['error'])
                            <span class="text-danger">  Error al leer los archivos </span>        
                            @else
                                @if($selectfiles['nuevos'])        
                                <span class="text-warning">    Archivos nuevos encontrados </span> 
                                @else
                                <span class="text-success">    No se encontraron nuevos archivos </span> 
                                @endif  
                            @endif 
                        </span>
                                    
                </div>
            </div>

        </div>
    </div>
    <div class="kt-portlet__body">
        <div class="container">
            <div class="row">
              <div class="col-sm">
                <label for="servidores" class="form-label">Proxy</label>
                <select class="select2 form-control" name="servidores" id="servidores" aria-placeholder="servidores"  style="width: max-content">                             
                    <option value="1">195.82</option>                  
                  </select>
              </div>
              <div class="col-sm">
                <label for="servidores" class="form-label">Edificio</label>
                <select class="select2 form-control" name="edificio" id="edificio" aria-placeholder="servidores"  style="width: max-content">                             
                    <option value="1">lavista</option>                  
                </select>
              </div>
              <div class="col-sm">
                <label for="servidores" class="form-label">Categoria</label>
                <select class="select2 form-control" name="edificio" id="categoria" aria-placeholder="categoria"  style="width: max-content">                             
                    <option value="1">lavista</option>                  
                </select>
              </div>
              <div class="col-sm">
                <div class="checkbox-inline">
                    <label class="checkbox checkbox-outline checkbox-success">
                        <input type="checkbox" name="Checkboxes15"/>
                        <span></span>
                        Default
                    </label>
                    <label class="checkbox checkbox-outline checkbox-success">
                        <input type="checkbox" name="Checkboxes15" checked="checked" />
                        <span></span>
                        Checked
                    </label>
                    <label class="checkbox checkbox-outline checkbox-success checkbox-disabled">
                        <input type="checkbox" name="Checkboxes15" disabled="disabled"/>
                        <span></span>
                        Disabled
                    </label>
                </div>
                <span class="form-text text-muted">Some help text goes here</span>
            </div>
            </div>
          </div>  

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
        <table class="table table-bordered table-striped" id="table-logs">
            <thead>
                <tr>
                    <th></th>
                    <th>ver mas</th>
                    <th>servidor</th>
                    <th>fecha</th>              
                    <th>ip</th>
                    <th>url</th>  
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
            let dataRegla = "{{ route('logs_red.dataLogs')}}";
            let importfile = "{{ route('logs_red.dataLogs.import') }}";
            
            let reglaCreate = "{{ route('reglas.create') }}";
            let reglaStore = "{{ route('reglas.store') }}";
            let reglasEstado = "{{ route('reglas.dataEstado', ['estado' => '']) }}";
            let updateInactiva = "{{ route('reglas.updateInactivas') }}";
          
        </script>
            <script src="{{ URL::asset('js/rev_logs_red/logs.js')}}" type="text/javascript"></script>
        @endsection
@endsection
