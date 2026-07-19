<x-app-layout>
    <div class="flex">
        @include("layouts.partials.sidebar")

        <main class="w-full">
            <x-slot name="header">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __("Transaction Details") }}
                </h2>
            </x-slot>

            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <div class="mb-4">
                                <strong class="text-gray-700">Transaction ID:</strong> #{{ $transaction->id }}
                            </div>
                            <div class="mb-4">
                                <strong class="text-gray-700">Sale ID:</strong> #{{ $transaction->sale_id }}
                            </div>
                            <div class="mb-4">
                                <strong class="text-gray-700">Customer:</strong> {{ $transaction->sale->customer->name ?? 'N/A' }} ({{ $transaction->sale->customer->email ?? 'N/A' }})
                            </div>
                            <div class="mb-4">
                                <strong class="text-gray-700">Payment Method:</strong> {{ $transaction->payment_method }}
                            </div>
                            <div class="mb-4">
                                <strong class="text-gray-700">Amount Paid:</strong> ${{ number_format($transaction->amount, 2) }}
                            </div>
                            <div class="mb-4">
                                <strong class="text-gray-700">Date:</strong> {{ $transaction->created_at->format('d M Y H:i') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</x-app-layout>
