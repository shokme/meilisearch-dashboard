<div class="w-1/3 border border-gray-100">
    <div>
        <div class="mx-4 my-4 relative rounded shadow-sm">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="w-4 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                          d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                          clip-rule="evenodd"></path>
                </svg>
            </div>
            <input id="email" class="form-input block w-full pl-10 sm:text-sm sm:leading-5"
                   placeholder="Search settings"/>
        </div>
    </div>

    <div class="text-sm">
        <h3 class="px-6 pt-2 text-xs pb-3 text-primary-500 uppercase font-semibold leading-normal">Relevance
            Essentials</h3>
        <a class="px-6 py-3 block text-primary-300 hover:text-primary-500 hover:bg-gray-100 ease-in duration-100 @if(request()->query('s') === 'synonyms') bg-gray-100 border-l-4 border-secondary-500 @endif"
           href="?s=synonyms">
            <span class="@if(request()->query('s') === 'synonyms') -ml-2 @endif truncate">Synonyms</span>
        </a>
        <a class="px-6 py-3 block text-primary-300 hover:text-primary-500 hover:bg-gray-100 ease-in duration-100 @if(request()->query('s') === 'stopwords') bg-gray-100 border-l-4 border-secondary-500 @endif"
           href="?s=stopwords">
            <span class="@if(request()->query('s') === 'stopwords') -ml-2 @endif truncate">Stop-words</span>
        </a>
        <a class="px-6 py-3 block text-primary-300 hover:text-primary-500 hover:bg-gray-100 ease-in duration-100 @if(request()->query('s') === 'facets') bg-gray-100 border-l-4 border-secondary-500 @endif"
           href="?s=facets">
            <span class="@if(request()->query('s') === 'facets') -ml-2 @endif truncate">Faceting</span>
        </a>
        <a class="px-6 py-3 block text-primary-300 hover:text-primary-500 hover:bg-gray-100 ease-in duration-100 @if(request()->query('s') === 'ranks') bg-gray-100 border-l-4 border-secondary-500 @endif"
           href="?s=ranks">
            <span class="@if(request()->query('s') === 'ranks') -ml-2 @endif truncate">Ranking</span>
        </a>
        <a class="px-6 py-3 block text-primary-300 hover:text-primary-500 hover:bg-gray-100 ease-in duration-100 @if(request()->query('s') === 'distinct') bg-gray-100 border-l-4 border-secondary-500 @endif"
           href="?s=distinct">
            <span class="@if(request()->query('s') === 'distinct') -ml-2 @endif truncate">Distinct</span>
        </a>
        <a class="px-6 py-3 block text-primary-300 hover:text-primary-500 hover:bg-gray-100 ease-in duration-100 @if(request()->query('s') === 'searchable') bg-gray-100 border-l-4 border-secondary-500 @endif"
           href="?s=searchable">
            <span class="@if(request()->query('s') === 'searchable') -ml-2 @endif truncate">Searchable</span>
        </a>
    </div>
</div>
