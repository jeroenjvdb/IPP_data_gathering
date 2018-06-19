@extends('layouts.master')

@section('content')

<h1>IPee Cloud</h1>

<div class="row">
@foreach($urinals as $urinal)
<div class="col-md-4">
<h2>device {{ $urinal->id }}</h2>

<hr>

<p>last congestion: {{ $urinal->lastCongestion ? $urinal->lastCongestion->created_at : "/" }}</p>
<p>last clogged:  {{ $urinal->lastClogged ? $urinal->lastClogged->created_at : "/" }}</p>
<p>packets received since startup {{ $urinal->data()->count() }}  </p>
<p>last packet received {{ $urinal->data->first()->created_at }}

</div>
@endforeach
</div>

<hr>

<table class="table">
    <thead>
        <th>Flushing Events</th>
        <th>Clogging</th>
        <th>Congestion</th>
        <th>Metal Key Presence</th>
	<th>Flushing Time</th>
	<th>Device #</th>
	<th>Created at (UTC) </th>
    </thead>
    <tbody>
        @foreach($screvles as $screvle)
            <tr>
                <td>{{ $screvle->data['nb_flush'] }}</td>
@if ($screvle->data['clogged'] == 0)
                <td>No clogging</td>
@else
		<td>Clogging detected</td>
@endif
@if ($screvle->data['congestion'] == 0)
                <td>No congestion</td>
@else
		<td> Congestion detected</td>
@endif
                <td>{{ $screvle->data['nb_mkey'] }}</td>
		<td>{{ $screvle->data['t_evac']  }}</td>
		<td>{{ $screvle->address }}</td>
		<td>{{ $screvle->created_at }}</td>
            </tr>
        @endforeach
    </tbody>
</table>


@stop
