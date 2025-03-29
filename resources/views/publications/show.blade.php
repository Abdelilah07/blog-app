<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Publication Details') }}: {{ $publication->title }}
        </h2>
    </x-slot>

    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h2 class="text-2xl font-bold mb-4">{{ $publication->title }}</h2>
                <p class="text-gray-600 mb-4">{{ $publication->content }}</p>
                <p class="text-sm text-gray-500 mt-2">
                    By:
                    @foreach($publication->users as $user)
                        {{ $user->name }}{{ !$loop->last ? ',' : '' }}
                    @endforeach
                </p>
                <p class="text-xs text-gray-400 mt-1">
                    Created: {{ $publication->created_at->diffForHumans() }}
                </p>
            </div>
        </div>
    </div>
</x-app-layout>