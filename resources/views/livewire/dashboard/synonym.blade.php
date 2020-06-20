<div>
  <div class="mb-4">
    <button wire:click="updateSynonyms" class="bg-secondary-500 font-semibold text-white rounded shadow px-2 py-2 text-sm">
      Add Synonym
    </button>
  </div>
  <div class="overflow-x-auto -mx-2 px-2">
    <div class="align-middle inline-block min-w-full overflow-hidden border-b border-gray-200 rounded">
      <table class="min-w-full">
        <thead>
        <tr>
          <th class="px-6 py-3 border border-r-0 border-gray-200 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
            Type
          </th>
          <th class="px-6 py-3 border border-r-0 border-l-0 border-gray-200 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
            Expansion
          </th>
          <th class="px-6 py-3 border border-l-0 border-gray-200 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
          </th>
        </tr>
        </thead>
        <tbody>
        @foreach($synonyms as $key => $synonym)
          <tr class="border border-gray-200 border-b-0">
            <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium text-gray-500">
              Synonym
            </td>
            <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500">
              {{ $key }} @foreach($synonym as $value) <--> {{ $value }}  @endforeach
            </td>
            <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500">
              <button class="p-1 bg-gray-50 border border-gray-200 rounded shadow">
                <svg class="w-5 text-secondary-500" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" viewBox="0 0 24 24" stroke="currentColor">
                  <path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
              </button>
              <button wire:click="deleteSynonyms('{{$key}}')" class="ml-1 p-1  bg-gray-50 border border-gray-200 rounded shadow">
                <svg class="w-5 text-secondary-500" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" viewBox="0 0 24 24" stroke="currentColor">
                  <path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
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
