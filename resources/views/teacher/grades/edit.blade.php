@extends('panel.teacher')

@section('subjects-list')
    @if ($subjects_handle->count() > 1)
        @foreach($subjects_handle as $s_handle)
            <li>
                {{ link_to_route('teacher.subjects.show', $s_handle->description, array($s_handle->id)) }}
            </li>
        @endforeach
    @elseif ($subjects_handle->count() > 0)
        <li>
            {{ link_to_route('teacher.subjects.show', $subjects_handle[0]->description, array($subjects_handle[0]->id)) }}
        </li>
    @endif 
@stop

@section('content')
<div class="students-box">
<h1>Edit Grades</h1>
<span>Subject: </span>{{ $subject->description }}
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

    <div class="students-box-body">
    {{ Form::model($grade, array('route' => array('teacher.subjects.update.grade', $subject->id, $grade->id), 'method' => 'put')) }}
		@if ($subject->type->type == 'Lecture/Laboratory')
			@include('teacher.grades._partials.leclab', ['origFile' => "grade"])
		@elseif ($subject->type->type == 'Lecture')
			@include('teacher.grades._partials.lecture', ['origFile' => "grade"])
		@elseif ($subject->type->type == 'Laboratory')
			@include('teacher.grades._partials.laboratory', ['origFile' => "grade"])
    	@endif
   	{{ Form::close() }}
  	</div>
<!-- <pre>
	{{ $subject }}
</pre> -->
</div>
@stop