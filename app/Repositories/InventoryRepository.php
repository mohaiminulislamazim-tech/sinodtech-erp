<?php

namespace App\Repositories;

use App\Models\Inventory;

class InventoryRepository extends BaseRepository implements InventoryRepositoryInterface
{
    public function __construct(Inventory $model)
    {
        parent::__construct($model);
    }

    public function findByProductAndBranch(int $productId, int $branchId)
    {
        return $this->model->where('product_id', $productId)
            ->where('branch_id', $branchId)
            ->first();
    }

    public function getLowStockCount()
    {
        return $this->model->whereColumn('quantity', '<=', 'low_stock_threshold')->count();
    }
}
