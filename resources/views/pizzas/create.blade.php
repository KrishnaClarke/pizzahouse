@extends('layouts.layout')

@section('title', 'Order a pizza')

@section('content')
    <h1>Build your pizza</h1>

    @if ($errors->any())
        <div class="errors">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="/pizzas" method="POST" class="card form">
        @csrf

        <label for="name">Your name</label>
        <input type="text" name="name" id="name" value="{{ old('name') }}" maxlength="100" required>

        <label for="type">Type of pizza</label>
        <select name="type" id="type" required>
            @foreach (\App\Models\Pizza::TYPES as $key => [$label, $price])
                <option value="{{ $key }}" @selected(old('type') === $key)>{{ $label }} &ndash; ${{ $price }}</option>
            @endforeach
        </select>

        <label for="base">Crust</label>
        <select name="base" id="base" required>
            @foreach (\App\Models\Pizza::CRUSTS as $key => [$label, $extra])
                <option value="{{ $key }}" @selected(old('base') === $key)>{{ $label }}{{ $extra ? " (+\${$extra})" : '' }}</option>
            @endforeach
        </select>

        <fieldset>
            <legend>Extra toppings (+${{ \App\Models\Pizza::TOPPING_PRICE }} each)</legend>
            @foreach (\App\Models\Pizza::TOPPINGS as $topping)
                <label class="check">
                    <input type="checkbox" name="toppings[]" value="{{ $topping }}" @checked(in_array($topping, old('toppings', [])))>
                    {{ ucfirst($topping) }}
                </label>
            @endforeach
        </fieldset>

        <button type="submit" class="btn">Place order</button>
        <p class="muted">Prices in BBD.</p>
    </form>
@endsection
