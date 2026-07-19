<?php

namespace App\Services;

use App\Repositories\InventoryRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Exception;

class InventoryService
{
    public function __construct(
        protected InventoryRepositoryInterface $inventoryRepository
    ) {}

    public function transferStock(int $productId, int $fromBranchId, int $toBranchId, int $quantity)
    {
        return DB::transaction(function () use ($productId, $fromBranchId, $toBranchId, $quantity) {
            $source = $this->inventoryRepository->findByProductAndBranch($productId, $fromBranchId);
            
            if (!$source || $source->quantity < $quantity) {
                throw new Exception("Insufficient stock in source branch.");
            }

            // Deduct from source
            $this->inventoryRepository->update($source->id, [
                'quantity' => $source->quantity - $quantity
            ]);

            // Add to destination
            $target = $this->inventoryRepository->findByProductAndBranch($productId, $toBranchId);
            
            if ($target) {
                $this->inventoryRepository->update($target->id, [
                    'quantity' => $target->quantity + $quantity
                ]);
            } else {
                $this->inventoryRepository->create([
                    'product_id' => $productId,
                    'branch_id' => $toBranchId,
                    'quantity' => $quantity,
                    'low_stock_threshold' => 10, // Default
                ]);
            }

            return true;
        });
    }

    public function adjustStock(int $inventoryId, int $newQuantity, string $reason)
    {
        return $this->inventoryRepository->update($inventoryId, [
            'quantity' => $newQuantity,
            'last_adjustment_reason' => $reason
        ]);
    }
}
