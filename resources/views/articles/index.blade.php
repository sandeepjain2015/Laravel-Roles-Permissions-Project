<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
        <nav class="flex space-x-4">
            <a href="{{ route('articles.index') }}" class="text-gray-600 hover:text-gray-900">All articles</a>
            <a href="{{ route('articles.create') }}" class="text-blue-600 hover:text-blue-900">Create article</a>
        </nav>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @if (session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative"
                        article="alert">

                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif
                <table class="w-full">
                    <thead>
                        <tr>
                            <th class="px-4 py-2">Name</th>
                            <th class="px-4 py-2">Content</th>
                            <th class="px-4 py-2">Author</th>
                            <th class="px-4 py-2">Created At</th>
                            <th class="px-4 py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($articles as $article)
                            <tr>
                                <td class="border px-4 py-2">{{ $article->title }}</td>
                                <td class="border px-4 py-2">{{ $article->content }}</td>
                                <td class="border px-4 py-2">{{ $article->author }}</td>
                                <td class="border px-4 py-2">{{ $article->created_at->format('Y-m-d H:i') }}</td>
                                <td class="border px-4 py-2">
                                    @can('view article')
                                        <x-anchor-link href="{{ route('articles.show', $article->id) }}" class="">
                                            {{ __('Show') }}
                                        </x-anchor-link>
                                    @endcan
                                    @can('edit article')
                                        <x-anchor-link href="{{ route('articles.edit', $article->id) }}" class="">
                                            {{ __('Edit') }}
                                        </x-anchor-link>
                                    @endcan
                                    @can('delete article')
                                        <form action="{{ route('articles.destroy', $article->id) }}" method="POST"
                                            class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <x-primary-button>
                                                {{ __('Delete') }}
                                            </x-primary-button>
                                        </form>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-4">
                    {{ $articles->links() }}
                </div>
            </div>

        </div>
</x-app-layout>
