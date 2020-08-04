<div>
    <h3 class="font-semibold underline">Attributes for faceting</h3>
    <p>List of attributes to use for faceting. <a class="underline text-blue-500" target="_blank" href="https://docs.meilisearch.com/guides/advanced_guides/settings.html#attributes-for-faceting">Learn more</a></p>
    <p>Default value: []</p>
    <button wire:click="restore('AttributesForFaceting')"
            class="mb-2 p-2 bg-primary-500 text-white border shadow rounded hover:bg-primary-300">Reset
    </button>
    <div class="mt-4 p-4 text-gray-700 bg-gray-100 border-t-4 border-primary-500 rounded-sm">
        @if(! count($facets))
            Not configured
        @else
            @foreach($facets as $i => $facet)
                <li class="flex items-center min-h-16 p-2">
                    <div class="flex-1">
                        <div class="flex items-center">
                            <span class="inline-block mx-2 font-semibold min-w-20">{{ $facet }}</span>
                        </div>
                    </div>
                    <span class="">
                        <button type="button"
                                class="bg-gray-50 border shadow-sm inline-flex items-center justify-center rounded h-8 w-8 text-md btn-neutral text-gray-600 ml-4"
                                aria-label="Remove Item"
                                wire:click="delete({{ $i }})">
                            <svg
                                width="1em" height="1em" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="">
                                <polyline points="3 6 5 6 21 6"></polyline>
                                <path
                                    d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                            </svg>
                        </button>
                    </span>
                </li>
            @endforeach
        @endif
    </div>
    <div x-data="{ open: false }">
        <button @click="open = true" class="mt-2 p-2 w-full border bg-gray-50 justify-center rounded-sm">+ Add an
            Attribute
        </button>
        <div class="absolute" x-show="open" x-cloak>
            <x-modal-centered-action :label="'Create Facet'">
                <div class="relative rounded-md shadow-sm">
                    <input required wire:model="attribute" wire:keydown.enter="add" @keydown.enter="open = false;"
                           class="mt-1 form-input block w-full sm:text-sm sm:leading-5"
                           placeholder="Add an attribute"/>
                </div>
                <x-slot name="button">
                    <div class="mt-5 sm:mt-6">
                        <span class="flex w-full rounded-md shadow-sm">
                            <button wire:click="add" @click="open = false;" type="button"
                                    class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-primary-500 text-base leading-6 font-medium text-white shadow-sm hover:bg-gray-800 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                                Save
                            </button>
                        </span>
                    </div>
                </x-slot>
            </x-modal-centered-action>
        </div>
    </div>
</div>
