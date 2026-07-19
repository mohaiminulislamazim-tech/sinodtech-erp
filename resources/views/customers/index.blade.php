<x-app-layout>
    <div class="flex">
        @include("layouts.partials.sidebar")

        <main class="w-full">
            <x-slot name="header">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __("Customers") }}
                </h2>
            </x-slot>

            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="text-lg font-medium text-gray-900">Customers</h3>
                                <a href="{{ route("customers.create") }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Create Customer</a>
                            </div>
                            @if (session("success"))
                                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                                    <span class="block sm:inline">{{ session("success") }}</span>
                                </div>
                            @endif
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Phone</th>
                                        <th scope="col" class="relative px-6 py-3">
                                            <span class="sr-only">Edit</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @forelse ($customers as $customer)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $customer->name }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $customer->email }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $customer->phone }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                <a href="{{ route("customers.show", $customer) }}" class="text-indigo-600 hover:text-indigo-900">Show</a>
                                                <a href="{{ route("customers.edit", $customer) }}" class="text-indigo-600 hover:text-indigo-900 ml-4">Edit</a>
                                                <form action="{{ route("customers.destroy", $customer) }}" method="POST" class="inline-block">
                                                    @csrf
                                                    @method("DELETE")
                                                    <button type="submit" class="text-red-600 hover:text-red-900 ml-4">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="px-6 py-4 whitespace-nowrap text-center text-gray-500">No customers found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <div class="mt-4">
                                {{ $customers->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</x-app-layout>
