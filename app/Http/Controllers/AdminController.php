<?php

namespace App\Http\Controllers;

use App\Models\ModelHasRole;
use App\Requests\UserRequest;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Yajra\Datatables\Datatables;
use App\Models\EscuelaIngles\NivelesIngles;
class AdminController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $datos = User::where('id', auth()->user()->id)->get();
        return view('usuarios.perfil', compact('datos'));
    }

    public function dashboard()
    {
      $perfil = Auth::user()->hasAnyRole(['SuperAdmin', 'Admin']);
    
      if($perfil == true){
          return view('admin.dashboard')->with([
            'regla' => null,
            'log' => null
          ]);
      }
      else {
        return view('/home');
      }

    }

    public function create() {
      $roles = DB::table('roles')->get();
      $niveles = NivelesIngles::get();
      return view('modals/users/add_user', compact('niveles'))->with('roles', $roles);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\usuarios\Users  $users
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $id = $request->id;
        $datosRoles = User::getRol($id);
        $roles = DB::table('roles')->get();


        $user = User::find($id);
        $niveles = NivelesIngles::get();

       $nivelesUser = DB::table('niveles_ingles_users')
                    ->rightJoin('niveles_ingles', 'niveles_ingles_users.enrol_nivel_ingles', '=', 'niveles_ingles.id_nivel_ingles')
                    ->where('niveles_ingles_users.id_user', '=', $id)
                    ->distinct()
                    ->get();
        return view('modals/users/edit_user')
            ->with(compact('user'))
            ->with(compact('datosRoles'))
            ->with(compact('roles'))
            ->with(compact('niveles'))
            ->with(compact('nivelesUser'));
    }

    /**
     * Actualizar usuario.
     *
     * @param  Request  $request
     * @param  Users  $users
     * @return Response
     */
    public function update(Request $request, User $users)
    {
        \Log::info(__METHOD__);
        try {
            $id      = $request->id_usuario;
            $id_rol  = $request->id_rol;
            $estatus = ($request->estatus_user == "on" ) ? 1 : 0;

            $users                   = User::find($id);
            $users->nombre           = $request->nombres;
            $users->apellido_paterno = $request->apellido_paterno;
            $users->usuario = $request->usuario;
            $users->apellido_materno = $request->apellido_materno;
            $users->email            = $request->correo;
            $users->estatus          = $estatus;
            $users->id_rol           = $id_rol;
          
            
            // Actualización de password
            if ($request->filled('password') && $request->filled('password2') ) {
                $password = $request->password;
                $pass2 = $request->password2;
                if ($password == $pass2) {
                    $password = Hash::make($password);
                    $users->password = $password;
                }
            }
            $users->save();
            $idUsuarioRol = DB::table('model_has_roles')->where('model_id', '=', $id)->first();
            $idUsuarioRolAnterior = $idUsuarioRol->role_id;

            ModelHasRole::where('model_id', $id)
               ->where('role_id', $idUsuarioRolAnterior)
               ->update(['role_id' => $id_rol]);

               DB::table('niveles_ingles_users')->where('id_user', $id)->delete();


               foreach ($request->seleccionados as $nivel) {
                    DB::table('niveles_ingles_users')->insert([
                        'enrol_nivel_ingles' => $nivel,
                        'id_user' => $id, // Suponiendo que tienes un campo user_id en tu formulario
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);
                }

               

            //$user->assignRole($grol->name);
            $response = ['success' => true, 'message' => 'Usuario actualizado satisfactoriamente.'];
        } catch (\Exception $th) {
          //  Bitacoras::registerError(__METHOD__, $th, 'Error al actualizar usuario (Exception).');
            $response = ['success' => false, 'message' => 'Error al actaulizar el usuario. '.$th];
        }

        return $response;
    }

    public function store(Request $request) {
           \Log::info(__METHOD__.' Crear nuevo Usuario');
           try {
            DB::beginTransaction();

            // Creamos el usuario
            $user = User::create([
                'nombre' => $request->nombre,
                'apellido_paterno' => $request->apellido_paterno,
                'apellido_materno' => $request->apellido_materno,
                'usuario' => $request->usuario,
                'password' => Hash::make($request->password), // Se utiliza Hash::make para generar un hash seguro de la contraseña
                'email' => $request->email,
            ]);
    
            // Obtenemos el ID del rol del formulario
            $id_rol = $request->id_rol;
    
            // Asignamos el rol al usuario
            $user->assignRole($id_rol);
    
            // Obtenemos el ID del rol anterior del usuario
            $idUsuarioRolAnterior = ModelHasRole::where('model_id', $user->id)->first()->role_id;
    
            // Actualizamos el registro en la tabla model_has_roles con el nuevo rol asignado
            ModelHasRole::where('model_id', $user->id)
                ->where('role_id', $idUsuarioRolAnterior)
                ->update(['role_id' => $id_rol]);
    
         
               foreach ($request->seleccionados as $nivel) {
                DB::table('niveles_ingles_users')->insert([
                    'enrol_nivel_ingles' => $nivel,
                    'id_user' => $user->id, // Suponiendo que tienes un campo user_id en tu formulario
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
                }

               $response = array('success' => true, 'message' => 'Usuario creado correctamente.');
               DB::commit();
           } catch (\Exception $th) {

               DB::rollback();
               $response = ['success' => false, 'message' => 'Error al guardar el usuario.'];
           }
           return $response;
       }

    public function listar_usuarios()
    {
        return view('usuarios.listar_usuarios');
    }

    public function data_listar_usuarios()
    {
        $users = User::select();
        return Datatables::of($users)->toJson();
    }

    public function listar_roles()
    {
        $roles = Role::all();//Get all roles
   //     return view('roles.index')->with('roles', $roles);
    return view('admin.roles.listar_roles')->with('roles', $roles);
    }

    public function data_listar_roles()
    {
      $role = Role::all();//Get all roles
      //  $permisos = =Permissions::getAllPermisos()
        //$role->permissions()->pluck('name');
     return Datatables::of($role)->toJson();
    }

    public function listar_permisos()
    {
        return view('usuarios.listar_permisos');
    }

    public function data_listar_permisos()
    {
        return Datatables::of(Permissions::getAllPermisos())
            ->toJson();
        //return view('usuarios.listar_usuarios', compact('users'));

    }

}
