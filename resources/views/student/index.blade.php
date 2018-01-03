@extends('voyager::master')

@section('content')

<div class="students-box">
	
    <p class="login-box-msg" style="font-weight: bold;">List of Grades</p>
        
    <table style="width: 50%;margin-left: 50px;" class="table-striped tbl-grade">
    <tr style="font-weight: bold;" align="center">
        <td>Subject</td>
        <td>Final Grade</td>
    </tr>
        @if ($grades->count() > 1)
            @foreach($grades as $grade)
                <tr>
                    <td align="left" style="width:50%;">{{ $grade->subject->description }}</td>
                    <td align="center" style="width:50%;">{{ $grade->final_grade }}</td>
                </tr>
            @endforeach
        @elseif ($grades->count() > 0)
            <tr>
                <td align="left" style="width:50%;">{{ $grades[0]->subject->description }}</td>
                <td align="center" style="width:50%;">{{ $grades[0]->final_grade }}</td>
            </tr>
        @else
            <li><span style="color: red;">No Grades Available</span></li>
        @endif 
    </table>
        
    
<!-- <pre>
    {{ $grades }}
</pre> -->
</div>

@stop