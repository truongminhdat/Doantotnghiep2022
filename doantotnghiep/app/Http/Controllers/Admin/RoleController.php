<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Roles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Roles::paginate(15);
        return view('admin.role.index',[
            'title'=>'Quản lý Phân Quyền'
        ],compact('data'));
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
        foreach ($all as $r){
            $name= $r->getName();
            $pos = strpos($name,'admin');
            if ($pos !== false && !in_array($name,$routes)){
                array_push($routes,$name);
            }

        }
        return view('admin.role.create',[
            'title'=>'Thêm quyền'
        ],compact('routes'));
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
            'name'=>'required'
        ],[
            'name.required'=>'Tên nhóm quyền không để trống'
        ]);
        $routes = json_encode($request->route);
        $role = new Roles();
        $role->name = $request->name;
        $role->permissions = $routes;
        $role->save();
        return redirect()->route('admin.role')->with('success','Thêm quyền thành công');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Roles  $roles
     * @return \Illuminate\Http\Response
     */
    public function show(Roles $roles)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Roles  $roles
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $model = Roles::find($id);
       $permissions = json_decode($model->permissions);
       $routes = [];
               $all = Route::getRoutes();
               foreach ($all as $r){
                   $name= $r->getName();
                   $pos = strpos($name,'admin');
                   if ($pos !== false && !in_array($name,$routes)){
                       array_push($routes,$name);
                   }

               }
               return view('admin.role.edit',[
                   'title'=>'Chỉnh sửa quyền'
               ],compact('routes','model','permissions'));
           }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Roles  $roles
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'=>'required'
        ],[
            'name.required'=>'Tên nhóm quyền không được để trống'
        ]);
        $routes = json_encode($request->route);
        $roles = Roles::find($id);
        $roles->name = $request->name;
        $roles->permissions = $routes;
        $roles->update();
        return redirect()->route('admin.role')->with('success','Cập nhật quyền thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Roles  $roles
     * @return \Illuminate\Http\Response
     */
    public function destroy(Roles $roles)
    {
        //
    }
}
