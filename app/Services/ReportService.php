<?php

namespace App\Services;

use App\Repositories\SaleRepositoryInterface;
use App\Repositories\TransactionRepositoryInterface;
use App\Repositories\InventoryRepositoryInterface;
use Carbon\Carbon;

class ReportService
{
    public function __construct(
        protected SaleRepositoryInterface $saleRepository,
        protected TransactionRepositoryInterface $transactionRepository,
        protected InventoryRepositoryInterface $inventoryRepository
    ) {}

    public function getDashboardStats()
    {
        $today = Carbon::today();
        return [
            'daily_sales' => $this->saleRepository->getDailyTotal($today),
            'monthly_sales' => $this->saleRepository->getMonthlyTotal(Carbon::now()->month),
            'total_customers' => \App\Models\Customer::count(),
            'low_stock_items' => $this->inventoryRepository->getLowStockCount(),
            'recent_sales' => $this->saleRepository->getRecent(5),
            'sales_chart_data' => $this->saleRepository->getWeeklyTrend(),
        ];
    }

    public function generateFinancialReport(Carbon $startDate, Carbon $endDate)
    {
        return $this->transactionRepository->getByDateRange($startDate, $endDate);
    }
}
