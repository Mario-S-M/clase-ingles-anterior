<!DOCTYPE html>
<html lang="en">
<head>
  <title>Lecciones de Inglés ENES Morelia-CAAM</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="{{asset('assets/css/style1.css')}}">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
 

    <body>
        <div class="container">

        @include('publico_externo/navbar')
        <br><br><br>

    
        <!-- Main jumbotron for a primary marketing message or call to action -->
        <div class="jumbotron" style="margin-top: 6rem">
          <div class="container">
            <h1 tabindex="1">Bienvenido al {{$nivel->nombre_nivel}}</h1>
            <p tabindex="1" style="font-size:25px">Aquí encontraras todas las lecciones relacionadas con este nivel.</p>
          
          </div>
        </div>
    
        <div class="container">
          <!-- Example row of columns -->
          <div class="row">

            @foreach ($data as $item)
            <div class="col-md-4">
                <h2 tabindex="1" style="font-size:4rem">{{$item->titulo_leccion}}</h2>
                <p tabindex="1" style="text-align: justify; font-size:18px">{{$item->descripcion}} </p>
                <p><a  tabindex="1"class="btn btn-default" href="{{ route('paginaexterna.leccion_page', ['id_leccion' => $item->id_leccion]) }}" role="button">Iniciar Leccion</a></p>
              </div>
            @endforeach

          </div>
    
          <hr>
    
          <footer>
            <p tabindex="99">© Sitio de Lecciones para la enseñanza de la lengua Inglesa ENES Morelia - CAAM</p>
          </footer>
        </div> <!-- /container -->
    
   
      

        </div>
    
    </body>

    <script src="https://cdn.userway.org/widgetapp/2024-02-15-11-56-38/widget_app_1707998198539.js" async="" id="a11yWidgetSrc" crossorigin="anonymous" integrity="sha256-ixfZz4UezOOeixB604s+JHPfsGXSxB1H0aU43GMkTjg="></script>

</body>
</html>
