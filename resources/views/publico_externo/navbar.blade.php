@inject('menuItems', 'App\Models\EscuelaIngles\NivelesIngles')
<link rel="stylesheet" href="{{asset('assets/css/style1.css')}}">

<<nav class="navbar navbar-inverse navbar-fixed-top"> 
    <div class="container-fluid">
      <div class="navbar-header">
        <img tabindex="1" src="{{asset('img/logo-unam-png-blanco-ok.png')}}" alt="Escudo Universidad Autonoma Nacional de Mexico UNAM" width="120px" >
        <img tabindex="1" src="{{asset('img/fes-aragon-logo.png')}}" alt="Escudo FES Aragon" width="80px" >

      </div>
      <ul class="nav navbar-nav">
        <li ><a tabindex="1" href="{{ url('') }}" style="color: white">Inicio</a></li>
        <li class="dropdown">
            <a tabindex="1" class="dropdown-toggle" data-toggle="dropdown" href="#"  role="button" aria-haspopup="true" aria-expanded="false" style="color: white">Niveles
            <span class="caret"></span></a>
            <ul class="dropdown-menu">

                @foreach($menuItems::all() as $menuItem)
                <li>
                    <a tabindex="1" href="{{ route('paginaexterna.lecciones', ['id_nivel_ingles' => $menuItem->id_nivel_ingles]) }}" style="font-size: 2rem">{{ $menuItem->nombre_nivel }}</a>
                </li>
                @endforeach
        
            </ul>
          </li>
          
      </ul>
      <img class="enes" tabindex="1" src="{{asset('img/enes-morelia.png')}}" alt="Escudo ENES Morelia" width="80px" >
        <a href="{{ route('paginaexterna.index.general') }}">
          <img class="caam" tabindex="1" src="{{asset('img/caam.png')}}" alt="Escudo Centro de Auto Acceso y Mediateca" width="180px" >
        </a>

   </div>
   
</nav>