<?php

namespace App\Http\Controllers;

use App\Absence_Type;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\HttpResponse;

class AbsenceTypesController extends Controller
{
    private $data;

    public function __construct() {
        $this->data = array();
        $this->data['controllerName'] = 'AbsenceTypesController';
        $this->data['tableName'] = 'absence_type_id';
        $this->data['singleName'] = 'Absence Type';
        $this->data['pluralName'] = 'Absence Types';
        $this->data['indexUrl'] = 'absence_types';
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $this->data['entities'] = Absence_Type::all();
        return view('admin.layouts.name_comment.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.layouts.name_comment.create', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, ['name' => 'required|string|regex:/^[a-zA-Z0-9\.\'\ \(\)\-]*$/|unique:absence_types']);
        Absence_Type::create($request->all());
        return redirect()->action('AbsenceTypesController@index')->with('success_message', 'Successfully added new '.$this->data['singleName'].': '.$request->name);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($name)
    {
        $this->data['entity'] = Absence_Type::where('name', $name)->firstOrFail();
        return view('admin.layouts.name_comment.show', $this->data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($name)
    {
        $this->data['entity'] = Absence_Type::where('name', $name)->firstOrFail();
        return view('admin.layouts.name_comment.edit', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($name, Request $request)
    {
        $this->validate($request, ['name' => 'required|string|regex:/^[a-zA-Z0-9\.\'\ \(\)\-]*$/']);
        $this->data['entity'] = Absence_Type::where('name', $name)->firstOrFail();
        $this->data['entity']->update($request->all());
        return view('admin.layouts.name_comment.show', $this->data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($name)
    {
        $entity = Absence_Type::where('name', $name)->firstOrFail();
        $entity->delete();
        return redirect()->action('AbsenceTypesController@index')->with('info_message', 'Successfully removed '.$this->data['singleName'].': '.$entity->name);
    }
}
