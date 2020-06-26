<div>
    <h3 class="font-semibold underline">Ranking</h3>
    <p>Controls the way results are sorted. <a href="#">Learn more</a></p>
    <p>Default value: ["typo", "words", "proximity", "attribute", "wordsPosition", "exactness"]</p>
    <button wire:click="resetRankingRules"
            class="mb-2 p-2 bg-primary-500 text-white border shadow rounded hover:bg-primary-300">Reset
    </button>

    <ul id="list">
        @foreach($rules as $rule)
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
                        <span
                            class="inline-block mx-2 font-semibold min-w-20">
                            @if(\Illuminate\Support\Str::contains($rule, 'asc'))
                                {{ \Illuminate\Support\Str::between($rule, 'asc(', ')') }}
                            @elseif(\Illuminate\Support\Str::contains($rule, 'desc'))
                                {{ \Illuminate\Support\Str::between($rule, 'desc(', ')') }}
                            @else
                                {{ $rule }}
                            @endif
                        </span>
                        @if(\Illuminate\Support\Str::contains($rule, 'asc') || \Illuminate\Support\Str::contains($rule, 'desc'))
                            <div x-data="{ open: false }" @click.away="open = false"
                                 class="relative inline-block text-left">
                                <div>
                                    <span class="rounded-md shadow-sm">
                                        <button @click="open = !open" type="button"
                                                class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-sm leading-5 font-medium text-gray-700 hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-50 active:text-gray-800 transition ease-in-out duration-150"
                                                id="options-menu" aria-haspopup="true" aria-expanded="true">
                                            @if(\Illuminate\Support\Str::contains($rule, 'asc'))
                                                Ascending
                                            @else
                                                Descending
                                            @endif
                                            <svg class="-mr-1 ml-2 h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd"
                                                      d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                      clip-rule="evenodd"/>
                                            </svg>
                                        </button>
                                    </span>
                                </div>

                                <div x-show="open"
                                     x-transition:enter="transition ease-out duration-100"
                                     x-transition:enter-start="transform opacity-0 scale-95"
                                     x-transition:enter-end="transform opacity-100 scale-100"
                                     x-transition:leave="transition ease-in duration-75"
                                     x-transition:leave-start="transform opacity-100 scale-100"
                                     x-transition:leave-end="transform opacity-0 scale-95"
                                     class="origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg z-10">
                                    <div class="rounded-md bg-white shadow-xs">
                                        <div class="py-1" role="menu" aria-orientation="vertical"
                                             aria-labelledby="options-menu">
                                            <span wire:click="updateOrder('{{ $rule }}', 'asc')" @click="open = false"
                                                  class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 hover:text-gray-900 focus:outline-none focus:bg-gray-100 focus:text-gray-900"
                                                  role="menuitem">Ascending
                                            </span>
                                            <span wire:click="updateOrder('{{$rule}}', 'desc')" @click="open = false"
                                                  class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 hover:text-gray-900 focus:outline-none focus:bg-gray-100 focus:text-gray-900"
                                                  role="menuitem">Descending
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
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
        <button @click="open = true" class="mt-2 p-2 w-full border bg-gray-50 justify-center rounded-sm">+ Add custom
            ranking attribute
        </button>
        <div class="absolute" x-show="open">
            <x-modal-centered-action>
                <div class="relative rounded-md shadow-sm">
                    <div class="grid grid-cols-1 row-gap-6 col-gap-4 sm:grid-cols-6">
                        <div class="sm:col-span-3">
                            <input required wire:keydown.enter="add" wire:model="word" @keydown.enter="open = false"
                                   class="form-input block w-full sm:text-sm sm:leading-5"
                                   placeholder="Attribute"/>
                        </div>

                        <div class="sm:col-span-3">
                            <select wire:model="order"
                                    class="form-select block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                                <option value="asc">Ascending
                                </option>
                                <option value="desc">Descending
                                </option>
                            </select>
                        </div>
                    </div>
                </div>
                <x-slot name="button">
                    <div class="mt-5 sm:mt-6">
                        <span class="flex w-full rounded-md shadow-sm">
                            <button wire:click="add" @click="open = false;" type="button"
                                    class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-primary-500 text-base leading-6 font-medium text-white shadow-sm hover:bg-gray-800 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                                Add rule attribute
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
            if(rule.includes('Descending')) {
                rule = `desc(${rule.replace('/Descending/', '')})`;
                console.log(rule);
                rule = `desc(bar)`;
            }
            if(rule.includes('Ascending')) {
                rule = `asc(${rule.replace('/\n/g', '').replace('/Ascending/', '')})`;
                console.log(rule)
                rule = `asc(bar)`;
            }
            list = [...list, rule]
        }

        const component = window.livewire.find(lw.id);
        component.call('update', list);
    }
</script>
