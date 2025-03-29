<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container mx-auto px-4">
            <div class="card bg-base-100 shadow-xl">
                <div class="card-body">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
