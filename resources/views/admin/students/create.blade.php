@extends('voyager::master')

@section('content')
<div class="students-box">
<h4>Add Subject</h4>
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
		{{ Form::open(array('route' => 'admin.students.store')) }}
			{{ Form::hidden('user_id', $id) }}
	    	<ul>
				<li>
					{{ Form::label('subject_id', 'Subject') }}
					{{ Form::select('subject_id', App\Subject::whereNotIn('id', $subjects)->pluck('description', 'id')) }}
				</li>
				<!-- <li>
					{{ Form::label('code', 'Code') }}
					{{ Form::text('code') }}
				</li>
				<li>
					{{ Form::label('unit_lec', 'Unit Lecture') }}
					{{ Form::text('unit_lec') }}
				</li>
				<li>
					{{ Form::label('unit_lab', 'Unit Laboratory') }}
					{{ Form::text('unit_lab') }}
				</li>
				<li>
					{{ Form::label('teacher_id', 'Teacher') }}
					{{ Form::text('teacher_id') }}
				</li> -->
				<li>
					{{ Form::submit('Save') }}
				</li>
			</ul>
	  	{{ Form::close() }}
  	</div>
</div>
@stop