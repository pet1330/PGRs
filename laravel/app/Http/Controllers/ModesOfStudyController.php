<?php

namespace App\Http\Controllers;

use App\Mode_Of_Study;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\HttpResponse;

class ModesOfStudyController extends Controller
{
    private $data;

    public function __construct() {
        $this->data = array();
        $this->data['controllerName'] = 'ModesOfStudyController';
        $this->data['tableName'] = 'mode_of_study_id';
        $this->data['singleName'] = 'Mode of Study';
        $this->data['pluralName'] = 'Modes of Study';
        $this->data['indexUrl'] = 'modes_of_study';
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $this->data['entities'] = Mode_Of_Study::all();
        return view('admin.layouts.name_comment_with_student_count.index', $this->data);
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
        $this->validate($request, ['name' => 'required|string|regex:/^[a-zA-Z0-9\.\'\ \(\)\-]*$/|unique:modes_of_study']);
        Mode_Of_Study::create($request->all());
        return redirect()->action('ModesOfStudyController@index')->with('success_message', 'Successfully added new '.$this->data['singleName'].': '.$request->name);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($name)
    {
        $this->data['entity'] = Mode_Of_Study::where('name', $name)->firstOrFail();
        return view('admin.layouts.name_comment_with_student_count.show', $this->data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($name)
    {
        $this->data['entity'] = Mode_Of_Study::where('name', $name)->firstOrFail();
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
        $this->data['entity'] = Mode_Of_Study::where('name', $name)->firstOrFail();
        $this->data['entity']->update($request->all());
        return view('admin.layouts.name_comment_with_student_count.show', $this->data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($name)
    {
        $entity = Mode_Of_Study::where('name', $name)->firstOrFail();
        $entity->delete();
        return redirect()->action('ModesOfStudyController@index')->with('info_message', 'Successfully removed '.$this->data['singleName'].': '.$entity->name);
    }
}
