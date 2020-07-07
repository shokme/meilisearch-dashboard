@props(['links' => []])
<div class="text-sm">
    @foreach($links as $link)
        <a class="px-6 py-3 block text-primary-300 hover:text-primary-500 hover:bg-gray-100 ease-in duration-100 @if(request()->query('s') === $link) bg-gray-100 border-l-4 border-secondary-500 @endif"
           {{ $attributes->merge(['href' => '?s='.$link]) }}>
            <span class="@if(request()->query('s') === $link) -ml-2 @endif truncate">{{ ucfirst($link) }}</span>
        </a>
    @endforeach
</div>
