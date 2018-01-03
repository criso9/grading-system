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
				</li>
		    @endforeach
		@elseif ($teachers->count() > 0)
			<li>{{ $teachers[0]->subject->description }}</li>
		@endif 
	</ul>
<br/>
<!-- <pre>
	{{ $teachers }}
</pre> -->
</div>
@stop