@extends('layouts.default')
@section('content')
<h1>All Users</h1>
<p>{{ link_to_route('users.create', 'Add new user') }}</p>
@if ($users->count())
{{ $users->links() }}
<div class="clear_fix"></div>
<table class="table table-striped table-bordered">
    <thead>
        <tr>
            @foreach ($headers as $key => $val)
            <th>
                @if ($sortby == $key && $order == 'asc') {{
                        link_to_action(
                            'UsersController@index',
                            $val,
                            array(
                                'sortby' => $key,
                                'order' => 'desc'
                            )
                        )
                }}
                @else {{
                        link_to_action(
                            'UsersController@index',
                            $val,
                            array(
                                'sortby' => $key,
                                'order' => 'asc'
                            )
                        )
                }}
                @endif

            </th>
            @endforeach
        </tr>
        {{ Form::model('users', array('route' => array('users.search'))) }}
        <tr>

            @foreach ($headers as $key => $val)
            <th>
                {{ Form::text($key, null, array( 'placeholder' => 'Search query...', 'style'=>'width: 120px;')) }}
            </th>
            @endforeach
            <th colspan="3">
    <div class="clear_fix">
        {{ Form::submit('Search',  array('class' => 'btn btn-info')) }}
    </div>
</th>
</tr>
{{ Form::close() }}
</thead>
<tbody>
    @foreach ($users as $user)
    <tr>
        <td>{{ $user->firstname }}</td>
        <td>{{ $user->lastname }}</td>
        <td>{{ $user->email }}</td>
        <td>{{ $user->phone }}</td>
        <td>{{ $user->address }}</td>
        <td>{{ link_to_route('users.edit', 'Edit', array($user->id), array('class' => 'btn btn-info')) }}</td>
        <td>{{ link_to_action('UsersController@sendWelcomeEmail', 'SendEmal', array($user->id), array('class' => 'btn btn-info')) }}</td>
        <td>{{ Form::open(array('method' => 'DELETE', 'route' => array('users.destroy', $user->id))) }} {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }} {{ Form::close() }}</td>
    </tr>
    @endforeach
</tbody>
</table>
@else    There are no users
@endif
@stop