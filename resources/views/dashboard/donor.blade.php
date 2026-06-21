<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Donor Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4">
                <div class="p-6 text-gray-900">
                    {{ __("Welcome Donor! Thank you for your life-saving contributions.") }}
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <a href="{{ route('donations.create') }}" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">Log a Donation</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
