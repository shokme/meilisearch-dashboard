@props(['links' => [], 'uid' => ''])
<div class="text-sm">
    @foreach($links as $link)
        <a class="px-6 py-3 block text-primary-300 hover:text-primary-500 hover:bg-gray-100 ease-in duration-100 @if(\Illuminate\Support\Str::contains(request()->path(), $link))
            bg-gray-100 border-l-4 border-secondary-500 @endif" href="{{ url("/dashboard/indexes/$uid/$link") }}">
            <span class="@if(\Illuminate\Support\Str::contains(request()->path(), $link)) -ml-2 @endif truncate">{{ ucfirst($link) }}</span>
        </a>
    @endforeach
</div>
