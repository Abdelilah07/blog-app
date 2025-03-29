<x-app-layout>
    {{-- Header Slot --}}
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl leading-tight">
                {{ __('Publications') }}
            </h2>
             {{-- Show Create button only if user is authorized by policy --}}
            @can('create', App\Models\Publication::class)
                <a href="{{ route('publications.create') }}" class="btn btn-primary btn-sm">Create New</a>
            @endcan
        </div>
    </x-slot>

    {{-- Main Content ($slot in app.blade.php) --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Flash messages are now handled by app.blade.php --}}

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse ($publications as $publication)
                    <div class="card bg-base-100 shadow-xl">
                        <div class="card-body">
                            <h2 class="card-title">{{ $publication->title }}</h2>
                            <p>{{ Str::limit($publication->content, 150) }}</p>
                            <p class="text-sm text-gray-500 mt-2">
                                By:
                                @foreach($publication->users as $user)
                                    {{ $user->name }}{{ !$loop->last ? ',' : '' }}
                                @endforeach
                            </p>
                            <p class="text-xs text-gray-400 mt-1">
                                Created: {{ $publication->created_at->diffForHumans() }}
                            </p>
                            <div class="card-actions justify-end mt-4">
                                @can('update', $publication)
                                    <a href="{{ route('publications.edit', $publication) }}" class="btn btn-xs btn-warning">Edit</a>
                                @endcan
                                @can('delete', $publication)
                                    <form action="{{ route('publications.destroy', $publication) }}" method="POST" onsubmit="return confirm('Are you sure?');" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-xs btn-error">Delete</button>
                                    </form>
                                @endcan
                                {{-- Optional View Button --}}
                                {{-- @can('view', $publication) <a href="{{ route('publications.show', $publication) }}" class="btn btn-xs btn-info">View</a> @endcan --}}
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-10 bg-base-100 rounded-lg shadow-sm">
                        <p class="text-gray-500 text-xl">No publications found.</p>
                         @can('create', App\Models\Publication::class)
                             <a href="{{ route('publications.create') }}" class="btn btn-primary mt-4">Create the first one!</a>
                         @endcan
                    </div>
                @endforelse
            </div>

            {{-- Pagination Links --}}
            <div class="mt-8">
                {{ $publications->links() }} {{-- Tailwind pagination styles should apply --}}
            </div>
        </div>
    </div>
</x-app-layout>