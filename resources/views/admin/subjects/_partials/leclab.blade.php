<ul>
	<li>
		{{ Form::label('quiz', 'Quizzes, SW, HW, Recitation, Deportment, Attendance') }}
		{{ Form::text('quiz') }}
	</li>
	<li>
		{{ Form::label('unit_test', 'Unit Test') }}
		{{ Form::text('unit_test') }}
	</li>
	<li>
		{{ Form::label('term_test', 'Term Test') }}
		{{ Form::text('term_test') }}
	</li>
	<li>
		{{ Form::label('laboratory', 'Laboratory(Practicum, Plates, Lab./Workshop Exercises/Experiments') }}
		{{ Form::text('laboratory') }}
	</li>
	<li>
		{{ Form::submit('Save') }}
	</li>
</ul>