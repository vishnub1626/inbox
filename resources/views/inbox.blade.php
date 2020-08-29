@extends('layouts.app')

@section('content')
    <div class="sticky top-0 flex flex-row items-center justify-between py-4 bg-white border-b border-blue-100 md:py-3">
        <a
            class="flex-shrink-0 px-1 py-1 mr-2 text-sm text-blue-800 bg-gray-100 border border-gray-500 hover:text-blue-900"
            href="{{ route('home') }}"
            >
            <svg viewBox="0 0 20 20" fill="currentColor" class="w-6 h-6 refresh">
                <path fill-rule="evenodd"
                    d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z"
                    clip-rule="evenodd"></path>
            </svg>
        </a>
        <div>
            <form class="w-full md:max-w-sm" method='GET' action=''>
                <div class="flex items-center bg-white border border-gray-500 shadow-sm">
                    <input
                        class="w-full px-2 mr-2 leading-tight text-gray-700 bg-transparent border-none appearance-none focus:outline-none"
                        name='q'
                        value="{{ request('q') ?? ''}}"
                        type="text" placeholder="Search..." aria-label="Search">
                    <button
                        class="flex-shrink-0 px-2 py-1 text-sm text-blue-800 bg-gray-100 border-l border-gray-500 hover:text-blue-600"
                        type="submit">
                        <svg viewBox="0 0 20 20" fill="currentColor" class="w-6 h-6 search">
                            <path fill-rule="evenodd"
                                d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="grid gap-6 mt-4">
        @forelse ($messages as $message)
            <a href="{{ $message->path() }}" class="flex items-center truncate">
                <img class="w-10 h-10 mr-2 rounded-full" src="{{ $message->sender_avatar_url }}"
                    alt="Avatar of {{ $message->sender_email }}">
                <div class="text-sm">
                    <p class="font-medium leading-none text-gray-900">{{ $message->sender_name ?? $message->sender_email }}</p>
                    <p class="font-medium text-gray-900">{{ $message->subject }}</p>
                    <p class="text-gray-600">{{ $message->body }}</p>
                </div>
            </a>
        @empty
            <p>Nothing to show here.</p>
        @endforelse
    </div>
    <div class="py-10">
        {{ $messages->withQueryString()->links() }}
    </div>
@endsection
