@extends('layouts.app')

@section('head')
    <script>
        window.message = @json($message);
        window.previous = '{{ route('home') }}';
    </script>
@endsection

@section('content')
    <div id="message">
        <div class="sticky top-0 flex flex-row items-center justify-between py-2 bg-white md:py-3">
            <a href="{{ route('home') }}" class="block text-blue-800">
                <svg viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 arrow-left">
                    <path fill-rule="evenodd"
                        d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z"
                        clip-rule="evenodd"></path>
                </svg>
            </a>
            <div>
                <div class="w-full md:max-w-sm">
                    <button class="text-sm text-red-700 hover:text-red-600 md:border md:border-red-600 md:p-1"
                        @click="confirmDeletion = true"
                        type="button">
                        <svg viewBox="0 0 20 20" fill="currentColor" class="w-6 h-6 trash">
                            <path fill-rule="evenodd"
                                d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <div class="py-1 break-words md:shadow md:p-3">
            <div>
                <p class="font-medium">{{ $message->subject }}</p>
            </div>
            <div class="flex flex-row justify-between mt-2">
                <div class="flex">
                    <img class="w-10 h-10 mr-2 rounded-full" src="{{ $message->sender_avatar_url }}"
                        alt="Avatar of {{ $message->sender_email }}">
                    <div class="text-sm">
                        <p class="mt-1 font-medium leading-none text-gray-900">
                            {{ $message->sender_name ?? $message->sender_email }}</p>
                        <p class="mt-1 text-xs leading-none text-gray-600">{{ $message->sender_email }}</p>
                    </div>
                </div>
                <div class="hidden text-sm text-gray-600 md:block">
                    {{ $message->received_at->diffForHumans() }}
                </div>
            </div>
            <div class="py-3 pl-1 overflow-x-auto">
                {!! $message->html !!}
            </div>
        </div>
        <confirmation-modal :show="confirmDeletion" @close="confirmDeletion = false" @confirm="deleteMessage"
            @cancel="confirmDeletion = false" />
    </div>
@endsection

@section('scripts')
    <script src="{{ mix('js/message.js') }}"></script>
@endsection
