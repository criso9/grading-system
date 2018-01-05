@extends('panel.teacher')

@section('subjects-list')
    @if ($subjects->count() > 1)
        @foreach($subjects as $subject)
            <li>
                {{ link_to_route('teacher.subjects.show', $subject->description, array($subject->id)) }}
            </li>
        @endforeach
    @elseif ($subjects->count() > 0)
        <li>
            {{ link_to_route('teacher.subjects.show', $subjects[0]->description, array($subjects[0]->id)) }}
        </li>
    @endif 
@stop

@section('content')
    <div style="position:relative; z-index:9; text-align:center;">
        <img src="@if( !filter_var(Auth::user()->avatar, FILTER_VALIDATE_URL)){{ Voyager::image( Auth::user()->avatar ) }}@else{{ Auth::user()->avatar }}@endif"
             class="avatar"
             style="border-radius:50%; width:150px; height:150px; border:5px solid #fff;"
             alt="{{ Auth::user()->name }} avatar">
        <h4>{{ ucwords(Auth::user()->name) }}</h4>
        <div class="user-email text-muted">{{ ucwords(Auth::user()->email) }}</div>
        <p>{{ Auth::user()->bio }}</p>
        <a href="{{ route('teacher.profile.edit', Auth::user()->id) }}" class="btn btn-primary">{{ __('voyager.profile.edit') }}</a>

        @if (Session::has('message'))
           <div class="alert alert-info" style="width: 40%;">
                <ul>
                    <li>{{ Session::get('message') }}</li>
                </ul>
            </div>
        @endif
    
    </div>
@stop