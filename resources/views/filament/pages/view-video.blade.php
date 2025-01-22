<x-filament::page>
    <video controls>
        <source src="{{ asset($this->record->video) }}" type="{{ $this->record->video_type }}">
        Your browser does not support the video tag.
    </video>
</x-filament::page>