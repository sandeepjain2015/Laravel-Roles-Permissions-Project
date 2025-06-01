<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Article Detail') }}
        </h2>

        <nav class="flex space-x-4">
            
            <a href="{{ route('articles.create') }}" class="text-blue-600 hover:text-blue-900">Create article</a>
        </nav>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- // Display the article details --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold">{{ $article->title }}</h3>
                    <p class="text-sm text-gray-600">{{ $article->content }}</p>
                    <p class="text-sm text-gray-600">{{ $article->author }}</p>
                    <span class="text-xs text-gray-500">Created at:
                        {{ $article->created_at->format('Y-m-d H:i') }}</span>
                </div>
                <div>
                    @can('edit article')
                        <x-anchor-link href="{{ route('articles.edit', $article->id) }}" class="">
                            {{ __('Edit') }}
                        </x-anchor-link>
                    @endcan
                    @can('delete article')
                        <form action="{{ route('articles.destroy', $article->id) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <x-primary-button>
                                {{ __('Delete') }}
                            </x-primary-button>
                        </form>
                    @endcan
                </div>
            </div>
        </div>
</x-app-layout>
