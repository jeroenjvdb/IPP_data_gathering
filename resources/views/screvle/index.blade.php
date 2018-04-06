@extends('layouts.master')

@section('content')

<table class="table">
    <thead>
        <th>payload</th>
        <th>address</th>
        <th>type</th>
    </thead>
    <tbody>
        @foreach($screvles as $screvle)
            <tr>
                <td>{{ $screvle->payload }}</td>
                <td>{{ $screvle->address }}</td>
                <td>{{ $screvle->type }}</td>
            </tr>
        @endforeach
    </tbody>
</table>


@stop