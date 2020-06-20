<div>
<h3 class="font-semibold underline">Attributes for faceting</h3>
<p>List of attributes to use for faceting. <a href="#">Learn more</a></p>
<p>Default value: []</p>
<div class="mt-4 p-4 text-gray-700 bg-gray-100 border-t-4 border-primary-500 rounded-sm">
  @if(! count($facets))
    Not configured
  @else
    <ul>
      @foreach($facets as $facet)
        <li class="">{{ $facet }}</li>
      @endforeach
    </ul>
  @endif
</div>
<button wire:click="addAttribute" class="mt-2 p-2 w-full border bg-gray-50 justify-center rounded-sm">+ Add an Attribute</button>
</div>