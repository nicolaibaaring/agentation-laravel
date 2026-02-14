@props(['endpoint' => null])

@if(app()->environment('local'))
    <div
        id="agentation-root"
        @if($endpoint) data-endpoint="{{ $endpoint }}" @endif
    ></div>
    @vite('resources/vendor/agentation-laravel/agentation.js')
@endif
