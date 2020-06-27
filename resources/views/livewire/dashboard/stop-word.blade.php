<div x-data="{ focus: false, words: [] }">
    <h3 class="font-semibold underline">Optional words</h3>
    <p>List of words that should be considered as optional. <a href="#">Learn more</a></p>
    <button wire:click="resetStopWords"
            class="mb-2 p-2 bg-primary-500 text-white border shadow rounded hover:bg-primary-300">Reset
    </button>
    <div class="mt-2 box-border border-0">
        <div
            @click="focus = true; $refs.words.focus()" @click.away="focus = false"
            class="flex items-center w-full min-h-10 px-4 @if(!$stopwords) py-3 @else py-1 @endif overflow-hidden text-xs leading-tight cursor-text bg-white border rounded border-gray-100 shadow-inner"
            :class="{ 'border-secondary-500 shadow': focus }">
            @if($stopwords)
                <div class="flex flex-wrap -ml-1 items-center">
                    @foreach($stopwords as $i => $word)
                        <span
                            @click.stop
                            class="inline-flex items-center border border-transparent rounded overflow-hidden h-6 px-2 text-xs leading-none bg-gray-100 border-gray-200 text-gray-700 m-1 max-w-48"
                            aria-label="foo">
                            <span class="truncate flex-1">{{ $word }}</span>
                            <button
                                wire:click="delete('{{ $i }}')"
                                class="outline-none h-full px-1 ml-2 -mr-2 border-l border-gray-200 hover:bg-gray-200 focus:bg-gray-200"
                                type="button" aria-label="Remove {{ $word }}">
                                <svg width="1em" height="1em" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                     stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <line x1="18" y1="6" x2="6" y2="18"></line>
                                    <line x1="6" y1="6" x2="18" y2="18"></line>
                                </svg>
                            </button>
                        </span>
                    @endforeach
                </div>
            @endif
            <input x-ref="words" @keydown.enter="addWord(@this, event.target.value)"
                   class="ml-1 flex bg-transparent text-primary-500 min-w-4" autocomplete="off" type="text"/>
        </div>
    </div>
</div>
<script>
    function addWord(lw, word) {
        const component = window.livewire.find(lw.id);
        component.call('update', word)
    }
</script>
