@extends('voyager::master')

@section('content')

<div class="students-box">
<h4 style="color: #22a7f0;">Enroll to Subjects</h4>
<span><b>Student Name: </b></span>{{ $student->name }}
<br/><br/>
@if ($subjectList->count() > 0)
	{{ link_to_route('admin.students.create', 'Add Subjects', array($student->id)) }}
@else
	<span style="color:red;">Already enrolled to all Subjects.</span>
@endif
<br/>
<h5>Enrolled Subjects:</h5>
	<ul>
		@if ($students->count() > 1)
			@foreach($students as $subject)
				<li>
					{{ $subject->subject->description }}
				</li>
		    @endforeach
		@elseif ($students->count() > 0)
			<li>{{ $students[0]->subject->description }}</li>
		@endif  
	</ul>
<br/>
<!-- <pre>
	{{ $students }}
</pre> -->
</div>
@stop