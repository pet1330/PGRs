<?php

namespace App\Http\Controllers;

use App\Enrolment_Status;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\HttpResponse;

class EnrolmentStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $enrolment_status = Enrolment_Status::all();

        return view('staff.pages.enrolment_status.index', compact('enrolment_status'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('staff.pages.enrolment_status.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, ['name' => 'required|string|regex:/^[a-zA-Z0-9\.\'\ \(\)\-]*$/|unique:enrolment_status']);

        Enrolment_Status::create($request->all());

        return redirect()->action('EnrolmentStatusController@index')->with('success_message', 'Successfully added new enrolment status: '.$request->name);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($name)
    {
        $enrolment_status = Enrolment_Status::where('name', $name)->firstOrFail();
        
        return view('staff.pages.enrolment_status.show', compact('enrolment_status'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($name)
    {
        $enrolment_status = Enrolment_Status::where('name', $name)->firstOrFail();
        
        return view('staff.pages.enrolment_status.edit', compact('enrolment_status'));
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

        $enrolment_status = Enrolment_Status::where('name', $name)->firstOrFail();

        $enrolment_status->update($request->all());

        return view('staff.pages.enrolment_status.show', compact('enrolment_status'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($name)
    {
        $enrolment_status = Enrolment_Status::where('name', $name)->firstOrFail();

        $enrolment_status->delete();

        return redirect()->action('EnrolmentStatusController@index')->with('info_message', 'Successfully removed enrolment status: '.$enrolment_status->name);
    }
}
