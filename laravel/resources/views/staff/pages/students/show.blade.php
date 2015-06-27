@extends('staff.layouts.default')
@section('title')
{{ $student->user->first_name}} {{ $student->user->last_name }}
@endsection
@section('content')
<div class=" col-md-9 col-lg-9 "> 
@include('global.includes.show_alerts')
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
            <td>UKBA status</td>
            <td>{{ $student->ukba_status->name }}</td>
        </tr>
        <tr>
            <td>Funding type</td>
            <td><a href="{{ action('FundingTypesController@show', ['name' => $student->funding_type->name]) }}">{{ $student->funding_type->name }}</a></td>
        </tr>
        <tr>
            <td>Award</td>
            <td><a href="{{ action('AwardsController@show', ['name' => $student->award->name]) }}">{{ $student->award->name }}</a></td>
        </tr>
        <tr>
            <td>Award type</td>
            <td><a href="{{ action('AwardTypesController@show', ['name' => $student->award_type->name]) }}">{{ $student->award_type->name }}</a></td>
        </tr>
        <tr>
            <td>Enrolment status</td>
            <td><a href="{{ action('EnrolmentStatusController@show', ['name' => $student->enrolment_status->name]) }}">{{ $student->enrolment_status->name }}</a></td>
        </tr>
    </tr>

</tbody>
</table>
<div class="btn-group">
    <a class="btn btn-default" href="{{ action('StudentsController@edit', ['enrolment' => $student->enrolment]) }}">Edit</a>
</div>
<div class="btn-group">
    <form action="{{ action('StudentsController@destroy', ['enrolment' => $student->enrolment]) }}" method="POST">
        <input type="hidden" name="_method" value="DELETE">
        <button class="btn btn-danger" type="submit">Delete</button>
    </form>
</div>
</div>
@endsection
@stop