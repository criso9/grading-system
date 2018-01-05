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

<div class="students-box">
        
    @if (Session::has('message'))
       <div class="alert alert-info" style="width: 40%;">
            <ul>
                <li>{{ Session::get('message') }}</li>
            </ul>
        </div>
    @endif

    <p class="login-box-msg">List of Subjects Handled</p>
        
    <ul>
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
    </ul>
        
</div>

@stop