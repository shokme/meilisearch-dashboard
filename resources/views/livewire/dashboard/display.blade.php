<div>
    <div>
        <h3 class="font-semibold underline">Accept new fields</h3>
        <p>defines whether new fields should be automatically added to the searchable-attributes and the
            displayed-attributes. <a href="#">Learn more</a></p>
        <p>Default value: true</p>
        <span wire:click="toggleFields" role="checkbox" tabindex="0" aria-checked="false"
              class="group relative inline-flex items-center justify-center flex-shrink-0 h-5 w-10 cursor-pointer focus:outline-none">
            <span aria-hidden="true"
                  class="@if($acceptFields) bg-secondary-500 @else bg-gray-200 @endif absolute h-4 w-9 mx-auto rounded-full transition-colors ease-in-out duration-200"></span>
            <span aria-hidden="true"
                  class="@if($acceptFields) translate-x-5 @else translate-x-0 @endif absolute left-0 inline-block h-5 w-5 border border-gray-200 rounded-full bg-white shadow transform group-focus:shadow-outline group-focus:border-blue-300 transition-transform ease-in-out duration-200"></span>
        </span>
    </div>
    <div class="mt-4">
        <h3 class="font-semibold underline">Displayed attributes</h3>
        <p>Attributes of the records that will be sent within the answer to a search. <a href="#">Learn more</a></p>
        <p>Default value: ['*']</p>
        <button wire:click="restore('DisplayedAttributes')"
                class="mb-2 p-2 bg-primary-500 text-white border shadow rounded hover:bg-primary-300">Reset
        </button>
        <div x-data="{ open: false }">
            <div class="mb-4">
                <button @click="open = true"
                        class="bg-secondary-500 font-semibold text-white rounded shadow px-2 py-2 text-sm">
                    Add Displayed Attribute
                </button>
                <div class="absolute" x-show="open" x-cloak>
                    <x-modal-centered-action :label="'Create Attribute'">
                        <div class="mt-2">
                            <div class="flex items-center">
                                <input wire:keydown.enter="update" wire:model="attribute" @keydown.enter="open = false"
                                       class="mt-1 form-input block w-full sm:text-sm sm:leading-5"
                                       placeholder="add attribute"/>
                            </div>
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
                        <tbody>
                        @foreach($attributes as $i => $attribute)
                            <tr class="border border-gray-200 border-b-0">
                                <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500">
                                    {{ $attribute }}
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500">
                                    <button wire:click="delete('{{$i}}')"
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
    </div>
</div>
