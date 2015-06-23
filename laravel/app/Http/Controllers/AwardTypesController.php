<?php

namespace App\Http\Controllers;

use App\Award_Type;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\HttpResponse;

class AwardTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $award_types = Award_Type::all();

        return view('staff.pages.award_types.index', compact('award_types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('staff.pages.award_types.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, ['name' => 'required|string|regex:/^[a-zA-Z0-9\.\'\ \(\)\-]*$/|unique:award_types']);

        Award_Type::create($request->all());

        return redirect()->action('AwardTypesController@index')->with('success_message', 'Successfully added new award type: '.$request->name);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($name)
    {
        $award_type = Award_Type::where('name', $name)->firstOrFail();
        
        return view('staff.pages.award_types.show', compact('award_type'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($name)
    {
        $award_type = Award_Type::where('name', $name)->firstOrFail();
        
        return view('staff.pages.award_types.edit', compact('award_type'));
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

        $award_type = Award_Type::where('name', $name)->firstOrFail();

        $award_type->update($request->all());

        return view('staff.pages.award_types.show', compact('award_type'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($name)
    {
        $award_type = Award_Type::where('name', $name)->firstOrFail();

        $award_type->delete();

        return redirect()->action('AwardTypesController@index')->with('info_message', 'Successfully removed award type: '.$award_type->name);
    }
}
