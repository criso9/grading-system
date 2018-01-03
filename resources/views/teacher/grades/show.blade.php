@extends('voyager::master')

@section('content')
<div class="students-box">
<h1>Grades</h1>
<span>Student Name: </span>{{ $student->user->name }}
<br/><span>Subject: </span>{{ $student->subject->description }}
<br/><span>Subject Type: </span>{{ $subject->type->type }}
<br/><br/>{{ link_to_route('teacher.subjects.create.grade', 'Add Grades', array($student->subject->id, $student->user_id)) }}


    <div class="students-box-body">
        <table style="width: 100%;" class="table-striped tbl-grade">
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
	{{ $subject }}
</pre> -->
</div>
@stop