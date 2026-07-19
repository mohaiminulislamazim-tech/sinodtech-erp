<?php

namespace App\Repositories;

use App\Models\Transaction;
use Illuminate\Support\Carbon;

class TransactionRepository extends BaseRepository implements TransactionRepositoryInterface
{
    public function __construct(Transaction $model)
    {
        parent::__construct($model);
    }

    public function getByDateRange(Carbon $startDate, Carbon $endDate)
    {
        return $this->model->with(['branch', 'sale'])
            ->whereBetween('created_at', [$startDate, $endDate])
            ->latest()
            ->get();
    }

    public function getSummaryByBranch(int $branchId)
    {
        return $this->model->where('branch_id', $branchId)
            ->selectRaw('type, SUM(amount) as total')
            ->groupBy('type')
            ->pluck('total', 'type');
    }
}
