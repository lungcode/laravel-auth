<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Route;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Role::paginate(15);
        return view('admin.role.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $routes = [];

        $all = Route::getRoutes();

        foreach($all as $r){
            $name = $r->getName();
            $pos = strpos($name,'admin');
            if($pos !== false && !in_array($name,$routes)){
                array_push($routes,$name);
            }
           
        }


        return view('admin.role.create',compact('routes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ],['name.required' => 'Tên nhóm quyền không để trống']);
        array_push($request->route,'admin.index');
        $routes = json_encode($request->route);
 
        Role::create(['name' => $request->name,'permissions' => $routes]);
        return redirect()->route('admin.role.index')->with('success','Thêm nhóm quyền thành côgn');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = Role::find($id);
        $permissions = json_decode($model->permissions);
        // dd($permissions);
        $routes = [];

        $all = Route::getRoutes();

        foreach($all as $r){
            $name = $r->getName();
            $pos = strpos($name,'admin');
            if($pos !== false && !in_array($name,$routes)){
                array_push($routes,$name);
            }
        }

        return view('admin.role.edit',compact('routes','model','permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required'
        ],['name.required' => 'Tên nhóm quyền không để trống']);
        array_push($request->route,'admin.index');
        $routes = json_encode($request->route);
        $role->update(['name' => $request->name,'permissions' => $routes]);
        return redirect()->route('admin.role.index')->with('success','Thêm nhóm quyền thành côgn');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        //
    }
}
