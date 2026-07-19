<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Http\Resources\BranchResource;
use App\Http\Requests\StoreBranchRequest;
use App\Http\Requests\UpdateBranchRequest;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    public function index(Request $request)
    {
        $branches = Branch::withCount(['employees', 'inventories'])
            ->when($request->search, function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('location', 'like', '%' . $request->search . '%');
            })
            ->latest()
            ->paginate(20);

        return BranchResource::collection($branches);
    }

    public function store(StoreBranchRequest $request)
    {
        $branch = Branch::create($request->validated());
        return new BranchResource($branch);
    }

    public function show(Branch $branch)
    {
        return new BranchResource($branch->load(['employees', 'inventories.product']));
    }

    public function update(UpdateBranchRequest $request, Branch $branch)
    {
        $branch->update($request->validated());
        return new BranchResource($branch);
    }

    public function destroy(Branch $branch)
    {
        if ($branch->sales()->exists() || $branch->inventories()->exists()) {
            return response()->json(['error' => 'Cannot delete branch with active records.'], 422);
        }
        $branch->delete();
        return response()->json(['message' => 'Branch deleted.']);
    }
}
