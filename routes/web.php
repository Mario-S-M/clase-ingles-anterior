<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();
Route::resource('roles', 'RoleController');

/*Route::resource('users', 'UserController');
Route::resource('permissions', 'PermissionController');*/

//Roles y Permisos
Route::group(['prefix'=>'admin'],function (){
  Route::group(['middleware' => ['permission:MenuRoles']], function() {
    //Route::get('/listar_roles', 'RoleController@listar_roles');
    Route::get('/listar_roles', 'AdminController@listar_roles');
    Route::get('/data_listar_roles', 'AdminController@data_listar_roles');
    Route::get('/roles/{id}/editar_roles_permisos', 'RoleController@editar_roles_permisos');
  });
});


Route::post('/login', 'Auth\LoginController@login');
Route::get('/register/verify/{code}', 'Auth\LoginController@verify');
Route::post('/register', 'Auth\RegisterController@create')->name('create');
Route::post('/passReset', 'Auth\ResetPasswordController@resetPassword');
Route::get('/validator/{id}', 'Auth\RegisterController@validator')->name('validator');
Route::post('/password/reset', 'Auth\ResetPasswordController@reset');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/condTerminos', 'HomeController@condTerminos')->name('condTerminos');
Route::post('/passReset', 'Auth\ForgotPasswordController@sendResetLinkEmail');
Route::post('/passForgot', 'Auth\ForgotPasswordController@validateEmail')->name('passReset');
Route::post('/passUpdate', 'Auth\ForgotPasswordController@updatePass')->name('updatePass');
Route::get('/forgot/verify/{id}', 'Auth\ForgotPasswordController@validateTokenPassReset')->name('forgotPassW');
Route::get('/passModal', 'Auth\ForgotPasswordController@');




 //Usuarios
 //editar usuarios
Route::group(['prefix' => 'users'], function() {
  Route::get('/profile', 'UserController@profile');
  Route::get('/index', 'UserController@index');
  Route::post('/updatePassword', 'UserController@updatePassword');
  Route::post('/validPassword', 'UserController@validPassword');
  Route::post('/validUser', 'Auth\RegisterController@validUser');
  Route::post('/validEmail', 'Auth\RegisterController@validEmail');
  Route::post('/editUser', 'UserController@editUser');
});
 //Administrador
 Route::group(['middleware' => ['role:SuperAdmin']], function() {
  //editar usuarios
  Route::group(['prefix' => 'admin'], function() {
    Route::get('/', 'AdminController@dashboard');
    Route::get('/index', 'AdminController@index');
    Route::get('/listar_usuarios', 'AdminController@listar_usuarios');
    // Route::get('/listar_roles', 'AdminController@listar_roles');
    Route::get('/data_listar_usuarios', 'AdminController@data_listar_usuarios');
    Route::get('/data_listar_roles', 'AdminController@data_listar_roles');
    Route::get('/create', 'AdminController@create');
    Route::get('/edit', 'AdminController@edit');
    Route::post('/store', 'AdminController@store');
    Route::post('/update', 'AdminController@update');
  });
  Route::group(['prefix' => 'rol'], function() {
    });
});
Route::resource('files', 'FileController');
//Route::get('/files/show', 'FileController@show');
/*Route::get('test', function() {
  dd(DB::connection()->getPdo());
});*/
Route::get('/block_screen', function () {
  return view('usuarios/block_screen');
});
Route::post('/block_screen', function () {
    return response()
    ->json(['status' => 'true']);
});
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

