<?php

namespace App\Http\Controllers;

use App\Funding;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\HttpResponse;

class FundingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $funding = Funding::all();

        return view('staff.pages.funding.index', compact('funding'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('staff.pages.funding.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, ['name' => 'required|string|regex:/^[a-zA-Z0-9\.\'\ \(\)\-]*$/|unique:funding']);

        Funding::create($request->all());

        return redirect()->action('FundingController@index')->with('success_message', 'Successfully added new award type: '.$request->name);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($name)
    {
        $funding = Funding::where('name', $name)->firstOrFail();
        
        return view('staff.pages.funding.show', compact('funding'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($name)
    {
        $funding = Funding::where('name', $name)->firstOrFail();
        
        return view('staff.pages.funding.edit', compact('funding'));
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

        $funding = Funding::where('name', $name)->firstOrFail();

        $funding->update($request->all());

        return view('staff.pages.funding.show', compact('funding'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($name)
    {
        $funding = Funding::where('name', $name)->firstOrFail();

        $funding->delete();

        return redirect()->action('FundingController@index')->with('info_message', 'Successfully removed award type: '.$funding->name);
    }
}
