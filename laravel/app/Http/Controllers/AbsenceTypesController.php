<?php

namespace App\Http\Controllers;

use App\Absence_Type;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\HttpResponse;

class AbsenceTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $absence_types = Absence_Type::all();

        return view('staff.pages.absence_types.index', compact('absence_types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('staff.pages.absence_types.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, ['name' => 'required|string|regex:/^[a-zA-Z0-9\.\'\ \(\)\-]*$/|unique:absence_type']);

        Absence_Type::create($request->all());

        return redirect()->action('AbsenceTypesController@index')->with('success_message', 'Successfully added new absence type: '.$request->name);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($name)
    {
        $absence_types = Absence_Type::where('name', $name)->firstOrFail();
        
        return view('staff.pages.absence_types.show', compact('absence_types'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($name)
    {
        $absence_types = Absence_Type::where('name', $name)->firstOrFail();
        
        return view('staff.pages.absence_types.edit', compact('absence_types'));
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

        $absence_types = Absence_Type::where('name', $name)->firstOrFail();

        $absence_types->update($request->all());

        return view('staff.pages.absence_types.show', compact('absence_types'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($name)
    {
        $absence_types = Absence_Type::where('name', $name)->firstOrFail();

        $absence_types->delete();

        return redirect()->action('AbsenceTypesController@index')->with('info_message', 'Successfully removed absence type: '.$absence_types->name);
    }
}
