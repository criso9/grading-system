@extends('voyager::master')

@section('content')

<div class="students-box">
<h4>Enroll to Subjects</h4>
<span><b>Teacher Name: </b></span>{{ $teacher->name }}
<br/><br/>
@if ($subjectList->count() > 0)
{{ link_to_route('admin.teachers.create', 'Add Subjects', array($teacher->id)) }}
@else
	<span style="color:red;">Already handled all Subjects.</span>
@endif
<br/>
<h5>Subjects:</h5>
	<ul>
		@if ($teachers->count() > 1)
			@foreach($teachers as $subject)
				<li>
					{{ $subject->subject->description }}
					{{ Form::open(array('route' => array('admin.teachers.destroy', $subject->id), 'method' => 'delete', 'class' => 'delete unenroll-teacher')) }}
		            {{ Form::submit('Remove') }}
		            {{ Form::close() }}
				</li>
		    @endforeach
		@elseif ($teachers->count() > 0)
			<li>
				{{ $teachers[0]->subject->description }}
				{{ Form::open(array('route' => array('admin.teachers.destroy', $teachers[0]->id), 'method' => 'delete', 'class' => 'delete unenroll-teacher')) }}
	            {{ Form::submit('Remove') }}
	            {{ Form::close() }}
			</li>
		@endif 
	</ul>
<br/>
<!-- <pre>
	{{ $teachers }}
</pre> -->
</div>
@stop