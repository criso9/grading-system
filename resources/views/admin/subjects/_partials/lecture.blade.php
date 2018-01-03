<ul>
	<li>
		{{ Form::label('quiz', 'Quizzes, SW, HW, Recitation, Deportment, Attendance') }}
		{{ Form::text('quiz') }}

		@if ($origFile == 'grade')
			/ {{ Form::label('tQuiz', $student->subject->quiz, array('name' => 'tQuiz')) }}
		@endif
	</li>
	<li>
		{{ Form::label('unit_test', 'Unit Test') }}
		{{ Form::text('unit_test') }}
		
		@if ($origFile == 'grade')
			/ {{ Form::label('tUnit', $student->subject->unit_test, array('name' => 'tUnit')) }}
		@endif
	</li>
	<li>
		{{ Form::label('term_test', 'Term Test') }}
		{{ Form::text('term_test') }}

		@if ($origFile == 'grade')
			/ {{ Form::label('tTerm', $student->subject->term_test, array('name' => 'tTerm')) }}	
		@endif
	</li>
	<li>
		{{ Form::hidden('laboratory', '0') }}
		{{ Form::submit('Save') }}
	</li>
</ul>