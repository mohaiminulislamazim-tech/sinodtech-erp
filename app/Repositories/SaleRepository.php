<?php

namespace App\Repositories;

use App\Models\Sale;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class SaleRepository extends BaseRepository implements SaleRepositoryInterface
{
    public function __construct(Sale $model)
    {
        parent::__construct($model);
    }

    public function getDailyTotal(Carbon $date)
    {
        return $this->model->whereDate('created_at', $date)->sum('total_amount');
    }

    public function getMonthlyTotal(int $month)
    {
        return $this->model->whereMonth('created_at', $month)->sum('total_amount');
    }

    public function getRecent(int $limit = 5)
    {
        return $this->model->with('customer')->latest()->take($limit)->get();
    }

    public function getWeeklyTrend()
    {
        $days = collect(range(6, 0))->map(fn($i) => Carbon::today()->subDays($i)->format('Y-m-d'));
        
        $data = $this->model->select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('SUM(total_amount) as total')
            )
            ->where('created_at', '>=', Carbon::today()->subDays(6))
            ->groupBy('date')
            ->get()
            ->pluck('total', 'date');

        return [
            'labels' => $days->map(fn($d) => Carbon::parse($d)->format('D'))->toArray(),
            'values' => $days->map(fn($d) => (float)($data[$d] ?? 0))->toArray(),
        ];
    }
}
