<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pizza extends Model
{
    use HasFactory;

    public const STATUS_PENDING = 'pending';
    public const STATUS_COMPLETED = 'completed';

    /** key => [label, price in BBD] */
    public const TYPES = [
        'margarita' => ['Margarita', 35],
        'hawaiian' => ['Hawaiian', 42],
        'veg supreme' => ['Veg Supreme', 45],
        'volcano' => ['Volcano', 48],
    ];

    /** key => [label, extra price in BBD] */
    public const CRUSTS = [
        'thick' => ['Thick', 0],
        'thin & crispy' => ['Thin & Crispy', 0],
        'cheese crust' => ['Cheese Crust', 8],
        'garlic crust' => ['Garlic Crust', 5],
    ];

    public const TOPPINGS = ['mushrooms', 'peppers', 'garlic', 'olives', 'pepperoni'];

    public const TOPPING_PRICE = 3;

    protected $fillable = ['name', 'type', 'base', 'toppings', 'price', 'status'];

    protected $casts = [
        'toppings' => 'array',
        'price' => 'decimal:2',
    ];

    public static function calculatePrice(string $type, string $base, array $toppings = []): float
    {
        return self::TYPES[$type][1]
            + self::CRUSTS[$base][1]
            + count($toppings) * self::TOPPING_PRICE;
    }

    public function isCompleted(): bool
    {
        return $this->status === self::STATUS_COMPLETED;
    }
}
