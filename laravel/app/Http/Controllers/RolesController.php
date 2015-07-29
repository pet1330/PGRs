<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Role;
use App\Permission;

class RolesController extends Controller
{
    private $data;

    public function __construct() {
        $this->data = array();
        $this->data['controllerName'] = 'RolesController';
        $this->data['tableName'] = 'all_roles_table';
        $this->data['singleName'] = 'Role';
        $this->data['pluralName'] = 'Roles';
        $this->data['indexUrl'] = 'roles';
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $this->data['entities'] = Role::all();
        return view('admin.pages.roles.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.pages.roles.create', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, ['name' => 'required|string|regex:/^[a-zA-Z0-9\.\'\ \(\)\-]*$/|unique:roles', 'display_name' => 'required|string', 'description' => 'string']);
        Role::create($request->all());
        return redirect()->action('RolesController@index')->with('success_message', 'Successfully added new '.$this->data['singleName'].': '.$request->name);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($name)
    {
        $this->data['entity'] = Role::where('name', $name)->firstOrFail();
        $this->data['users'] = Role::find($this->data['entity']->id)->users()->get();
        $this->data['permissions'] = $this->data['entity']->perms()->get();
        return view('admin.pages.roles.show', $this->data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($name)
    {
        $this->data['entity'] = Role::with('perms')->where('name', $name)->firstOrFail();
        $this->data['all_permissions'] = Permission::lists('display_name', 'id');
        return view('admin.pages.roles.edit', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update($name, Request $request)
    {
        $this->validate($request, ['display_name' => 'required|string','description' => 'string']);
        $this->data['entity'] = Role::where('name', $name)->firstOrFail();
        $this->data['entity']->update($request->all());
        return redirect()->action('RolesController@show', ['name' => $name]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($name)
    {
        $entity = Role::where('name', $name)->firstOrFail();
        $entity->delete();
        return redirect()->action('RolesController@index')->with('info_message', 'Successfully removed '.$this->data['singleName'].': '.$entity->name);
    }
}
