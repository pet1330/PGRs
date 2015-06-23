@extends('staff.layouts.default')
@section('title')
{{ $enrolment_status->name }}
@endsection
@section('content')
<div class=" col-md-9 col-lg-9 "> 
  <table class="table table-user-information">
    <tbody>
        <tr>
            <td>Name</td>
            <td>{{ $enrolment_status->name }}</td>
        </tr>
        <tr>
            <td>Comments</td>
            <td>{{ $enrolment_status->comments }}</td>
        </tr>
        <tr>
            <td>Number of students</td>
            <td>{{ $result = App\Student::EnrolmentStatusCount($enrolment_status->id)->count() }}</td>
        </tr>
    </tr>
</tbody>
</table>
<div class="btn-group">
    <a class="btn btn-default" href="{{ action('EnrolmentStatusController@edit', ['name' => $enrolment_status->name]) }}">Edit</a>
</div>
<div class="btn-group">
    <form action="{{ action('EnrolmentStatusController@destroy', ['name' => $enrolment_status->name]) }}" method="POST">
        <input type="hidden" name="_method" value="DELETE">
        <button class="btn btn-danger" type="submit">Delete</button>
    </form>
</div>
</div>
@endsection
@stop