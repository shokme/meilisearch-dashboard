<div x-data="{ open: false }">
    <h3 class="font-semibold underline">Synonyms</h3>
    <p>A set of words defined for an index. <a class="underline text-blue-500" href="https://docs.meilisearch.com/guides/advanced_guides/settings.html#synonyms">Learn more</a></p>
    <button wire:click="restore('Synonyms')"
            class="mb-2 p-2 bg-primary-500 text-white border shadow rounded hover:bg-primary-300">Reset
    </button>
    <div class="mt-2 mb-4">
        <button @click="open = true" class="bg-secondary-500 font-semibold text-white rounded shadow px-2 py-2 text-sm">
            Add Synonyms
        </button>
        <div class="absolute" x-show="open" x-cloak>
            <x-modal-centered-action :label="'Create Synonym'">
                <div class="mt-2">
                    <span class="block text-sm leading-5 font-medium text-gray-700">Type</span>
                    <div class="shadow border rounded px-2 py-4 space-y-4">
                        <div class="flex items-center">
                            <input wire:model.lazy="type" id="synonyms" value="synonyms" name="synonyms" type="radio"
                                   class="form-radio h-4 w-4 text-indigo-600 transition duration-150 ease-in-out">
                            <label for="synonyms" class="ml-3 block">
                                <span class="block text-sm leading-5 font-medium text-gray-700">Synonyms</span>
                            </label>
                        </div>
                        <div class="flex items-center">
                            <input wire:model.lazy="type" id="oneway" value="oneway" name="oneway" type="radio"
                                   class="form-radio h-4 w-4 text-indigo-600 transition duration-150 ease-in-out">
                            <label for="oneway" class="ml-3">
                                <span class="block text-sm leading-5 font-medium text-gray-700">One-way Synonyms</span>
                            </label>
                        </div>
                    </div>
                    @if($type === 'synonyms')
                        <div class="relative rounded-md shadow-sm">
                            <label for="synonyms" class="ml-3">
                                <span class="block text-sm leading-5 font-medium text-gray-700">Synonyms</span>
                            </label>
                            <input required @keydown.enter="open = false;" wire:keydown.enter="update" wire:model="updateSynonyms"
                                   class="mt-1 form-input block w-full sm:text-sm sm:leading-5"
                                   placeholder="List of synonyms (separated by ',')"/>
                        </div>
                    @else
                        <div class="relative rounded-md shadow-sm">
                            <label for="synonyms" class="ml-3">
                                <span class="block text-sm leading-5 font-medium text-gray-700">Search term</span>
                            </label>
                            <input required @keydown.enter="open = false;" wire:keydown.enter="update" wire:model="updateSynonyms"
                                   class="mt-1 form-input block w-full sm:text-sm sm:leading-5"
                                   placeholder="Expression"/>
                        </div>

                        <div class="relative rounded-md shadow-sm">
                            <label for="synonyms" class="ml-3">
                                <span class="block text-sm leading-5 font-medium text-gray-700">Alternative</span>
                            </label>
                            <input required  @keydown.enter="open = false;" wire:keydown.enter="update" wire:model="alternative"
                                   class="mt-1 form-input block w-full sm:text-sm sm:leading-5"
                                   placeholder="List of synonyms (separated by ',')"/>
                        </div>
                    @endif
                </div>
                <x-slot name="button">
                    <div class="mt-5 sm:mt-6">
                        <span class="flex w-full rounded-md shadow-sm">
                            <button wire:click="update" @click="open = false;" type="button"
                                    class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-primary-500 text-base leading-6 font-medium text-white shadow-sm hover:bg-gray-800 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                                Save
                            </button>
                        </span>
                    </div>
                </x-slot>
            </x-modal-centered-action>
        </div>
    </div>
    <div class="overflow-x-auto -mx-2 px-2">
        <div class="align-middle inline-block min-w-full overflow-hidden border-b border-gray-200 rounded">
            <table class="min-w-full">
                <thead>
                <tr>
                    <th class="px-6 py-3 border border-r-0 border-gray-200 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                        Expansion
                    </th>
                    <th class="px-6 py-3 border border-l-0 border-gray-200 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($synonyms as $key => $synonym)
                    <tr class="border border-gray-200 border-b-0">
                        <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500">
                            {{ $key }} @foreach($synonym as $value) <--> {{ $value }}  @endforeach
                        </td>
                        <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500">
                            <button wire:click="delete('{{$key}}')"
                                    class="ml-1 p-1  bg-gray-50 border border-gray-200 rounded shadow">
                                <svg class="w-5 text-secondary-500" fill="none" stroke-linecap="round"
                                     stroke-linejoin="round" stroke-width="1.5" viewBox="0 0 24 24"
                                     stroke="currentColor">
                                    <path
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                            </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
