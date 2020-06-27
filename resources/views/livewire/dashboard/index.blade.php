<div class="max-w-6xl mx-auto">
    <div class="mt-8 flex shadow rounded-sm">
        <x-index-nav/>
        <div class="w-2/3 border border-gray-100 border-l-0 px-4 py-4">
            @switch(request()->query('s'))
                @case('synonyms')
                <livewire:dashboard.synonym :uid="$index"></livewire:dashboard.synonym>
                @break
                @case('ranks')
                <livewire:dashboard.rank :uid="$index"></livewire:dashboard.rank>
                @break
                @case('stopwords')
                <livewire:dashboard.stop-word :uid="$index"></livewire:dashboard.stop-word>
                @break
                @case('facets')
                <livewire:dashboard.facet :uid="$index"></livewire:dashboard.facet>
                @break
                @case('distinct')
                <livewire:dashboard.distinct :uid="$index"></livewire:dashboard.distinct>
                @break
            @endswitch
        </div>
    </div>
</div>
