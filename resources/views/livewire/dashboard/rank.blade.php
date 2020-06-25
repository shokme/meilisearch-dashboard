<div>
    <h3 class="font-semibold underline">Ranking</h3>
    <p>Controls the way results are sorted. <a href="#">Learn more</a></p>
    <p>Default value: ["typo", "words", "proximity", "attribute", "wordsPosition", "exactness"]</p>
    <ul>
        @foreach($rules as $rule)
            <li class="cursor-move flex items-center min-h-16 p-2 display-body bg-white border-b border-grqy-100">
                <svg width="24" height="24"
                     class="flex-shrink-0 mr-2 text-gray-300">
                    <path fill="currentColor"
                          d="M22 15c0 .6-.4 1-1 1H3c-.6 0-1-.4-1-1s.4-1 1-1h18c.6 0 1 .4 1 1zM3 10h18c.6 0 1-.4 1-1s-.4-1-1-1H3c-.6 0-1 .4-1 1s.4 1 1 1z"></path>
                </svg>
                <div class="flex-1 overflow-hidden">
                    <div class="flex items-center p-px overflow-hidden">
                        <span class="inline-block mx-2 font-semibold min-w-20">{{ $rule }}</span>
                        <span class="inline-block leading-none">
                            {{--                                <button disabled="" type="button"--}}
                            {{--                                        class="btn inline-flex justify-center items-center px-4 rounded typo-display-body h-8 btn-subtle btn-disabled">--}}
                            {{--                                    <span--}}
                            {{--                                        class="truncate text-center">Ascending</span>--}}
                            {{--                                    <svg--}}
                            {{--                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"--}}
                            {{--                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"--}}
                            {{--                                        stroke-linejoin="round" class="flex-shrink-0 pl-2 text-gray-600">--}}
                            {{--                                        <polyline--}}
                            {{--                                            points="6 9 12 15 18 9"></polyline>--}}
                            {{--                                    </svg>--}}
                            {{--                                </button>--}}
                        </span>
                    </div>
                </div>
                <span class="">
                    <button type="button"
                            class="bg-gray-50 border shadow-sm inline-flex items-center justify-center rounded h-8 w-8 text-md btn-neutral text-gray-600 ml-4"
                            aria-label="Remove Item">
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
    <button wire:click="addAttribute" class="mt-2 p-2 w-full border bg-gray-50 justify-center rounded-sm">+ Add custom
        ranking attribute
    </button>
</div>
