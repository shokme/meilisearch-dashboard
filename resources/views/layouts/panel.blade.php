@extends('layouts.app')

@section('content')
    <div class="max-w-6xl mx-auto">
        <div class="mt-8 flex shadow rounded-sm">
            <x-index-nav/>
            <div class="w-2/3 border border-gray-100 border-l-0 px-4 py-4">
                @yield('panel')
            </div>
            <div
                x-data="{ open: false, message: '' }"
                x-show="open"
                @indexing.window="open = true; message = $event.detail.message; setTimeout(() => { open = false }, 2000)"
                x-transition:leave="transition ease-in duration-100"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                x-cloak
            >
                <div class="absolute top-8 right-4 rounded-md bg-blue-50 p-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-blue-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                      d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                      clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm leading-5 font-medium text-blue-800" x-text="message"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
