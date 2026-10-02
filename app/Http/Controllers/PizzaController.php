<?php

namespace App\Http\Controllers;

use App\Models\Pizza;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PizzaController extends Controller
{
    public function index()
    {
        $pizzas = Pizza::latest()->get();

        return view('pizzas.index', ['pizzas' => $pizzas]);
    }

    public function show(Pizza $pizza)
    {
        return view('pizzas.show', ['pizza' => $pizza]);
    }

    public function create()
    {
        return view('pizzas.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'type' => ['required', Rule::in(array_keys(Pizza::TYPES))],
            'base' => ['required', Rule::in(array_keys(Pizza::CRUSTS))],
            'toppings' => ['nullable', 'array'],
            'toppings.*' => [Rule::in(Pizza::TOPPINGS)],
        ]);

        $toppings = array_values(array_unique($data['toppings'] ?? []));

        $pizza = Pizza::create([
            'name' => $data['name'],
            'type' => $data['type'],
            'base' => $data['base'],
            'toppings' => $toppings,
            'price' => Pizza::calculatePrice($data['type'], $data['base'], $toppings),
            'status' => Pizza::STATUS_PENDING,
        ]);

        return redirect('/')->with(
            'mssg',
            sprintf('Thanks for your order, %s! Your total is $%s BBD.', $pizza->name, number_format($pizza->price, 2))
        );
    }

    public function complete(Pizza $pizza)
    {
        $pizza->update(['status' => Pizza::STATUS_COMPLETED]);

        return redirect('/pizzas')->with('mssg', 'Order marked as completed.');
    }

    public function destroy(Pizza $pizza)
    {
        $pizza->delete();

        return redirect('/pizzas')->with('mssg', 'Order cancelled.');
    }
}
