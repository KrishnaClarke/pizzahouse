@extends('layouts.layout')

@section('title', 'Orders')

@section('content')
    <h1>Orders</h1>

    @forelse ($pizzas as $pizza)
        <a href="/pizzas/{{ $pizza->id }}" class="card order">
            <span><strong>{{ $pizza->name }}</strong> &middot; {{ \App\Models\Pizza::TYPES[$pizza->type][0] ?? $pizza->type }}</span>
            <span>
                ${{ number_format($pizza->price, 2) }}
                <span class="badge {{ $pizza->status }}">{{ ucfirst($pizza->status) }}</span>
            </span>
        </a>
    @empty
        <p class="muted">No orders yet.</p>
    @endforelse
@endsection
