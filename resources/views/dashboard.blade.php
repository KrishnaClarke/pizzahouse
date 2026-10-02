@extends('layouts.layout')

@section('title', 'Dashboard')
@section('main_class', 'wide')

@section('content')
    <h1>Staff dashboard</h1>

    <div class="stats">
        <div class="card stat"><span class="muted">Total orders</span><strong>{{ $stats['total'] }}</strong></div>
        <div class="card stat"><span class="muted">Pending</span><strong>{{ $stats['pending'] }}</strong></div>
        <div class="card stat"><span class="muted">Revenue (completed)</span><strong>${{ number_format($stats['revenue'], 2) }}</strong></div>
        <div class="card stat"><span class="muted">Open order value</span><strong>${{ number_format($stats['open_value'], 2) }}</strong></div>
        <div class="card stat"><span class="muted">Average order</span><strong>${{ number_format($stats['average'], 2) }}</strong></div>
    </div>

    <div class="grid-2">
        <div class="card">
            <h2>Orders per day <span class="muted">(last 14 days)</span></h2>
            <div class="columns">
                @foreach ($daily as $day)
                    <div class="col" title="{{ $day['label'] }}: {{ $day['orders'] }} orders">
                        <span class="val">{{ $day['orders'] ?: '' }}</span>
                        <div class="bar" style="height: {{ round($day['orders'] / $maxOrders * 100) }}%"></div>
                        <span class="lbl">{{ \Illuminate\Support\Str::before($day['label'], ' ') }}</span>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="card">
            <h2>Revenue per day <span class="muted">(BBD, all orders)</span></h2>
            <div class="columns">
                @foreach ($daily as $day)
                    <div class="col" title="{{ $day['label'] }}: ${{ number_format($day['revenue'], 2) }}">
                        <span class="val">{{ $day['revenue'] ? round($day['revenue']) : '' }}</span>
                        <div class="bar alt" style="height: {{ round($day['revenue'] / $maxRevenue * 100) }}%"></div>
                        <span class="lbl">{{ \Illuminate\Support\Str::before($day['label'], ' ') }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="grid-3">
        @foreach ([['Orders by pizza type', $byType], ['Orders by crust', $byCrust], ['Popular toppings', $toppings]] as [$title, $data])
            <div class="card">
                <h2>{{ $title }}</h2>
                @php($max = max(1, $data->max() ?? 1))
                @forelse ($data as $label => $count)
                    <div class="hbar">
                        <div class="hbar-top"><span>{{ $label }}</span><span>{{ $count }}</span></div>
                        <div class="track"><div class="fill" style="width: {{ round($count / $max * 100) }}%"></div></div>
                    </div>
                @empty
                    <p class="muted">No data yet.</p>
                @endforelse
            </div>
        @endforeach
    </div>
@endsection
