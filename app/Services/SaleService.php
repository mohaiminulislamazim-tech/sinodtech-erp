<?php

namespace App\Services;

use App\Repositories\SaleRepositoryInterface;
use App\Repositories\InventoryRepositoryInterface;
use App\Repositories\TransactionRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Exception;

class SaleService
{
    public function __construct(
        protected SaleRepositoryInterface $saleRepository,
        protected InventoryRepositoryInterface $inventoryRepository,
        protected TransactionRepositoryInterface $transactionRepository
    ) {}

    public function processSale(array $data)
    {
        return DB::transaction(function () use ($data) {
            $totalAmount = 0;
            foreach ($data['items'] as $item) {
                $totalAmount += $item['price'] * $item['quantity'];
            }

            $sale = $this->saleRepository->create([
                'customer_id' => $data['customer_id'],
                'branch_id' => $data['branch_id'],
                'total_amount' => $totalAmount,
                'discount' => $data['discount'] ?? 0,
                'payment_method' => $data['payment_method'],
                'status' => 'completed',
            ]);

            foreach ($data['items'] as $item) {
                $sale->items()->create([
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                ]);

                // Update Inventory
                $inventory = $this->inventoryRepository->findByProductAndBranch($item['product_id'], $data['branch_id']);
                if (!$inventory || $inventory->quantity < $item['quantity']) {
                    throw new Exception("Insufficient stock for product ID: {$item['product_id']}");
                }

                $this->inventoryRepository->update($inventory->id, [
                    'quantity' => $inventory->quantity - $item['quantity']
                ]);
            }

            // Create Transaction
            $this->transactionRepository->create([
                'branch_id' => $data['branch_id'],
                'amount' => $totalAmount - ($data['discount'] ?? 0),
                'type' => 'income',
                'description' => "Sale #{$sale->id}",
                'reference_id' => $sale->id,
                'reference_type' => get_class($sale),
            ]);

            return $sale;
        });
    }
}
