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
    <div class="navbar-wrapper">
      <div class="container">

        @include('publico_externo/navbar')

      </div>
    </div>


    <br>
    <br>
    <br>
    <br>
    
    <div class="container text-center" style="margin-top: 6rem">

      <div class="well ">
        <h1 style="font-weight: bold; font-size:5rem" tabindex="1" for="">{{ isset($paginaLeccion->titulo) ? $paginaLeccion->titulo: "No encontrado"}}</h1>
      </div>

      <br>


     
      
    
    </div>
    

    <!-- Marketing messaging and featurettes

          'titulo' => 'Esta es una prueba de la leccion 1',
            'link_video_frame' => '<iframe width="560" height="315" src="https://www.youtube.com/embed/8iLPYo9p3I0?si=OBjAquAOLCQ21MKM" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>',
            'link_cuestonario' => "https://docs.google.com/forms/d/e/1FAIpQLSe3jtwKXktHEPQQfkt0T7FtIjNgXgf7DcJpQY2F92WsbpE_eA/closedform",
            'clv_leccion' => 1,
            'created_at' => now(),
            'updated_at' => now()
    ================================================== -->
    <!-- Wrap the rest of the page in another container to center all the content. -->

    <div class="container marketing">

      @foreach ($secciones as $secc)
          <hr class="featurette-divider">
          
          

          @if(($loop->index%2)==0)


          <div>
              <div tabindex="1" style="text-align: justify">
                <p >{!! htmlspecialchars_decode($secc->contenido) !!}</p>
              </div>
            <br>
            <img tabindex="1" class="featurette-image img-responsive center-block" data-src="holder.js/500x500/auto" alt="{{ $secc->descripcion_imagen }}" src="{{$secc->imagen}}" data-holder-rendered="true" style="width: 450px">
            <!--<p tabindex="1" style="text-align: center" class="lead"> {{ $secc->descripcion_imagen }}</p>-->
          </div>


              <!--<div class="row featurette">
                <div class="col-md-7">
                 
                  <p class="lead"> {!! $secc->contenido !!}</p>
                </div>
                <div class="col-md-5">
                  <img class="featurette-image img-responsive center-block" data-src="holder.js/500x500/auto" alt="500x500" src="{{$secc->imagen}}" data-holder-rendered="true">
                  <p class="lead"> {{ $secc->descripcion_imagen }}</p>
                </div>
              </div>-->

             @else

             <br>

             <div class="row featurette">
              <div class="col-md-7 col-md-push-5">
               

                <div tabindex="1" style="text-align: justify">
                  <p >{!! htmlspecialchars_decode($secc->contenido) !!}</p>
                </div>
               
              </div>
              <div class="col-md-5 col-md-pull-7">
                <img tabindex="1" class="featurette-image img-responsive center-block" data-src="holder.js/500x500/auto" alt="{{ $secc->descripcion_imagen }}" src="{{$secc->imagen}}" data-holder-rendered="true">
                <!--<p tabindex="1" style="text-align: center" class="lead"> {{ $secc->descripcion_imagen }}</p>-->
              </div>
            </div>

             @endif
     
      @endforeach


      
      

     
    </div><!-- /.container -->

    <br>
    <br>
    <br>

    <div tabindex="1">
     <!-- {!!  isset($paginaLeccion->link_video_frame) ? $paginaLeccion->link_video_frame: "No encontrado" !!}-->
     {!! isset($paginaLeccion->link_video_frame) ? '<div style="text-align: center;">' . $paginaLeccion->link_video_frame . '</div>' : "No encontrado"!!}
    </div>

    <br>
    <br>
    <br>


    <div class="container text-center">

      <br>
      <div class="jumbotron">
       
        
          @if(isset($paginaLeccion->link_cuestonario))
              <p tabindex="1" class="lead">Realiza tu Evaluación</p>
              <p><a tabindex="1" class="btn btn-lg btn-success" target="_blank" href="{{$paginaLeccion->link_cuestonario}}" role="button">Iniciar Cuestionario</a></p>
          @endif
        </div>

        <br>

        <!-- FOOTER -->
        <footer>
          
          <p tabindex="99">© Sitio de Lecciones para la enseñanza de la lengua Inglesa ENES Morelia - CAAM</p>
        </footer>
  
    </div>

   
    <script src="https://cdn.userway.org/widgetapp/2024-02-15-11-56-38/widget_app_1707998198539.js" async="" id="a11yWidgetSrc" crossorigin="anonymous" integrity="sha256-ixfZz4UezOOeixB604s+JHPfsGXSxB1H0aU43GMkTjg="></script>

</body>
</html>
