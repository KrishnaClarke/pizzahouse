<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        @extends('layouts.layout')

        @section('content')

                                <h2 class="mt-6 text-xl font-semibold text-gray-900 dark:text-white">Pizza House<br/>
                         Pizzas Menu</h2>

                                <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
                                   
                                
                                 


                                  @foreach($pizzas as $pizza)
                                    <div class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">

                                    <a href="/pizzas/{{ $pizza->id }}">{{ $pizza->name }}</a>
                                 
                                    </div>
                                  @endforeach
                                </p>
                              
                                  
                            </div>

@endsection