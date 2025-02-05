<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;

use Illuminate\Support\Facades\DB;
use App\Models\EscuelaIngles\Lecciones;
use App\Models\EscuelaIngles\SeccionesPagina;
use App\Models\EscuelaIngles\PaginaLeccion;
use App\Models\EscuelaIngles\NivelesIngles;
use Illuminate\Support\Facades\Validator;
class CursosController extends Controller
{
    //




     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexNivelView()
    {

        $id = Auth::user()->id;
        return view('cursos.listar_niveles', compact("id"));    
    }

       /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function niveles_data(Request $request)
    {
        try {
            if ($request->ajax()) {
                
                
                if(Auth::user()->hasRole('SuperAdmin')){
                    $data = NivelesIngles::all();
                }else{
                    $id = Auth::user()->id;
                    $data = DB::table('niveles_ingles_users')->distinct()->
                    rightJoin('niveles_ingles','niveles_ingles_users.enrol_nivel_ingles', '=', 'niveles_ingles.id_nivel_ingles')->where('niveles_ingles_users.id_user',$id)->get();
                }
                    

                      
                  
                    return Datatables::of($data)->toJson();
            }
        } catch (\Exception $e) {
            return $response = array('success' => false, 'body' => null, "respuesta" => ["code" => "niveles_data-1", "msg" => "Ocurrio un error"] , "codigo_estatus" => 500);
        }  
    }


        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createNivelPage()
    {
        try {
             
                return view('modals/cursos/add_edit_nivel');  

        } catch (\Exception $th) {
            $response = array('success' => false, 'body' => null, "respuesta" => ["code" => "dispositivo-2", "msg" => "Ocurrio un error"] , "codigo_estatus" => 500);
        }

       return $response;
    }


        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit_nivel(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_nivel_ingles'          => 'required'
        ]);
        
        if ($validator->fails()) {
            return $response = array('success' => false, 'body' => null, "respuesta" => ["code" => "edit_nivel-1", "msg" => "Estas mandando incompleta la infomarcion " ], "codigo_estatus" => 406);
        }

        try {
            $nivelData = NivelesIngles::find($request->id_nivel_ingles);
            if (!is_null($nivelData)) {

              

                return view('modals/cursos/add_edit_nivel', compact('nivelData'));  
                
            }else{
               $response = array('success' => false, 'body' => null, "respuesta" => ["code" => "edit_nivel-3", "msg" => "No encontramos el nivel que buscas"] , "codigo_estatus" => 404);
            }            
              
        } catch (\Exception $th) {
            $response = array('success' => false, 'body' => null, "respuesta" => ["code" => "edit_nivel-2", "msg" => "Ocurrio un error al abrir el nivel, Intentalo mas Tarde"] , "codigo_estatus" => 500);
        }

       return $response;
    }





    /****************************************************************/
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexLeccionView($id_nivel)
    {
        $id = $id_nivel;
        return view('cursos.listar_lecciones',compact("id"));    
    }


    public function lecciones_data($id_nivel_ingles)
    {
        try {
          
                    $data =  Lecciones::leftJoin('pagina_leccion','pagina_leccion.clv_leccion', '=', 'leccion.id_leccion')->
                                        where('clv_nivel_ingles',$id_nivel_ingles)->
                    get();
                    return Datatables::of($data)->toJson();
            
        } catch (\Exception $e) {
            return $response = array('success' => false, 'body' => null, "respuesta" => ["code" => "empleados-1", "msg" => "Ocurrio un error"] , "codigo_estatus" => 500);
        }
    }


      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexPaginaSecciones($id_leccion)
    {

        $id = $id_leccion;
        return view('cursos.listar_seccion_pagina', compact("id"));    
    }


    public function secciones_page_data($id_leccion)
    {
        try {

            $paginaLeccionData = PaginaLeccion::where('clv_leccion',$id_leccion)->first();
           
            
            $data =  SeccionesPagina::where('clv_pagina_leccion',$paginaLeccionData->id_pagina_leccion)->
            get();

                    return Datatables::of($data)->toJson();
        } catch (\Exception $e) {
            return $response = array('success' => false, 'body' => null, "respuesta" => ["code" => "empleados-1", "msg" => "Ocurrio un error"] , "codigo_estatus" => 500);
        }

    }




    /*CRUD DE LECCIONES Y SECCIONES PAGE */


        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createLeccion()
    {
        try {
          
            return view('modals/cursos/add_edit_leccion');     
        } catch (\Exception $th) {
            $response = array('success' => false, 'body' => null, "respuesta" => ["code" => "dispositivo-2", "msg" => "Ocurrio un error, Intentalo mas Tarde"] , "codigo_estatus" => 500);
        }

       return $response;
    }

        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createSeccionPage($id_leccion)
    {
        try {
             
            
            $paginaLeccionData = PaginaLeccion::where('clv_leccion',$id_leccion)->first();
            if (!is_null($paginaLeccionData)) {

                $paginaLeccion =  $paginaLeccionData->id_pagina_leccion;
                return view('modals/cursos/add_edit_seccion_page', compact('paginaLeccion'));  
                
            }else{
               $response = array('success' => false, 'body' => null, "respuesta" => ["code" => "edit_leccion-3", "msg" => "No encontramos la leccion que buscas"] , "codigo_estatus" => 404);
            }  
        } catch (\Exception $th) {
            $response = array('success' => false, 'body' => null, "respuesta" => ["code" => "dispositivo-2", "msg" => "Ocurrio un error"] , "codigo_estatus" => 500);
        }

       return $response;
    }





    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit_leccion(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_leccion'          => 'required'
        ]);
        
        if ($validator->fails()) {
            return $response = array('success' => false, 'body' => null, "respuesta" => ["code" => "edit_leccion-1", "msg" => "Estas mandando incompleta la infomarcion" ], "codigo_estatus" => 406);
        }

        try {
            $leccionData = Lecciones::find($request->id_leccion);
            if (!is_null($leccionData)) {

                $paginaLeccionData = PaginaLeccion::where('clv_leccion',$request->id_leccion)->first();

                return view('modals/cursos/add_edit_leccion', compact('leccionData','paginaLeccionData'));  
                
            }else{
               $response = array('success' => false, 'body' => null, "respuesta" => ["code" => "edit_leccion-3", "msg" => "No encontramos la leccion que buscas"] , "codigo_estatus" => 404);
            }            
              
        } catch (\Exception $th) {
            $response = array('success' => false, 'body' => null, "respuesta" => ["code" => "edit_leccion-2", "msg" => "Ocurrio un error al abrir la leccion, Intentalo mas Tarde"] , "codigo_estatus" => 500);
        }

       return $response;
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit_SeccionPage(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_seccion_pagina'          => 'required'
        ]);
        
        if ($validator->fails()) {
            return $response = array('success' => false, 'body' => null, "respuesta" => ["code" => "edit_SeccionPage-1", "msg" => "Estas mandando incompleta la infomarcion " ], "codigo_estatus" => 406);
        }

        try {
            $seccionPaginaData = SeccionesPagina::find($request->id_seccion_pagina);
            if (!is_null($seccionPaginaData)) {

                return view('modals/cursos/add_edit_seccion_page', compact('seccionPaginaData'));  
                
            }else{
               $response = array('success' => false, 'body' => null, "respuesta" => ["code" => "edit_SeccionPage-3", "msg" => "No encontramos la secccion que buscas"] , "codigo_estatus" => 404);
            }            
              
        } catch (\Exception $th) {
            $response = array('success' => false, 'body' => null, "respuesta" => ["code" => "edit_SeccionPage-2", "msg" => "Ocurrio un error al abrir la seccion, Intentalo mas Tarde"] , "codigo_estatus" => 500);
        }

       return $response;
    }




    /*INSERTAR VALORES */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


     public function store_leccion(Request $request)
     {
         $validation = Validator::make($request->all(), [
             'titulo_leccion' => 'required',
             'descripcion' => 'required',
             'titulo' => 'required',
             'link_video_frame' => 'required',
             'link_cuestonario' => 'required',
             'enrol_nivel_ingles' => 'required',
         ]);
     
         if ($validation->fails()) {
             return response()->json([
                 'success' => false,
                 'message' => 'La información enviada está incompleta o inválida.',
                 'errors' => $validation->errors()->all(),
             ], 422);
         }
     
         try {
            
             $clv_nivel_ingles = $request->enrol_nivel_ingles;
             if ($request->has('id_leccion')) {
                // Si existe id_leccion en la solicitud, actualiza la lección existente
                $leccion = Lecciones::updateOrCreate(
                    [
                        'id_leccion' => $request->id_leccion,
                    ],
                    [
                        'titulo_leccion' => $request->titulo_leccion,
                        'descripcion' => $request->descripcion,
                        'clv_nivel_ingles' => $clv_nivel_ingles,
                    ]
                );
            } else {
                // Si no existe id_leccion en la solicitud, crea una nueva lección
                $leccion = Lecciones::create([
                    'titulo_leccion' => $request->titulo_leccion,
                    'descripcion' => $request->descripcion,
                    'clv_nivel_ingles' => $clv_nivel_ingles,
                ]);
            }
            

           
            $paginaLeccionData = PaginaLeccion::where('clv_leccion',$request->id_leccion)->first();
            // Verifica si la lección fue creada o actualizada
            if (!$leccion->wasRecentlyCreated && !is_null($paginaLeccionData)) {
                // Si no fue creada recientemente, significa que ya existía
                $message = 'La lección ya estaba creada anteriormente.';
                $code = 'store_leccion-4';
            } else {
                // Si fue creada recientemente, guarda la información adicional
                PaginaLeccion::create([
                    'clv_leccion' => $leccion->id_leccion,
                    'link_video_frame' => $request->link_video_frame,
                    'link_cuestonario' => $request->link_cuestonario,
                    'titulo' => $request->titulo,
                ]);
            
                $message = 'La petición se completó correctamente.';
                $code = 'store_leccion-3';
            }
            
     
             $response = array('success' => true, 'body' => null, "respuesta" => ["code" => $code, "msg" => $message] , "codigo_estatus" => 200);
             return $response;
     
         } catch (\Exception $th) {

           return  $response = array('success' => false, 'body' => null, "respuesta" => ["code" => "edit_SeccionPage-2", "msg" => "Ocurrio un error".$th] , "codigo_estatus" => 500);
         }
     }
     



    
    /*INSERTAR VALORES */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


     
     public function store_seccion_leccion(Request $request)
     {
         $validation = Validator::make($request->all(), [
             'descripcion_imagen' => 'required',
             'contenido' => 'required',
         ]);
     
         if ($validation->fails()) {
             return response()->json([
                 'success' => false,
                 'message' => 'La información enviada está incompleta o inválida.',
                 'errors' => $validation->errors()->all(),
             ], 422);
         }
     
         try {
            if ($request->hasFile('imagen')) {
                $imagen = $request->file('imagen');
                $nombreImagen = time() . '_' . $imagen->getClientOriginalName();
                // Guardar la imagen en el almacenamiento
                $rutaImagen = $imagen->storeAs('public/ruta/de/almacenamiento', $nombreImagen);
                // Obtener la URL de la imagen para guardar en la base de datos
                $urlImagen = url('storage/ruta/de/almacenamiento/' . $nombreImagen);
            } else {
                // Si no se ha enviado una nueva imagen, mantener la misma URL de imagen
                $urlImagen = $request->input('imagen'); // Suponiendo que 'imagen_url' es el nombre del campo oculto que contiene la URL de la imagen actual
            }
    
            // Determinar si es una creación o una actualización
            if (!$request->has('clv_pagina_leccion')) {
                // Actualización
                $seccionPagina = SeccionesPagina::findOrFail($request->id_seccion_pagina);
                $seccionPagina->update([
                  
                    'imagen' => $urlImagen,
                    'descripcion_imagen' => $request->descripcion_imagen,
                    'contenido' => $request->contenido,
                ]);
                $message = 'El contenido se actualizó correctamente.';
                $code = 'update_seccion_pagina';
            } else {
                // Creación
                $seccionPagina = SeccionesPagina::create([
                    'clv_pagina_leccion' => $request->clv_pagina_leccion,
                    'imagen' => $urlImagen,
                    'descripcion_imagen' => $request->descripcion_imagen,
                    'contenido' => $request->contenido,
                ]);
                $message = 'El contenido se creó correctamente.';
                $code = 'store_seccion_pagina';
            }
    
     
            $response = array('success' => true, 'body' => null, "respuesta" => ["code" => $code, "msg" => $message] , "codigo_estatus" => 200);
            return $response;
     
         } catch (\Exception $th) {
            return  $response = array('success' => false, 'body' => null, "respuesta" => ["code" => "edit_SeccionPage-2", "msg" => "Ocurrio un error". $th] , "codigo_estatus" => 500);
         }
     }
     



     
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


     public function store_nivel(Request $request)
     {
         $validation = Validator::make($request->all(), [
             'nombre_nivel' => 'required',
           
         ]);
     
         if ($validation->fails()) {
             return response()->json([
                 'success' => false,
                 'message' => 'La información enviada está incompleta o inválida.',
                 'errors' => $validation->errors()->all(),
             ], 422);
         }
     
         try {
            
             if ($request->has('id_nivel_ingles')) {
                // Si existe id_leccion en la solicitud, actualiza la lección existente
                $nivel = NivelesIngles::updateOrCreate(
                    [
                        'id_nivel_ingles' => $request->id_nivel_ingles,
                    ],
                    [
                        'nombre_nivel' => $request->nombre_nivel,
                        
                       
                    ]
                );
            } else {
                // Si no existe id_leccion en la solicitud, crea una nueva lección
                $nivel = NivelesIngles::create([
                    'nombre_nivel' => $request->nombre_nivel,
                 
                ]);
            }
            
          
            // Verifica si la lección fue creada o actualizada
            if ($nivel->wasRecentlyCreated) {
                $message = 'Creado correctamente.';
                $code = 'store_leccion-3';
                
            } else {
                $message = 'El nivel se actualizo correctamente.';
                $code = 'store_leccion-4';
            
              
            }
            
     
             $response = array('success' => true, 'body' => null, "respuesta" => ["code" => $code, "msg" => $message] , "codigo_estatus" => 200);
             return $response;
     
         } catch (\Exception $th) {

           return  $response = array('success' => false, 'body' => null, "respuesta" => ["code" => "edit_SeccionPage-2", "msg" => "Ocurrio un error".$th] , "codigo_estatus" => 500);
         }
     }





     
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function borradoNivel(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id'          => 'required'
        ]);
        
        if ($validator->fails()) {
            return $response = array('success' => false, 'body' => null, "respuesta" => ["code" => "borradoNivel-1", "msg" => "Estas mandando incompleta la infomarcion " ], "codigo_estatus" => 406);
        }

        try {
            $data = NivelesIngles::find($request->id);

            if ($data) {
               
                $cantidad =  Lecciones::where('clv_nivel_ingles',$request->id)->count();
                if( $cantidad > 0){
                    $response = array('success' => false, 'body' => null, "respuesta" => ["code" => "borradoNivel-5", "msg" => "Elimina las lecciones primero para poder borrar"] , "codigo_estatus" => 404);
                }else{
                    DB::table('niveles_ingles_users')->where('enrol_nivel_ingles', $request->id)->delete();

                    $data->delete();
                    // Éxito: El registro ha sido eliminado
                    $response = array('success' => true, 'body' => null, "respuesta" => ["code" => "borradoNivel-4", "msg" => "Se borro correctamente"] , "codigo_estatus" => 200);
                }


              
            } else {
                // El registro no fue encontrado
                $response = array('success' => false, 'body' => null, "respuesta" => ["code" => "borradoNivel-3", "msg" => "No encontramos la secccion que buscas"] , "codigo_estatus" => 404);
            }

        } catch (\Exception $th) {
            $response = array('success' => false, 'body' => null, "respuesta" => ["code" => "borradoNivel-2", "msg" => "Ocurrio un error al eliminar un elemento, Intentalo mas Tarde " .$th] , "codigo_estatus" => 500);
        }

       return $response;
    }



     
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function borradoLeccion(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id'          => 'required'
        ]);
        
        if ($validator->fails()) {
            return $response = array('success' => false, 'body' => null, "respuesta" => ["code" => "borradoLeccion-1", "msg" => "Estas mandando incompleta la infomarcion " ], "codigo_estatus" => 406);
        }

        try {
            $data = Lecciones::find($request->id);

            if ($data) {

                $data2 = PaginaLeccion::where('clv_leccion',$data->id_leccion)->first();

                if(is_null($data2)){
                    $data->delete();
                    return $response = array('success' => true, 'body' => null, "respuesta" => ["code" => "borradoLeccion-4", "msg" => "Se borro correctamente"] , "codigo_estatus" => 200);
                }

              
                $cantidad =  SeccionesPagina::where('clv_pagina_leccion',$data2->id_pagina_leccion)->count();
                
                if( $cantidad > 0){
                    $response = array('success' => false, 'body' => null, "respuesta" => ["code" => "borradoLeccion-6", "msg" => "Elimina los contenidos de tu lección primero"] , "codigo_estatus" => 404);
                }else{
                    $data2->delete();
                    $data->delete();
                    
                    $response = array('success' => true, 'body' => null, "respuesta" => ["code" => "borradoLeccion-5", "msg" => "Se borro correctamente"] , "codigo_estatus" => 200);
                }
                
                
               
                // Éxito: El registro ha sido eliminado
               
            } else {
                // El registro no fue encontrado
                $response = array('success' => false, 'body' => null, "respuesta" => ["code" => "borradoLeccion-3", "msg" => "No encontramos la secccion que buscas"] , "codigo_estatus" => 404);
            }

        } catch (\Exception $th) {
            $response = array('success' => false, 'body' => null, "respuesta" => ["code" => "borradoLeccion-2", "msg" => "Ocurrio un error al eliminar un elemento, Intentalo mas Tarde" ] , "codigo_estatus" => 500);
        }

       return $response;
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function borradoSeccionesPagina(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id'          => 'required'
        ]);
        
        if ($validator->fails()) {
            return $response = array('success' => false, 'body' => null, "respuesta" => ["code" => "borradoSeccionesPagina-1", "msg" => "Estas mandando incompleta la infomarcion " ], "codigo_estatus" => 406);
        }

        try {
            $data = SeccionesPagina::find($request->id);

            if ($data) {

               

                if(!is_null($data)){
                   

                    $data->delete();
                    $response = array('success' => true, 'body' => null, "respuesta" => ["code" => "borradoSeccionesPagina-5", "msg" => "Se borro correctamente"] , "codigo_estatus" => 200);
                   
                }else{
                    $response = array('success' => false, 'body' => null, "respuesta" => ["code" => "borradoSeccionesPagina-4", "msg" => "No encontramos la secccion que buscas"] , "codigo_estatus" => 404);
                }
               
                // Éxito: El registro ha sido eliminado
               
            } else {
                // El registro no fue encontrado
                $response = array('success' => false, 'body' => null, "respuesta" => ["code" => "borradoSeccionesPagina-3", "msg" => "No encontramos la secccion que buscas"] , "codigo_estatus" => 404);
            }

        } catch (\Exception $th) {
            $response = array('success' => false, 'body' => null, "respuesta" => ["code" => "borradoSeccionesPagina-2", "msg" => "Ocurrio un error al eliminar un elemento, Intentalo mas Tarde " .$th] , "codigo_estatus" => 500);
        }

       return $response;
    }



    
}