Route::group(['prefix' => 'admin'], function() {


  //Logs
  Route::resource('/log_red_saf','RevLogsInternet\LogInternetViewerController');
  Route::get('/data/log_red_saf','RevLogsInternet\LogInternetViewerController@dataLogs')->name('logs_red.dataLogs');
  Route::get('/data/import/log_red_saf','RevLogsInternet\LogInternetViewerController@importfile')->name('logs_red.dataLogs.import');


  Route::get('log_internet', 'RevLogsInternet\LogInternetViewerController@index2');

  Route::get('log', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');



  Route::resource('/cat_accion', 'CatAccionController');
  Route::get('/data/cat_accion', 'CatAccionController@dataAccion')->name('cat_accion.dataAccion');
  Route::resource('/cat_direccion', 'CatDireccionController');
  Route::get('/data/cat_direccion', 'CatDireccionController@dataDireccion')->name('cat_direccion.dataDireccion');
  Route::resource('/cat_estatus_regla', 'CatEstatusReglaController');
  Route::get('/data/cat_estatus_regla', 'CatEstatusReglaController@dataEstatusRegla')->name('cat_estatus_regla.dataEstatusRegla');
  Route::resource('/cat_estatus', 'CatEstatusController');
  Route::get('/data/cat_estatus', 'CatEstatusController@dataEstatus')->name('cat_estatus.dataEstatus');
  Route::resource('/cat_tipo_correo', 'CatTipoCorreoController');
  Route::get('/data/cat_tipo_correo', 'CatTipoCorreoController@dataTipoCorreo')->name('cat_tipo_correo.dataTipoCorreo');
  Route::resource('/reglas','ReglaController');
  Route::get('/data/reglas','ReglaController@dataReglas')->name('reglas.dataRegla');
  
  Route::get('/regla/grafica_estatus','ReglaController@graficaEstatus')->name('reglas.graficaEstatus');
  Route::get('/regla/grafica_usuarios','ReglaController@graficaUsuarios')->name('reglas.graficaUsuarios');
  Route::get('/regla/ultimos_logs','ReglaController@logs')->name('reglas.ultimosLogs');
  Route::get('/regla/ultimas_reglas','ReglaController@ultimasReglas')->name('reglas.ultimasReglas');
  Route::get('/regla/import/view', 'ReglaController@importView')->name('reglas.importView');
  Route::post('/regla/import','ReglaController@importReglas')->name('reglas.importReglas');
  Route::get('/regla/{estado}','ReglaController@reglasEstado')->name('reglas.reglasEstado');
  Route::get('/data/regla/{estado?}','ReglaController@dataEstado')->name('reglas.dataEstado');
  Route::post('/reglas/update/inactivas', 'ReglaController@updateInactivas')->name('reglas.updateInactivas');
  Route::resource('/logs','LogReglaController');
  Route::get('/data/logs','LogReglaController@dataLogs')->name('logs.dataLogs');
});

/***************************************************************/
/*****************RUTAS DEL NUEVO SISTEMAS********************** */
/*
Route::get('/', function () {
  return redirect('/inicio');
 
});*/


Route::get('/','PublicoExternoController@indexHomePagina')
->name('paginaexterna.index');

Route::get('/lecciones/{id_nivel_ingles}','PublicoExternoController@viewLeccionId')
->name('paginaexterna.lecciones');


Route::get('/leccion_page/{id_leccion}','PublicoExternoController@viewPageLeccionId')
->name('paginaexterna.leccion_page');




Route::get('/administrador', function () {
  if (Auth::check()){
    if( Auth::user()->hasRole('admin') || Auth::user()->hasRole('SuperAdmin')){
      return redirect('/admin');
    }
    else{
      return redirect('/home');
    }
  }
  else{
    return redirect('/login');
  }
})->name('paginaexterna.index.general');

Route::group(['middleware' => ['role:SuperAdmin|Maestros']], function() {
  //editar usuarios
  Route::group(['prefix' => 'cursos'], function() {

    //VISTA DE EMPLEADOS

    
  /*ELIMINAR DATOS */

  Route::post('/delete-nivel', 'CursosController@borradoNivel')->name('delete.nivel');


  Route::post('/delete-leccion', 'CursosController@borradoLeccion')->name('delete.leccion');


  Route::post('/delete-seccion', 'CursosController@borradoSeccionesPagina')->name('delete.seccion');
    


    Route::get('/niveles','CursosController@indexNivelView')
    ->name('cursos.nivel.index');


    Route::get('/niveles-data','CursosController@niveles_data')
    ->name('cursos.nivel.data');


    Route::get('/create-nivel','CursosController@createNivelPage')
    ->name('create.nivel');
    
    
    
    Route::get('/edit-nivel','CursosController@edit_nivel')
    ->name('edit.nivel');


    Route::post('/store-nivel', 'CursosController@store_nivel')->name('store.nivel');

    


    Route::get('/lecciones/{id_nivel_ingles}','CursosController@indexLeccionView')
    ->name('cursos.lecciones.index');


    Route::get('/lecciones-data/{id_nivel_ingles}','CursosController@lecciones_data')
    ->name('cursos.lecciones.data');


    Route::get('/seccion-pagina/{id_nivel_ingles}','CursosController@indexPaginaSecciones')
    ->name('cursos.seccion.pagina.index');

    Route::get('/seccion-pagina-data/{id_nivel_ingles}','CursosController@secciones_page_data')
    ->name('cursos.seccion.pagina.data');



    Route::get('/create-leccion','CursosController@createLeccion')
    ->name('create.leccion');

    Route::get('/create-seccion-pagina/{id_leccion}','CursosController@createSeccionPage')
    ->name('create.seccion.pagina');



    Route::get('/edit-leccion','CursosController@edit_leccion')
    ->name('edit.leccion');

    Route::get('/edit-seccion-pagina','CursosController@edit_SeccionPage')
    ->name('edit.seccion.pagina');



 
  Route::post('/store-leccion', 'CursosController@store_leccion')->name('store.leccion');

  Route::post('/create-seccion-pagina', 'CursosController@store_seccion_leccion')->name('store.seccion.pagina');


    
    


    Route::get('/listar-empleados','Pasedelista\EmpleadosController@indexEmpleados')
    ->name('pasedelista.listar.empleados');

    Route::get('/listar-empleados-data','Pasedelista\EmpleadosController@empleados_data')
    ->name('pasedelista.listar.empleados.data');

    Route::get('/empleado-create','Pasedelista\EmpleadosController@createEmpleado')
    ->name('pasedelista.crear.empleado');

    Route::post('/empleado-guardar','Pasedelista\EmpleadosController@store_empleado')
    ->name('pasedelista.guardar.empleado');

    Route::get('/empleado-edit','Pasedelista\EmpleadosController@editEmpleado')
    ->name('pasedelista.edit.empleado');

    Route::post('/empleado-actualizar','Pasedelista\EmpleadosController@update_empleados')
    ->name('pasedelista.actualizar.empleado');




  
  
  });
 
});

