@extends('voyager::master')

@section('content')

<div class="students-box">

    <div class="students-box-body">
        <p class="login-box-msg">List of Teachers</p>

        @if (count($teachers))
        	<ul>
        		@foreach($teachers as $teacher)
        			<li>
        				{{ link_to_route('admin.teachers.show', $teacher->name, array($teacher->id)) }}
        			</li>
                @endforeach
        	</ul>
        @endif 
    </div>
    <div class="pagination">{{ $teachers->links() }}</div>
</div>

@stop