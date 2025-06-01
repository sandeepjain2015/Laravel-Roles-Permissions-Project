<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Article') }}
        </h2>

        <nav class="flex space-x-4">
            <a href="{{ route('articles.index') }}" class="text-gray-600 hover:text-gray-900">All Articles</a>
            <a href="{{ route('articles.create') }}" class="text-blue-600 hover:text-blue-900">Create Article</a>
        </nav>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative"
                            role="alert">
                            <strong class="font-bold">Success!</strong>
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative"
                            role="alert">
                            <strong class="font-bold">Error!</strong>
                            <span class="block sm:inline">{{ session('error') }}</span>
                        </div>
                    @endif
                    <form method="POST" action="{{ route('articles.store') }}">

                        @csrf
                        <div class="mb-4">
                            <x-input-label for="title" :value="__('Article Title')" />
                            <x-text-input id="title" class="block mt-1 w-full" type="text" name="title"
                                required />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>
                        <div class="mb-4">
                            <x-input-label for="content" :value="__('Content')" />
                            <x-textarea-input id="content" name="content" rows="5" required />
                            <x-input-error :messages="$errors->get('content')" class="mt-2" />
                        </div>
                        <div class="mb-4">
                            <x-input-label for="author" :value="__('Author')" />
                            <x-text-input id="author" class="block mt-1 w-full" type="text" name="author"
                                required />
                            <x-input-error :messages="$errors->get('author')" class="mt-2" />
                        </div>
                        <x-primary-button>
                            {{ __('Create Article') }}
                        </x-primary-button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
