@extends('staff.layouts.default')
@section('title')
{{ $student->user->first_name}} {{ $student->user->last_name }}
@endsection
@section('content')
<?php try{ ?>
<div class=" col-md-9 col-lg-9 "> 
  <table class="table table-user-information">
    <tbody>
        <tr>
            <td>Name</td>
            <td>{{ $student->user->title }} {{ $student->user->first_name }} {{ $student->user->middle_name }} {{ $student->user->last_name }}</td>
        </tr>
        <tr>
            <td>Student ID number</td>
            <td>{{ $student->enrolment }}</td>
        </tr>
        <tr>
            <td>Account email</td>
            <td><a href="mailto:{{ $student->user->email }}">{{ $student->user->email }}</a></td>
        </tr>
        <tr>
            <td>Personal/other email</td>
            <td><a href="mailto:{{ $student->user->personal_email }}">{{ $student->user->personal_email }}</a></td>
        </tr>
        <tr>
           <tr>
            <td>Phone</td>
            <td><a href="tel:{{ $student->user->personal_phone }}">{{ $student->user->personal_phone }}</a></td>
        </tr>
        <tr>
            <td>Gender</td>
            <td>{{ $student->gender }}</td>
        </tr>
        <tr>
            <td>Home address</td>
            <td>{{ $student->home_address }}</td>
        </tr>
        <tr>
            <td>Current address</td>
            <td>{{ $student->current_address }}</td>
        </tr>
        <tr>
            <td>Nationality</td>
            <td>{{ $student->nationality }}</td>
        </tr>
        <tr>
            <td>Start date</td>
            <td>{{ $student->start }}</td>
        </tr>
        <tr>
            <td>End date</td>
            <td>{{ $student->end }}</td>
        </tr>
        <tr>
            <td>Status</td>
            <td>{{ $student->uk_ba_status->name }}</td>
        </tr>
        <tr>
            <td>Funding</td>
            <td>{{ $student->funding->name }}</td>
        </tr>
        <tr>
            <td>Level</td>
            <td>{{ $student->level->name }}</td>
        </tr>
    </tr>

</tbody>
</table>
<a class="btn btn-default" href="{{ action('StudentsController@show', ['enrolment' => $student->enrolment]) }}">Cancel</a>
<a class="btn btn-success" href="{{ action('StudentsController@update', ['enrolment' => $student->enrolment]) }}">Update</a>
</div>
<?php
} catch(\Exception $e) {
    echo "<pre>";
    echo $e;
    echo "</pre>";
} ?>
@endsection
@stop