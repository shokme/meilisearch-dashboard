<div>
    @foreach($instances as $instance)
        <li wire:click="toggle('{{ $instance->host }}')">{{ $instance->host }}</li>
    @endforeach
</div>
