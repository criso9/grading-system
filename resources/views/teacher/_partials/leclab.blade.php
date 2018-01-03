
	<tr style="font-weight: bold;" align="center">
		<td colspan="2">Quiz</td>
		<td colspan="2">Unit Test</td>
		<td colspan="2">Term Test</td>
		<td colspan="2">Laboratory</td>
		<td>Edit</td>
		<td>Delete</td>
	</tr>
	<tr align="center">
		<td>Score</td>
		<td>Items</td>
		<td>Score</td>
		<td>Items</td>
		<td>Score</td>
		<td>Items</td>
		<td>Score</td>
		<td>Items</td>
		<td></td>
		<td></td>
	</tr>
	
	@if ($grades->count() > 1)
    	@foreach($grades as $grade)
		<tr align="center">
	        <td>{{ $grade->quiz }}</td>
	        <td>{{ $grade->t_quiz }}</td>
	        <td>{{ $grade->unit_test }}</td>
	        <td>{{ $grade->t_unit_test }}</td>
	        <td>{{ $grade->term_test }}</td>
	        <td>{{ $grade->t_term_test }}</td>
	        <td>{{ $grade->laboratory }}</td>
	        <td>{{ $grade->t_laboratory }}</td>
	        <td>
	            {{ Form::open(array('route' => array('teacher.subjects.edit.grade', $subject->id, $grade->id), 'method' => 'get', 'class' => 'edit')) }}
	            {{ Form::submit('Edit') }}
	            {{ Form::close() }}
	        </td>
	        <td>
	            {{ Form::open(array('route' => array('teacher.subjects.destroy.grade', $subject->id, $grade->id), 'method' => 'delete', 'class' => 'delete')) }}
	            {{ Form::submit('Delete') }}
	            {{ Form::close() }}
	        </td>
	    </tr>
    	@endforeach
    @elseif ($grades->count() > 0)
    <tr align="center">
        <td>{{ $grades[0]->quiz }}</td>
        <td>{{ $grades[0]->t_quiz }}</td>
        <td>{{ $grades[0]->unit_test }}</td>
        <td>{{ $grades[0]->t_unit_test }}</td>
        <td>{{ $grades[0]->term_test }}</td>
        <td>{{ $grades[0]->t_term_test }}</td>
        <td>{{ $grades[0]->laboratory }}</td>
        <td>{{ $grades[0]->t_laboratory }}</td>
        <td>
            {{ Form::open(array('route' => array('teacher.subjects.edit.grade', $subject->id, $grades[0]->id), 'method' => 'get', 'class' => 'edit')) }}
            {{ Form::submit('Edit') }}
            {{ Form::close() }}
        </td>
        <td>
            {{ Form::open(array('route' => array('teacher.subjects.destroy.grade', $subject->id, $grades[0]->id), 'method' => 'delete', 'class' => 'delete')) }}
            {{ Form::submit('Delete') }}
            {{ Form::close() }}
	    </td>
    </tr>
    @else
    	<tr align="center">
    		<td colspan="10">
    			<span style="color: red;">No grades available</span>
    		</td>
    	</tr>
    @endif
