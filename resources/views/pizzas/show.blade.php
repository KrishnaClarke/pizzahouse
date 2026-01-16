<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        @extends('layouts.layout')

        @section('content')

                                <h2 class="mt-6 text-xl font-semibold text-gray-900 dark:text-white">Pizza House<br/>
                       </h2>

                                <div class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
                                   <h1 class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">Order from {{$pizza->name}}</h1>
                                    <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">Type - {{$pizza->type}}</p>
                                    <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">Base - {{$pizza->base}}</p>
                                    <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">Extra toppings:</p>
                                <ul class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">

                                    @foreach($pizza->toppings as $topping)
                                    
                                    <li class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">{{$topping}}</li>
                                    @endforeach
                                    
                                </ul>
                                <form action="/pizzas/{{$pizza->id}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button>Complete Order</button>
                                </form>
                                </div>
                              
                                  <a href="/pizzas" class="back"><- Back to all pizzas </a>
                            </div>

@endsection