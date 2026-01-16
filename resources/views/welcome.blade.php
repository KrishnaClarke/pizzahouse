<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
        @extends('layouts.layout')

@section('content')
   
                                <h2 class="mt-6 text-xl font-semibold text-gray-900 dark:text-white">Pizza House<br/>
                        The best Pizza in BIM</h2>
                                <p class="mssg">{{session('mssg')}}</p>
                                <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
                                    Laravel has wonderful documentation covering every aspect of the framework. Whether you are a newcomer or have prior experience with Laravel, we recommend reading our documentation from beginning to end.
                                    <a  href="/pizzas/create">Order Pizza HereS</a>
                                </p>
                            </div>

@endsection