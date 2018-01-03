<ul>
	<li>
		{{ Form::label('quiz', 'Quizzes, SW, HW, Recitation, Deportment, Attendance') }}
		{{ Form::text('quiz', null, array('class' => 'grade-field')) }}
		/ {{ Form::text('t_quiz', null, array('class' => 'grade-field')) }}
	</li>
	<li>
		{{ Form::label('unit_test', 'Unit Test') }}
		{{ Form::text('unit_test', null, array('class' => 'grade-field')) }}
		/ {{ Form::text('t_unit_test', null, array('class' => 'grade-field')) }}
	</li>
	<li>
		{{ Form::label('term_test', 'Term Test') }}
		{{ Form::text('term_test', null, array('class' => 'grade-field')) }}
		/ {{ Form::text('t_term_test', null, array('class' => 'grade-field')) }}
	</li>
	<li>
		{{ Form::label('laboratory', 'Laboratory') }}
		{{ Form::text('laboratory', null, array('class' => 'grade-field')) }}
		/ {{ Form::text('t_laboratory', null, array('class' => 'grade-field')) }}
	</li>
	<li>
		{{ Form::hidden('student_id', $student->id) }}
		{{ Form::submit('Save') }}
	</li>
</ul>