@extends('layouts.default')
@section('content')
<h1>Edit User</h1>
{{ Form::model($user, array('method' => 'PATCH', 'route' => array('users.update', $user->id))) }}
<ul><li>{{ Form::label('firstname', 'First name:') }} {{ Form::text('firstname') }} </li>
    <li> {{ Form::label('lastname', 'Last name:') }} {{ Form::text('lastname') }} </li>
    <li> {{ Form::label('email', 'Email:') }} {{ Form::text('email') }}</li>
    <li> {{ Form::label('phone', 'Phone:') }} {{ Form::text('phone') }}</li>
    <li> {{ Form::label('address', 'Address:') }} {{ Form::text('address') }} </li>
    <li> {{ Form::submit('Update', array('class' => 'btn btn- info')) }}
        {{ link_to_route('users.show', 'Cancel', $user->id, array('class' => 'btn')) }}
    </li>
</ul> {{ Form::close() }}
@if ($errors->any())
<ul>
    {{ implode('', $errors->all('<li class="error">:message</ li>')) }}
</ul> @endif
@stop