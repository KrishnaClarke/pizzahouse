<?php

namespace App\Http\Controllers;

use App\Models\Pizza;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $stats = [
            'total' => Pizza::count(),
            'pending' => Pizza::where('status', Pizza::STATUS_PENDING)->count(),
            'revenue' => (float) Pizza::where('status', Pizza::STATUS_COMPLETED)->sum('price'),
            'open_value' => (float) Pizza::where('status', Pizza::STATUS_PENDING)->sum('price'),
            'average' => (float) Pizza::avg('price'),
        ];

        // Last 14 days, zero-filled so quiet days still show up.
        $days = collect(range(13, 0))->map(fn ($i) => now()->subDays($i)->startOfDay());
        $recent = Pizza::where('created_at', '>=', $days->first())
            ->get()
            ->groupBy(fn (Pizza $p) => $p->created_at->toDateString());

        $daily = $days->map(function ($day) use ($recent) {
            $orders = $recent->get($day->toDateString(), collect());

            return [
                'label' => $day->format('d M'),
                'orders' => $orders->count(),
                'revenue' => (float) $orders->sum('price'),
            ];
        });

        $byType = Pizza::select('type', DB::raw('count(*) as orders'))
            ->groupBy('type')->orderByDesc('orders')->get()
            ->mapWithKeys(fn ($row) => [Pizza::TYPES[$row->type][0] ?? $row->type => (int) $row->orders]);

        $byCrust = Pizza::select('base', DB::raw('count(*) as orders'))
            ->groupBy('base')->orderByDesc('orders')->get()
            ->mapWithKeys(fn ($row) => [Pizza::CRUSTS[$row->base][0] ?? $row->base => (int) $row->orders]);

        $toppings = Pizza::all(['id', 'toppings'])
            ->flatMap(fn (Pizza $p) => $p->toppings ?? [])
            ->countBy()
            ->sortDesc()
            ->mapWithKeys(fn ($count, $name) => [ucfirst($name) => $count]);

        return view('dashboard', [
            'stats' => $stats,
            'daily' => $daily,
            'maxOrders' => max(1, $daily->max('orders')),
            'maxRevenue' => max(1, $daily->max('revenue')),
            'byType' => $byType,
            'byCrust' => $byCrust,
            'toppings' => $toppings,
        ]);
    }
}
