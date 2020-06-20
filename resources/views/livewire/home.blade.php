<div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
  <div class="max-w-md w-full">
    <form wire:submit.prevent="connect">
      <div class="rounded-md shadow-sm">
        <div>
          <input wire:model="host" aria-label="Host" name="host" type="text" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:shadow-outline-blue focus:border-blue-300 focus:z-10 sm:text-sm sm:leading-5" placeholder="Host" />
        </div>
        <div class="mt-2">
          <input wire:model="key" aria-label="Key (optional)" name="key" type="text" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:shadow-outline-blue focus:border-blue-300 focus:z-10 sm:text-sm sm:leading-5" placeholder="Key (optional)" />
        </div>
      </div>

      <div class="mt-6">
        <button type="submit" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-secondary-600 hover:bg-secondary-500 focus:outline-none focus:border-secondary-700 focus:shadow-outline-indigo active:bg-secondary-700 transition duration-150 ease-in-out">
          Connect
        </button>
      </div>
    </form>
  </div>
</div>