@extends('voyager::master')

@section('content')

<div class="students-box">
	
    <div class="students-box-body">
        <p class="login-box-msg" style="font-weight: bold;">List of Students</p>

        @if (count($students))
        	<ul>
        		@foreach($students as $student)
        			<li>
        				{{ link_to_route('admin.students.show', $student->name, array($student->id)) }}
        			</li>
                @endforeach
        	</ul>
        @endif 
    </div>
    <div class="pagination">{{ $students->links() }}</div>
</div>

@stop