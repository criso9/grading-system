@extends('panel.student')

@section('content')
    <div style="position:relative; z-index:9; text-align:center;">
        <img src="@if( !filter_var(Auth::user()->avatar, FILTER_VALIDATE_URL)){{ Voyager::image( Auth::user()->avatar ) }}@else{{ Auth::user()->avatar }}@endif"
             class="avatar"
             style="border-radius:50%; width:150px; height:150px; border:5px solid #fff;"
             alt="{{ Auth::user()->name }} avatar">
        <h4>{{ ucwords(Auth::user()->name) }}</h4>
        <div class="user-email text-muted">{{ ucwords(Auth::user()->email) }}</div>
        <p>{{ Auth::user()->bio }}</p>
        <a href="{{ route('student.profile.edit', Auth::user()->id) }}" class="btn btn-primary">{{ __('voyager.profile.edit') }}</a>
    </div>

    @if (Session::has('message'))
       <div class="alert alert-info" style="width: 40%;">
            <ul>
                <li>{{ Session::get('message') }}</li>
            </ul>
        </div>
    @endif
@stop