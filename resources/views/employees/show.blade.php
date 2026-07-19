<x-app-layout>
    <div class="flex">
        @include("layouts.partials.sidebar")

        <main class="w-full">
            <x-slot name="header">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __("Employee Details") }}
                </h2>
            </x-slot>

            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <div class="mb-4">
                                <strong class="text-gray-700">Name:</strong> {{ $employee->name }}
                            </div>
                            <div class="mb-4">
                                <strong class="text-gray-700">Email:</strong> {{ $employee->email }}
                            </div>
                            <div class="mb-4">
                                <strong class="text-gray-700">Phone:</strong> {{ $employee->phone }}
                            </div>
                            <div class="mb-4">
                                <strong class="text-gray-700">Address:</strong> {{ $employee->address }}
                            </div>
                            <div class="mb-4">
                                <strong class="text-gray-700">Salary:</strong> {{ $employee->salary }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</x-app-layout>
