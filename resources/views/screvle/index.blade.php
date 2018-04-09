@extends('layouts.master')

@section('content')

<table class="table">
    <thead>
        <th>payload</th>
        <td>time left</td>
        <th>address</th>
        <th>type</th>
	<th>created at</th>
    </thead>
    <tbody>
        @foreach($screvles as $screvle)
            <tr>
                <td>{{ $screvle->payload }}</td> 
                <td>{{ $screvle->data['hours'] . 'h ' . $screvle->data['minutes'] . 'm ' . $screvle->data['seconds'] . 's' }}</td>
                <td>{{ $screvle->address }}</td>
                <td>{{ $screvle->type }}</td>
		<td>{{ $screvle->created_at }}</td>
            </tr>
        @endforeach
    </tbody>
</table>


@stop