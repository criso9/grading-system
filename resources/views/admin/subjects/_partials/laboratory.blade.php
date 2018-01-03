<ul>
	<li>
		{{ Form::label('laboratory', 'Practicum, Laboratory/Workshop Exercises, Plates') }}
		{{ Form::text('laboratory') }}
	</li>
	<li>
		{{ Form::label('term_test', 'Term_Test') }}
		{{ Form::text('term_test') }}
	</li>
	<li>
		{{ Form::hidden('quiz', '0') }}
		{{ Form::hidden('unit_test', '0') }}
		{{ Form::submit('Save') }}
	</li>
</ul>