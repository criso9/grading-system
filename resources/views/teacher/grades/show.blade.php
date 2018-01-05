@extends('panel.teacher')

@section('subjects-list')
    @if ($subjects_handled->count() > 1)
        @foreach($subjects_handled as $s_handle)
            <li>
                {{ link_to_route('teacher.subjects.show', $s_handle->description, array($s_handle->id)) }}
            </li>
        @endforeach
    @elseif ($subjects_handled->count() > 0)
        <li>
            {{ link_to_route('teacher.subjects.show', $subjects_handled[0]->description, array($subjects_handled[0]->id)) }}
        </li>
    @endif 
@stop

@section('content')
<div class="students-box">
<h4>Grades</h4>
<span>Student Name: </span>{{ $student->user->name }}
<br/><span>Subject: </span>{{ $student->subject->description }}
<br/><span>Subject Type: </span>{{ $subject->type->type }}
<br/><br/>
@if (count($errors) > 0)
        <div class="alert alert-danger" style="width:60%;">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (Session::has('message'))
       <div class="alert alert-info" style="width: 40%;">
            <ul>
                <li>{{ Session::get('message') }}</li>
            </ul>
        </div>
    @endif

{{ link_to_route('teacher.subjects.create.grade', 'Add Grades', array($student->subject->id, $student->user_id)) }}

    <div class="students-box-body">
        <table style="width: 70%;" class="table-striped tbl-grade">
        	@if ($subject->type->type == 'Lecture/Laboratory')
                @include('teacher._partials.leclab', ['origFile' => "grade"])
            @elseif ($subject->type->type == 'Lecture')
                @include('teacher._partials.lecture', ['origFile' => "grade"])
            @elseif ($subject->type->type == 'Laboratory')
                @include('teacher._partials.laboratory', ['origFile' => "grade"])
            @endif
        </table>
  	</div>

<br/>
@if($grades->count() > 0)
    {{ Form::open(array('route' => array('teacher.subjects.compute', $student->subject->id, $student->id), 'method' => 'put', 'class' => 'edit')) }}
    {{ Form::submit('Compute Final Grade') }}
    {{ Form::close() }}
@endif


<!-- <pre>
	{{ $student }}
</pre> -->
</div>
@stop