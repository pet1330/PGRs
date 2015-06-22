@extends('staff.layouts.default')
@section('title')
{{ $level->name }}
@endsection
@section('content')
<div class=" col-md-9 col-lg-9 "> 
  <table class="table table-user-information">
    <tbody>
        <tr>
            <td>Name</td>
            <td>{{ $level->name }}</td>
        </tr>
        <tr>
            <td>Comments</td>
            <td>{{ $level->comments }}</td>
        </tr>
    </tr>
</tbody>
</table>
<a class="btn btn-default" href="{{ action('LevelController@edit', ['name' => $level->name]) }}">Edit</a>
<form action="{{ action('LevelController@destroy', ['id' => $level->id]) }}" method="POST">
    <input type="hidden" name="_method" value="DELETE">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input class="btn btn-danger" type="submit" value="Delete">
</form>
</div>
@endsection
@stop