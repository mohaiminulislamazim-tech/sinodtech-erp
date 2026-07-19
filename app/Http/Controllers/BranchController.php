<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\StoreBranchRequest;
use App\Http\Requests\UpdateBranchRequest;
use App\Models\Branch;

class BranchController extends Controller
{
    public function index()
    {
        $branches = Branch::paginate(10);
        return view("branches.index", compact("branches"));
    }

    public function create()
    {
        return view("branches.create");
    }

    public function store(StoreBranchRequest $request)
    {
        Branch::create($request->validated());
        return redirect()->route("branches.index")->with("success", "Branch created successfully.");
    }

    public function show(Branch $branch)
    {
        return view("branches.show", compact("branch"));
    }

    public function edit(Branch $branch)
    {
        return view("branches.edit", compact("branch"));
    }

    public function update(UpdateBranchRequest $request, Branch $branch)
    {
        $branch->update($request->validated());
        return redirect()->route("branches.index")->with("success", "Branch updated successfully.");
    }

    public function destroy(Branch $branch)
    {
        $branch->delete();
        return redirect()->route("branches.index")->with("success", "Branch deleted successfully.");
    }
}
