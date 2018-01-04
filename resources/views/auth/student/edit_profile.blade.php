@extends('panel.student')

@section('content')

<div class="side-body padding-top">
    <h1 class="page-title">
        <i class="voyager-person"></i>
        Edit User
    </h1>

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="page-content edit-add container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                {{ Form::model($user, array('route' => array('student.profile.update', $user->id), 'method' => 'put')) }}
                    <ul>
                        <li>
                            {{ Form::label('name', 'Name') }}
                            {{ Form::text('name') }}
                        </li>
                        <li>
                            {{ Form::label('email', 'E-mail') }}
                            {{ Form::text('email') }}
                        </li>
                        <li>
                            {{ Form::label('password', 'Password') }}
                            <br/><small>Leave empty to keep the same</small><br/>
                            {{ Form::password('password') }}
                        </li>
                        <!-- <li>
                            {{ Form::label('avatar', 'Avatar') }}
                            <img style="width:200px; height:auto; clear:both; display:block; padding:2px; border:1px solid #ddd; margin-bottom:10px;" src="/storage/{{ $user->avatar }}">
                            {{ Form::file('avatar') }}
                        </li> -->
                        <li>
                            {{ Form::submit('Save') }}
                        </li>
                    </ul>
                {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>

</div>

<!-- <pre>
    {{ $user }}
</pre> -->
 
@stop