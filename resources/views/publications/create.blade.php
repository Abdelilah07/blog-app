<x-app-layout>
    {{-- Header Slot --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Create New Publication') }}
        </h2>
    </x-slot>

    {{-- Main Content ($slot in app.blade.php) --}}
    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            {{-- Flash messages handled by layout --}}
            {{-- Validation errors can also be handled by layout if added there --}}

            <div class="card bg-base-100 shadow-xl">
                <div class="card-body">
                    <form method="POST" action="{{ route('publications.store') }}">
                        @csrf

                        {{-- Title --}}
                        <div class="form-control w-full mb-4">
                            <label class="label" for="title">
                                <span class="label-text">Title</span>
                            </label>
                            <input type="text" id="title" name="title" placeholder="Publication Title"
                                class="input input-bordered w-full @error('title') input-error @enderror"
                                value="{{ old('title') }}" required />
                            @error('title')
                            <label class="label">
                                <span class="label-text-alt text-error">{{ $message }}</span>
                            </label>
                            @enderror
                        </div>

                        {{-- Content --}}
                        <div class="form-control w-full mb-4">
                            <label class="label" for="content">
                                <span class="label-text">Content</span>
                            </label>
                            <textarea id="content" name="content"
                                class="textarea textarea-bordered h-48 @error('content') textarea-error @enderror"
                                placeholder="Write your publication content here..." required>{{ old('content') }}</textarea>
                            @error('content')
                            <label class="label">
                                <span class="label-text-alt text-error">{{ $message }}</span>
                            </label>
                            @enderror
                        </div>


                        <div class="form-control mt-6">
                            <button type="submit" class="btn btn-primary">Create Publication</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>