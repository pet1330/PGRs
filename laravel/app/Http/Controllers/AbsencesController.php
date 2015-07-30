<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Absence;
use App\Absence_Type;
use App\Student;


class AbsencesController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Request $request, $enrolment)
    {
        $student = Student::with('user')->where('enrolment', $enrolment)->firstOrFail();
        $absence_types = Absence_Type::lists('name', 'id');
        return view('entities.students.absences.create', compact('student', 'absence_types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request, $enrolment)
    {
        $this->validate($request, [
            'absence_type_id' => 'required|integer|exists:absence_types,id',
            'start' => 'required|date',
            'end' => 'required|date|after:start',
            'description' => 'string'
            ]);
        $request['student_id'] = Student::where('enrolment', $enrolment)->first()->id;
        // get existing absence record
        $absence = Absence::create($request->all());
        return redirect()->action('StudentsController@show', ['enrolment' => $enrolment])->with('success_message', 'Successfully created <a href="'.action('AbsencesController@show', ['enrolment' => $enrolment, 'id' => $absence->id]).'" class="alert-link">'.$absence->absence_type->name.' absence record</a> starting '.$absence->start);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($enrolment, $id)
    {
        $absence = Absence::with('absence_type', 'student.user')->where('id', $id)->first();
        return view('entities.students.absences.show', compact('absence'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($enrolment, $id)
    {
        $absence = Absence::with('absence_type', 'student.user')->where('id', $id)->first();
        $absence_types = Absence_Type::lists('name', 'id');
        return view('entities.students.absences.edit', compact('absence', 'absence_types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $enrolment, $id)
    {
        $this->validate($request, [
            'absence_type_id' => 'required|integer|exists:absence_types,id',
            'start' => 'required|date',
            'end' => 'required|date|after:start',
            'description' => 'string'
            ]);
        // get existing absence record
        $absence = Absence::where('id', $id)->first();
        $absence->update($request->all());
        return redirect()->action('StudentsController@show', ['enrolment' => $enrolment])->with('success_message', 'Successfully updated <a href="'.action('AbsencesController@show', ['enrolment' => $enrolment, 'id' => $id]).'" class="alert-link">'.$absence->absence_type->name.' absence record</a> starting '.$absence->start);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($enrolment, $id)
    {
        $absence = Absence::where('id', $id)->firstOrFail();
        $absence->delete();
        return redirect()->action('StudentsController@show', ['enrolment' => $enrolment])->with('success_message', 'Successfully removed '.$absence->absence_type->name.' absence record');
    }
}
