<ul>
	<li>
		{{ Form::label('laboratory', 'Laboratory') }}
		{{ Form::text('laboratory', null, array('class' => 'grade-field')) }}
		/ {{ Form::text('t_laboratory', null, array('class' => 'grade-field')) }}
	</li>
	<li>
		{{ Form::label('term_test', 'Term Test') }}
		{{ Form::text('term_test', null, array('class' => 'grade-field')) }}
		/ {{ Form::text('t_term_test', null, array('class' => 'grade-field')) }}
	</li>
	<li>
		{{ Form::hidden('student_id', $student->id) }}
		{{ Form::hidden('quiz', '0') }}
		{{ Form::hidden('t_quiz', '0') }}
		{{ Form::hidden('unit_test', '0') }}
		{{ Form::hidden('t_unit_test', '0') }}
		{{ Form::submit('Save') }}
	</li>
</ul>