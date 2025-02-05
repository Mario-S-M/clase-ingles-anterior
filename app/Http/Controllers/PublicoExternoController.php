<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;
use App\Models\Checador\Checador;
use Illuminate\Support\Facades\DB;

use App\Models\EscuelaIngles\Lecciones;
use App\Models\EscuelaIngles\NivelesIngles;
use App\Models\EscuelaIngles\PaginaLeccion;
use App\Models\EscuelaIngles\SeccionesPagina;

class PublicoExternoController extends Controller
{
    //

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexHomePagina()
    {
        //dd("prueba");
        return view('publico_externo.home');    
    }


    public function viewLeccionId($id_nivel_ingles)
    {
        //dd("prueba");
        $nivel = NivelesIngles::where('id_nivel_ingles',$id_nivel_ingles)->first();
        $data = Lecciones::where('clv_nivel_ingles',$id_nivel_ingles)->get();
        return view('publico_externo.lecciones', compact("data","nivel"));    
    }


    public function viewPageLeccionId($id_leccion)
    {
        //dd("prueba");
        $paginaLeccion = PaginaLeccion::where('clv_leccion',$id_leccion)->first();
        $secciones = [];
        if(! is_null($paginaLeccion)){
            $secciones = SeccionesPagina::where('clv_pagina_leccion',$paginaLeccion->id_pagina_leccion)->get();
        }
        
        return view('publico_externo.paginaLeccion', compact("secciones","paginaLeccion"));    
    }
}
