<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Ruta archivos
    |--------------------------------------------------------------------------
    |
    | El valor retorna la ruta donde estan almacenados los archivos para de logs 
    | para que estos sean leidos
    |  
    |
    */
    'rutalogs' => env('LOGREDCONFIG_RUTALOGS', storage_path()),

];