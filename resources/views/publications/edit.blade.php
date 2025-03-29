<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Edit Publication') }}: {{ $publication->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            {{-- Flash/Validation messages handled by layout --}}

            <div class="card bg-base-100 shadow-xl">
                <div class="card-body">
                    <form method="POST" action="{{ route('publications.update', $publication) }}">
                        @csrf
                        @method('PUT')

                        {{-- Title --}}
                        <div class="form-control w-full mb-4">
                            <label class="label" for="title">
                                <span class="label-text">Title</span>
                            </label>
                            <input type="text" id="title" name="title" placeholder="Publication Title"
                                class="input input-bordered w-full @error('title') input-error @enderror"
                                value="{{ old('title', $publication->title) }}" required />
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
                                placeholder="Write your publication content here..." required>{{ old('content', $publication->content) }}</textarea>
                            @error('content')
                            <label class="label">
                                <span class="label-text-alt text-error">{{ $message }}</span>
                            </label>
                            @enderror
                        </div>


                        <div class="flex items-center justify-end mt-6 space-x-3">
                            <a href="{{ route('publications.index') }}" class="btn btn-ghost">Cancel</a>
                            <button type="submit" class="btn btn-primary">Update Publication</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>