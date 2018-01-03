@extends('voyager::master')

@section('content')

<div class="students-box">
<h4>Enrolled Students</h4>
<span><b>Subject: </b></span>{{ $subject->description }}
<br/><br/>

<br/>
	<table style="width: 100%;" class="table-striped tbl-grade">
	<tr style="font-weight: bold;" align="center">
		<td>Name</td>
		<td>Final Grade</td>
		<td>View</td>
	</tr>
	@if ($students->count() > 1)
		@foreach($students as $student)
			<tr align="center">
		        <td>{{ $student->user->name }}</td>
		        <td>{{ $student->final_grade }}</td>
		        <td>{{ link_to_route('teacher.subjects.show.grade', 'View', array($student->subject->id, $student->user->id)) }}</td>
	        </tr>
	    @endforeach
	@elseif ($students->count() > 0)
		<tr align="center">
	        <td>{{ $students[0]->user->name }}</td>
	        <td>{{ $students[0]->final_grade }}</td>
	        <td>{{ link_to_route('teacher.subjects.show.grade', 'View', array($students[0]->subject->id, $students[0]->user->id)) }}</td>
        </tr>
    @else
    	<tr align="center">
    		<td colspan="3">
    			<span style="color: red;">No enrolled Students</span>
    		</td>
    	</tr>
	@endif  
	</table>
<br/>
<!-- <pre>
	{{ $students }}
</pre> -->
</div>
@stop