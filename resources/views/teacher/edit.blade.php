@extends('panel.teacher')

@section('subjects-list')
    @if ($subjects_handle->count() > 1)
        @foreach($subjects_handle as $s_handle)
            <li>
                {{ link_to_route('teacher.subjects.show', $s_handle->description, array($s_handle->id)) }}
            </li>
        @endforeach
    @elseif ($subjects_handle->count() > 0)
        <li>
            {{ link_to_route('teacher.subjects.show', $subjects_handle[0]->description, array($subjects_handle[0]->id)) }}
        </li>
    @endif 
@stop

@section('content')
<div class="students-box">
<h1>Add Total Items</h1>
<span>Subject: </span>{{ $subject->description }}
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
		{{ Form::model($subject, array('route' => array('teacher.subjects.update', $subject->id), 'method' => 'put')) }}
	    	@if ($subject->unit_lec != '0' && $subject->unit_lab != '0')
	    		<span>Subject Type: Lecture/Laboratory</span><br/>
				@include('admin.subjects._partials.leclab', ['origFile' => "edit"])
			@elseif ($subject->unit_lec != '0' && $subject->unit_lab == '0')
				<span>Subject Type: Lecture</span><br/>
				@include('admin.subjects._partials.lecture', ['origFile' => "edit"])
			@elseif ($subject->unit_lec = '0' && $subject->unit_lab != '0')
				<span>Subject Type: Laboratory</span><br/>
				@include('admin.subjects._partials.laboratory', ['origFile' => "edit"])
	    	@endif
	  	{{ Form::close() }}
  	</div>
<!-- <pre>
	{{ $subject }}
</pre> -->
</div>
@stop