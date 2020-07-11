<div>
    <div class="mx-w-screen-xl mx-auto pt-8 flex items-center justify-between">
        <h2 class="font-extrabold tracking-tight text-primary-500 text-2xl leading-10">
            System info
        </h2>
    </div>
    <div class="flex flex-col" wire:poll.3000ms>
        <div class="overflow-x-auto -mx-2 px-2">
            <div class="align-middle inline-block min-w-full overflow-hidden">
                <div class="mt-2">
                    <div class="mb-2">
                        <span class="font-medium text-primary-500">Processor consumption</span>
                        <ul class="ml-2">
                            @foreach($sys['processorUsage'] as $key => $processor)
                                <li><span class="font-light">Thread</span><span class="text-sm font-bold">#{{ $key+1 }}</span> <span class="font-light ml-2">{{$processor}}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="mb-2">
                        <p class="font-medium text-primary-500">System memory <span class="font-light">{{ $sys['global']['totalMemory'] }}</span></p>
                        <p class="font-medium text-primary-500">Memory consumption <span class="font-light">{{ $sys['global']['usedMemory'] }} ({{ $sys['memoryUsage'] }})</span>
                        </p>
                    </div>
                    <div class="mb-2">
                        <p class="font-medium text-primary-500">System swap <span class="font-light">{{ $sys['global']['totalSwap'] }}</span></p>
                        <p class="font-medium text-primary-500">Swap consumption <span class="font-light">{{ $sys['global']['usedSwap'] }}</span></p>
                    </div>
                    <div class="mb-2">
                        <p class="font-medium text-primary-500">Input data <span class="font-light">{{ $sys['global']['inputData'] }}</span></p>
                        <p class="font-medium text-primary-500">Output data <span class="font-light">{{ $sys['global']['outputData'] }}</span></p>
                    </div>
                    <div class="mb-8">
                        <p class="font-medium text-primary-500">Memory process: <span class="font-light">{{ $sys['process']['memory'] }}</span></p>
                        <p class="font-medium text-primary-500">CPU process: <span class="font-light">{{ $sys['process']['cpu'] }}</span></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
