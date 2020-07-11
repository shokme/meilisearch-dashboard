@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="mt-8 flex shadow rounded-sm">
        <x-index-nav/>
        <div class="w-2/3 border border-gray-100 border-l-0 px-4 py-4">
            @yield('panel')
        </div>
    </div>
</div>
@endsection
