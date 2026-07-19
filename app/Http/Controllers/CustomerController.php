<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Models\Customer;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::paginate(10);
        return view("customers.index", compact("customers"));
    }

    public function create()
    {
        return view("customers.create");
    }

    public function store(StoreCustomerRequest $request)
    {
        Customer::create($request->validated());
        return redirect()->route("customers.index")->with("success", "Customer created successfully.");
    }

    public function show(Customer $customer)
    {
        return view("customers.show", compact("customer"));
    }

    public function edit(Customer $customer)
    {
        return view("customers.edit", compact("customer"));
    }

    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        $customer->update($request->validated());
        return redirect()->route("customers.index")->with("success", "Customer updated successfully.");
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();
        return redirect()->route("customers.index")->with("success", "Customer deleted successfully.");
    }

    public function lost()
    {
        $lostCustomers = \App\Models\Customer::whereDoesntHave("sales", function ($query) {
            $query->where("created_at", ">=", now()->subDays(30));
        })->with(["sales" => function($query){
            $query->latest();
        }])->get();

        return view("customers.lost", compact("lostCustomers"));
    }
}
