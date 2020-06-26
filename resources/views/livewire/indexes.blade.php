<div>
  <div class="mx-w-screen-xl mx-auto py-12 px-4 py-6 px-8 flex items-center justify-between" x-data="{ open: false }">
    <h2 class="font-extrabold tracking-tight text-primary-500 text-2xl leading-10">
      Indexes
    </h2>
    <div class="flex lg:flex-shrink-0 mt-0">
      <div class="inline-flex rounded shadow">
        <button @click="open = true" class="inline-flex items-center justify-center px-2 py-1 border border-transparent text-base leading-6 font-medium rounded text-white bg-primary-500 hover:bg-gray-800 focus:outline-none focus:shadow-outline transition duration-150 ease-in-out">Create Index</button>
      </div>
    </div>
    <div class="absolute" x-show="open">
        <x-modal-centered-action :label="'Create Index'">
        <div class="mt-3 relative rounded-md shadow-sm">
            <input required wire:keydown.enter="create" @keydown.enter="open = false;" wire:model="uid" class="form-input block w-full sm:text-sm sm:leading-5" placeholder="Index uid to create"/>
        </div>
        <div class="mt-3 relative rounded-md shadow-sm">
            <input wire:keydown.enter="create" @keydown.enter="open = false;" wire:model="pk" class="form-input block w-full sm:text-sm sm:leading-5" placeholder="Primary Key (optional)"/>
        </div>
            <x-slot name="button">
                <div class="mt-5 sm:mt-6">
            <span class="flex w-full rounded-md shadow-sm">
                <button wire:click="create" @click="open = false;" type="button" class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-primary-500 text-base leading-6 font-medium text-white shadow-sm hover:bg-gray-800 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                    Create
                </button>
            </span>
        </div>
            </x-slot>
        </x-modal-centered-action>
    </div>
  </div>

  <div class="flex flex-col px-8">
    <div class="overflow-x-auto -mx-2 px-2">
      <div class="align-middle inline-block min-w-full shadow overflow-hidden border-b border-gray-200">
        <table class="min-w-full">
          <thead>
          <tr>
            <th class="px-6 py-3 border-b border-gray-200 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
              Index
            </th>
            <th class="px-6 py-3 border-b border-gray-200 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
              Records
            </th>
          </tr>
          </thead>
          <tbody>
          @foreach($indexes as $index)
            <tr class="border-b border-gray-200">
              <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium text-gray-900">
                <a href="/dashboard/indexes/{{$index['uid']}}" class="text-blue-500">{{ $index['uid'] }}</a>
              </td>
              <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500">
                {{ number_format($index['numberOfDocuments'], 0, ',', ' ') }}
              </td>
            </tr>
          @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
