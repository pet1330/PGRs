@extends('staff.layouts.default')
@section('title')
{{ $singleName }}: {{ $entity->name }}
@endsection
@section('content')
<div class=" col-md-9 col-lg-9 "> 
  <table class="table table-user-information">
    <tbody>
        <tr>
            <td>Name</td>
            <td>{{ $entity->name }}</td>
        </tr>
        <tr>
            <td>Description</td>
            <td>{{ $entity->description }}</td>
        </tr>
        <tr>
            <td>Number of students</td>
            <td>{{ $result = App\Student::EntityCount($tableName, $entity->id)->count() }}</td>
        </tr>
    </tr>
</tbody>
</table>
<div class="btn-group">
    <a class="btn btn-default" href="{{ action($controllerName.'@index') }}">View all {{ $pluralName }}</a>
</div>
<div class="btn-group">
    <a class="btn btn-default" href="{{ action($controllerName.'@edit', ['name' => $entity->name]) }}">Edit</a>
</div>
<div class="btn-group">
    <form action="{{ action($controllerName.'@destroy', ['name' => $entity->name]) }}" method="POST">
        <input type="hidden" name="_method" value="DELETE">
        <button class="btn btn-danger" type="submit">Delete</button>
    </form>
</div>
</div>
@endsection
@stop