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

<h4>Enrolled Students</h4>
<br/>
@if (Session::has('message'))
       <div class="alert alert-info" style="width: 40%;">
            <ul>
                <li>{{ Session::get('message') }}</li>
            </ul>
        </div>
    @endif
    <br/>
<span><b>Subject: </b></span>{{ $subject->description }}
<br/><br/>

<br/>
	<table style="width: 70%;" class="table-striped tbl-grade">
	<tr style="font-weight: bold;" align="center">
		<td>Name</td>
		<td>Final Grade</td>
		<td>Remarks</td>
		<td>View</td>
		<td>Action</td>
	</tr>
	@if ($students->count() > 1)
		@foreach($students as $student)
			<tr align="center">
		        <td>{{ $student->user->name }}</td>
		        <td>{{ $student->final_grade }}</td>
		        <td>{{ $student->remarks }}</td>
		        <td>{{ link_to_route('teacher.subjects.show.grade', 'View', array($student->subject->id, $student->user->id)) }}</td>
		        <td>
		        	{{ Form::open(array('route' => array('email.send', $student->id), 'method' => 'post', 'class' => 'edit')) }}
				    {{ Form::submit('Send Email') }}
				    {{ Form::close() }}
				</td>
	        </tr>
	    @endforeach
	@elseif ($students->count() > 0)
		<tr align="center">
	        <td>{{ $students[0]->user->name }}</td>
	        <td>{{ $students[0]->final_grade }}</td>
	        <td>{{ $students[0]->remarks }}</td>
	        <td>{{ link_to_route('teacher.subjects.show.grade', 'View', array($students[0]->subject->id, $students[0]->user->id)) }}</td>
	        <td>
	        	{{ Form::open(array('route' => array('email.send', $students[0]->id), 'method' => 'post', 'class' => 'edit')) }}
			    {{ Form::submit('Send Email') }}
			    {{ Form::close() }}
			</td>
        </tr>
    @else
    	<tr align="center">
    		<td colspan="5">
    			<span style="color: red;">No enrolled Students</span>
    		</td>
    	</tr>
	@endif  
	</table>
<br/>
<!-- <pre>
	{{ $subject }}
</pre> -->
</div>
@stop