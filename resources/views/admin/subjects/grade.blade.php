@extends('_layouts.default')

@section('content')
<div class="students-box">
<h1>Add Grades</h1>
<span>Subject: </span>{{ $student->subject->description }}
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
    	<span>Subject Type: </span>{{ $subject->type->type }}
		{{ Form::model($student, array('route' => array('teacher.subjects.update.grade', $student->subject_id , $student->id), 'method' => 'put')) }}
	    	@if ($subject->type->type == 'Lecture/Laboratory')
				@include('admin.subjects._partials.leclab', ['origFile' => "grade"])
			@elseif ($subject->type->type == 'Lecture')
				@include('admin.subjects._partials.lecture', ['origFile' => "grade"])
			@elseif ($subject->type->type == 'Laboratory')
				@include('admin.subjects._partials.laboratory', ['origFile' => "grade"])
	    	@endif

	    	{{ Form::label('final_grade', 'Final Grade') }}
			{{ Form::text('final_grade') }}
	  	{{ Form::close() }}
  	</div>
<pre>
	{{ $subject }}
</pre>
</div>
@stop