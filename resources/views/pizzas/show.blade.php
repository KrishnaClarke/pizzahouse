@extends('layouts.layout')

@section('title', 'Order #'.$pizza->id)

@section('content')
    <a href="/pizzas" class="back">&larr; Back to all orders</a>

    <div class="card">
        <h1>Order #{{ $pizza->id }} &ndash; {{ $pizza->name }}</h1>
        <p><span class="badge {{ $pizza->status }}">{{ ucfirst($pizza->status) }}</span></p>

        <dl>
            <dt>Type</dt>
            <dd>{{ \App\Models\Pizza::TYPES[$pizza->type][0] ?? $pizza->type }}</dd>
            <dt>Crust</dt>
            <dd>{{ \App\Models\Pizza::CRUSTS[$pizza->base][0] ?? $pizza->base }}</dd>
            <dt>Extra toppings</dt>
            <dd>
                @if (count($pizza->toppings ?? []))
                    <ul>
                        @foreach ($pizza->toppings as $topping)
                            <li>{{ ucfirst($topping) }}</li>
                        @endforeach
                    </ul>
                @else
                    None
                @endif
            </dd>
            <dt>Total</dt>
            <dd>${{ number_format($pizza->price, 2) }} BBD</dd>
            <dt>Ordered</dt>
            <dd>{{ $pizza->created_at->diffForHumans() }}</dd>
        </dl>

        <div class="actions">
            @unless ($pizza->isCompleted())
                <form action="/pizzas/{{ $pizza->id }}/complete" method="POST">
                    @csrf
                    @method('PATCH')
                    <button class="btn">Complete order</button>
                </form>
            @endunless
            <form action="/pizzas/{{ $pizza->id }}" method="POST" onsubmit="return confirm('Cancel this order?')">
                @csrf
                @method('DELETE')
                <button class="btn danger">Cancel order</button>
            </form>
        </div>
    </div>
@endsection
