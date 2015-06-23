<?php

namespace App\Http\Controllers;

use App\Award;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\HttpResponse;

class AwardsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $awards = Award::all();

        return view('staff.pages.awards.index', compact('awards'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('staff.pages.awards.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, ['name' => 'required|string|regex:/^[a-zA-Z0-9\.\'\ \(\)\-]*$/|unique:awards']);

        Award::create($request->all());

        return redirect()->action('AwardsController@index')->with('success_message', 'Successfully added new award: '.$request->name);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($name)
    {
        $award = Award::where('name', $name)->firstOrFail();
        
        return view('staff.pages.awards.show', compact('award'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($name)
    {
        $award = Award::where('name', $name)->firstOrFail();
        
        return view('staff.pages.awards.edit', compact('award'));
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

        $award = Award::where('name', $name)->firstOrFail();

        $award->update($request->all());

        return view('staff.pages.awards.show', compact('award'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($name)
    {
        $award = Award::where('name', $name)->firstOrFail();

        $award->delete();

        return redirect()->action('AwardsController@index')->with('info_message', 'Successfully removed award: '.$award->name);
    }
}
