<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\HttpResponse;

use App\GS_Form;
use App\Event;

class FormsController extends Controller
{
    private $data;

    public function __construct() {
        $this->data = array();
        $this->data['controllerName'] = 'FormsController';
        $this->data['tableName'] = 'all_forms_table';
        $this->data['singleName'] = 'Form';
        $this->data['pluralName'] = 'Forms';
        $this->data['indexUrl'] = 'forms';
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $this->data['entities'] = GS_Form::all();
        return view('admin.pages.forms.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.pages.forms.create', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, ['name' => 'required|string|regex:/^[a-zA-Z0-9\.\'\ \(\)\-]*$/|unique:gs_forms', 'defaultStartMonth' => 'digits_between:1,9999']);
        if(!$request->has('approved_enabled')){
            $request['approved_enabled'] = '0';
        }
        if ($request->defaultStartMonth == '0' || !$request->has('defaultStartMonth')) {
            $request['defaultStartMonth'] = null;
        }
        GS_Form::create($request->all());
        return redirect()->action('FormsController@index')->with('success_message', 'Successfully added new '.$this->data['singleName'].': '.$request->name);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $entity = GS_Form::where('id', $id)->firstOrFail();
        $this->data['entity'] = $entity;
        $this->data['isInUse'] = $entity->isInUse();
        return view('admin.pages.forms.show', $this->data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $this->data['entity'] = GS_Form::where('id', $id)->firstOrFail();
        return view('admin.pages.forms.edit', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update($id, Request $request)
    {
        $this->data['entity'] = GS_Form::where('id', $id)->firstOrFail();
        $this->validate($request, ['name' => 'required|string|regex:/^[a-zA-Z0-9\.\'\ \(\)\-]*$/|unique:gs_forms,name,'.$this->data['entity']->id, 'defaultStartMonth' => 'digits_between:1,9999']);
        if(!$request->has('approved_enabled')){
            $request['approved_enabled'] = '0';
        }
        if ($request->defaultStartMonth == '0' || !$request->has('defaultStartMonth')) {
            $request['defaultStartMonth'] = null;
        }
        $this->data['entity']->update($request->all());
        $this->data['isInUse'] = $this->data['entity']->isInUse();
        return view('admin.pages.forms.show', $this->data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $entity = GS_Form::where('id', $id)->firstOrFail();
        $entity->delete();
        return redirect()->action('FormsController@index')->with('info_message', 'Successfully removed '.$this->data['singleName'].': '.$entity->name);
    }
}
