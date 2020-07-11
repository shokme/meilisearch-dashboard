<div class="w-1/3 mt-2">
    <label for="instances" class="font-thin text-gray-700">Select an instance</label>
    <select id="instances" class="font-thin text-gray-700 mt-1 form-select block w-full pl-3 pr-10 py-2 text-base leading-6 border-gray-300 focus:outline-none
    focus:shadow-outline-blue focus:border-blue-300 sm:text-sm sm:leading-5">
        @foreach($instances as $instance)
            <option wire:click="toggle('{{ $instance->host }}')">{{ $instance->host }}</option>
        @endforeach
    </select>
</div>
