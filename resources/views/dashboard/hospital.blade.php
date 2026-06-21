<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Hospital Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in as a Hospital. Submit new blood requests below.") }}
                </div>
            </div>
            
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <a href="{{ route('blood-requests.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Request Blood</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
