<?php

namespace App\Http\Controllers;

use App\Level;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\HttpResponse;

class LevelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $levels = Level::all();

        return view('staff.pages.level.index', compact('levels'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('staff.pages.level.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, ['name' => 'required|string|unique:level']);

        Level::create($request->all());

        return redirect()->action('LevelController@index')->with('success_message', 'Successfully added new level');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($name)
    {
        $level = Level::where('name', $name)->first();
        
        return view('staff.pages.level.show', compact('level'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($name)
    {
        $level = Level::where('name', $name)->first();
        
        return view('staff.pages.level.edit', compact('level'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $level = Level::where('id', $id)->first();

        $level->delete();

        return redirect()->action('LevelController@index')->with('info_message', 'Successfully removed level');
    }
}
