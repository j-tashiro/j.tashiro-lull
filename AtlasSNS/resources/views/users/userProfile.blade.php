@extends('layouts.login')

@section('content')

{!! Form::open(['url' => '/profileUpdate','route' => 'upload', 'method' => 'post', 'enctype' => 'multipart/form-data']) !!}
{!! Form::hidden('id',$user->id) !!}

<div class="form_profile">

@foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
@endforeach

<img src="{{ \Storage::url($user->image) }}">

        <div class="profile_layout">
                {{ Form::label('','user name') }}
                {{ Form::text('username',$user->username,['class' => 'input',]) }}
        </div>

        <div class="profile_layout">
                {{ Form::label('','mail address') }}
                {{ Form::text('mail',$user->mail,['class' => 'input']) }}
        </div>

        <div class="profile_layout">
                {{ Form::label('','password') }}
                {{ Form::password('password',['class' => 'input']) }}
        </div>

        <div class="profile_layout">
                {{ Form::label('','password confirm') }}
                {{ Form::password('password_confirmation',['class' => 'input']) }}
        </div>

        <div class="profile_layout">
                {{ Form::label('','bio') }}
                {{ Form::text('bio',$user->bio,['class' => 'input']) }}
        </div>

        <div class="profile_layout">
                {{ Form::label('','icon image') }}
                {{ Form::file('image', ['class' => 'profile_image']) }}
                <!-- {{ Form::image('icon image',null,['class' => 'input']) }} -->
        </div>

        {{ Form::submit('更新',['class' => 'profile_button']) }}

</div>

{!! Form::close() !!}


@endsection