<div class="flex flex-col" wire:poll.3000ms>
    @if($stats['isIndexing'])<div class="p-2 text-white text-center font-bold bg-secondary-500 rounded shadow"><p>Indexing in progress</p></div>@endif
    <div class="overflow-x-auto -mx-2 px-2">
        <div class="align-middle inline-block min-w-full overflow-hidden">
            <div>
                @if($stats['numberOfDocuments'] === 0)
                    <p class="font-medium text-xl">No documents</p>
                @else
                    <p class="font-medium">Number of documents: <span class="font-light">{{ $stats['numberOfDocuments'] }}</span></p>
                @endif
                @if($distribution)
                    <table class="mt-2 min-w-full">
                        <thead>
                        <tr>
                            <th class="px-6 py-3 border-b border-gray-200 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Field
                            </th>
                            <th class="px-6 py-3 border-b border-gray-200 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Value
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($distribution as $key => $value)
                            <tr class="border-b border-gray-200">
                                <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium text-gray-900">
                                    {{ $key }}
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500">
                                    {{ $value }}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
</div>
