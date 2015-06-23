@extends('staff.layouts.default')
@section('title')
{{ $award->name }}
@endsection
@section('content')
<div class=" col-md-9 col-lg-9 "> 
  <table class="table table-user-information">
    <tbody>
        <tr>
            <td>Name</td>
            <td>{{ $award->name }}</td>
        </tr>
        <tr>
            <td>Comments</td>
            <td>{{ $award->comments }}</td>
        </tr>
        <tr>
            <td>Number of students</td>
            <td>{{ $result = App\Student::AwardCount($award->id)->count() }}</td>
        </tr>
    </tr>
</tbody>
</table>
<div class="btn-group">
    <a class="btn btn-default" href="{{ action('AwardsController@edit', ['name' => $award->name]) }}">Edit</a>
</div>
<div class="btn-group">
    <form action="{{ action('AwardsController@destroy', ['name' => $award->name]) }}" method="POST">
        <input type="hidden" name="_method" value="DELETE">
        <button class="btn btn-danger" type="submit">Delete</button>
    </form>
</div>
</div>
@endsection
@stop