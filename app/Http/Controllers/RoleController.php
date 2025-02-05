<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class RoleController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $roles = Role::all();
        return view('roles.index',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::all();//Get all permissions
        return view('roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'=>'required|unique:roles|max:10',
            'permissions' =>'required',
            ]
        );
        $role = new Role();
        $role->name = $request->name;
        $role->save();
        if($request->permissions <> ''){
            $role->permissions()->attach($request->permissions);
        }
        return redirect()->route('roles.index')->with('success','Roles Agregado');
    }

     public function edit($id) {
        $role = Role::findOrFail($id);
        $permissions = Permission::all();
        return view('roles.edit', compact('role', 'permissions'));
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        return redirect('admin/listar_roles');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $role = Role::findOrFail($id);//Trae el rol con el id solicitado
       // $role = Role::where('id','=',$id)->get();

        $this->validate($request, [
            'name'=>'required',
            'permissions' =>'required',
            ]);
        $input = $request->except(['permissions']);
        $permissions = $request['permissions'];

        $role->fill($input)->save();


        $p_all = Permission::all();

        foreach ($p_all as $p) {
            $role->revokePermissionTo($p);
        }
        foreach ($permissions as $permission) {
            $p = Permission::where('id', '=', $permission)->firstOrFail();
            $role->givePermissionTo($p);
            //dd($role->givePermissionTo($p));
        }
        return redirect('admin/listar_roles');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();
        return redirect()->route('roles.index')
            ->with('success',
             'Role deleted successfully!');
    }

    public function listar_roles()
    {
        $roles = Role::all();
   //     return view('roles.index')->with('roles', $roles);
    return view('admin.roles.listar_roles')->with('roles', $roles);
    }

    public function data_listar_roles()
    {
        $role = Role::all();
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
    
    public function editar_roles_permisos(Request $request)
    {
       // dd("entro");
       $id=$request->id;
       $role = Role::findOrFail($id);
        $permissions = Permission::all();

        return view('admin.roles.editar_roles_permisos', compact('role', 'permissions'));
    }
}
