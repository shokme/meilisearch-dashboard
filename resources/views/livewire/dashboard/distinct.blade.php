<div>
    <h3 class="font-semibold underline">Attributes for distinct</h3>
    <p>Attribute used for the deduplication by the distinct feature. <a class="underline text-blue-500" href="https://docs.meilisearch.com/guides/advanced_guides/settings.html#distinct-attribute">Learn more</a></p>
    <p>Default value: </p>
    <input wire:keydown.enter="update($event.target.value)"
           class="mt-1 form-input block w-full sm:text-sm sm:leading-5" value="{{ $attribute }}"/>
</div>
