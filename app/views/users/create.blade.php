@extends('layouts.default')
@section('content')
<h1>Create User</h1>
{{ Form::open(array('route' => 'users.store')) }}
<ul>

    <li> {{ Form::label('firstname', 'First Name:') }} {{ Form::text('firstname') }} </li>
    <li> {{ Form::label('lastname', 'Last Name') }} {{Form::text('lastname') }} </li>
    <li> {{ Form::label('email', 'Email:') }} {{ Form::text('email') }} </li>
    <li> {{ Form::label('phone', 'Phone:') }} {{ Form::text('phone') }} </li>
    <li> {{ Form::label('address', 'Address:') }} {{ Form::text('address') }} </li>
    <li> {{ Form::submit('Submit', array('class' => 'btn')) }} </li>
</ul> {{ Form::close() }}
@if ($errors->any())
<ul> {{ implode('', $errors->all('<li class="error">:message</ li>')) }}
</ul> @endif
@stop

