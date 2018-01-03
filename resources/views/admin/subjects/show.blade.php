@extends('_layouts.default')

@section('content')

<div class="students-box">
<h1>Enrolled Students</h1>
<span><b>Subject: </b></span>{{ $students[0]->subject->description }}
<br/><br/>

<br/>
	<ul>
		@if ($students->count() > 1)
			@foreach($students as $student)
				<li>
					{{ link_to_route('teacher.subjects.edit.grade', $student->user->name, array($student->subject->id, $student->user->id)) }}
				</li>
		    @endforeach
		@elseif ($students->count() > 0)
			<li>
				{{ $students[0]->user->name }}
			</li>
		@endif  
	</ul>
<br/>
<pre>
	{{ $students }}
</pre>
</div>
@stop