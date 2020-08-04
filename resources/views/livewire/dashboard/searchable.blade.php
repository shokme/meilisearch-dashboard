<div>
    <h3 class="font-semibold underline">Searchable attributes</h3>
    <p>The complete list of attributes that will be used for searching. <a class="underline text-blue-500" target="_blank" href="https://docs.meilisearch.com/guides/advanced_guides/settings.html#searchable-attributes">Learn more</a></p>
    <p>Default value: ['*']</p>
    <button wire:click="restore('SearchableAttributes')"
            class="mb-2 p-2 bg-primary-500 text-white border shadow rounded hover:bg-primary-300">Reset
    </button>

    <ul id="list">
        @foreach($attributes as $attribute)
            <li id="{{ $loop->index }}"
                class="cursor-move flex items-center min-h-16 p-2 display-body bg-white border-b border-gray-100"
                x-data
                x-on:dragstart="
                event.dataTransfer.effectAllowed = 'move';
                event.dataTransfer.setData('text/plain', event.target.id)"
                x-on:dragover.prevent
                x-on:drop.prevent="
                const target = event.target.closest('li');
                const id = event.dataTransfer.getData('text/plain');
                const element = document.getElementById(id);
                const tmp = document.createElement('span');
                tmp.className='hide';
                target.before(tmp);
                element.before(target);
                tmp.replaceWith(element);
                update(@this)"
                draggable="true">
                <svg width="24" height="24"
                     class="flex-shrink-0 mr-2 text-gray-300">
                    <path fill="currentColor"
                          d="M22 15c0 .6-.4 1-1 1H3c-.6 0-1-.4-1-1s.4-1 1-1h18c.6 0 1 .4 1 1zM3 10h18c.6 0 1-.4 1-1s-.4-1-1-1H3c-.6 0-1 .4-1 1s.4 1 1 1z"></path>
                </svg>
                <div class="flex-1">
                    <div class="flex items-center">
                        <span class="inline-block mx-2 font-semibold min-w-20">
                            {{ $attribute }}
                        </span>
                    </div>
                </div>
                <span class="" draggable="false">
                    <button type="button"
                            class="bg-gray-50 border shadow-sm inline-flex items-center justify-center rounded h-8 w-8 text-md btn-neutral text-gray-600 ml-4"
                            aria-label="Remove Item"
                            wire:click="delete({{ $loop->index }})">
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
    </ul>
    <div class="mt-2" x-data="{ open: false }">
        <button @click="open = true" class="mt-2 p-2 w-full border bg-gray-50 justify-center rounded-sm">+ Add a
            searchable attribute
        </button>
        <div class="absolute" x-show="open" x-cloak>
            <x-modal-centered-action>
                <div class="relative rounded-md shadow-sm">
                    <div class="grid grid-cols-1 row-gap-6 col-gap-4 sm:grid-cols-6">
                        <div class="sm:col-span-6">
                            <input required wire:keydown.enter="add" wire:model="attribute" @keydown.enter="open = false"
                                   class="form-input block w-full sm:text-sm sm:leading-5"
                                   placeholder="Attribute"/>
                        </div>
                    </div>
                </div>
                <x-slot name="button">
                    <div class="mt-5 sm:mt-6">
                        <span class="flex w-full rounded-md shadow-sm">
                            <button wire:click="add" @click="open = false;" type="button"
                                    class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-primary-500 text-base leading-6 font-medium text-white shadow-sm hover:bg-gray-800 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                                Add attribute
                            </button>
                        </span>
                    </div>
                </x-slot>
            </x-modal-centered-action>
        </div>
    </div>

</div>

<script>
    function update(lw, rule) {
        const children = document.getElementById('list').children;
        let list = [];
        console.log(rule);

        for (let i = 0; i < children.length; i++) {
            let rule = children[i].children[1].innerText
            if (rule.includes('Descending')) {
                rule = `desc(${rule.replace(/\n/g, '').replace('Descending', ')')}`;
            }
            if (rule.includes('Ascending')) {
                rule = `asc(${rule.replace(/\n/g, '').replace('Ascending', ')')}`;
            }
            list = [...list, rule]
        }

        const component = window.livewire.find(lw.id);
        component.call('update', list);
    }
</script>
